<?php
	echo Menu::item([
		"name"=>"Rider",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"rider/create","text"=>"Create Rider","icon"=>"far fa-circle nav-icon"],
			["route"=>"rider","text"=>"Manage Rider","icon"=>"far fa-circle nav-icon"],
		]
	]);
