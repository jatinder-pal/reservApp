<?php
session_start();
// Required File Start.........
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/connection.php'; //DB connectivity
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
// Required File END...........
error_reporting(E_ALL); 
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
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/988a7dc35f.js"></script>
	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  rel="stylesheet" type="text/css"/>  
	<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="logo">
	<img class="logo_img" src="images/ReservTheNewLayawayLogo.jpg" alt="ReservStoreLogo" />
</div>
<div class="content-container">
<div id="tabs">
  <ul>
    <li><a href="#register">Dashboard</a></li>
    <li><a href="#settings">Settings</a></li>
    <li><a href="#help">Help</a></li>
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
		<div class="generate_key">
			<form method="post" name="merchantform" id="getmerchantApi" action="#">
				<input id="term_and_condition" type="checkbox" name="term_and_condition" data-target="#termModal" value="term_condition" />
				<label for="term_and_condition">Please confirm these Terms and Conditions</label>
				<input type="button" class="getmerchantApi" value="Get Merchant ID" name="submit" />
			</form>
			<!-- Terms and Condition Modal -->
			<div class="modal fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			      </div>
			      <div class="modal-body">
					<div class="merchant-agreement">
						<h3 class="modal-title">Merchant Agreement</h3>
						<h4 class="modal-subtitle">Merchant Signup Form (“Order Form”)</h4>
						<div class="columns">
							<div class="left-column">Service Provider</div>
							<div class="right-column">
								<p>Agatsu, LLC, d/b/a Forward Funded(referred to herein as “Reserv”)</p>
								<p>Address:128 Monroe St., Rockville, MD 20850</p>
								<p>Attn:Brendan Snow</p>
								<p>Email:Brendan.snow@forwardfunded.com</p>
								<p>Phone:303-304-0208</p>
							</div>
						</div>
						<div class="columns">
							<div class="left-column">Merchant</div>
							<div class="right-column">
								<p>Any merchant that has hereby downloaded the Reserv app from the Shopify store and uses it to create digital layaway, automated saving, or other saving plans (e.g. “Reserves”) for the customers of its ecommerce store. </p>
							</div>
						</div>
						<div class="columns">
							<div class="left-column">Merchant Stores/Websites to be Integrated</div>
							<div class="right-column">
								<p></p>
							</div>
						</div>
						<div class="columns">
							<div class="left-column">Effective Date</div>
							<div class="right-column">
								<p>October 9, 2017</p>
							</div>
						</div>
						<div class="columns">
							<div class="left-column">Territory</div>
							<div class="right-column">
								<p>United States</p>
							</div>
						</div>
						<div class="columns">
							<div class="left-column">Description of Services</div>
							<div class="right-column">
								<p>Digital layaway, automated saving, saving goals, save up before purchase, or other plans, referred to as amongst other things, “Reserves”.</p>
							</div>
						</div>
						<div class="columns">
							<div class="left-column">Service Fees and Payment Terms</div>
							<div class="right-column">
								<p>2% of completed plans OR 2% of down payments remitted to Crown and Caliber</p>
							</div>
						</div>
						<div class="columns">
							<div class="left-column">Term</div>
							<div class="right-column">
								<p>This Merchant Agreement (the “Agreement”) shall commence on the Effective Date and shall continue through the end of December 31st 2018(the “Initial Term”) unless sooner terminated in accordance with Section 10.2 of the attached Merchant Terms and Conditions.  Following the Initial Term, this Agreement shall automatically renew for successive one (1) year terms unless either party provides the other with written notice of non-renewal at least thirty (30) days prior to the expiration of the then current term (each a “Renewal Term” and collectively with the Initial Term, the “Term”).</p>
							</div>
						</div>
						<div class="columns">
							<div class="left-column">Merchant Terms and Conditions</div>
							<div class="right-column">
								<p>This Merchant Agreement (including the Order Form) may be executed in one or more counterparts, each of which when executed and delivered shall be deemed an original, but all of which taken together shall constitute one and the same agreement.  By signing below, the undersigned represents that he/she is duly authorized to sign on behalf of the party for whom he/she signs, and that this Merchant Agreement constitutes the valid and binding agreement of such party.  The Merchant Terms and Conditions located in Exhibit “A” are incorporated into this Agreement by reference.  If there is any conflict between this Order Form and the Merchant Terms and Conditions, this Order Form shall control.  Certain capitalized terms not otherwise defined herein shall have the meanings ascribed to such terms in the attached Merchant Terms and Conditions.</p>
							</div>
						</div>
					</div>
					<div class="exhibit-a">
						<h3 class="modal-title">Exhibit “A”</h3>
						<h4 class="modal-subtitle">MERCHANT TERMS & CONDITIONS</h4>
						<ul>
							<div class="head">SECTION 1.DEFINED TERMS</div>
							<div class="subhead">
							<li>1.1	“Brand Features” means the registered and unregistered trade names, trademarks, service marks, logos, domain names, and other distinctive brand features of each party.</li>
							<li>1.2	“Buyer” means a person that purchases digital, virtual or physical goods and/or services from the Merchant.</li>
							<li>1.3	“Disputes” means any disagreements, litigation, or other disputes between Merchant and a Buyer with respect to the Products or a Transaction or between Merchant and a third party arising from the use of the Service, but excluding Service Disputes.</li>
							<li>1.4	“Reserv Account Holder” means the individual that establishes an Reserv Account and provides a Payment Account to be used for the Service.</li>
							</div>
						</ul>
					</div>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- Terms and Condition Modal -->
		</div>
	  
		<div class="options">
			<form method="post" name="form" id="getoptions" action="#">
				<div class="auto_manual_outer">
					<p>Do you want to add Resev button Automatic or Manual ?</p>
					<div class="options">
						<input id="automatic_code" type="radio" name="automatic_manual_code" value="automatic_code" checked />
						<label for="automatic_code">Automatic</label>
					</div>
					<div class="options">
						<input id="manual_code" type="radio" name="automatic_manual_code" value="manual_code" />
						<label for="manual_code">Manual</label>
					</div>
				</div>
				<table>
					<tr class="1 height">
						<td>Options</td>
						<td>Enter Unique class of "Add to Cart" button</td>
						<td></td>
						<td></td>
					</tr>
					<tr style="height: 10px">
						<td style="padding: 5px"></td>
						<td style="padding: 5px"></td>
						<td style="padding: 5px"></td>
						<td></td>
					</tr>
					<tr class="2">
						<td style="width: 1%;"><input id="product_page" type="checkbox" name="sel_options[]" value="product_page" /><label for="product_page"></label></td>
						<td>Product Page</td>
						<td><input id="product_page_class" type="text" name="product_page_class" value="" /></td>
						<td><a href="#" data-toggle="tooltip" title="dummy content here" class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
					</tr>
					<tr class="3">
						<td style="width: 1%;"><input id="catalog_page" type="checkbox" name="sel_options[]" value="catalog_page" /><label for="catalog_page"></label></td>
						<td>Catalog Page</td>
						<td><input id="catalog_page_class" type="text" name="catalog_page_class" value="" /></td>
						<td><a href="#" data-toggle="tooltip" title="dummy content here" class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
					</tr>
					<tr class="4">
						<td style="width: 1%;"><input id="cart_page" type="checkbox" name="sel_options[]" value="cart_page" /><label for="cart_page"></label></td>
						<td>Cart Page</td>
						<td><input id="cart_page_class" type="text" name="cart_page_class" value="" /></td>
						<td><a href="#" data-toggle="tooltip" title="dummy content here" class="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
					</tr>
				</table>
				<div class="generate_code_outer">
					<div class="code_textarea">
						<textarea class="generate_code" placeholder="/*****Generate Code*****/" id="generate_code" name="generate_code"></textarea>
					</div>
					<div class="code_submit">
						<input type="button" class="saveoptions" value="Show Reserv button" name="submit" />
					</div>
				</div>
			</form>
		</div>
		<div class="customcss">
			<form method="post" name="cssform" id="addcustomcss" action="#">
				<div class="css_code_outer">
					<h3 class="css_title">Custom CSS</h3>
					<div class="css_body">
						<textarea id="add_css" name="add_css" placeholder="/*****Custom CSS*****/"></textarea>
						<input type="button" class="savecss" value="Save CSS" name="submit" />
					</div>
				</div>
			</form>
		</div>
  </div>
  <div id="help">
  	<h2>help!!</h2>
  </div>
