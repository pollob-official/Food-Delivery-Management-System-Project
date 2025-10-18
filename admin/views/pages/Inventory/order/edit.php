<?php
echo Page::title(["title"=>"Edit Order"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"order", "text"=>"Manage Order"]);
echo Page::context_open();
echo Form::open(["route"=>"order/update"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id","value"=>"$order->id"]);
	echo Form::input(["label"=>"Customer Id","type"=>"text","name"=>"customer_id","value"=>"$order->customer_id"]);
	echo Form::input(["label"=>"Rider","name"=>"rider_id","table"=>"riders","value"=>"$order->rider_id"]);
	echo Form::input(["label"=>"Restaurant Id","type"=>"text","name"=>"restaurant_id","value"=>"$order->restaurant_id"]);
	echo Form::input(["label"=>"Delivery Address","type"=>"textarea","name"=>"delivery_address","value"=>"$order->delivery_address"]);
	echo Form::input(["label"=>"Total Amount","type"=>"text","name"=>"total_amount","value"=>"$order->total_amount"]);
	echo Form::input(["label"=>"Delivery Fee","type"=>"text","name"=>"delivery_fee","value"=>"$order->delivery_fee"]);
	echo Form::input(["label"=>"Tax Amount","type"=>"text","name"=>"tax_amount","value"=>"$order->tax_amount"]);
	echo Form::input(["label"=>"Coupon Id","type"=>"text","name"=>"coupon_id","value"=>"$order->coupon_id"]);
	echo Form::input(["label"=>"Tracking","name"=>"tracking_id","table"=>"trackings","value"=>"$order->tracking_id"]);
	echo Form::input(["label"=>"Payment Status","type"=>"text","name"=>"payment_status","value"=>"$order->payment_status"]);
	echo Form::input(["label"=>"Version","type"=>"text","name"=>"version","value"=>"$order->version"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
