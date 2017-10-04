<?php

require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{
	      
			$products = $shopify('GET /admin/products.json');
			if($products){
			echo '<div>';			  
			foreach($products as $Allproducts)
			{
				print_r(Allproducts);
			}
			 echo '</div>';
			}
	else{
	echo "<div class='no-result'>No Products</div>";
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
