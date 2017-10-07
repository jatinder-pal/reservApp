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
				<tr>
				<td colspan="3"><input type="button" class="saveoptions" value="Show Revise button" name="submit" /></td>
				</tr>
			</tbody>
		</table>
	</form>
	</div>
	
	<div class="customcss">
	<form method="post" name="cssform" id="addcustomcss" action="#">
		<table cellspacing="10" cellpadding="10" border="1">
			<thead><tr><th>Custom CSS</th></tr></thead>
			<tbody>
			<tr><td><textarea id="add_css" name="add_css" placeholder="/*****Custom CSS*****/"></textarea></td></tr>
			<tr><td><input type="button" class="savecss" value="Save CSS" name="submit" /></td></tr>
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
				data = value.split(':');
				value = data[0];
				var classes = data[1];
				if($('input[name="sel_options[]"][value='+value+']')){
				  $('input[name="sel_options[]"][value='+value+']').attr("checked","true");
				  $('input[id='+value+'_class]').val(classes);
				} else {
				  $('input[name="sel_options[]"]').attr("checked","false");
				  $('input[id='+value+'_class]').val(" ");
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
	var Arraydata = [];
	$("input[name='sel_options[]']:checked").each(function() {
	    var getid = $(this).attr('id');
	    Arraydata.push($(this).val()+':'+$('#'+getid+'_class').val());
	});
	//console.log(Arraydata);
	$.ajax({
		type: 'POST',
		url: '/metafields.php?access_token='+access_token+'&shop='+shop+'&options='+Arraydata,
		dataType: "html",
		success: function(data) { 
			//console.log(data);
			if(data){
				addScript(data);
			}
		}
	});
    	});
	
	//Save Custom CSS
	$('body').on('click', '.savecss', function(e){
		var access_token = '<?php echo $access_token ?>';
		var shop = '<?php echo $_REQUEST['shop'] ?>';
		var csscode = html_entity_decode($('#add_css').val());
		//console.log(csscode);
		$.ajax({
			type: 'POST',
			url: '/AddCssFile.php?access_token='+access_token+'&shop='+shop+'&cssCode='+csscode,
			dataType: "html",
			success: function(data) { 
				console.log(data);
			}
		});
    	});
});
</script>	
</body>
</html>
