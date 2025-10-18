<?php
// echo Page::title(["title"=>"Create Invoice"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"invoice", "text"=>"Manage Invoice"]);
echo Page::context_open();
echo Form::open(["route"=>"invoice/save"]);
	echo Form::input(["label"=>"Order","name"=>"order_id","table"=>"orders"]);
	echo Form::input(["label"=>"Customer","name"=>"customer_id","table"=>"customers"]);
	echo Form::input(["label"=>"Restaurant","name"=>"restaurant_id","table"=>"restaurants"]);
	echo Form::input(["label"=>"Total Amount","type"=>"text","name"=>"total_amount"]);
	echo Form::input(["label"=>"Tax Amount","type"=>"text","name"=>"tax_amount"]);
	echo Form::input(["label"=>"Discount Amount","type"=>"text","name"=>"discount_amount"]);
	echo Form::input(["label"=>"Grand Total","type"=>"text","name"=>"grand_total"]);
	echo Form::input(["label"=>"Payment Method","type"=>"text","name"=>"payment_method"]);
	echo Form::input(["label"=>"Payment Status","type"=>"text","name"=>"payment_status"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
