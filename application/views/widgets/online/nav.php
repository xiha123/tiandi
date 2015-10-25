<?php

$navList = array(
	"1" => array(
		"title" => "新手指南",
		"link" => "admin/onlineGoTo",
		"icon" => "fa fa-th-large",
		"active" => false
	)
);


if (isset($activeNav)) $navList[$activeNav]['active'] = true;

foreach ($navList as $item) {
	$active = $item["active"] == true ? ' class="active"' : "";
	echo '<li role="presentation" ' . $active . '><a href="' . $item["link"] . '"><i class="' . $item["icon"] . '"></i><font>' . $item["title"] . '</font></a></li>';
}
