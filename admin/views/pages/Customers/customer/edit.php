<?php
echo Page::title(["title"=>"Edit Customer"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"customer", "text"=>"Manage Customer"]);
echo Page::context_open();
echo Form::open(["route"=>"customer/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$customer->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$customer->name"]);
	echo Form::input(["label"=>"Default Address Id","type"=>"textarea","name"=>"default_address_id","value"=>"$customer->default_address_id"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
