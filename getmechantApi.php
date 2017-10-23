<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$term_condition = $_REQUEST['term_condition'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
        echo $term_condition;
	if($term_condition){
	  //$metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'seloptions', 'value' => $alloptions,
	'value_type' => 'string'));
	} else {
	  //$alloptions = "noData";
	  //$metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'seloptions', 'value' => $alloptions,
	'value_type' => 'string'));
	}
	
	//$auto_manual_field = array( "metafield" => array('namespace' => 'automanualfield', 'key' => 'automanual', 'value' => $auto_manual,
	'value_type' => 'string'));
	
	//$response = $shopify('POST /admin/metafields.json',$metafield);
	//$response_auto_manual = $shopify('POST /admin/metafields.json',$auto_manual_field);
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
