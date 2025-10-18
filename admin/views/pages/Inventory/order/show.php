<?php
// show.php (Inventory order view)
// Replace your existing view file with this. It ensures $db is available and then
// loads order, customer and order details to render the invoice-like page.

// -------------- Ensure DB connection is available --------------
if (!isset($db) || !$db instanceof mysqli) {
    // Try to include a project db_config. Adjust this path if your config is elsewhere.
    // Typical path from admin/views/pages/... to project root: go up 5 directories to reach project root.
    $try_path = __DIR__ . '/../../../../../../configs/db_config.php';
    if (file_exists($try_path)) {
        require_once($try_path);
    }

    // If still not set, create a local connection (fallback).
    if (!isset($db) || !$db instanceof mysqli) {
        // <-- Adjust credentials if needed for your environment -->
        $db = new mysqli("localhost", "root", "", "food_delivery");
        if ($db->connect_error) {
            die("DB Connection error: " . $db->connect_error);
        }
    }
}

// -------------- Helpers / input --------------
$orderId = null;

// Try to get order id from passed variables (commonly $data or $params in controllers)
if (isset($data) && is_object($data) && isset($data->id)) {
    $orderId = intval($data->id);
} elseif (isset($_GET['id'])) {
    $orderId = intval($_GET['id']);
} elseif (isset($id)) {
    $orderId = intval($id);
}

if (!$orderId || $orderId <= 0) {
    echo "<div class='alert alert-danger'>Invalid order id.</div>";
    return;
}

// -------------- Load order --------------
$stmt = $db->prepare("SELECT * FROM orders WHERE id = ? LIMIT 1");
if (!$stmt) {
    echo "<div class='alert alert-danger'>DB prepare error: " . htmlspecialchars($db->error) . "</div>";
    return;
}
$stmt->bind_param("i", $orderId);
$stmt->execute();
$orderRes = $stmt->get_result();
$order = $orderRes->fetch_object();
$stmt->close();

if (!$order) {
    echo "<div class='alert alert-warning'>Order not found.</div>";
    return;
}

// -------------- Load customer, restaurant, rider (if present) --------------
$customer = null;
if (!empty($order->customer_id)) {
    $stmt = $db->prepare("SELECT * FROM customers WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $order->customer_id);
        $stmt->execute();
        $cres = $stmt->get_result();
        $customer = $cres->fetch_object();
        $stmt->close();
    }
}

$restaurant = null;
if (!empty($order->restaurant_id)) {
    $stmt = $db->prepare("SELECT * FROM restaurants WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $order->restaurant_id);
        $stmt->execute();
        $rres = $stmt->get_result();
        $restaurant = $rres->fetch_object();
        $stmt->close();
    }
}

$rider = null;
if (!empty($order->rider_id)) {
    $stmt = $db->prepare("SELECT * FROM riders WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $order->rider_id);
        $stmt->execute();
        $rres2 = $stmt->get_result();
        $rider = $rres2->fetch_object();
        $stmt->close();
    }
}

// -------------- Load order details (items) --------------
$items = [];
$stmt = $db->prepare("SELECT * FROM order_details WHERE order_id = ?");
if ($stmt) {
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $dres = $stmt->get_result();
    while ($row = $dres->fetch_object()) {
        // try fetch product name if product_id exists
        $product_name = "Unknown product";
        if (!empty($row->product_id)) {
            $pstmt = $db->prepare("SELECT name FROM products WHERE id = ? LIMIT 1");
            if ($pstmt) {
                $pstmt->bind_param("i", $row->product_id);
                $pstmt->execute();
                $pres = $pstmt->get_result();
                $pobj = $pres->fetch_object();
                if ($pobj && isset($pobj->name)) $product_name = $pobj->name;
                $pstmt->close();
            }
        } elseif (!empty($row->product_name)) {
            $product_name = $row->product_name;
        }

        $items[] = (object)[
            'id' => $row->id,
            'product_id' => $row->product_id ?? null,
            'product_name' => $product_name,
            'qty' => isset($row->qty) ? (float)$row->qty : (float)($row->quantity ?? 1),
            'price' => isset($row->price) ? (float)$row->price : (float)($row->unit_price ?? 0),
            'line_total' => (isset($row->price) && isset($row->qty)) ? ($row->price * $row->qty) : (isset($row->line_total) ? $row->line_total : 0)
        ];
    }
    $stmt->close();
}

