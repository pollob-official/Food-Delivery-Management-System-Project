<?php
echo Page::title(["title"=>"Create Restaurant"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"restaurant", "text"=>"Manage Restaurant"]);
echo Page::context_open();
echo Form::open(["route"=>"restaurant/save"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id"]);
	echo Form::input(["label"=>"User Id","type"=>"text","name"=>"user_id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description"]);
	echo Form::input(["label"=>"Phone","type"=>"text","name"=>"phone"]);
	echo Form::input(["label"=>"Address","type"=>"textarea","name"=>"address"]);
	echo Form::input(["label"=>"Open Hours","type"=>"text","name"=>"open_hours"]);
	echo Form::input(["label"=>"Is Active","type"=>"checkbox","name"=>"is_active","value"=>"1"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
