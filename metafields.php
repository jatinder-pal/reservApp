<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$productids = $_REQUEST['productids'];
$productids = explode(',', $productids);
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	foreach($productids as $productid){	
		$metafield[] = array('namespace' => 'selectedproducts', 'key' => 'checkedids', 'value' => $productid,
		'value_type' => 'integer');
		print_r($metafield);
		$curl_url = $shopify('POST /admin/products/'.$productid.'/metafields.json', array('metafield' => $metafield) );
		print_r($curl_url);
		echo 'testtt';
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
