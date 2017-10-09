<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$cssCode = $_REQUEST['cssCode'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	print_r($cssCode);
	$themes = $shopify('GET /admin/themes.json');
	foreach($themes as $theme){
	  if($theme['role'] == 'main') {
		echo $theme['id'];
		$data = array( "asset" => array('key' => 'custom_reserve.css', 'value' => $cssCode )); 
		print_r($data);
		$response = $shopify('PUT /admin/themes/'.$theme['id'].'/assets.json',$data);
		print_r($response);
		//$shopify('GET /admin/themes/'.$theme['id'].'/assets.json?asset[key]=assets/custom_reserve.css&theme_id='.$theme['id']);
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
