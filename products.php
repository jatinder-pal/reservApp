<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{
	      
			$products = $shopify('GET /admin/products.json');
			if($products){
			echo '<form>';
			echo '<table cellspacing="10" cellpadding="10" border="1">';
			echo '<thead><tr><th></th><th>Product Name</th><th>Content</th><th>Brand</th><th>Image</th></tr></thead>';
			echo '<tbody><tr>';
			foreach($products as $Allproducts) {
				echo '<td><input type="checkbox" name="'.$Allproducts["id"].'" data-pro-handle="'.$Allproducts["handle"].'" /></td>';
				echo '<td>'.$Allproducts['title'].'</td>';
				echo '<td>'.$Allproducts['body_html'].'</td>';
				echo '<td>'.$Allproducts['vendor'].'</td>';
				echo '<td><img src="'.$Allproducts["image"]["src"].'" alt="productimage" /></td>';
			}
			echo '</tr>';
			echo '<tr><td colspan="5"><input type="submit" value="Show button on Product Page" name="submit" /></td></tr></tbody>';
			echo '</table>';
			 echo '</form>';
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
