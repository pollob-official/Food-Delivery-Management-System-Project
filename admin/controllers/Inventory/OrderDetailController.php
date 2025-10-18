<?php
class OrderDetailController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["order_id"])){
		$errors["order_id"]="Invalid order_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["menu_item_id"])){
		$errors["menu_item_id"]="Invalid menu_item_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["qty"])){
		$errors["qty"]="Invalid qty";
	}
	if(!preg_match("/^[\s\S]+$/",$data["unit_price"])){
		$errors["unit_price"]="Invalid unit_price";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_price"])){
		$errors["total_price"]="Invalid total_price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtNotes"])){
		$errors["notes"]="Invalid notes";
	}

*/
		if(count($errors)==0){
			$orderdetail=new OrderDetail();
		$orderdetail->id=$data["id"];
		$orderdetail->order_id=$data["order_id"];
		$orderdetail->menu_item_id=$data["menu_item_id"];
		$orderdetail->qty=$data["qty"];
		$orderdetail->unit_price=$data["unit_price"];
		$orderdetail->total_price=$data["total_price"];
		$orderdetail->notes=$data["notes"];
		$orderdetail->created_at=$now;

			$orderdetail->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",OrderDetail::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["id"])){
		$errors["id"]="Invalid id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["order_id"])){
		$errors["order_id"]="Invalid order_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["menu_item_id"])){
		$errors["menu_item_id"]="Invalid menu_item_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["qty"])){
		$errors["qty"]="Invalid qty";
	}
	if(!preg_match("/^[\s\S]+$/",$data["unit_price"])){
		$errors["unit_price"]="Invalid unit_price";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_price"])){
		$errors["total_price"]="Invalid total_price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtNotes"])){
		$errors["notes"]="Invalid notes";
	}

*/
		if(count($errors)==0){
			$orderdetail=new OrderDetail();
			$orderdetail->id=$data["id"];
		$orderdetail->id=$data["id"];
		$orderdetail->order_id=$data["order_id"];
		$orderdetail->menu_item_id=$data["menu_item_id"];
		$orderdetail->qty=$data["qty"];
		$orderdetail->unit_price=$data["unit_price"];
		$orderdetail->total_price=$data["total_price"];
		$orderdetail->notes=$data["notes"];
		$orderdetail->created_at=$now;

		$orderdetail->update();
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
		OrderDetail::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",OrderDetail::find($id));
	}
}
?>
