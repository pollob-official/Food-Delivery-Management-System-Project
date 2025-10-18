<?php
echo Page::title(["title"=>"Show Rider"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"rider", "text"=>"Manage Rider"]);
echo Page::context_open();
echo Rider::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
