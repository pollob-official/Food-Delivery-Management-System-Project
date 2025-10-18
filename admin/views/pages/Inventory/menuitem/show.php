<?php
echo Page::title(["title"=>"Show MenuItem"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"menuitem", "text"=>"Manage MenuItem"]);
echo Page::context_open();
echo MenuItem::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
