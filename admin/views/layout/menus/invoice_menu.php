<?php
	echo Menu::item([
		"name"=>"Invoice",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"invoice/create","text"=>"Create Invoice","icon"=>"far fa-circle nav-icon"],
			["route"=>"invoice","text"=>"Manage Invoice","icon"=>"far fa-circle nav-icon"],
		]
	]);
