<?php
class CustomerController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}

*/
		if(count($errors)==0){
			$customer=new Customer();
		$customer->name=$data["name"];
		$customer->email=$data["email"];
		$customer->phone=$data["phone"];
		$customer->created_at=$now;

			$customer->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",Customer::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}

*/
		if(count($errors)==0){
			$customer=new Customer();
			$customer->id=$data["id"];
		$customer->name=$data["name"];
		$customer->email=$data["email"];
		$customer->phone=$data["phone"];
		$customer->created_at=$now;

		$customer->update();
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
		Customer::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",Customer::find($id));
	}
}
?>
