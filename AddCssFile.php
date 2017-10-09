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
		$data = array( "asset" => array('key' => 'assets/custom_reserve.css', 'value' => $cssCode )); 
		$response = $shopify('PUT /admin/themes/'.$theme['id'].'/assets.json',$data);
		//print_r($response);
		  
		$themebackup = array( "asset" => array('key' => 'layout/theme.bak.liquid', 'source_key' => 'layout/theme.liquid' )); 
		$themefilebackup = $shopify('PUT /admin/themes/'.$theme['id'].'/assets.json',$themebackup);
		$themedata = array( "asset" => array('key' => 'layout/theme.liquid', 'value' => "{{ 'custom_reserve.css' | asset_url | stylesheet_tag }}" )); 
		$newthemedata = $shopify('PUT /admin/themes/'.$theme['id'].'/assets.json',$themedata);
		print_r($newthemedata);
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
