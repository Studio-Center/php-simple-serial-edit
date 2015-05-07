<?php
$csv = array_map('str_getcsv', file('btProductList.csv'));

$fp = fopen('finished.sql', 'wr');

foreach($csv as $id => $val){
	$curArr = unserialize($val[1]);
	//print_r($curArr);
	$curArr['selectedSearchField']  = array();
	unset($curArr['primaryHoverImage']);
	unset($curArr['prAltThumbnailImage']);
	unset($curArr['overlayCalloutImage']);
	unset($curArr['overlayCalloutImageMaxWidth']);
	unset($curArr['overlayCalloutImageMaxHeight']);
	unset($curArr['useOverlaysL']);
	unset($curArr['overlayLightboxImageMaxWidth']);
	unset($curArr['overlayLightboxImageMaxHeight']);

	$val[1] = str_replace("'","\'",serialize($curArr));

	// save line
	$query = "UPDATE btProductList SET block_args = '$val[1]' WHERE bID = $val[0];\n";
	fwrite($fp, $query);

};

fclose($fp);
