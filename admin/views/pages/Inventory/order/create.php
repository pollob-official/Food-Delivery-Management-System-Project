<?php
echo Page::title(["title"=>"Create Order"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"order", "text"=>"Manage Order"]);
echo Page::context_open();
echo Form::open(["route"=>"order/save"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id"]);
	echo Form::input(["label"=>"Customer Id","type"=>"text","name"=>"customer_id"]);
	echo Form::input(["label"=>"Rider","name"=>"rider_id","table"=>"riders"]);
	echo Form::input(["label"=>"Restaurant Id","type"=>"text","name"=>"restaurant_id"]);
	echo Form::input(["label"=>"Delivery Address","type"=>"textarea","name"=>"delivery_address"]);
	echo Form::input(["label"=>"Total Amount","type"=>"text","name"=>"total_amount"]);
	echo Form::input(["label"=>"Delivery Fee","type"=>"text","name"=>"delivery_fee"]);
	echo Form::input(["label"=>"Tax Amount","type"=>"text","name"=>"tax_amount"]);
	echo Form::input(["label"=>"Coupon Id","type"=>"text","name"=>"coupon_id"]);
	echo Form::input(["label"=>"Tracking","name"=>"tracking_id","table"=>"trackings"]);
	echo Form::input(["label"=>"Payment Status","type"=>"text","name"=>"payment_status"]);
	echo Form::input(["label"=>"Version","type"=>"text","name"=>"version"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
