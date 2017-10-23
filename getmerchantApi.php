<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$term_condition = $_REQUEST['term_condition'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	if($term_condition){
	  $metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'termcondition', 'value' => $term_condition, 'value_type' => 'string'));
	} else {
	  $term_condition = "noTerms";
	  $metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'termcondition', 'value' => $term_condition, 'value_type' => 'string'));
	}
	$response = $shopify('POST /admin/metafields.json',$metafield);
	if($response){
	  $shopData = $shopify('GET /admin/shop.json');
	}
	print_r($response);
	print_r($shopData);
	//echo $response['value'].'==='.
	
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
