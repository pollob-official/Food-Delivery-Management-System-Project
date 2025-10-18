<?php
echo Page::title(["title"=>"Edit OrderDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"orderdetail", "text"=>"Manage OrderDetail"]);
echo Page::context_open();
echo Form::open(["route"=>"orderdetail/update"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id","value"=>"$orderdetail->id"]);
	echo Form::input(["label"=>"Order Id","type"=>"text","name"=>"order_id","value"=>"$orderdetail->order_id"]);
	echo Form::input(["label"=>"Menu Item Id","type"=>"text","name"=>"menu_item_id","value"=>"$orderdetail->menu_item_id"]);
	echo Form::input(["label"=>"Qty","type"=>"text","name"=>"qty","value"=>"$orderdetail->qty"]);
	echo Form::input(["label"=>"Unit Price","type"=>"text","name"=>"unit_price","value"=>"$orderdetail->unit_price"]);
	echo Form::input(["label"=>"Total Price","type"=>"text","name"=>"total_price","value"=>"$orderdetail->total_price"]);
	echo Form::input(["label"=>"Notes","type"=>"text","name"=>"notes","value"=>"$orderdetail->notes"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
