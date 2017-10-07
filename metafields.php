<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$alloptions = $_REQUEST['options'];
$allclasses = $_REQUEST['classes'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	if($alloptions){
	$metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'seloptions', 'value' => $alloptions,
	'value_type' => 'string'));
		if($allclasses) {
		$classfield = array( "metafield" => array('namespace' => 'reviseclass', 'key' => 'selclasses', 'value' => $allclasses,
	'value_type' => 'string'));
		} else {
		$allclasses = "noClass";
		$classfield = array( "metafield" => array('namespace' => 'reviseclass', 'key' => 'selclasses', 'value' => $allclasses,
	'value_type' => 'string'));
		}
	} else {
	$alloptions = "noData";
	$metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'seloptions', 'value' => $alloptions,
	'value_type' => 'string'));
	}
	$response1 = $shopify('POST /admin/metafields.json',$metafield);
	$response2 = $shopify('POST /admin/metafields.json',$classfield);
	//print_r($response);
	$array = array( $response1['value'] => $response2['value']);
	echo json_encode($array);
	//echo $response1['value'];
	//echo $response2['value'];
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
