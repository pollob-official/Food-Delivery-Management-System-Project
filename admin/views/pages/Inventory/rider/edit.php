<?php
echo Page::title(["title"=>"Edit Rider"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"rider", "text"=>"Manage Rider"]);
echo Page::context_open();
echo Form::open(["route"=>"rider/update"]);
	echo Form::input(["label"=>"Id","type"=>"text","name"=>"id","value"=>"$rider->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$rider->name"]);
	echo Form::input(["label"=>"Vehicle Type","type"=>"text","name"=>"vehicle_type","value"=>"$rider->vehicle_type"]);
	echo Form::input(["label"=>"Is Active","type"=>"checkbox","name"=>"is_active","value"=>"$rider->is_active","checked"=>$rider->is_active?"checked":""]);
	echo Form::input(["label"=>"Is Available","type"=>"checkbox","name"=>"is_available","value"=>"$rider->is_available","checked"=>$rider->is_available?"checked":""]);
	echo Form::input(["label"=>"Password","type"=>"text","name"=>"password","value"=>"$rider->password"]);
	echo Form::input(["label"=>"Photo","type"=>"file","name"=>"photo","value"=>$rider->photo]);
	echo Form::input(["label"=>"Car Number","type"=>"text","name"=>"car_number","value"=>"$rider->car_number"]);
	echo Form::input(["label"=>"Car Photo","type"=>"text","name"=>"car_photo","value"=>"$rider->car_photo"]);
	echo Form::input(["label"=>"Mobile","type"=>"text","name"=>"mobile","value"=>"$rider->mobile"]);
	echo Form::input(["label"=>"Email","type"=>"text","name"=>"email","value"=>"$rider->email"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