</div>
</div> 
<script>
$(function(){
    $( "#tabs" ).tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
});	
	
// Add Script
function addScript(options){
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
// Add CSS
function fetchCssCode(){
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	$.ajax({
		url: '/getCSSfile.php?access_token='+access_token+'&shop='+shop,
		success: function(response){
			$('#add_css').val(response);
		}
	});
}
	
// fetch MerchantApi
function fetchMerchantApi(data){
	data = $.parseJSON(data);
	var sendData = { "merchantName": data.shop_owner, "EmailAddress": data.email, "phone": data.phone, "website": data.domain, "address1": data.address1, "city": data.city, "zipCode": data.zip, "stateConst": data.province_code};
	console.log(sendData);
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	$.ajax({
		url: 'https://testreserveservices.azurewebsites.net/api/account/register/store/merchant',
		crossDomain: true,
		type: 'POST',
		dataType: 'json',
		processData: false,
		contentType: 'application/json',
		data: JSON.stringify(sendData),
		header: {
		    "Access-Control-Allow-Origin": "*",
		},
		success: function(response){
			console.log(response);
			console.log(response.success);
			if(response.success && response.merchantId){
			  $.ajax({
				type: 'POST',
				url: '/saveMerchantApi.php?access_token='+access_token+'&shop='+shop+'&merchantId='+response.merchantId,
				dataType: "html",
				success: function(response1) { 
					console.log(response1);
					showMerchantmsg();
				}
			  });
			} else {
			 alert('No Merchant ID generated!');
			}
		}
	});
}
// show Merchant ID message
function showMerchantmsg(){
	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	 $.ajax({
		type: 'POST',
		url: '/showMerchantApi.php?access_token='+access_token+'&shop='+shop,
		dataType: "html",
		success: function(response) {
			console.log(response);
			if (!$.trim(response)){ 
			  //alert(response);
			} else {
				$('body .code_merchantid_msg').remove();
				$('#getmerchantApi').after('<p class="code_merchantid_msg">Merchant ID: '+response+'</p>');
				$('#term_and_condition').attr('checked', true);
				$('.getmerchantApi').removeAttr('disabled').removeClass('disabled');
			}
		}
	 });
}
	
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
	 
	$('#manual_code').click(function(){
		$('#generate_code').slideDown();
	});
	$('#automatic_code').click(function(){
		$('#generate_code').slideUp();
	});
	
	fetchMetafield();
	fetchCssCode();
  	showMerchantmsg();
	
	$('#term_and_condition').click(function() {
	    var checked = $(this).is(':checked');
	    if (checked) {
		$('#termModal').modal();
		$('.getmerchantApi').removeAttr('disabled').removeClass('disabled');
	    } else {
		$('.getmerchantApi').attr('disabled', 'disabled').addClass('disabled');
	    }
	});
	
	$('body').on('click', '.getmerchantApi', function(e){
		var _this = $(this);
		var access_token = '<?php echo $access_token ?>';
		var shop = '<?php echo $_REQUEST['shop'] ?>';
		var term_and_condition = $("input[name='term_and_condition']:checked").val();
		$.ajax({
		type: 'POST',
		url: '/getmerchantApi.php?access_token='+access_token+'&shop='+shop+'&term_condition='+term_and_condition,
		dataType: 'html',
		success: function(data) {
			fetchMerchantApi(data);
		}
		}); 
	}); 
	
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
