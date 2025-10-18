<?php
echo Page::title(["title"=>"Edit MenuItem"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"menuitem", "text"=>"Manage MenuItem"]);
echo Page::context_open();
echo Form::open(["route"=>"menuitem/update"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id","value"=>"$menuitem->id"]);
	echo Form::input(["label"=>"Restaurant Id","type"=>"text","name"=>"restaurant_id","value"=>"$menuitem->restaurant_id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$menuitem->name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description","value"=>"$menuitem->description"]);
	echo Form::input(["label"=>"Price","type"=>"text","name"=>"price","value"=>"$menuitem->price"]);
	echo Form::input(["label"=>"Is Available","type"=>"checkbox","name"=>"is_available","value"=>"$menuitem->is_available","checked"=>$menuitem->is_available?"checked":""]);
	echo Form::input(["label"=>"Category","type"=>"text","name"=>"category","value"=>"$menuitem->category"]);
	echo Form::input(["label"=>"Photo","type"=>"file","name"=>"photo","value"=>$menuitem->photo]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
