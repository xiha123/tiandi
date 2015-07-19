<?php

$navList = array(
	array(
		"title" => "课程管理",
		"link" => "admin/onlineClass",
		"icon" => "icon-home",
		"active" => false
	),
);


if (isset($activeNav)) $navList[$activeNav]['active'] = true;
for($index = 0;$index < count($navList);$index ++){
	$active = $navList[$index]["active"] == true ? ' class="active"' : "";
	echo '<li role="presentation" ' . $active . '><a href="' . $navList[$index]["link"] . '"><i class="' . $navList[$index]["icon"] . '"></i><font>' . $navList[$index]["title"] . '</font></a></li>';
}
