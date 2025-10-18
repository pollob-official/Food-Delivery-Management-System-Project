<?php
class InvoiceController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Invoices");
	}
	public function create(){
		view("Invoices");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["order_id"])){
		$errors["order_id"]="Invalid order_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["customer_id"])){
		$errors["customer_id"]="Invalid customer_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["restaurant_id"])){
		$errors["restaurant_id"]="Invalid restaurant_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_amount"])){
		$errors["total_amount"]="Invalid total_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["tax_amount"])){
		$errors["tax_amount"]="Invalid tax_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["discount_amount"])){
		$errors["discount_amount"]="Invalid discount_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["grand_total"])){
		$errors["grand_total"]="Invalid grand_total";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPaymentMethod"])){
		$errors["payment_method"]="Invalid payment_method";
	}
	if(!preg_match("/^[\s\S]+$/",$data["payment_status"])){
		$errors["payment_status"]="Invalid payment_status";
	}

*/
		if(count($errors)==0){
			$invoice=new Invoice();
		$invoice->order_id=$data["order_id"];
		$invoice->customer_id=$data["customer_id"];
		$invoice->restaurant_id=$data["restaurant_id"];
		$invoice->total_amount=$data["total_amount"];
		$invoice->tax_amount=$data["tax_amount"];
		$invoice->discount_amount=$data["discount_amount"];
		$invoice->grand_total=$data["grand_total"];
		$invoice->payment_method=$data["payment_method"];
		$invoice->payment_status=$data["payment_status"];
		$invoice->created_at=$now;
		$invoice->updated_at=$now;

			$invoice->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Invoices",Invoice::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["order_id"])){
		$errors["order_id"]="Invalid order_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["customer_id"])){
		$errors["customer_id"]="Invalid customer_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["restaurant_id"])){
		$errors["restaurant_id"]="Invalid restaurant_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_amount"])){
		$errors["total_amount"]="Invalid total_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["tax_amount"])){
		$errors["tax_amount"]="Invalid tax_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["discount_amount"])){
		$errors["discount_amount"]="Invalid discount_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["grand_total"])){
		$errors["grand_total"]="Invalid grand_total";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPaymentMethod"])){
		$errors["payment_method"]="Invalid payment_method";
	}
	if(!preg_match("/^[\s\S]+$/",$data["payment_status"])){
		$errors["payment_status"]="Invalid payment_status";
	}

*/
		if(count($errors)==0){
			$invoice=new Invoice();
			$invoice->id=$data["id"];
		$invoice->order_id=$data["order_id"];
		$invoice->customer_id=$data["customer_id"];
		$invoice->restaurant_id=$data["restaurant_id"];
		$invoice->total_amount=$data["total_amount"];
		$invoice->tax_amount=$data["tax_amount"];
		$invoice->discount_amount=$data["discount_amount"];
		$invoice->grand_total=$data["grand_total"];
		$invoice->payment_method=$data["payment_method"];
		$invoice->payment_status=$data["payment_status"];
		$invoice->created_at=$now;
		$invoice->updated_at=$now;

		$invoice->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Invoices");
	}
	public function delete($id){
		Invoice::delete($id);
		redirect();
	}
	public function show($id){
		view("Invoices",Invoice::find($id));
	}
}
?>
