<?php
// echo Page::title(["title"=>"Show Invoice"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"invoice", "text"=>"Manage Invoice"]);
echo Page::context_open();
echo Invoice::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
