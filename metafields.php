<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$alloptions = $_REQUEST['options'];
$alloptions = explode(',', $alloptions);
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	foreach($alloptions as $option){	
		$metafield = array( "metafield" => array('namespace' => 'selectedoptions', 'key' => 'seloptions', 'value' => $option,
		'value_type' => 'string'));
		$response = $shopify('POST /admin/metafields.json',$metafield);
		echo <pre>";print_r($response);
		foreach($response as $response_option){
		  echo $response_option;
		}
	}
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
