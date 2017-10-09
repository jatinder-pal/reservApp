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
		  
		if($cssCode){
			$metafield = array( "metafield" => array('namespace' => 'revisecss', 'key' => 'csscode', 'value' => $cssCode,
	'value_type' => 'string'));
		} else {
			$cssCode = "noCss";
			$metafield = array( "metafield" => array('namespace' => 'revisecss', 'key' => 'csscode', 'value' => $cssCode,
	'value_type' => 'string'));
		}
		$response = $shopify('POST /admin/metafields.json',$metafield);
		$response['value'];

		$url = "/admin/script_tags.json?src=https://reserv-app.herokuapp.com/addCssCode.js?access_token=$access_token";
		$js_file = "https://reserv-app.herokuapp.com/addCssCode.js?access_token=$access_token";
		$data = $shopify("GET $url");
		if(!$data){
			$fields = array( "script_tag" => array('event' => 'onload', 'src' => $js_file));
			$response = $shopify('POST /admin/script_tags.json',$fields);
			//print_r($response);
			print_r('Add JS file for CSS');
		} else {
			//print_r($data);
			print_r('Already exist JS file for CSS');
		}
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
