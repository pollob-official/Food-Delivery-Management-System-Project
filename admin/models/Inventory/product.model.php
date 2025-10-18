<?php

class Product{
    public $id;
    public $name;
    public $price;
    public $offer_price;

public function __construct($id, $name, $price, $offer_price){
    $this->id=$id;
    $this->name=$name;
    $this->price=$price;
    $this->offer_price=$offer_price;
}

public static function GetAll(){
    global $db, $tx;
    $product=$db->query("select * from {$tx}products");
    return $product->fetch_all(MYSQLI_ASSOC);
}



}
?>