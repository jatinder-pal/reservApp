<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$alloptions = $_REQUEST['options'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{
	$js_file = 'https://revise-app.herokuapp.com/addRevise.js';
	if($alloptions == 'noData'){
		$data = $shopify('GET /admin/script_tags.json?src=https://revise-app.herokuapp.com/addRevise.js');
		print_r($data);
		echo $scriptid = $data['id'];
		//$response = $shopify('DELETE /admin/script_tags/'.$scriptid.'.json');
		//print_r($response);
	} else {	
		$fields = array( "script_tag" => array('event' => 'onload', 'src' => $js_file));
		$response = $shopify('POST /admin/script_tags.json',$fields);
		print_r($response);
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
