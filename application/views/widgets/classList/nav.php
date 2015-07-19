<?php

$navList = array(
	array(
		"title" => "课程管理",
		"link" => "admin/onlineClass",
		"icon" => "icon-home",
		"active" => false
	),
	array(
		"title" => "轮播设置",
		"link" => "admin/onlineSlider",
		"icon" => "icon-th-large",
		"active" => false
	),
	array(
		"title" => "在线课堂设置",
		"link" => "admin/onlineClass",
		"icon" => "icon-shopping-cart",
		"active" => false
	),
	array(
		"title" => "用户管理",
		"link" => "admin/users",
		"icon" => "icon-user",
		"active" => false
	),
);


if (isset($activeNav)) $navList[$activeNav]['active'] = true;
for($index = 0;$index < count($navList);$index ++){
	$active = $navList[$index]["active"] == true ? ' class="active"' : "";
	echo '<li role="presentation" ' . $active . '><a href="' . $navList[$index]["link"] . '"><i class="' . $navList[$index]["icon"] . '"></i><font>' . $navList[$index]["title"] . '</font></a></li>';
}
