<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$merchantId = $_REQUEST['merchantId'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	$response = $shopify('GET /admin/metafields.json');
	foreach($response as $options){
		if($options['namespace'] == 'genarateMerchantId'){
			echo 'Already Exist';
			echo $getMerchantId = $options['value'];
		} else {
			$metafield = array( "metafield" => array('namespace' => 'genarateMerchantId', 'key' => 'merchantId', 'value' => $merchantId, 'value_type' => 'string'));
			$response = $shopify('POST /admin/metafields.json',$metafield);
			echo 'Newly Added';
			echo $response['value'];
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
