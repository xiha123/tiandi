<?php

$navList = array(
	array(
		"title" => "在线轮播",
		"link" => "admin/onlineSlider",
		"icon" => "fa fa-th-large",
		"active" => false
	),
	array(
		"title" => "新手指南",
		"link" => "admin/onlineGoTo",
		"icon" => "fa fa-th-large",
		"active" => false
	),
);


if (isset($activeNav)) $navList[$activeNav]['active'] = true;
for($index = 0;$index < count($navList);$index ++){
	$active = $navList[$index]["active"] == true ? ' class="active"' : "";
	echo '<li role="presentation" ' . $active . '><a href="' . $navList[$index]["link"] . '"><i class="' . $navList[$index]["icon"] . '"></i><font>' . $navList[$index]["title"] . '</font></a></li>';
}
