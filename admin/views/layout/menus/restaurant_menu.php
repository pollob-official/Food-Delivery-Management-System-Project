<?php
	echo Menu::item([
		"name"=>"Restaurant",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"restaurant/create","text"=>"Create Restaurant","icon"=>"far fa-circle nav-icon"],
			["route"=>"restaurant","text"=>"Manage Restaurant","icon"=>"far fa-circle nav-icon"],
		]
	]);
