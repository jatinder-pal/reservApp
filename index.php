
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
echo $server = 'https://'.$_SERVER['SERVER_NAME'];
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
	<h1 class="title">Welcome to Reserv!</h1>
	<div id="tabs">
		<ul>
		<li><a href="#settings">Settings</a></li>
		<li><a href="#faq">FAQ</a></li>
		<li><a href="#contactus" class="contacttab">Contact Us</a></li>
		</ul> 
		<div id="settings">
			<div class="section-top">
				<div class="generate_key">
					<form method="post" name="merchantform" id="getmerchantApi" action="#">
						<input id="term_and_condition" type="checkbox" name="term_and_condition" value="term_condition" />
						<label>I Agree to the <a data-target="#termModal" href="javascript:void(0);" class="popup_click">Terms and Conditions</a></label>
						<div class="api_buttons">
							<input type="button" class="allbtns getmerchantApi" value="Get Merchant ID" name="submit" />
						</div>
					</form>
					<!-- Terms and Condition Modal -->
					<div class="modal fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								</div>
							<div class="modal-body">
								<div class="merchant-agreement">
									<h3 class="modal-title">Merchant Agreement</h3>
									<h4 class="modal-subtitle">Merchant Signup Form (“Order Form”)</h4>
									<div class="columns">
										<div class="left-column"><b>Service Provider</b></div>
										<div class="right-column">
											<p><b>Agatsu, LLC, d/b/a Forward Funded</b>(referred to herein as <b>“Reserv”</b>)</p>
											<p><b>Address:</b> 128 Monroe St., Rockville, MD 20850</p>
											<p><b>Attn:</b> Brendan Snow</p>
											<p><b>Email:</b> <a href="mailto:Brendan.snow@forwardfunded.com">Brendan.snow@forwardfunded.com</a></p>
											<p><b>Phone:</b> 303-304-0208</p>

										</div>
									</div>
									<div class="columns">
										<div class="left-column">Merchant</div>
										<div class="right-column">
											<p><b>Any merchant that has hereby downloaded the Reserv app from the Shopify store and uses it to create digital layaway, automated saving, or other saving plans (e.g. “Reserves”) for the customers of its ecommerce store.</b></p>
										</div>
									</div>
									<div class="columns">
										<div class="left-column"><b>Merchant Stores/Websites to be Integrated</b></div>
										<div class="right-column">
											<p><br/><br/></p>
										</div>
									</div>
									<div class="columns">
										<div class="left-column"><b>Effective Date</b></div>
										<div class="right-column">
											<p><b>October 9, 2017</b></p>
										</div>
									</div>
									<div class="columns">
										<div class="left-column"><b>Territory</b></div>
										<div class="right-column">
											<p><b>United States</b></p>
										</div>
									</div>
									<div class="columns">
										<div class="left-column"><b>Description of Services</b></div>
										<div class="right-column">
											<p><b>Digital layaway, automated saving, saving goals, save up before purchase, or other plans, referred to as amongst other things, “Reserves”.</b></p>
										</div>
									</div>
									<div class="columns">
										<div class="left-column"><b>Service Fees and Payment Terms</b></div>
										<div class="right-column">
											<p><b>2% of completed plans OR 2% of down payments remitted to Crown and Caliber</b><br/></p>
										</div>
									</div>
									<div class="columns">
										<div class="left-column"><b>Term</b></div>
										<div class="right-column">
											<p>This Merchant Agreement (the <b>“Agreement”</b>) shall commence on the Effective Date and shall continue through the end of December 31st 2018(the <b>“Initial Term”</b>) unless sooner terminated in accordance with Section 10.2 of the attached Merchant Terms and Conditions.  Following the Initial Term, this Agreement shall automatically renew for successive one (1) year terms unless either party provides the other with written notice of non-renewal at least thirty (30) days prior to the expiration of the then current term (each a <b>“Renewal Term”</b> and collectively with the Initial Term, the <b>“Term”</b>).</p>
										</div>
									</div>
									<div class="columns">
										<div class="left-column"><b>Merchant Terms and Conditions</b></div>
										<div class="right-column">
											<p>This Merchant Agreement (including the Order Form) may be executed in one or more counterparts, each of which when executed and delivered shall be deemed an original, but all of which taken together shall constitute one and the same agreement.  By signing below, the undersigned represents that he/she is duly authorized to sign on behalf of the party for whom he/she signs, and that this Merchant Agreement constitutes the valid and binding agreement of such party.  The Merchant Terms and Conditions located in Exhibit “A” are incorporated into this Agreement by reference.  If there is any conflict between this Order Form and the Merchant Terms and Conditions, this Order Form shall control.  Certain capitalized terms not otherwise defined herein shall have the meanings ascribed to such terms in the attached Merchant Terms and Conditions.</p>
										</div>
									</div>
								</div>
								<div class="exhibit-a">
									<h3 class="modal-title">Exhibit “A”</h3>
									<h4 class="modal-subtitle">MERCHANT TERMS &amp; CONDITIONS</h4>
									<ul>
										<li><div class="head"><strong>SECTION 1.DEFINED TERMS</strong></div></li>
										<li>1.1	<b>“Brand Features”</b> means the registered and unregistered trade names, trademarks, service marks, logos, domain names, and other distinctive brand features of each party.</li>
										<li>1.2	<b>“Buyer”</b> means a person that purchases digital, virtual or physical goods and/or services from the Merchant.</li>
										<li>1.3	<b>“Disputes”</b> means any disagreements, litigation, or other disputes between Merchant and a Buyer with respect to the Products or a Transaction or between Merchant and a third party arising from the use of the Service, but excluding Service Disputes.</li>
										<li>1.4	<b>“Reserv Account Holder”</b> means the individual that establishes an Reserv Account and provides a Payment Account to be used for the Service.</li>
										<li>1.5	<b>“ReservPlatform”</b> means that certain app (including the Reserv button) provided by Reservthat provides the Service that is owned or operated by Reserv or its affiliates and is non-exclusively licensed to Merchant pursuant to the terms of this Agreement.</li>
										<li>1.6	<b>“Merchant Stores and Websites”</b> means all e-commerce store locations and website(s) at the URL(s) listed in the Merchant Agreement Order Form (the “Order Form”), and such other websites as mutually agreed in writing by Reserv and Merchant.</li>
										<li>1.7	<b>“Payment Account”</b> means the credit card account, debit card account, or other payment instrument that is registered by anReservAccount Holder with the Service and accepted by Reserv to facilitate the processing of Payment Transactions.</li>
										<li>1.8	<b>“Payment Transaction”</b> means the initiation of the processing of a payment through the Service that results in the debiting or charging of the Purchase Amount to anReserv Account Holder’s Payment Account and the issuance of funds to Merchant’s settlement account.</li>
										<li>1.9	<b>“Products”</b> mean any digital, virtual or physical merchandise, goods, or services offered by Merchant that a Buyer may pay for using the Service.</li>
										<li>1.10 <b>“Purchase Amount”</b> means the monetary amount of a Payment Transaction, which includes any taxes, shipping charges, handling charges, or other fees that are charged to the Buyer as part of the Payment Transaction.</li>
										<li>1.11 <b>“Service”</b> means the Reserv service, including the Reserv Platform, described in this Agreement that facilitates the processing of Payment Transaction(s) on behalf of Merchant to complete a payment for a purchase between Merchant and Buyer.</li>
										<li>1.12 <b>“Service Disputes”</b> mean any disagreements, litigation, or other disputes between Reserv and Buyers arising solely from an error in the functioning of the Service.</li>
										<li>1.13 <b>“Transaction”</b> shall mean the purchase of Products from Merchant by a third party Buyer.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 2.SERVICES AND RESERV OBLIGATIONS.</strong></div></li>
										<li>2.1	<b>Changes to Service.</b>  Reserv has the right: (i) to change, suspend or discontinue the Service and/or the technology, infrastructure or security related thereto, in whole or in part, as necessary to perform maintenance or updates to the Service or as otherwise determined by Reserv, in its sole discretion; and (ii) to impose limits on certain features or restrict access to parts or all of the Service without notice and without liability.  Reserv may decline to initiate the process for any Payment Transaction in connection with, among other reasons, fraud prevention activities, applicable law, or Reserv privacy or data security policies.</li>
										<li>2.2	<b>Changes to Fees.</b>  Reserv has the right to revise the Service fees from time to time, at any time for and during any subsequent renewal period(s) following the Initial Term, but shall communicate such fee change to Merchant within a reasonable time frame prior to such change in fee taking affect.  In the event that such change is unacceptable to the Merchant, Merchant shall be entitled to terminate the Agreement.</li>
										<li>2.3	<b>Secure Transactions.</b>  Reserv has implemented and will maintain security systems for the transmission of Merchant’s Transactions, consisting of encryption and “firewall” technologies that are understood in the industry to provide adequate security for the transmission of such information.  Reserv does not guarantee the security of the Services or Transaction or Payment Transaction data, and Reserv will not be responsible in the event of any infiltration of its security systems, provided that Reserv has used commercially reasonable efforts to prevent any such infiltration.  Merchant further acknowledges and agrees that Merchant, and not Reserv, is responsible for the security of Transaction and Payment Transaction data or information or any other information stored on Merchant’s servers, and that Reserv is not responsible for any other party’s servers (other than subcontractors of Reserv solely to the extent Reserv is liable for its own actions hereunder).</li>
										<li>2.4	<b>Additional Service Terms.</b>  Merchant acknowledges and agrees that: (i) Merchant’s sales of Products are transactions between Merchant and the Buyer and not with Reserv; (ii) Reserv is a third-party service provider facilitating the processing of Payment Transactions for Merchant and is not a party to any Payment Transaction; (iii) Reserv is not a bank or other chartered depository institution; (iv) the receipt of an authorization for a Payment Transaction indicates only that, as of the date of the authorization, the underlying Payment Account has sufficient credit with the card issuer for the amount of the Purchase Amount and is within the parameters established by the Reserv Account Holder; (v) the authorization is not a confirmation of the Buyer’s identity; nor is an authorization a guarantee by Reserv that the Transaction will not be subject to a chargeback or other reversal; and (vi) any Transaction data received by Reserv may be compiled and used by Reserv for any purpose and shared with affiliated entities, Reserv Account Holders, participating merchants and third parties.</li>
										<li>2.5	<b>No Endorsement.</b>  Unless otherwise agreed to in writing between Merchant and Reserv, Merchant acknowledges that Reserv does not endorse the Merchant Stores and Websites, any of the information or other content appearing on the Merchant Stores and Websites (“Merchant Content”), or any of the Products.  Merchant agrees not to state or imply any endorsement by Reserv on the Merchant Stores and Websites or otherwise.  To the extent that Merchant Content appears within the Service or on ReservPlatform, Reserv reserves the right to modify or remove the Merchant Content, at its sole discretion.</li>
										<li>2.6	<b>Disputes.</b>  Merchant is solely responsible for Disputes, chargeback or refund requests from Buyer and Reserv is not a party to and will not be responsible for any Disputes, chargebacks or refunds.  Reserv is solely responsible for Service Disputes and Merchant is not a party to and will not be responsible for any Service Disputes; provided, that Merchant agrees to provide reasonable assistance to Reserv in resolving Service Disputes.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 3.SERVICE IMPLEMENTATION AND SUPPORT</strong></div></li>
										<li>3.1	<b>Implementation of Service.</b>  Merchant agrees to provide current, complete and accurate registration information for the Service and to maintain and promptly update the information.  Merchant will integrate Merchant Stores and Websites with the Service in accordance with the integration instructions provided by Reserv.Reserv reserves approval authority as to the implementation of the Service in connection with each Merchant Store and Website, and Reserv may upon notice suspend Merchant’s use of the Service until Merchant corrects implementation issues as reasonably specified by Reserv.</li>
										<li>3.2	<b>Implementation Updates.</b>  Merchant will provide Reserv with sixty (60) days advance notice of any change to Merchant Stores and Websites or the code or technology used to implement the Service in connection with Merchant Stores and Website that could reasonably be expected to adversely affect Merchant’s implementation of the Service.  If Reserv updates the technical or implementation specifications for the Service, Merchant will implement the updates as soon as reasonably practical, but no later than ninety (90) days of receiving notice of the updates.  If Reserv updates its look and feel or branding specifications, Merchant will implement the updates as soon as reasonably practical, but no later than thirty (30) days of receiving notice of the updates.</li>
										<li>3.3	<b>Support.</b>  Reserv shall provide technical support services to Merchant with respect to the implementation and operation of the Service as commercially reasonable.Merchant may submit a written request for technical support via email to <a href="mailto:info@myreserv.com">info@myreserv.com</a> or <a href="mailto:brendan.snow@forwardfunded.com">brendan.snow@forwardfunded.com</a> or such other email address or methods specified by Reserv from time to time. </li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 4.MERCHANT OBLIGATIONS</strong></div></li>
										<li>4.1	<b>Obligations.</b> Merchant shall be solely responsible for:
											<ul>
												<li>a.	Establishing, hosting and maintenance of Merchant Stores and Websites;</li>
												<li>b.	Providing Reserv at least thirty (30) days prior written notice of any change in Merchant’s payment gateway provider, merchant account and/or merchant ID;</li>
												<li>c.	Fulfilling all orders and handling all returns, refunds and chargebacks for Products sold by Merchant to Buyers using the Service and ensuring that any data stored or transmitted by Merchant in conjunction with the Services is accurate, complete and in the form as requested by Reserv;</li>
												<li>d.	Keeping its Reserv Service login name, ID and password confidential.  Merchant shall notify Reserv immediately upon learning of any unauthorized use of its user name, ID or password.  Merchant shall be solely responsible for: (i) updating its passwords or IDs for access to the Service periodically, and (ii) creating passwords that are reasonably strong under the circumstances.  Merchant agrees to restrict use and access to its password to its employees and contractors as is strictly necessary and shall ensure that such employees and contractors comply with the terms of this Agreement.  Merchant is solely responsible for all activities that occur under its account and password, whether or not it authorized the activity;</li>
												<li>e.	Maintaining commercially reasonable business practices in conjunction with use of the Service, and collecting, storing and transmitting its Merchant data in a secure manner and protecting the privacy of such Merchant data, including ensuring that Merchant’s payment gateway provider are compliant with the Payment Card Industry Data Security Standards; and</li>
											</ul>
										</li>
										<li>4.2	<b>Limitations on the Use of Service.</b>  Merchant shall only use the Service to process a Payment Transaction for a Product that is purchased by a Buyer through a legitimate, bona fide sale of the Product.  Merchant will comply with the Service usage policies, as updated by Reserv from time to time, including, without limitation, integration guidelines, Reserv brand guidelines, data security requirements, and operating rules and/or policies of the card associations or networks that are used to process the Payment Transactions.</li>
										<li>4.3	<b>Data Protection.</b>
											<ul>
												<li>a.	Merchant and each of its subsidiaries, if any (collectively, the <b>“Merchant”</b>), are currently in compliance, and will remain in compliance throughout the Term, with applicable state and federal laws, rules, regulations, codes, orders, decrees, guidelines and rulings thereunder of any federal, state, provincial, regional, county, city, municipal or local government of the United States, or any department, agency, bureau or other administrative or regulatory body obtaining authority from any of the foregoing relating to privacy and protection of Personal Information (as defined below) (collectively, the <b>“Privacy Laws”</b>).  For purposes of this Section, <b>“Personal Information” </b> shall have the meaning set forth in any applicable Privacy Laws that defines data that identifies or can be used to identify individuals.</li>

												<li>b.	All websites established or maintained by the Merchant and Reserv that are accessible to individuals contain privacy statements advising them how their Personal Information will be used, collected, stored and protected.  The Merchant and Reserveach agree to implement and maintain such appropriate security measures for the Personal Information they maintain as required by applicable Privacy Laws.  Each party agrees that it will not store or maintain Personal Information received via its website, except in a manner consistent with its published privacy policies and the requirements set forth in any applicable Privacy Laws.</li>

												<li>c.	The Merchant has entered into written agreements with all of its relevant vendors, service providers and other entities (<b>“Merchant’s Third Party Service Providers”</b>), to which it provides Personal Information maintained on behalf of Reserv, that require Merchant’s Third Party Service Providers to protect such Personal Information in a manner that is substantially similar to the protections that the Merchant is required by law, or pursuant to its published privacy policies, to provide to the individuals involved or to Reserv.  </li>

												<li>d.	If the Merchant receives notice regarding any violation of any Privacy Laws, has reason to believe such notice will be received or has reason to believe that the security of any records containing Personal Information that identifies individuals that the Merchant maintains has been breached or potentially breached, the Merchant shall immediately provide notice to Reserv regarding such notice or knowledge.  Merchant shall cooperate with and follow the instructions of Reserv in responding to any such breach related to Personal Information that was provided to the Merchant by Reserv, or by Reserv employees, agents or customers, hereunder.</li>

												<li>e.	Upon termination of the Agreement, the Merchant shall return to Reservall Personal Information, or destroy such Personal Information beyond recovery and certify such destruction in writing to Reserv.  Without limiting the foregoing, upon termination of the Agreement, the Merchant shall use the best possible means to scrub, shred or otherwise destroy beyond recovery all electronic Personal Information in its possession, certifying such destruction in writing to Reserv, and providing Reserv a written explanation of the method used for data disposal/destruction, along with a written certification that such method meets or exceeds Reserv’s data handling standards and industry best practices for the disposal/destruction of sensitive data.</li>
											</ul>
										</li>
										<li>4.4	<b>Prohibited Actions.</b>  Merchant shall not use the Service to process Payment Transactions in connection with an illegal transaction or the sale or exchange of any illegal or prohibited goods or services, including those prohibited for sale to children under the age of eighteen (18).  Unless expressly permitted in writing by Reserv, Merchant may not: (i) require Buyer to provide Merchant with the account numbers of any credit card, debit card or other payment instrument once Buyer has selected to use the Service as their payment mechanism; (ii) add any Service use surcharge to a Payment Transaction; (iii) separately process as a Payment Transaction the amount of any tax applicable to a purchase of a Product; (iv) submit to the Service a Payment Transaction that was previously returned as a chargeback; or (v) permit the use of the Service for payment of any debt owed to Merchant by Buyer.</li>
										<li>4.5	<b>Refunds and Adjustments.</b>  Merchant will disclose/display its return/cancellation policy as required by applicable law.  Merchant (and not Reserv) will be responsible for responding to, handling and processing all returns, refunds and chargebacks for Products sold by Merchant to Buyers using the Service in connection with the Merchant Stores and Websites.  If Merchant allows a return, cancellation, refund or price adjustment in connection with a Payment Transaction, Reserv will assist Merchant by initiating a return payment, provided that Merchant provides Reserv with the Merchant order ID and any other Transaction data or information required.  Refunds cannot exceed the total amount of the Payment Transaction.  If Merchant provides a refund through a means other than through the Service, Merchant remains responsible if the Payment Transaction results in a chargeback through the Service.  Merchant acknowledges that even if Merchant’s return/cancellation policy prohibits returns or cancellations, Merchant may still receive chargebacks relating to the transactions.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 5.SERVICE FEES AND PAYMENT TERMS</strong></div></li>
										<li>5.1	<b>Late Fees.</b>  Any fees remaining unpaid after thirty (30) days from the date of invoice shall accrue interest at a rate of the lesser of: (a) 1.5% per month, compounded monthly; or (b) the highest rate allowed by law.  If collection procedures are required, Merchant shall pay all expenses of collection and all reasonable attorneys’ fees and costs incurred by Reserv in connection with such collection proceeding, regardless of whether or not a suit is filed.  Failure of Merchant to make any payment of any fees when due shall be deemed to be a material breach of this Agreement and shall, if not cured within fifteen (15) days after notice of such breach, be sufficient cause for the immediate suspension of Reserv’s provision of Service and/or termination of this Agreement as provided hereunder.</li>
										<li>5.2	<b>Taxes.</b>  Merchant will pay any applicable taxes, including sales, use, personal property, value-added, excise, customs fees, import duties or stamp duties or other taxes and duties imposed by governmental entities of whatever kind and imposed with respect to the transactions under this Agreement, including penalties and interest, but specifically excluding taxes based upon Reserv’s net income.  For purposes of clarification, Reserv is not responsible for, and is not the entity collecting sales or income or other taxes with respect to Transactions or Payment Transactions of Buyers.  In the event that Reserv has the legal obligation to collect any applicable taxes, the appropriate amount will be invoiced to and paid by Merchant net thirty (30) days from the date of invoice or other notification.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 6.BRAND FEATURES</strong></div></li>
										<li>6.1	<b>Reserv Brand Features.</b>  Subject to this Agreement and after Merchant has implemented the Service, Reserv grants Merchant a limited, royalty-free, non-exclusive and non-sublicensable license to reproduce, distribute and display Reserv Brand Features for the sole purpose of promoting the availability of the Service on the Merchant Stores and Websites.  Merchant will not alter or modify any Reserv Brand Features and will use them only in accordance with such usage and other guidelines as may be provided by Reserv to Merchant from time to time.  Any other uses of Reserv Brand Features require prior written approval from Reserv.  Reserv may revoke the permission granted in this paragraph to use Reserv Brand Features by providing written notice to Merchant and a reasonable period of time to cease usage.</li>
										<li>6.2	<b>Merchant Brand Features.</b>  Subject to this Agreement, Merchant grants Reserv a limited, royalty-free, nonexclusive and non-sublicensable license to reproduce, distribute and display Merchant Brand Features in connection with: (i) operating the Service and (ii) promotions, presentations, marketing materials, verbal communications, and lists of merchants that identify Merchant as a participating merchant that has implemented the Service, including a merchant directory posted on the ReservPlatform.  Reserv will not alter or modify any Merchant Brand Features and will use them in accordance with such usage and other guidelines as may be provided by Merchant to Reserv from time.  Any other uses of Merchant Brand Features require prior written approval from Merchant.  Merchant may revoke the permission granted in this paragraph to use Merchant Brand Features by providing written notice to Reserv and a reasonable period of time to cease usage.</li>
										<li>6.3	<b>Brand Feature Rights.</b> Each party retains all right, title and interest, including, without limitation, all intellectual property rights, relating to its own Brand Features.  Except as expressly provided in this Agreement, neither party acquires any right, title or interest in any Brand Features of the other party, and any rights not expressly granted are deemed withheld.  All use by Reserv of Merchant Brand Features (including any associated goodwill) will inure to the benefit of Merchant, and all use by Merchant of Reserv Brand Features (including any associated goodwill) will inure to the benefit of Reserv.  While this Agreement remains in effect and upon request, each party agrees to furnish the other party with samples of the usage of the other party’s Brand Features as contemplated by this Section 6 to enable the other party to monitor and ensure that the usage is consistent with the other party’s quality control requirements.  While this Agreement remains in effect, Merchant agrees not to challenge or assist others to challenge the Reserv Brand Features (except to protect Merchant’s rights to its own Brand Features) and not to register any Brand Features or domain names that are confusingly similar to those of Reserv.  The licenses for the Brand Features granted under this Agreement shall terminate immediately upon termination of this Agreement for any reason at which time both parties shall cease any further use of the other party’s Brand Features.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 7.CONFIDENTIALITY AND PROPRIETARY RIGHTS</strong></div></li>
										<li>7.1	<b>Confidentiality Obligations.  “Confidential Information”</b> means: (a) all Reservsoftware, technology, programming, specifications, materials, guidelines and documentation relating to the Service; (b) any information disclosed by one party to the other under this Agreement, including, without limitation, tangible, intangible or electronic information such as: (i) trade secrets; (ii) financial information, including pricing terms of this Agreement; (iii) technical information, including source code, research, development, procedures, algorithms, data, designs, and know-how; and (iv) business information, including operations, planning, marketing and promotion plans, and products; and (c) any other information that is marked confidential or if disclosed orally designated as confidential at the time of disclosure or that should be reasonably understood to be confidential.  Each party shall: (i) use the other party’s Confidential Information only for the purpose of its performance under this Agreement; (ii) not disclose to any third party or use any Confidential Information disclosed to it by the other except as expressly permitted in this Agreement and for purposes of performing this Agreement; and (iii) shall take reasonable measures to maintain the confidentiality of all Confidential Information of the other party in its possession or control, which shall in no event be less than the measures it uses to maintain the confidentiality of its own proprietary information or Confidential Information of similar importance.  Upon written request, each party will promptly return all Confidential Information of the other party, together with all copies, or certify in writing that all Confidential Information and copies have been destroyed.</li>
										<li>7.2	Confidentiality Limitations and Exceptions.  The obligations set forth this in this Section 7 do not apply to information that: (i) is in or enters the public domain without breach of this Agreement; <br/>(ii) the receiving party lawfully receives from a third party without restriction on disclosure and without breach of a nondisclosure obligation, <br/>(iii) the receiving party knew prior to receiving such information from the disclosing party or develops independently without access or reference to the Confidential Information;<br/> (iv) is disclosed with the written approval of the disclosing party; or <br/>(v) is disclosed five (5) years from the effective date of termination or expiration of this Agreement.  Notwithstanding anything to the contrary above, each party may disclose Confidential Information of the other party: (i) to the extent required by a court of competent jurisdiction or other governmental authority or otherwise as required by law but only after alerting the other party of such disclosure requirement and, prior to any such disclosure, allowing (where practicable to do so) the other party a reasonable period of time within which to seek a protective order against the proposed disclosure, or (ii) on a “need-to-know” basis under an obligation of confidentiality substantially similar in all material respects to those confidentiality obligations in this Section 7 to its legal counsel, accountants, contractors, consultants, banks and other financing sources.</li>
										<li>7.3	<b>Merchant Username, Password, and Merchant Key.</b>  Merchant will be responsible for maintaining the confidentiality of its Service username/password/ID.  Merchant is responsible for all activity by persons that use the username/password/ID, including any consequences of the use or misuse of the username/password/ID.  Merchant agrees to notify Reserv immediately of any unauthorized use of its username/password/ID or any other breach of security regarding the Service of which Merchant has knowledge.  Merchant agrees that all officers, employees, agents, representatives and others having access to the Service username/password/ID will be vested by Merchant with the authority to use the Service and legally bind Merchant.</li>
										<li>7.4	<b>Proprietary Rights.</b>  Reserv, and as applicable its licensors, retain all right, title and interest, including, without limitation, all intellectual property rights relating to the Service (and any derivative works or enhancements thereof) and materials provided to Merchant by Reserv in connection with the Service, including, but not limited to, all software, technology, information, content, materials, guidelines, and documentation.  Merchant does not acquire any right, title, or interest therein, except for the limited use rights expressly set forth in the Agreement.  Any rights not expressly granted in this Agreement are deemed withheld.  Merchant agrees not modify, adapt, translate, prepare derivative works from, decompile, reverse engineer, disassemble or otherwise attempt to derive source code from the Service or software which are provided to Merchant by Reserv hereunder.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 8.WARRANTIES AND DISCLAIMER</strong></div></li>
										<li><b>8.1	Representations and Warranties.</b>  Merchant represents and warrants to Reserv that: <br>(a) if an individual, Merchant is a resident of the United States and is at least eighteen (18) years old; <br>(b) if a business entity, Merchant is duly authorized to do business in the United States; <br>(c) Merchant has all requisite corporate or other power and authority to enter into and perform its obligations under this Agreement and this Agreement will constitute the valid and binding obligations of Merchant; <br>(d) Merchant owns and controls the Merchant Stores and Websites and otherwise has and will maintain all rights, authorizations and licenses that are required to permit Merchant to use the Service in connection with the Merchant Stores and Websites; <br>(e) Merchant’s execution of this Agreement and use of the Service does not violate any other agreement to which Merchant is subject; and <br>(f) Merchant will comply with all applicable laws, regulations and ordinances in connection with Merchant’s use of the Service and use and disclosure of any data required hereunder.  Reserv represents and warrants to Merchant that: <br>(i) Reserv is duly authorized to do business in the United States; <br>(ii) Reserv has all requisite corporate or other power and authority to enter into and perform its obligations under this Agreement and this Agreement will constitute the valid and binding obligations of Reserv; <br>(iii) Reserv’s execution of this Agreement and provision of the Service does not violate any other agreement to which Reserv is subject; and <br>(iv) Reserv will comply with all applicable laws, regulations and ordinances in connection with Reserv’s provision of the Service.</li>
										<li>8.2	<b>DISCLAIMER OF WARRANTIES.</b>THE SERVICE (INCLUDING ALL CONTENT, SOFTWARE, DATA TRANSMISSION, FUNCTIONS, MATERIALS AND INFORMATION PROVIDED IN CONNECTION WITH OR ACCESSIBLE THROUGH THE SERVICE) IS PROVIDED “AS IS” AND WITHOUT WARRANTY.  RESERV AND ITS AFFILIATES AND AGENTS DISCLAIM ALL WARRANTIES (WHETHER EXPRESS, IMPLIED, STATUTORY OR OTHERWISE), INCLUDING, WITHOUT LIMITATION, WARRANTIES OF NON-INFRINGEMENT, MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. Reserv does not warrant that the operation of the Service will be uninterrupted or error free.  Reserv will not be responsible for any service interruptions or delay, including, but not limited to, power outages, system failures or other interruptions that may affect the receipt, processing, acceptance, completion or settlement of Payment Transactions or the Service.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 9.LIMITATION OF LIABILITY AND INDEMNIFICATION</strong></div></li>
										<li>9.1	<b>Limitation of Liability.</b> Merchant acknowledges that Reserv is not a financial or credit reporting institution.  Reserv is responsible only for providing data transmission to effect or direct certain payment authorizations for Merchant and is not responsible for the results of any credit inquiry, the operation of web sites of ISPs or financial institutions or the availability or performance of the Internet, or for any damages or costs Merchant suffers or incurs as a result of any instructions given, actions taken or omissions made by Merchant, Merchant’s financial processor(s), or any ISP.  IN NO EVENT WILL RESERV’S LIABILITY (INCLUDING LIABILITY FOR NEGLIGENCE) ARISING OUT OF THIS AGREEMENT EXCEED THE FEES PAID TO RESERV BY MERCHANT HEREUNDER DURING THE THREE (3) MONTH PERIOD IMMEDIATELY PRECEDING THE EVENT WHICH GAVE RISE TO THE CLAIM FOR DAMAGES.  IN NO EVENT WILL RESERV OR ITS LICENSORS HAVE ANY LIABILITY (INCLUDING LIABILITY FOR NEGLIGENCE) TO MERCHANT OR ANY OTHER PARTY FOR ANY LOST OPPORTUNITY OR PROFITS, COSTS OF PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES, OR FOR ANY INDIRECT, INCIDENTAL, CONSEQUENTIAL, PUNITIVE OR SPECIAL DAMAGES ARISING OUT OF THIS AGREEMENT, UNDER ANY CAUSE OF ACTION OR THEORY OF LIABILITY (INCLUDING NEGLIGENCE), AND WHETHER OR NOT RESERV HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  THESE LIMITATIONS WILL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY.  Notwithstanding the above, the limitations set forth above shall be enforceable to the maximum extent allowed by applicable law.</li>
										<li>9.2	<b>Indemnification.</b> This Section is subject to the terms of Section 9.1, above.  Either party will defend, indemnify, and hold harmless the other party and the officers, directors, agents and employees of the other party from any and all third party claims, demands, liabilities, costs or expenses, including damage awards, settlement amounts and reasonable attorneys’ fees, resulting from the indemnifying party’s material breach of any duty, representation or warranty of this Agreement.  A party’s right to indemnification under the Agreement (<b>“Indemnified Party”</b>) is conditioned upon the following: prompt written notice to the party obligated to provide indemnification (<b>“Indemnifying Party”</b>) of any claim, action or demand for which indemnity is sought; control of the investigation, preparation, defense and settlement thereof by the Indemnifying Party; and such reasonable cooperation by the Indemnified Party, at the Indemnifying Party’s request and expense, in the defense of the claim.  The Indemnified Party shall have the right to participate in the defense of a claim by the Indemnifying Party with counsel of the Indemnified Party’s choice at the Indemnified Party’s expense.The Indemnifying Party shall not, without the prior written consent of the Indemnified Party, settle, compromise or consent to the entry of any judgment that makes any admissions in the Indemnified Party’s name or imposes any liability upon the Indemnified Party.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 10.TERM AND TERMINATION</strong></div></li>
										<li>10.1 <b>Term.</b> This Agreement shall be effective once both Parties have fully executed this Agreement, and shall continue until the date set forth on the face of the Order Form, unless otherwise terminated in accordance with Section 10.2 herein.</li>
										<li>10.2 <b>Termination.</b> Reserv may terminate this Agreement or suspend Merchant’s use of the Service without liability to Merchant,<br/> (i) following ten (10) days prior electronic or written notice if: <br/>(a) Merchant is in breach of this Agreement, <br/>(b) causes or fails to fix a security breach relating to the Service, <br/>(c) fails to comply with Reserv’s best practices requirements for security management or to respond to an inquiry from Reserv, concerning the accuracy or completeness of the information Merchant is required to provide pursuant to this Agreement, <br/>(d) non-payment of Fees due Reserv hereunder and payment is not received within ten (10) days following notice thereof; and (ii) immediately, without prior notice, if: <br/>(a) Reserv reasonably believes Merchant’s breach compromises the security of the Service in any material fashion, <br/>(b) fraudulent Transactions are being made in Merchant Stores and Websites using the Service, or <br/>(c) Reserv’s financial processor requires such termination or suspension or terminates a relationship necessary for the provision of the Service.  In addition, either party may terminate this Agreement without prior notice effective immediately in the event that the other party: <br/>(i) files a petition for bankruptcy or reorganization, or such a petition is filed against it; <br/>(ii) becomes insolvent or makes an assignment for the benefit of its creditors; or <br/>(iii) breaches its confidentiality obligations under Section 7 of this Agreement and such event is not cured (if reasonably capable of being cured) within five (5) days following such breach.  If Services are suspended or terminated by Reserv due to lack of payment by Merchant, reinstatement of Services shall be subject to Merchant paying Reserv all past due Fees, at Reserv’s then current rates as applicable.</li>
										<li>10.3 <b>Effect of Termination.</b> Upon termination or expiration of this Agreement, Reserv will terminate Merchant’s access to the Service and Merchant will remove the ReservService from Merchant Stores and Websites.  Each party will be released from all obligations and liabilities to the other occurring or arising after the date of such termination or expiration, except Merchant will remain liable for chargebacks for Transactions made using the Service prior to such date.  Notwithstanding the foregoing, Merchant’s obligations to pay all Fees incurred prior to the date of termination or expiration and the provisions of Sections 2.6, 4.3, 4.5, 5.2, 6.3, 7, 8, 9, 10 and 11 will survive any termination or expiration of this Agreement.</li>
									</ul>
									<ul>
										<li><div class="head"><strong>SECTION 11.GENERAL</strong></div>
										</li><li>11.1 <b>Notices.</b> Reserv may communicate with Merchant regarding the Service by means of electronic communications, including: <br/>(i) sending electronic mail to the email address Merchant provided to Reserv during registration or <br/>(ii) posting of notices or communications on the Merchant page of the ReservPlatform.  All other notices, including notices required under this Agreement, will be written in English and shall be delivered by U.S. Postal service or nationally recognized overnight courier addressed to the party at its address set forth in the Order Form or such other address as such party may designate in writing.  Notice will be deemed given upon receipt when delivered personally, upon written verification of receipt from overnight courier, or upon verification of receipt of registered or certified mail.  All notices to Reserv shall be to the attention of Legal Counsel.</li>
										<li>11.2 <b>Governing Law; Venue.<b>  The validity, interpretation and performance of this Agreement shall be governed by the laws of the State of Maryland without giving effect to the conflicts of laws provisions thereof.  Exclusive venue for the resolution of any dispute between these parties shall be in the state and federal courts located in Montgomery County, Maryland and each party consents to personal jurisdiction in these courts.  The parties specifically exclude from application to this Agreement the United Nations Convention on Contracts for the International Sale of Goods and the Uniform Computer Information Transactions Act.  In any legal proceeding arising out of or relating to this Agreement, the prevailing party shall recover all its costs incurred in prosecuting or defending such legal proceeding, including its reasonable attorneys’ fees.</li>
										<li>11.3 <b>Assignment.</b> Except as specifically permitted below, Merchant shall not have the right to assign its rights or obligations hereunder to any other person or entity, without the prior written consent of Reserv.  Merchant shall be permitted to assign this Agreement without consent (but with written notice) to: (i) any successor by merger, acquisition, consolidation or corporate restructuring; (ii) any parent, majority owned subsidiary or affiliate; or (iii) any entity which acquires all or substantially all of the stock or assets of the company or assets of the business unit in the company to which this Agreement relates; provided, such party agrees in writing to be bound by the terms and conditions of this Agreement.  Reserv may assign this Agreement or its rights and/or obligations hereunder upon notice to Merchant.</li>
										<li>11.4 <b>Force Majeure.</b> Neither party will be liable for failing or delaying performance of its obligations (except for the payment of money) resulting from any condition beyond its reasonable control, including but not limited to, governmental action, acts of terrorism, earthquake, fire, flood or other acts of God, labor conditions, power failures, and Internet disturbances.</li>
										<li>11.5 <b>Publicity.</b> Each party will treat this Agreement and its terms as confidential hereunder and will make no press release or public disclosure, either written or oral, regarding the existence of, or transactions contemplated by, this Agreement without the prior written consent of the other party, which consent shall not be unreasonably withheld or delayed; provided that the foregoing will not prohibit any disclosure to the extent required by applicable securities laws or the rules of any stock exchange where a party’s securities are traded or to a party’s attorneys, auditors or in response to a subpoena or request by governmental agency.  Notwithstanding anything herein to the contrary, Reserv shall have the right to list Merchant as a participating merchant on Reserv’s website, on publicly available customer lists, and in an initial press release announcing the execution of this Agreement and the relationship and transactions contemplated herein Agreement (excluding financial terms).</li>
										<li>11.6 <b>Other Provisions.</b> The failure of Reserv to exercise or enforce any right or provision of the Agreement will not constitute a waiver of the right or provision.  Headings are for reference purposes only and will not be used for interpretation of this Agreement.  Unless otherwise expressly stated, all amounts stated in this Agreement are denominated in United States dollars.  The policies and URLs referenced in this Agreement are incorporated by reference and may be updated by Reserv from time to time.  The parties are and will remain independent contractors and nothing in this Agreement will be deemed to create any agency, partnership, or joint venture relationship between the parties.  Neither party will be deemed to be an employee or legal representative of the other nor will either party have any right or authority to create any obligation on behalf of the other party.  If any provision of this Agreement is adjudged by any court of competent jurisdiction to be unenforceable or invalid, that provision will be limited or eliminated to the minimum extent necessary so that this Agreement will otherwise remain in full force and effect and remain enforceable between the parties.  This Agreement is not intended and will not be construed to create any rights or remedies in any parties other than Merchant and Reserv and no other person may assert any rights as a third party beneficiary; provided, that Indemnified Parties will be a third party beneficiary of the indemnity in Section 9.  This Agreement may be executed in any number of counterparts, each of which shall be deemed an original and together which shall constitute one and the same instrument and facsimile, adobe or other pdf signatures shall be effective as if originals.</li>
										<li>11.7 <b>Entire Agreement.</b> This Agreement constitutes the entire agreement between the parties with respect to the subject matter.  This Agreement supersedes any other prior or collateral agreements, whether oral or written, with respect to the subject matter.  The Agreement will be binding on and inure to the benefit of each of the parties and their permitted successors and assigns.</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
					<!-- Terms and Condition Modal -->
			</div>
				<div class="options option_outer">
					<form method="post" name="form" id="getoptions" action="#">
						<div class="auto_manual_outer">
							<p>Select an Automatic or Custom Reserv button set up?</p>
							<div class="options">
								<input id="automatic_code" type="radio" name="automatic_custom_code" value="automatic_code" checked />
								<label for="automatic_code">Automatic</label>
							</div>
							<div class="options">
								<input id="custom_code" type="radio" name="automatic_custom_code" value="custom_code" />
								<label for="custom_code">Custom</label>
							</div>
						</div>
						<div class="settings_err">Is the Reserv button not appearing? Try a Custom set up or <a href="javascript:void(0);" class="contactclick">contact us</a>.</div>
						<table>
							<tr class="1 height">
								<td>Options</td>
								<td colspan="2" class="custom_option" style="display:none;"><p class="tile_code">Enter the code you use to create your custom "Add to Cart" button in the textbox below, and the Reserv button will appear beneath your "Add to Cart" button</p></td>
							</tr>
							<tr style="height: 10px">
								<td style="padding: 5px"></td>
								<td style="padding: 5px"></td>
								<td style="padding: 5px"></td>
							</tr>
							<tr class="2">
								<td style="width: 1%;"><input id="product_page" type="checkbox" name="sel_options[]" value="product_page" checked /><label for="product_page"></label></td>
								<td>Product Page</td>
								<td class="custom_option" style="display:none;">
									<input id="product_page_class" type="text" name="product_page_class" value="" /></td>
								<td><a href="#" data-toggle="tooltip" title="If you check this box, the Reserv button will appear on each product page." class="tooltip"><img src="https://cdn.shopify.com/s/files/1/1678/5213/files/icons8-info.png?10135806894320450616" alt="info"></a></td>
							</tr>
							<tr class="3">
								<td style="width: 1%;"><input id="catalog_page" type="checkbox" name="sel_options[]" value="catalog_page" checked /><label for="catalog_page"></label></td>
								<td>Catalog Page</td>
								<td class="custom_option" style="display:none;">
									<input id="catalog_page_class" type="text" name="catalog_page_class" value="" /></td>
								<td><a href="#" data-toggle="tooltip" title="If you check this box, the Reserv button will appear on each catalog page." class="tooltip"><img src="https://cdn.shopify.com/s/files/1/1678/5213/files/icons8-info.png?10135806894320450616" alt="info"></a></td>
							</tr>
							<tr class="4">
								<td style="width: 1%;"><input id="cart_page" type="checkbox" name="sel_options[]" value="cart_page" checked /><label for="cart_page"></label></td>
								<td>Cart Page</td>
								<td class="custom_option" style="display:none;">
									<input id="cart_page_class" type="text" name="cart_page_class" value="" /></td>
								<td><a href="#" data-toggle="tooltip" title="If you check this box, the Reserv button will appear on cart page." class="tooltip"><img src="https://cdn.shopify.com/s/files/1/1678/5213/files/icons8-info.png?10135806894320450616" alt="info"></a></td>
							</tr>
						</table>
						<div class="generate_code_outer">
							<div class="code_submit">
								<input type="button" class="saveoptions" value="Show Reserv button" name="submit" />
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="css-section">
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
		</div>
		<div id="faq">
			<h5 class="faqhead">Where is customer money being held?</h5>
			<p class="faqcontent">Funds are held at our payment processor’s financial institution. Our payment processor is Dwolla, and they are a software layer on top of Veridian Credit Union.</p>
			<h5 class="faqhead">Do customers earn interest on my funds saved with Reserv?</h5>
			<p class="faqcontent">No, but we are working on making this possible. However, we're fee-free to customers. In today’s low interest rate environment, being fee-free often means customers will save money, even without being able to earn short term interest. Think of RESERV as “virtual envelope” system to help your customers save up for the items they want to buy from you but cannot afford right now.</p>
			<h5 class="faqhead">Does RESERV earn interest on customer money?</h5>
			<p class="faqcontent">No.</p>
			<h5 class="faqhead">How does RESERV make money?</h5>
			<p class="faqcontent">We earn a 2% commission on all products sold using a Reserv digital layaway or automated saving plan.</p> 
			<h5 class="faqhead">What happens if a customer cancels a Reserv layaway plan?</h5> 
			<p class="faqcontent">They may lose their down payment, if you as a merchant have decided to require one, but nothing more. Any funds in excess of the down payment will be remitted to you upon cancellation.</p> 
			<h5 class="faqhead">What is the customer return period?</h5>
			<p class="faqcontent">Return policies are set by the merchant. Merchants manage all returns and refunds.</p> 
			<h5 class="faqhead">How long do payments take to settle?</h5>
			<p class="faqcontent">Up to 5 business days, but often as little as one business day.</p>
			<h5 class="faqhead">Are there fees for customers?</h5>
			<p class="faqcontent">No, RESERV is completely fee-free to customers.</p>
			<h5 class="faqhead">Is this debt?</h5>
			<p class="faqcontent">No, RESERV is a savings vehicle. We want to help customers avoid debt while making the purchases they want, and help merchants sell higher AOV carts and drive incremental revenue.</p>
			<h5 class="faqhead">Are funds held in RESERV plans FDIC Insured?</h5>
			<p class="faqcontent">No. Customer money is kept with Dwolla’s partner credit union, Veridian Credit Union, based in Des Moines Iowa, in the form of cash. Neither Dwolla nor Veridian collect interest on customer funds.</p>
		</div>
		<div id="contactus">
			<strong>Please contact us at:</strong>
			<p>877-677-2607</p>
			<p>info@myreserv.com</p>
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
	var server = '<?php echo $_SERVER['SERVER_NAME']; ?>';
	$.ajax({
		url: '/addScript.php?access_token='+access_token+'&shop='+shop+'&options='+options+'&server='+server,
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
				$('.getmerchantApi').after('<a href="#" class="allbtns logintoreserv">Login to Reserv</a>');
				$('.api_buttons').after('<p class="code_merchantid_msg">Merchant ID: '+response+'</p>');
				$('#term_and_condition').attr('checked', true);
				$('.getmerchantApi').removeAttr('disabled').removeClass('disabled');
			}
		}
	 });
}
	
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({placement: "right"});
	$('.contactclick').on('click', function(){
		$('.contacttab').trigger('click');
	});
	 
	$('#custom_code').click(function(){
		$('.custom_option').slideDown();
	});
	$('#automatic_code').click(function(){
		$('.custom_option').slideUp();
	});
	
	fetchMetafield();
	fetchCssCode();
  	showMerchantmsg();
	
	$('.popup_click').click(function(){
		$('#termModal').modal();
	});
	
	$('#term_and_condition').click(function() {
	    var checked = $(this).is(':checked');
	    if (checked) {
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
		var auto_custom = $("input[name='automatic_custom_code']:checked").val();
		$("input[name='sel_options[]']:checked").each(function() {
		    var getid = $(this).attr('id');
		    Arraydata.push($(this).val()+':'+$('#'+getid+'_class').val());
		});
		$.ajax({
			type: 'POST',
			url: '/metafields.php?access_token='+access_token+'&shop='+shop+'&options='+Arraydata+'&auto_manual='+auto_custom,
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
