<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$alloptions = $_REQUEST['options'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{
	$url = "/admin/script_tags.json?src=https://revise-app.herokuapp.com/addRevise.js?id=$access_token";
	$fields = "https://revise-app.herokuapp.com/addRevise.js?id=$access_token";
	if($alloptions == 'noData'){
		$data = $shopify("GET $url");
		foreach($data as $file){
			print_r($file);
			$response = $shopify('DELETE /admin/script_tags/'.$file['id'].'.json');
			print_r('Remove JS file');
		}
	} else {
		$data = $shopify("GET $url");
		if(!$data){
			$fields = array( "script_tag" => array('event' => 'onload', 'src' => $js_file));
			$response = $shopify('POST /admin/script_tags.json',$fields);
			print_r($response);
		} else {
			print_r($data);
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
