<?php
echo Page::title(["title"=>"Create MenuItem"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"menuitem", "text"=>"Manage MenuItem"]);
echo Page::context_open();
echo Form::open(["route"=>"menuitem/save"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id"]);
	echo Form::input(["label"=>"Restaurant Id","type"=>"text","name"=>"restaurant_id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description"]);
	echo Form::input(["label"=>"Price","type"=>"text","name"=>"price"]);
	echo Form::input(["label"=>"Is Available","type"=>"checkbox","name"=>"is_available","value"=>"1"]);
	echo Form::input(["label"=>"Category","type"=>"text","name"=>"category"]);
	echo Form::input(["label"=>"Photo","type"=>"file","name"=>"photo"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
