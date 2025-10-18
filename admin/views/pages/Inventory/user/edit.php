<?php
echo Page::title(["title"=>"Edit User"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"user", "text"=>"Manage User"]);
echo Page::context_open();
echo Form::open(["route"=>"user/update"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id","value"=>"$user->id"]);
	echo Form::input(["label"=>"Email","type"=>"text","name"=>"email","value"=>"$user->email"]);
	echo Form::input(["label"=>"Phone","type"=>"text","name"=>"phone","value"=>"$user->phone"]);
	echo Form::input(["label"=>"Password Hash","type"=>"text","name"=>"password_hash","value"=>"$user->password_hash"]);
	echo Form::input(["label"=>"Role","name"=>"role_id","table"=>"roles","value"=>"$user->role_id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$user->name"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
