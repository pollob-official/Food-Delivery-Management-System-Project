<?php
	echo Menu::item([
		"name"=>"Tracking",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"tracking/create","text"=>"Create Tracking","icon"=>"far fa-circle nav-icon"],
			["route"=>"tracking","text"=>"Manage Tracking","icon"=>"far fa-circle nav-icon"],
		]
	]);
