<?php
	define('APP_ROOT', str_replace('\\', '/', dirname(__FILE__)));
	require(APP_ROOT.'/pscws4.class.php');

	function get_tags_arr($title){
		$pscws = new PSCWS4();
		$pscws->set_dict(APP_ROOT.'/scws/dict.utf8.xdb');
		$pscws->set_rule(APP_ROOT.'/scws/rules.utf8.ini');
		$pscws->set_ignore(true);
		$pscws->send_text($title);
		$words = $pscws->get_tops(10);
		$tags = array();
		foreach ($words as $val) {
			$tags[] = $val['word'];
		}
		$pscws->close();
		return $tags;
	}
	function str_replace_once($needle, $replace, $haystack) {
		// Looks for the first occurence of $needle in $haystack
		// and replaces it with $replace.
		$pos = strpos($haystack, $needle);
		if ($pos === false) {
			return $haystack;
		}
		return substr_replace($haystack, $replace, $pos, strlen($needle));
	}