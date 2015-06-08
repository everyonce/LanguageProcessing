<?php
/**
 * Display Output
 *
 */


if ($format=='json') {
	if ($callback=='') {
		header("Content-Type: application/json;charset=utf-8");
		echo json_encode($out);
		exit;
	} else {
		header("Content-Type: text/javascript;charset=utf-8");
		echo $callback.'('.json_encode($out).')';
		exit;
	}
} elseif($format=='php') {
	header("Content-Type: application/php;charset=utf-8");
	echo serialize($out);
	exit;
} elseif($format=='test') {
	header("Content-Type: text/html;charset=utf-8");
	print_r($out);
	exit;
} elseif($format=='xml') {
	header("Content-Type: text/xml;charset=utf-8");
	print array2xml($out);
	exit;
}
?>
