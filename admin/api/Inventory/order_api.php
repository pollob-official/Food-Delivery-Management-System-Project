<?php
class OrderApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["orders"=>Order::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["orders"=>Order::pagination($page,$perpage),"total_records"=>Order::count()]);
	}
	function find($data){
		echo json_encode(["order"=>Order::find($data["id"])]);
	}
	function delete($data){
		Order::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$order=new Order();
		$order->rider_id=$data["rider_id"];
		$order->delivery_address=$data["delivery_address"];
		$order->tracking_id=$data["tracking_id"];
		$order->created_at=$data["created_at"];
		$order->updated_at=$data["updated_at"];
		$order->version=$data["version"];

		$order->save();
		echo json_encode(["success" => "yes"]);
	}
	function save_order($data,$file=[]){
		global $now;
		$order=new Order();
		$order->customer_id=$data["customer_id"];
		$order->rider_id=$data["rider_id"];
		$order->restaurant_id=$data["restaurant_id"];
		$order->delivery_address=$data["delivery_address"];
		$order->total_amount=$data["total_amount"];
		$order->delivery_fee=$data["delivery_fee"];
		$order->tax_amount=$data["tax_amount"];
		$order->coupon_id=$data["coupon_id"];
		$order->payment_status=$data["payment_status"];
		$order->tracking_id=$data["tracking_id"];
		$order->created_at=$now;
		$order->updated_at=$now;
		$order->version=$data["version"];

		$order->save();

		$orderdetail=new OrderDetail();
		$orderdetail->qty=$data["qty"];
		$orderdetail->notes=$data["notes"];
		$orderdetail->created_at=$data["created_at"];

		$orderdetail->save();

		






		echo json_encode(["success" => $data]);
	}
	function update($data,$file=[]){
		$order=new Order();
		$order->id=$data["id"];
		$order->rider_id=$data["rider_id"];
		$order->delivery_address=$data["delivery_address"];
		$order->tracking_id=$data["tracking_id"];
		$order->created_at=$data["created_at"];
		$order->updated_at=$data["updated_at"];
		$order->version=$data["version"];

		$order->update();
		echo json_encode(["success" => "yes"]);
	}
	function update_order_by_tracking_id($data){
		$order=new Order();
		$order->id=$data["id"];
		$order->tracking_id=$data["tracking_id"];
		$order->update_by_tracking_id();
		echo json_encode(["success" => "success"]);
	}
	function update_order_by_rider_id($data){
		$order=new Order();
		$order->id=$data["id"];
		$order->rider_id=$data["rider_id"];
		$order->update_by_rider_id();
		echo json_encode(["success" => $data]);
	}
}
?>
