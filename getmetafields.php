<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{		
		$response = $shopify('GET /admin/metafields.json');
		$revisebutton = ''; $automanualfield = '';
		foreach($response as $options){
			if($options['namespace'] == 'revisebutton'){
				$revisebutton = $options['value'];
			} else if($options['namespace'] == 'automanualfield'){
				$automanualfield = $options['value'];
			}
		}
		echo $revisebutton.'==='.$automanualfield;
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
