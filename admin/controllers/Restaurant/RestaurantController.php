<?php
class RestaurantController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Restaurant");
	}
	public function create(){
		view("Restaurant");
	}
public function save($data,$file){
	global $now;
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["id"])){
		$errors["id"]="Invalid id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["user_id"])){
		$errors["user_id"]="Invalid user_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}
	if(!preg_match("/^[\s\S]+$/",$data["address"])){
		$errors["address"]="Invalid address";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOpenHours"])){
		$errors["open_hours"]="Invalid open_hours";
	}
	if(!preg_match("/^[\s\S]+$/",$data["is_active"])){
		$errors["is_active"]="Invalid is_active";
	}

*/
		if(count($errors)==0){
			$restaurant=new Restaurant();
		$restaurant->id=$data["id"];
		$restaurant->user_id=$data["user_id"];
		$restaurant->name=$data["name"];
		$restaurant->description=$data["description"];
		$restaurant->phone=$data["phone"];
		$restaurant->address=$data["address"];
		$restaurant->open_hours=$data["open_hours"];
		$restaurant->is_active=isset($data["is_active"])?1:0;
		$restaurant->created_at=$now;

			$restaurant->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Restaurant",Restaurant::find($id));
}
public function update($data,$file){
	global $now;
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["id"])){
		$errors["id"]="Invalid id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["user_id"])){
		$errors["user_id"]="Invalid user_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}
	if(!preg_match("/^[\s\S]+$/",$data["address"])){
		$errors["address"]="Invalid address";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOpenHours"])){
		$errors["open_hours"]="Invalid open_hours";
	}
	if(!preg_match("/^[\s\S]+$/",$data["is_active"])){
		$errors["is_active"]="Invalid is_active";
	}

*/
		if(count($errors)==0){
			$restaurant=new Restaurant();
			$restaurant->id=$data["id"];
		$restaurant->id=$data["id"];
		$restaurant->user_id=$data["user_id"];
		$restaurant->name=$data["name"];
		$restaurant->description=$data["description"];
		$restaurant->phone=$data["phone"];
		$restaurant->address=$data["address"];
		$restaurant->open_hours=$data["open_hours"];
		$restaurant->is_active=isset($data["is_active"])?1:0;
		$restaurant->created_at=$now;

		$restaurant->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Restaurant");
	}
	public function delete($id){
		Restaurant::delete($id);
		redirect();
	}
	public function show($id){
		view("Restaurant",Restaurant::find_order_by_restuarant_id($id));
	}
}
?>
