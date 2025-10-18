<?php
class CustomerController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Customers");
	}
	public function create(){
		view("Customers");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["default_address_id"])){
		$errors["default_address_id"]="Invalid default_address_id";
	}

*/
		if(count($errors)==0){
			$customer=new Customer();
		$customer->name=$data["name"];
		$customer->default_address_id=$data["default_address_id"];
		$customer->created_at=$now;

			$customer->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Customers",Customer::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["default_address_id"])){
		$errors["default_address_id"]="Invalid default_address_id";
	}

*/
		if(count($errors)==0){
			$customer=new Customer();
			$customer->id=$data["id"];
		$customer->name=$data["name"];
		$customer->default_address_id=$data["default_address_id"];
		$customer->created_at=$now;

		$customer->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Customers");
	}
	public function delete($id){
		Customer::delete($id);
		redirect();
	}
	public function show($id){
		view("Customers",Customer::find($id));
	}
}
?>
