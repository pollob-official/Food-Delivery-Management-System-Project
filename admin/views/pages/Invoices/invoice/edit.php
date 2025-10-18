<?php
// echo Page::title(["title"=>"Edit Invoice"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"invoice", "text"=>"Manage Invoice"]);
echo Page::context_open();
echo Form::open(["route"=>"invoice/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$invoice->id"]);
	echo Form::input(["label"=>"Order","name"=>"order_id","table"=>"orders","value"=>"$invoice->order_id"]);
	echo Form::input(["label"=>"Customer","name"=>"customer_id","table"=>"customers","value"=>"$invoice->customer_id"]);
	echo Form::input(["label"=>"Restaurant","name"=>"restaurant_id","table"=>"restaurants","value"=>"$invoice->restaurant_id"]);
	echo Form::input(["label"=>"Total Amount","type"=>"text","name"=>"total_amount","value"=>"$invoice->total_amount"]);
	echo Form::input(["label"=>"Tax Amount","type"=>"text","name"=>"tax_amount","value"=>"$invoice->tax_amount"]);
	echo Form::input(["label"=>"Discount Amount","type"=>"text","name"=>"discount_amount","value"=>"$invoice->discount_amount"]);
	echo Form::input(["label"=>"Grand Total","type"=>"text","name"=>"grand_total","value"=>"$invoice->grand_total"]);
	echo Form::input(["label"=>"Payment Method","type"=>"text","name"=>"payment_method","value"=>"$invoice->payment_method"]);
	echo Form::input(["label"=>"Payment Status","type"=>"text","name"=>"payment_status","value"=>"$invoice->payment_status"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
