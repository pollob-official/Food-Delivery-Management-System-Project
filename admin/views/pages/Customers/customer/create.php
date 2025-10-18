<?php
echo Page::title(["title"=>"Create Customer"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"customer", "text"=>"Manage Customer"]);
echo Page::context_open();
echo Form::open(["route"=>"customer/save"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Default Address Id","type"=>"textarea","name"=>"default_address_id"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
