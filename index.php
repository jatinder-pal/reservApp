<?php
session_start();
// Required File Start.........
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/connection.php'; //DB connectivity
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
// Required File END...........
error_reporting(E_ALL);
 //print_r($_SESSION); 
ini_set('display_errors', 1);

if((isset($_REQUEST['shop'])) && (isset($_REQUEST['code'])) && $_REQUEST['shop']!='' && $_REQUEST['code']!='' )
{
	$_SESSION['shop']=$_REQUEST['shop'];
	$_SESSION['code']=$_REQUEST['code'];
}
$access_token = shopify\access_token($_REQUEST['shop'], SHOPIFY_APP_API_KEY, SHOPIFY_APP_SHARED_SECRET, $_REQUEST['code']);

?>
<html>
<head>
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700" rel="stylesheet"> 
 <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/988a7dc35f.js"></script>
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  rel="stylesheet" type="text/css"/>  
<link href="style.css" rel="stylesheet" type="text/css"/>
 </head>
 <body>
<h2>Hello welcome to my app</h2>
<div class="content-container">
	<div class="options">
	<form method="post" name="form" id="getoptions" action="#">
		<table cellspacing="10" cellpadding="10" border="1">
			<thead>
				<tr>
				<th></th><th>Options</th><th>Class name</th>
				</tr>
			</thead>
			<tbody>
				<tr><td><input id="product_page" type="checkbox" name="sel_options[]" value="product_page" /></td>
					<td><label for="product_page">Product Page</label></td>
					<td><input id="product_page_class" type="text" name="product_page_class" value="" /></td>
				</tr>
				<tr><td><input id="catalog_page" type="checkbox" name="sel_options[]" value="catalog_page" /></td>
					<td><label for="catalog_page">Catalog Page</label></td>
					<td><input id="catalog_page_class" type="text" name="catalog_page_class" value="" /></td>
				</tr>
				<tr><td><input id="quick_view" type="checkbox" name="sel_options[]" value="quick_view" /></td>
					<td><label for="quick_view">Quick View</label></td>
					<td><input id="quick_view_class" type="text" name="quick_view_class" value="" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="button" class="saveoptions" value="Show Revise button" name="submit" /></td>
				</tr>
			</tbody>
		</table>
	</form>
	</div>
</div> 
<script>
// Add Script
function addScript(options){ 
	console.log('Add Script');
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	$.ajax({
		url: '/addScript.php?access_token='+access_token+'&shop='+shop+'&options='+options,
		success: function(data){
			console.log(data);
		}
	});
}
// fetch Metafields
function fetchMetafield(){
	console.log('fetch Metafield');
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	$.ajax({
		url: '/getmetafields.php?access_token='+access_token+'&shop='+shop,
		success: function(data){
			if(data){
			var options = data.split(',');
			//console.log(options);
			$.each(options, function(index, value){
				//console.log(value);
				if($('input[name="sel_options[]"][value='+value+']')){
				  $('input[name="sel_options[]"][value='+value+']').attr("checked","true");
				} else {
				  $('input[name="sel_options[]"]').attr("checked","false");
				}
			});
			addScript(data);
			}
		}
	});
}
$(document).ready(function(){
	fetchMetafield();
	$('body').on('click', '.saveoptions', function(e){
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	var checkdata = [];
	var checkdata1 = [];
	$("input[name='sel_options[]']:checked").each(function() {
	    var getid = $(this).attr('id');
	    getid = getid+'_class';
	    var key = $(this).val();
	    var array = {key: $(getid).val()};
	    checkdata.push($(this).val());
	    checkdata1.push(array);
	});
	console.log(checkdata);
	console.log(array);
	console.log(checkdata1);
	$.ajax({
		type: 'POST',
		url: '/metafields.php?access_token='+access_token+'&shop='+shop+'&options='+checkdata,
		dataType: "html",
		success: function(data) { 
			//console.log(data);
			if(data){
				addScript(data);
			}
		}
	});
    	});
});
</script>	
</body>
</html>
