<?php
class OrderController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Inventory");
	}
	public function create(){
		view("Inventory");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["id"])){
		$errors["id"]="Invalid id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["customer_id"])){
		$errors["customer_id"]="Invalid customer_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["rider_id"])){
		$errors["rider_id"]="Invalid rider_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["restaurant_id"])){
		$errors["restaurant_id"]="Invalid restaurant_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["delivery_address"])){
		$errors["delivery_address"]="Invalid delivery_address";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_amount"])){
		$errors["total_amount"]="Invalid total_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["delivery_fee"])){
		$errors["delivery_fee"]="Invalid delivery_fee";
	}
	if(!preg_match("/^[\s\S]+$/",$data["tax_amount"])){
		$errors["tax_amount"]="Invalid tax_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["coupon_id"])){
		$errors["coupon_id"]="Invalid coupon_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["tracking_id"])){
		$errors["tracking_id"]="Invalid tracking_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["payment_status"])){
		$errors["payment_status"]="Invalid payment_status";
	}
	if(!preg_match("/^[\s\S]+$/",$data["version"])){
		$errors["version"]="Invalid version";
	}

*/
		if(count($errors)==0){
			$order=new Order();
		$order->id=$data["id"];
		$order->customer_id=$data["customer_id"];
		$order->rider_id=$data["rider_id"];
		$order->restaurant_id=$data["restaurant_id"];
		$order->delivery_address=$data["delivery_address"];
		$order->total_amount=$data["total_amount"];
		$order->delivery_fee=$data["delivery_fee"];
		$order->tax_amount=$data["tax_amount"];
		$order->coupon_id=$data["coupon_id"];
		$order->tracking_id=$data["tracking_id"];
		$order->payment_status=$data["payment_status"];
		$order->created_at=$now;
		$order->updated_at=$now;
		$order->version=$data["version"];

			$order->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",Order::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["id"])){
		$errors["id"]="Invalid id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["customer_id"])){
		$errors["customer_id"]="Invalid customer_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["rider_id"])){
		$errors["rider_id"]="Invalid rider_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["restaurant_id"])){
		$errors["restaurant_id"]="Invalid restaurant_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["delivery_address"])){
		$errors["delivery_address"]="Invalid delivery_address";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_amount"])){
		$errors["total_amount"]="Invalid total_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["delivery_fee"])){
		$errors["delivery_fee"]="Invalid delivery_fee";
	}
	if(!preg_match("/^[\s\S]+$/",$data["tax_amount"])){
		$errors["tax_amount"]="Invalid tax_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["coupon_id"])){
		$errors["coupon_id"]="Invalid coupon_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["tracking_id"])){
		$errors["tracking_id"]="Invalid tracking_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["payment_status"])){
		$errors["payment_status"]="Invalid payment_status";
	}
	if(!preg_match("/^[\s\S]+$/",$data["version"])){
		$errors["version"]="Invalid version";
	}

*/
		if(count($errors)==0){
			$order=new Order();
			$order->id=$data["id"];
		$order->id=$data["id"];
		$order->customer_id=$data["customer_id"];
		$order->rider_id=$data["rider_id"];
		$order->restaurant_id=$data["restaurant_id"];
		$order->delivery_address=$data["delivery_address"];
		$order->total_amount=$data["total_amount"];
		$order->delivery_fee=$data["delivery_fee"];
		$order->tax_amount=$data["tax_amount"];
		$order->coupon_id=$data["coupon_id"];
		$order->tracking_id=$data["tracking_id"];
		$order->payment_status=$data["payment_status"];
		$order->created_at=$now;
		$order->updated_at=$now;
		$order->version=$data["version"];

		$order->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Inventory");
	}
	public function delete($id){
		Order::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",Order::find($id));
	}
}
?>
