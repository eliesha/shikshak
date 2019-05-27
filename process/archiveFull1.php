<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
require CLASS_PATH.'series.php';
$series = new Series();
header('Content-Type: text/html; charset=utf-8');
$act = isset($_REQUEST['id']) ? escapeString($_REQUEST['id']) : null;
if(isset($_REQUEST['id'])){$id = $_REQUEST['id'];}
$seriesYear = $series->getAnkaByYear($id);
if (!empty($seriesYear)) {
			$data = api_response($seriesYear, true, 200);
			echo $data;
			exit;
} else {
	$data = api_response(null, false, 404, 'No archive left.');
	echo $data;
	exit;
 }
