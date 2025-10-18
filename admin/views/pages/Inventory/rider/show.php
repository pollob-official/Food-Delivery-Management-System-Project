<?php
// echo Page::title(["title"=>"Show Rider"]);
// echo Page::body_open();
// echo Html::link(["class"=>"btn btn-success", "route"=>"rider", "text"=>"Manage Rider"]);
// echo Page::context_open();
// echo Rider::html_row_details($id);
// echo Page::context_close();
// echo Page::body_close();


$rider = $data["rider"];
$orders = $data["orders"];
?>

<div class="row">
  <!-- Rider Info -->
  <div class="col-xxl-3 col-md-4">
    <div class="card text-center p-3">
      <img src="<?= $base_url ?>/img/<?= $rider->photo ?>" alt="Rider Photo"
           class="rounded-circle mx-auto" style="width:100px; height:100px; object-fit:cover;">
      <h5 class="mt-3"><?= htmlspecialchars($rider->name) ?></h5>
      <p class="text-muted mb-1"><?= htmlspecialchars($rider->vehicle_type) ?> - <?= htmlspecialchars($rider->car_number) ?></p>
      <p class="small <?= $rider->is_available ? 'text-success' : 'text-danger' ?>">
        <?= $rider->is_available ? 'Available' : 'Not Available' ?>
      </p>
      <div class="d-flex justify-content-center gap-2">
        <a href="<?= $base_url ?>/rider/edit/<?= $rider->id ?>" class="btn btn-sm btn-outline-primary">Edit Profile</a>
        <a href="<?= $base_url ?>/logout" class="btn btn-sm btn-outline-danger">Logout</a>
      </div>
    </div>
  </div>

  <!-- Orders Table -->
  <div class="col-xxl-9 col-md-8">
    <div class="card card-table">
      <div class="card-body">
        <div class="title-header option-title d-flex justify-content-between align-items-center">
          <h5>My Assigned Orders</h5>
          <a href="#" class="btn btn-dashed btn-sm">Download</a>
          <div> 
            <form action="<?= $base_url?>/rider/show/<?=$rider->id?>" method="Get">
              <?php 
              $tracking= $_GET['tracking_order'];
              echo Tracking::html_select("tracking_order",  $tracking)
              

              
              ?> 
              <button type="submit" class="btn btn-dashed btn-sm">search</button>
            </form>
         
        
        </div>
        </div>

        <div class="table-responsive theme-scrollbar">
          <table class="table category-table dataTable no-footer">
            <thead>
              <tr>
                <th>Order Code</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Update Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($orders) {
                foreach ($orders as $order) {
                  $date = date("M d, Y", strtotime($order->created_at));
                  $status = Tracking::find($order->tracking_id)->name ?? "Pending";
                  $statusSelect = Tracking::html_select("status", $order->tracking_id);
                  echo "
                  <tr>
                    <td>$order->id</td>
                    <td>$date</td>
                    <td>$order->customer_id</td>
                    <td>$order->delivery_address</td>
                    <td>$$order->total_amount</td>
                    <td><span class='badge bg-info'>$status</span></td>
                    <td>$statusSelect</td>
                  </tr>";
                }
              } else {
                echo "<tr><td colspan='7' class='text-center text-muted'>No orders assigned yet</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  $(".status").on("change", function(){
    let status_id = $(this).val();
    let order_id = $(this).closest("tr").find("td").eq(0).text();

    $.ajax({
      url: "<?= $base_url ?>/api/order/update_order_by_tracking_id",
      type: "GET",
      data: { id: order_id, tracking_id: status_id },
      success: function(res){
        console.log(res);
        location.reload();
      },
      error: function(err){
        console.log(err);
      }
    });
  });


  // $(".tracking_order").on("change", function(){
  //   let tracking_id = $(this).val();
  //   let rider_id= "<?= $rider->id?>" 
  //   alert(rider_id);
   

  //   $.ajax({
  //     url: `<?= $base_url ?>rider/show/${rider_id}?tracking_id=${tracking_id}`,
  //     type: "GET",
  //     data: {},
  //     success: function(res){
  //       console.log(res);
  //       location.reload();
  //     },
  //     error: function(err){
  //       console.log(err);
  //     }
  //   });
  // });
});
</script>
