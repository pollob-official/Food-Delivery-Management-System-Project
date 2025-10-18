<?php
// echo Page::title(["title"=>"Show Restaurant"]);
// echo Page::body_open();
// echo Html::link(["class"=>"btn btn-success", "route"=>"restaurant", "text"=>"Manage Restaurant"]);
// echo Page::context_open();
// echo Restaurant::html_row_details($id);
// echo Page::context_close();
// echo Page::body_close();

// print_r($restaurant);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Order List</h5>
                    <a href="#" class="btn btn-dashed">Download all orders</a>
                </div>
                <div>
                    <div class="table-responsive theme-scrollbar">
                        <div id="table_id_wrapper" class="dataTables_wrapper no-footer">
                            <div id="table_id_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="table_id"></label></div>
                            <table class="table category-table dataTable no-footer" id="table_id">
                                <thead>
                                    <tr>
                                      
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 102.391px;">Order Code</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 96.5781px;">Date</th>

                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 129.453px;">Delivery Status</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.7969px;">Amount</th>
                                        <th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 114px;">Option</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 94.4531px;">Tracking</th>
                                          <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 108.312px;">Assign Rider</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    foreach ($restaurant as $key => $value) {
                                        $date = date("F d, Y", strtotime($value->created_at));
                                        $status = Tracking::find($value->tracking_id)->name ?? "";
                                        
                                        $tracking = Tracking::html_select("status", $value->tracking_id);
                                        $riders = Rider::html_select("rider", $value->rider_id);
                                        echo "
                                       
                                       
                                    <tr data-bs-toggle=\"offcanvas\" class=\"odd\">
                                       

                                        <td> $value->id</td>

                                        <td>  $date</td>

                                        

                                        <td class=\"order-success\">
                                            <span class=\"font-success f-w-500\"> $status</span>
                                        </td>

                                        <td>$$value->total_amount</td>

                                       <td>
              <a href='$base_url/restaurant/edit/$value->id' class=\"btn btn-sm btn-outline-primary\"><i class=\"bi bi-pencil\"></i></a>
              <a href='$base_url/order/show/$value->id' class=\"btn btn-sm btn-outline-danger\"><i class=\"bi bi-eye\"></i></a>
              <a href='$base_url/restaurant/confirm/$value->id' class=\"btn btn-sm btn-outline-danger\"><i class=\"bi bi-trash\"></i></a>
            </td>
                                        <td>
                                            $tracking
                                        </td>
                                         <td>
                                            <a class=\"d-block\">
                                                <span class=\"order-image\">
                                                   $riders
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                       
                                       
                                       ";
                                    }


                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        $(".status").on("change", function() {
            let status_id = $(this).val();
            let order_id = $(this).closest("tr").find("td").eq(0).text();


            $.ajax({
                url: "<?= $base_url ?>/api/order/update_order_by_tracking_id",
                type: "GET",
                data: {
                    id: order_id,
                    tracking_id: status_id
                },
                success: function(res) {
                    console.log(res);
                    location.reload();
                },
                error: function(err) {
                    console.log(err);

                }
            });


        });

        $(".rider").on("change", function() {
            let rider_id = $(this).val();
            let order_id = $(this).closest("tr").find("td").eq(0).text();
            
          // alert(rider_id);
            

            $.ajax({
                url: "<?= $base_url ?>/api/order/update_order_by_rider_id",
                type: "GET",
                data: {
                    id: order_id,
                    rider_id: rider_id
                },
                success: function(res) {
                    console.log(res);
                   // location.reload();
                },
                error: function(err) {
                    console.log(err);

                }
            });


        });



    })
</script>