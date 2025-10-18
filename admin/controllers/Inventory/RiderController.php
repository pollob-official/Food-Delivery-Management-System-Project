<?php 
class RiderController{

function index(){
    $data=Rider::all();
    view("inventory",   $data);
}
function create(){
    view("inventory");
}
function save(){
    if(isset($_POST['btn_save'])){
        print_r($_POST);
      $name= $_POST['name'];
      $email= $_POST['email'];
      $mobile= $_POST['mobile'];
      $password= $_POST['password'];
      $photo= $_POST['photo'];
      $car_number= $_POST['car_number'];
      $car_name= $_POST['car_name'];
      $car_img= $_POST['car_img'];


      $rider= new Rider(null,$name,$email,$mobile,$password, $photo, $car_number,$car_name, $car_img);
    }
}
function edit(){
    view("inventory");
}
function update(){
    view("inventory");
}

function delete(){
    view("inventory");
}


function show($id){
     $tracking_id=$_GET["tracking_order"] ?? "";
     print_r(   $tracking_id);
    $data['rider']= Rider::find($id);
    $data['orders']= Order::find_by_rider_id($id,  $tracking_id);
    view("inventory", $data);
}
function order($id){
    print_r($_REQUEST);  
    // $data['rider']= Rider::find($id);
    // $data['orders']= Order::find_by_rider_id($id);
    // view("inventory", $data);
}





}



?>