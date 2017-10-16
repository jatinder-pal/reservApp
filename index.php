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
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://use.fontawesome.com/988a7dc35f.js"></script>
	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  rel="stylesheet" type="text/css"/>  
	<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="logo">
	<img class="logo_img" src="images/ReservStoreLogo.jpg" alt="ReservStoreLogo.jpg" />
</div>
<div class="content-container">
<div id="tabs">
  <ul>
    <li><a href="#register">Registration</a></li>
    <li><a href="#settings">Settings</a></li>
  </ul>
  <div id="register">
    <form method="post" name="registerform" id="registerform" action="#">
		<div class="registeration-form">
			<h3>Register</h3>
    	    <label for="name">Name:</label>
			<p><input type="text" id="name" class="form-control" name="name"></p>
			<label for="email">Email:</label>
			<p><input type="email" id="email" class="form-control" name="email"></p>
			<label for="password">Password:</label>
			<p><input type="password" id="password" class="form-control" name="password"></p>
			<p><input type="button" class="btn" value="Register" name="submit"></p>
		</div>
	</form>
  </div>
  <div id="settings">
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
					<tr><td><input id="cart_page" type="checkbox" name="sel_options[]" value="cart_page" /></td>
						<td><label for="cart_page">Cart Page</label></td>
						<td><input id="cart_page_class" type="text" name="cart_page_class" value="" /></td>
					</tr>
					<tr><td colspan="3">Do you want to add Resev button Automatic or Manual ?</td></tr>
					<tr>
						<td></td>
						<td><label for="automatic_code">Automatic</label>
						<input id="automatic_code" type="radio" name="automatic_manual_code" value="automatic_code" checked /></td>
						<td><label for="manual_code">Manual</label>
						<input id="manual_code" type="radio" name="automatic_manual_code" value="manual_code" /></td>
					</tr>
					<tr><td colspan="3"><textarea class="generate_code" id="generate_code" name="generate_code"></textarea></td></tr>
					<tr>
					<td colspan="3"><input type="button" class="saveoptions" value="Show Reserv button" name="submit" /></td>
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
</div>
</div> 
<script>
$(function(){
    $( "#tabs" ).tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
});	
	
// Add Script
function addScript(options){ 
	//console.log(options);
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	$.ajax({
		url: '/addScript.php?access_token='+access_token+'&shop='+shop+'&options='+options,
		success: function(data){
			console.log(data);
			if($("#manual_code").is(':checked')){
				$('#generate_code').show().val(data);
			} else if($("#automatic_code").is(':checked')){
				$('#generate_code').hide().val(" ");
			}
		}
	});
}
// fetch Metafields
function fetchMetafield(){
	//console.log('fetch Metafield');
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	$.ajax({
		url: '/getmetafields.php?access_token='+access_token+'&shop='+shop,
		success: function(data){
			//console.log(data);
			var options = data.split('===');
			var auto_manual = options[1];
			options = options[0].split(',');
			$('input[name="automatic_manual_code"][value='+auto_manual+']').attr("checked","true");
			$.each(options, function(index, value){
				var value_data = value.split(':');
				value = value_data[0];
				var classes = value_data[1];
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
	});
}
function fetchCssCode(){
	//console.log('fetch CSS Code');
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	$.ajax({
		url: '/getCSSfile.php?access_token='+access_token+'&shop='+shop,
		success: function(response){
			$('#add_css').val(response);
		}
	});
}
$(document).ready(function(){
	$('#manual_code').click(function(){
		$('#generate_code').slideDown();
	});
	$('#automatic_code').click(function(){
		$('#generate_code').slideUp();
	});
	
	fetchMetafield();
	fetchCssCode();
	
	$('body').on('click', '.saveoptions', function(e){
	var _this = $(this);
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	var Arraydata = [];
	$("input[name='sel_options[]']:checked").each(function() {
	    var getid = $(this).attr('id');
	    Arraydata.push($(this).val()+':'+$('#'+getid+'_class').val());
	});
	var auto_manual = $("input[name='automatic_manual_code']:checked").val();
	//console.log(Arraydata);
	$.ajax({
		type: 'POST',
		url: '/metafields.php?access_token='+access_token+'&shop='+shop+'&options='+Arraydata+'&auto_manual='+auto_manual,
		dataType: "html",
		success: function(data) { 
			//console.log(data);
			if(data){
				addScript(data);
				_this.after('<p class="code_success_msg">Successfully Updated!</p>');
				$('body .code_success_msg').fadeOut(2000);
			}
		}
	});
    	});
	
	//Save Custom CSS
	$('body').on('click', '.savecss', function(e){
		var _this = $(this);
		var access_token = '<?php echo $access_token ?>';
		var shop = '<?php echo $_REQUEST['shop'] ?>';
		var csscode = escape($('#add_css').val());
		//console.log(csscode);
		$.ajax({
			type: 'POST',
			url: '/AddCssFile.php?access_token='+access_token+'&shop='+shop+'&cssCode='+csscode,
			dataType: "html",
			success: function(data) { 
				console.log(data);
				_this.after('<p class="css_success_msg">CSS code successfully updated!</p>');
				$('body .css_success_msg').fadeOut(2000);
			}
		});
    	});
});
</script>	
</body>
</html>
