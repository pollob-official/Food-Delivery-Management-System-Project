<?php
echo Page::title(["title"=>"Create Tracking"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"tracking", "text"=>"Manage Tracking"]);
echo Page::context_open();
echo Form::open(["route"=>"tracking/save"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
