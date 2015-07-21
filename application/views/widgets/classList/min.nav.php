<?php

$navList = array(
	array(
		"title" => "返回",
		"link" => "admin/classList",
		"icon" => "icon-arrow-left",
		"active" => false
	),
	array(
		"title" => "标签管理",
		"link" => "javascript:void(0)",
		"icon" => "icon-tag",
		"active" => false
	),
	array(
		"title" => "报名地址及课程描述",
		"link" => "javascript:void(0)",
		"icon" => "icon-list",
		"active" => false
	),
	array(
		"title" => "公开课课程设置",
		"link" => "javascript:void(0)",
		"icon" => "icon-list",
		"active" => false
	),
	array(
		"title" => "付费课课程设置",
		"link" => "javascript:void(0)",
		"icon" => "icon-list",
		"active" => false
	),
	array(
		"title" => "课程章节设置",
		"link" => "javascript:void(0)",
		"icon" => "icon-list",
		"active" => false
	),
);


if (isset($activeNav)) $navList[$activeNav]['active'] = true;
for($index = 0;$index < count($navList);$index ++){
	$active = $navList[$index]["active"] == true ? ' class="active"' : "";
	echo '<li role="presentation" ' . $active . '><a href="' . $navList[$index]["link"] . '"><i class="' . $navList[$index]["icon"] . '"></i><font>' . $navList[$index]["title"] . '</font></a></li>';
}
