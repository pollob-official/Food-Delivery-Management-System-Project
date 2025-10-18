<?php
class MenuItemController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["restaurant_id"])){
		$errors["restaurant_id"]="Invalid restaurant_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}
	if(!preg_match("/^[\s\S]+$/",$data["price"])){
		$errors["price"]="Invalid price";
	}
	if(!preg_match("/^[\s\S]+$/",$data["is_available"])){
		$errors["is_available"]="Invalid is_available";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCategory"])){
		$errors["category"]="Invalid category";
	}
	if(!preg_match("/^[\s\S]+$/",$data["photo"])){
		$errors["photo"]="Invalid photo";
	}

*/
		if(count($errors)==0){
			$menuitem=new MenuItem();
		$menuitem->id=$data["id"];
		$menuitem->restaurant_id=$data["restaurant_id"];
		$menuitem->name=$data["name"];
		$menuitem->description=$data["description"];
		$menuitem->price=$data["price"];
		$menuitem->is_available=isset($data["is_available"])?1:0;
		$menuitem->category=$data["category"];
		$menuitem->photo=File::upload($file["photo"], "img",$data["id"]);
	

			$menuitem->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",MenuItem::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["id"])){
		$errors["id"]="Invalid id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["restaurant_id"])){
		$errors["restaurant_id"]="Invalid restaurant_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}
	if(!preg_match("/^[\s\S]+$/",$data["price"])){
		$errors["price"]="Invalid price";
	}
	if(!preg_match("/^[\s\S]+$/",$data["is_available"])){
		$errors["is_available"]="Invalid is_available";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCategory"])){
		$errors["category"]="Invalid category";
	}
	if(!preg_match("/^[\s\S]+$/",$data["photo"])){
		$errors["photo"]="Invalid photo";
	}

*/
		if(count($errors)==0){
			$menuitem=new MenuItem();
			$menuitem->id=$data["id"];
		$menuitem->id=$data["id"];
		$menuitem->restaurant_id=$data["restaurant_id"];
		$menuitem->name=$data["name"];
		$menuitem->description=$data["description"];
		$menuitem->price=$data["price"];
		$menuitem->is_available=isset($data["is_available"])?1:0;
		$menuitem->category=$data["category"];
		if($file["photo"]["name"]!=""){
			$menuitem->photo=File::upload($file["photo"], "img",$data["id"]);
		}else{
			$menuitem->photo=MenuItem::find($data["id"])->photo;
		}
		

		$menuitem->update();
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
		MenuItem::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",MenuItem::find($id));
	}
}
?>
