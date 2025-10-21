<?php
// show.php (Inventory Order View - Using menu_items)

// -------------- DB Connection --------------
if (!isset($db) || !$db instanceof mysqli) {
    $try_path = __DIR__ . '/../../../../../../configs/db_config.php';
    if (file_exists($try_path)) require_once($try_path);

    if (!isset($db) || !$db instanceof mysqli) {
        $db = new mysqli("localhost", "root", "", "food_delivery");
        if ($db->connect_error) die("DB Connection error: " . $db->connect_error);
    }
}

// -------------- Get Order ID --------------
$orderId = intval($_GET['id'] ?? $id ?? ($data->id ?? 0));
if (!$orderId) {
    echo "<div class='alert alert-danger'>Invalid order id.</div>";
    return;
}

// -------------- Load Order --------------
$stmt = $db->prepare("SELECT * FROM orders WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$order = $stmt->get_result()->fetch_object();
$stmt->close();

if (!$order) {
    echo "<div class='alert alert-warning'>Order not found.</div>";
    return;
}

// -------------- Load Related Entities --------------
$customer = $db->query("SELECT * FROM customers WHERE id = " . intval($order->customer_id))->fetch_object() ?? null;
$restaurant = $db->query("SELECT * FROM restaurants WHERE id = " . intval($order->restaurant_id))->fetch_object() ?? null;
$rider = $db->query("SELECT * FROM riders WHERE id = " . intval($order->rider_id))->fetch_object() ?? null;

// -------------- Load Order Items --------------
$items = [];
$stmt = $db->prepare("
    SELECT od.*, mi.name AS item_name 
    FROM order_details od 
    LEFT JOIN menu_items mi ON od.menu_item_id = mi.id
    WHERE od.order_id = ?");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_object()) {
    $items[] = (object)[
        'id' => $row->id,
        'menu_item_id' => $row->menu_item_id,
        'item_name' => $row->item_name ?? 'Unknown Item',
        'qty' => floatval($row->qty ?? 1),
        'price' => floatval($row->unit_price ?? 0),
        'line_total' => floatval($row->total_price ?? 0)
    ];
}
$stmt->close();

// -------------- Calculations --------------
$subtotal = array_sum(array_map(fn($it) => $it->line_total, $items));
$delivery_fee = floatval($order->delivery_fee ?? 0);
$tax_amount = floatval($order->tax_amount ?? 0);
$coupon_discount = floatval($order->coupon_discount ?? 0); // if stored on order
// fallback if order stores total_amount already, keep consistent:
// $grand_total = floatval($order->total_amount ?? (($subtotal + $tax_amount + $delivery_fee) - $coupon_discount));
$grand_total = ($subtotal + $tax_amount + $delivery_fee) - $coupon_discount;
?>

<style>
/* Page look */
body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
.invoice { background: #fff; padding: 2rem; border-radius: .5rem; box-shadow: 0 6px 18px rgba(0,0,0,.06); max-width: 1000px; margin: 2rem auto; }
.table thead th { border-bottom: 2px solid #e9ecef; }
.no-break { page-break-inside: avoid; }

/* Notes styling (on-screen) */
textarea.note-field { width:100%; border:1px solid #ddd; border-radius:.25rem; padding:.5rem; resize:none; }

/* Totals small screen tweak */
.totals-box { min-width:320px; }

/* -------- PRINT STYLES -------- */
@media print {
    /* hide everything except invoice */
    body * { visibility: hidden; }

    #printable-invoice, #printable-invoice * { visibility: visible; }

    /* place invoice full-page, remove shadows/padding that cause overflow */
    #printable-invoice {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 0;      /* reduce to avoid overflow */
        margin: 0;
        box-shadow: none;
        border-radius: 0;
        background: #fff;
        overflow: hidden;
    }

    /* page sizing exact A4 */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
        width: 210mm;
        height: 297mm;
        overflow: hidden;
    }

    /* hide admin layout pieces if present */
    .sidebar, .topbar, .navbar, .no-print { display: none !important; }

    /* Make inputs/textarea print like plain text (no box) */
    textarea, input, select {
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        color: #000 !important;
        resize: none !important;
        -webkit-appearance: none;
        appearance: none;
    }

    /* tighten up padding so content fits on single page */
    .invoice { padding: 10mm !important; border-radius: 0 !important; }

    @page { size: A4; margin: 5mm; }
}
</style>

<div id="printable-invoice" class="invoice">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3 style="margin:0">Zomo Food Delivery</h3>
            <small class="text-muted">Dhaka, Bangladesh</small><br>
            <small class="text-muted">Phone: +8801234567890 · Email: support@zomo.com</small>
        </div>
        <div class="text-end">
            <h4 style="margin:0">INVOICE</h4>
            <small>#<?= str_pad(intval($order->id), 4, '0', STR_PAD_LEFT) ?></small><br>
            <small>Date: <?= date("d-m-Y", strtotime($order->created_at)) ?></small>
        </div>
    </div>

    <!-- Addresses -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <h6 style="margin-bottom:.25rem">Bill To</h6>
            <strong><?= htmlspecialchars($customer->name ?? 'Unknown Customer') ?></strong><br>
            <small><?= nl2br(htmlspecialchars($order->delivery_address ?? '')) ?></small><br>
            <small>Phone: <?= htmlspecialchars($customer->phone ?? 'N/A') ?></small>
        </div>
        <div class="col-sm-6 text-sm-end">
            <h6 style="margin-bottom:.25rem">Restaurant</h6>
            <strong><?= htmlspecialchars($restaurant->name ?? 'Unknown Restaurant') ?></strong><br>
            <small><?= htmlspecialchars($restaurant->address ?? '') ?></small><br>
            <small>Phone: <?= htmlspecialchars($restaurant->phone ?? 'N/A') ?></small>
        </div>
    </div>

    <!-- Items table -->
    <div class="table-responsive mb-3 no-break">
        <table class="table align-middle" style="margin-bottom:0">
            <thead class="table-light">
                <tr>
                    <th style="width:40px">#</th>
                    <th>Description</th>
                    <th style="width:80px">Qty</th>
                    <th style="width:120px">Unit Price</th>
                    <th style="width:120px">Line Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                    <tr><td colspan="5" class="text-center text-muted">No items found for this order.</td></tr>
                <?php else: $i = 1; foreach ($items as $it): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= htmlspecialchars($it->item_name) ?></td>
                        <td><?= $it->qty ?></td>
                        <td style="text-align:right"><?= number_format($it->price, 2) ?></td>
                        <td style="text-align:right"><?= number_format($it->line_total, 2) ?></td>
                    </tr>
                <?php $i++; endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Totals block (the section you asked for) -->
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="totals-box" style="min-width:320px;">
            <div class="row g-2">
                <div class="col-6 text-muted">Subtotal</div>
                <div class="col-6 text-end fw-semibold"><?= number_format($subtotal, 2) ?></div>

                <div class="col-6 text-muted">Tax</div>
                <div class="col-6 text-end"><?= number_format($tax_amount, 2) ?></div>

                <div class="col-6 text-muted">Delivery Fee</div>
                <div class="col-6 text-end"><?= number_format($delivery_fee, 2) ?></div>

                <div class="col-6 text-muted">Coupon Discount</div>
                <div class="col-6 text-end">-<?= number_format($coupon_discount, 2) ?></div>

                <div class="col-12"><hr style="margin: .5rem 0"></div>

                <div class="col-6 text-muted fs-5">Total</div>
                <div class="col-6 text-end fs-5 fw-bold"><?= number_format($grand_total, 2) ?></div>
            </div>
        </div>
    </div>

    <!-- Notes -->
    <div class="mb-4">
        <label class="form-label" style="font-weight:600; display:block; margin-bottom:.25rem">Notes</label>
        <!-- keep editable on-screen, but prints as plain text -->
        <textarea class="note-field" rows="3"><?= htmlspecialchars($order->notes ?? 'Thank you for ordering with Zomo!') ?></textarea>
    </div>

    <!-- Footer/buttons (hidden on print) -->
    <div class="d-flex justify-content-between align-items-center no-print">
        <div><small class="text-muted">Payment Status: <?= htmlspecialchars(ucfirst($order->payment_status ?? 'unknown')) ?></small></div>
        <div>
            <button onclick="window.print()" class="btn btn-success me-2">Print / Save PDF</button>
        </div>
    </div>
</div>


