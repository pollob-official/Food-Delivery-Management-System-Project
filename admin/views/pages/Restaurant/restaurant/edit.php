<?php
echo Page::title(["title"=>"Edit Restaurant"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"restaurant", "text"=>"Manage Restaurant"]);
echo Page::context_open();
echo Form::open(["route"=>"restaurant/update"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id","value"=>"$restaurant->id"]);
	echo Form::input(["label"=>"User Id","type"=>"text","name"=>"user_id","value"=>"$restaurant->user_id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$restaurant->name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description","value"=>"$restaurant->description"]);
	echo Form::input(["label"=>"Phone","type"=>"text","name"=>"phone","value"=>"$restaurant->phone"]);
	echo Form::input(["label"=>"Address","type"=>"textarea","name"=>"address","value"=>"$restaurant->address"]);
	echo Form::input(["label"=>"Open Hours","type"=>"text","name"=>"open_hours","value"=>"$restaurant->open_hours"]);
	echo Form::input(["label"=>"Is Active","type"=>"checkbox","name"=>"is_active","value"=>"$restaurant->is_active","checked"=>$restaurant->is_active?"checked":""]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
