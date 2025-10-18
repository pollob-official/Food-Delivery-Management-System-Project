<?php
	echo Menu::item([
		"name"=>"Menuitem",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"menuitem/create","text"=>"Create Menuitem","icon"=>"far fa-circle nav-icon"],
			["route"=>"menuitem","text"=>"Manage Menuitem","icon"=>"far fa-circle nav-icon"],
		]
	]);
