<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$alloptions = $_REQUEST['options'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{		
		$metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'seloptions', 'value' => $alloptions,
		'value_type' => 'string'));
		$response = $shopify('POST /admin/metafields.json',$metafield);
		print_r($response);
		print_r($response->value);
		print_r($response['value']);
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
