<?php
echo Page::title(["title"=>"Create Rider"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"rider", "text"=>"Manage Rider"]);
echo Page::context_open();
echo Form::open(["route"=>"rider/save"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Vehicle Type","type"=>"text","name"=>"vehicle_type"]);
	echo Form::input(["label"=>"Is Active","type"=>"checkbox","name"=>"is_active","value"=>"1"]);
	echo Form::input(["label"=>"Is Available","type"=>"checkbox","name"=>"is_available","value"=>"1"]);
	echo Form::input(["label"=>"Password","type"=>"text","name"=>"password"]);
	echo Form::input(["label"=>"Photo","type"=>"file","name"=>"photo"]);
	echo Form::input(["label"=>"Car Number","type"=>"text","name"=>"car_number"]);
	echo Form::input(["label"=>"Car Photo","type"=>"text","name"=>"car_photo"]);
	echo Form::input(["label"=>"Mobile","type"=>"text","name"=>"mobile"]);
	echo Form::input(["label"=>"Email","type"=>"text","name"=>"email"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
