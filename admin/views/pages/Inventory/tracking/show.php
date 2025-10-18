<?php
echo Page::title(["title"=>"Show Tracking"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"tracking", "text"=>"Manage Tracking"]);
echo Page::context_open();
echo Tracking::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
