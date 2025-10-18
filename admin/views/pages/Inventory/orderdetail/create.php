<?php
echo Page::title(["title"=>"Create OrderDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"orderdetail", "text"=>"Manage OrderDetail"]);
echo Page::context_open();
echo Form::open(["route"=>"orderdetail/save"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id"]);
	echo Form::input(["label"=>"Order Id","type"=>"text","name"=>"order_id"]);
	echo Form::input(["label"=>"Menu Item Id","type"=>"text","name"=>"menu_item_id"]);
	echo Form::input(["label"=>"Qty","type"=>"text","name"=>"qty"]);
	echo Form::input(["label"=>"Unit Price","type"=>"text","name"=>"unit_price"]);
	echo Form::input(["label"=>"Total Price","type"=>"text","name"=>"total_price"]);
	echo Form::input(["label"=>"Notes","type"=>"text","name"=>"notes"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