// -------------- Calculations --------------
$subtotal = 0;
foreach ($items as $it) {
    $subtotal += floatval($it->line_total);
}
$delivery_fee = isset($order->delivery_fee) ? floatval($order->delivery_fee) : 0;
$tax_amount = isset($order->tax_amount) ? floatval($order->tax_amount) : 0;
$coupon_discount = 0;
if (!empty($order->coupon_id)) {
    // Simple assumption: coupon stored elsewhere; default small discount for demonstration
    $coupon_discount = 0; // adjust if you have coupon logic
}
$grand_total = ($order->total_amount ?? $subtotal) + $delivery_fee + $tax_amount - $coupon_discount;

// -------------- Render HTML (invoice) --------------
?>
<style>
/* Small visual tweaks - you can move to global CSS */
.invoice { background:#fff;padding:2rem;border-radius:.5rem;box-shadow:0 6px 18px rgba(0,0,0,.06); max-width:1000px;margin:auto; }
.table thead th { border-bottom: 2px solid #e9ecef; }
.no-break { page-break-inside: avoid; }
@media print { .no-print { display:none !important; } .invoice{box-shadow:none;border:none;margin:0;border-radius:0;} }
.table input[type="number"], .table input[type="text"] { width:100%; min-width:0; box-shadow:none; border:none; background:transparent; padding:.25rem 0; }
.table input:focus { outline:none; }
</style>

<div class="invoice">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3 class="mb-0">Zomo Food Delivery</h3>
            <small class="text-muted">Dhaka, Bangladesh</small><br>
            <small class="text-muted">Phone: +8801234567890 · Email: support@zomo.com</small>
        </div>
        <div class="text-end">
            <h4 class="mb-0">INVOICE</h4>
            <small class="text-muted">#<?= htmlspecialchars(str_pad($order->id, 4, '0', STR_PAD_LEFT)) ?></small><br>
            <small class="text-muted">Date: <?= htmlspecialchars(date("d-m-Y", strtotime($order->created_at))) ?></small>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-6">
            <h6 class="mb-1">Bill To</h6>
            <strong><?= htmlspecialchars($customer->name ?? 'Unknown Customer') ?></strong><br>
            <small><?= nl2br(htmlspecialchars($order->delivery_address ?? ($customer->address ?? ''))) ?></small><br>
            <small>Phone: <?= htmlspecialchars($customer->phone ?? 'N/A') ?></small>
        </div>
        <div class="col-sm-6 text-sm-end">
            <h6 class="mb-1">Restaurant</h6>
            <strong><?= htmlspecialchars($restaurant->name ?? 'Unknown Restaurant') ?></strong><br>
            <small><?= htmlspecialchars($restaurant->address ?? '') ?></small><br>
            <small>Phone: <?= htmlspecialchars($restaurant->phone ?? 'N/A') ?></small>
        </div>
    </div>

    <div class="table-responsive mb-3 no-break">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:55%">Description</th>
                    <th style="width:10%">Qty</th>
                    <th style="width:15%">Unit Price</th>
                    <th style="width:15%">Line Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($items) === 0): ?>
                    <tr><td colspan="5" class="text-center text-muted">No items found for this order.</td></tr>
                <?php else: ?>
                    <?php $i=1; foreach ($items as $it): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= htmlspecialchars($it->product_name) ?></td>
                            <td><?= htmlspecialchars($it->qty) ?></td>
                            <td><?= htmlspecialchars(number_format($it->price,2)) ?></td>
                            <td><?= htmlspecialchars(number_format($it->line_total,2)) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end align-items-center mb-3 no-print">
        <div style="min-width:320px;">
            <div class="row g-2">
                <div class="col-6 text-muted">Subtotal</div><div class="col-6 text-end fw-semibold"><?= number_format($subtotal,2) ?></div>

                <div class="col-6 text-muted">Tax</div><div class="col-6 text-end"><?= number_format($tax_amount,2) ?></div>

                <div class="col-6 text-muted">Delivery Fee</div><div class="col-6 text-end"><?= number_format($delivery_fee,2) ?></div>

                <div class="col-6 text-muted">Coupon Discount</div><div class="col-6 text-end">-<?= number_format($coupon_discount,2) ?></div>

                <hr>

                <div class="col-6 text-muted fs-5">Total</div><div class="col-6 text-end fs-5 fw-bold"><?= number_format($grand_total,2) ?></div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Notes</label>
        <textarea class="form-control" rows="3">Thank you for ordering with Zomo!</textarea>
    </div>

    <div class="d-flex justify-content-between align-items-center no-print">
        <div><small class="text-muted">Payment Status: <?= htmlspecialchars(ucfirst($order->payment_status ?? 'unknown')) ?></small></div>
        <div>
            <button onclick="window.print()" class="btn btn-success me-2">Print / Save PDF</button>
            <a class="btn btn-primary" href="#">Download HTML</a>
        </div>
    </div>
</div>
