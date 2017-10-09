<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$cssCode = $_REQUEST['cssCode'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	$themes = $shopify('GET /admin/themes.json');
	foreach($themes as $theme){
	  if($theme['role'] == 'main') {
		$data = array( "asset" => array('key' => 'assets/custom_reserve.css', 'value' => $cssCode )); 
		$response = $shopify('PUT /admin/themes/'.$theme['id'].'/assets.json',$data);
		
		$backupfile = $shopify('GET /admin/themes/'.$theme['id'].'/assets.json?asset[key]=layout/theme.bak.liquid&theme_id='.$theme['id']);
		if($backupfile){
			echo 'Backupfile Already exist';
		} else {
			$themebackup = array( "asset" => array('key' => 'layout/theme.bak.liquid', 'source_key' => 'layout/theme.liquid' )); 
			$themefilebackup = $shopify('PUT /admin/themes/'.$theme['id'].'/assets.json',$themebackup);
			echo 'Backupfile created';
		}
  
		$themefile = $shopify('GET /admin/themes/'.$theme['id'].'/assets.json?asset[key]=sections/header.liquid&theme_id='.$theme['id']);
		$myfile = $themefile['value'];
		$splitfile = explode("</header>", $myfile);
		$themehtml = $splitfile[0].'{{ "custom_reserve.css" | asset_url | stylesheet_tag }} </header>'.$splitfile[1];
		$themedata = array( "asset" => array('key' => 'layout/theme.liquid', 'value' => $themehtml));
		$newthemefile = $shopify('PUT /admin/themes/'.$theme['id'].'/assets.json',$themedata);
		print_r($newthemefile);
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
