<?php



// ----------------- MenuItem Helper -----------------
// class MenuItemHelper {
//     public static function html_select($id="menuItemsSelect", $restaurant_id=null){
//         global $db;
//         $html = "<select class='form-select' id='$id' name='menu_item_id'>";
//         $html .= "<option value=''>Select Menu Item</option>";
//         $sql = "SELECT id, name, price FROM menu_items WHERE 1";
//         if($restaurant_id) $sql .= " AND restaurant_id=" . intval($restaurant_id);
//         $result = $db->query($sql);
//         while($menuitem = $result->fetch_object()){
//             $price = number_format($menuitem->price, 2, '.', '');
//             $html .= "<option value='{$menuitem->id}' data-price='{$price}'>{$menuitem->name} - {$price}</option>";
//         }
//         $html .= "</select>";
//         return $html;
//     }
// }
?>

<style>
.invoice { background:#fff; padding:2rem; border-radius:.5rem; box-shadow:0 6px 18px rgba(0,0,0,.06); max-width:1000px; margin:auto; }
.table thead th { border-bottom:2px solid #e9ecef; }
.table input[type="number"], .table input[type="text"] { width:100%; min-width:0; box-shadow:none; border:none; background:transparent; padding:.25rem 0; }
.table input:focus { outline:none; }
</style>

<div class="invoice">
    <h3>Create New Order</h3>
    <form id="orderForm" method="POST" action="">

        <!-- Customer & Restaurant -->
        <div class="row mb-3">
            <div class="col-md-6">
                <?php
                
                 echo  Customer::html_select("customer_id");
                
                ?>
            </div>
            <div class="col-md-6">
                <?php
                
                    echo  Restaurant::html_select("restaurant_id");
                
                ?>
                 
            </div>
        </div>

        <!-- Delivery Address -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label>Delivery Address</label>
                <textarea name="delivery_address" id="deliveryAddress" class="form-control" rows="2" required></textarea>
            </div>
        </div>

        <!-- Add Item Section -->
        <div class="row mb-3">
            <div class="col-md-8">
                <?= MenuItem::html_select("menu_id") ?>
            </div>
            <div class="col-md-2">
                <label>Quantity</label>
                <input type="number" id="itemQty" value="1" min="1" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" id="addItemBtn" class="btn btn-primary w-100">Add Item</button>
            </div>
        </div>

        <!-- Order Summary Table -->
        <div class="table-responsive mb-3">
            <table class="table table-bordered" id="orderSummary">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Line Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="6" class="text-center">No items added</td></tr>
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="d-flex justify-content-end mb-3">
            <div style="min-width:300px;">
                <div class="row g-2">
                    <div class="col-6 text-muted">Subtotal</div><div class="col-6 text-end" id="subtotal">0.00</div>
                    <div class="col-6 text-muted">Tax (5%)</div><div class="col-6 text-end" id="tax">0.00</div>
                    <div class="col-6 text-muted">Delivery Fee</div>
                    <div class="col-6 text-end"><input type="number" name="delivery_fee" id="deliveryFee" value="50" class="form-control form-control-sm"></div>
                    <hr>
                    <div class="col-6 text-muted fs-5">Grand Total</div><div class="col-6 text-end fs-5 fw-bold" id="grandTotal">0.00</div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success" name="create">Save Order</button>
    </form>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let orderItems = [];

function updateOrderTable() {
    const tbody = $("#orderSummary tbody");
    tbody.empty();
    let subtotal = 0;
    if(orderItems.length === 0){
        tbody.append('<tr><td colspan="6" class="text-center">No items added</td></tr>');
    } else {
        orderItems.forEach((item,i)=>{
            const lineTotal = (item.price*item.qty).toFixed(2);
            subtotal += parseFloat(lineTotal);
            tbody.append(`<tr>
                <td>${i+1}</td>
                <td>${item.name}<input type="hidden" name="items[${i}][menu_item_id]" value="${item.id}"></td>
                <td>${item.qty}<input type="hidden" name="items[${i}][qty]" value="${item.qty}"></td>
                <td>${item.price.toFixed(2)}</td>
                <td>${lineTotal}</td>
                <td><button type="button" class="btn btn-danger btn-sm removeItem" data-index="${i}">Remove</button></td>
            </tr>`);
        });
    }
    const tax = subtotal*0.05;
    const delivery = parseFloat($("#deliveryFee").val()||0);
    $("#subtotal").text(subtotal.toFixed(2));
    $("#tax").text(tax.toFixed(2));
    $("#grandTotal").text((subtotal+tax+delivery).toFixed(2));
}

$(document).ready(function(){
    // Change restaurant -> reload menu items
    $("#restaurantSelect").change(function(){
        const restaurant_id = $(this).val();
        if(!restaurant_id) return $("#menuItemsSelect").html('<option value="">Select Menu Item</option>');
        $.getJSON('create.php', {action:'fetch_menu', restaurant_id:restaurant_id}, function(data){
            let options = '<option value="">Select Menu Item</option>';
            data.forEach(m => options += `<option value="${m.id}" data-price="${m.price}">${m.name} - ${m.price.toFixed(2)}</option>`);
            $("#menuItemsSelect").html(options);
        });
    });

    // Add Item Button
    $("#addItemBtn").click(function(){
        const selected = $("#menu_id option:selected");
        const id = selected.val();
        const name = selected.text();
        const price = parseFloat(selected.data("price") || 0);
        const qty = parseInt($("#itemQty").val() || 1);
        if(!id) return alert("Select a menu item");
        orderItems.push({id,name,price,qty});
        updateOrderTable();
    });

    // Remove Item
    $("#orderSummary").on("click",".removeItem", function(){
        const index = $(this).data("index");
        orderItems.splice(index,1);
        updateOrderTable();
    });

    // Update totals on delivery fee change
    $("#deliveryFee").on("input", updateOrderTable);

    // Fetch last delivery address on customer select
    $("#customerSelect").change(function(){
        const customer_id = $(this).val();
        if(!customer_id){
            $("#deliveryAddress").val('');
            return;
        }
        $.ajax({
            url: "fetch_address.php",
            type: "GET",
            data: { customer_id: customer_id },
            dataType: "json",
            success: function(res){
                $("#deliveryAddress").val(res.address || '');
            }
        });
    });

    $("#orderForm").on("submit", function(e){
    e.preventDefault();

    let customer_id = $("#customer_id").val();
    let restaurant_id = $("#restaurant_id").val();
    let delivery_address = $("#deliveryAddress").val();
    let delivery_fee = parseFloat($("#deliveryFee").val() || 0);
    let subtotal = parseFloat($("#subtotal").text() || 0);
    let tax_amount = parseFloat($("#tax").text() || 0);
    let total_amount = parseFloat($("#grandTotal").text() || 0);
    let payment_status = 'unpaid';
    let tracking_id = 1; // default 'pending' status
    let version = 1;

    if(orderItems.length === 0){
        alert("Please add at least one item to the order.");
        return;
    }

    $.ajax({
        url: "<?=$base_url?>/api/order/save_order",
        type: "POST",
        data: {
            customer_id,
            restaurant_id,
            delivery_address,
            delivery_fee,
            subtotal,
            tax_amount,
            total_amount,
            payment_status,
            tracking_id,
            version,
            items: orderItems
        },
        success: function(res){
            console.log("Order Saved:", res);
            alert("Order successfully saved!");
            location.reload();
        },
        error: function(err){
            console.log(err);
            alert("Failed to save order.");
        }
    });
});

       

});
</script>
