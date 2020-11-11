<?php
function funnelSettingsPopup($data_arr=array())
{
	$plugins_ob=false;
	if(isset($GLOBALS['plugin_loader']))
	{
	  $plugins_ob=$GLOBALS['plugin_loader'];
	}
	ob_start();
?>

<div class="row">
<div class="col-sm-12">
<span style="float:right;color:rgb(31, 87, 202);font-size:16px;margin-bottom:10px;cursor:pointer;" v-on:click="funnalSettingToggle()"><i class="fas fa-arrow-alt-circle-left"></i> <?php w("Go&nbsp;back"); ?></span>
</div>
</div>
<div class="container-fluid">

		<ul class="nav nav-tabs md-tabs nav-justified theme-nav rounded-top  d-flex flex-column flex-sm-row" role="tablist">


			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#home" role="tab">
					<i class="fas fa-cog pr-2"></i><?php w("Page Settings"); ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#menu1" role="tab">
					<i class="fas fa-table pr-2"></i><?php w("Edit SEO Data"); ?></a>
			</li>

		</ul>
	</div>


<div class="container-fluid">
<div class="form-inputs">
<div class="tab-content">	
<div id="home" class="tab-pane fade show active">
					<div class="col-md-12 pl-0"> <label for="url">{{t('Page URL')}}:</label>
						<div class="input-group">
							<div class="input-group-prepend"><span class="input-group-text">{{funnel_url}}/</span></div>
							<input type="text" class="form-control" id="quick-url" v-bind:placeholder="t('Path')" v-model="page_foler_name">
							<div class="input-group-append" data-toggle="tooltip" v-bind:title="t('Copy To Clipboard')" onclick=copyText('funnel.funnel_url+"/"+funnel.page_foler_name+"/"',1) style="cursor:pointer;"><span class="input-group-text"><i class="fas fa-copy"></i></span></div>
							<a class="input-group-append" v-bind:href="funnel_url+'/'+page_foler_name+'/'" target="_BLANK"><span class="input-group-text"><i class="fas fa-eye"></i></span></a>
							<div class="input-group-append" data-toggle="tooltip" v-bind:title="t('Copy Verified Membership Link')" v-if="(tempselected_category=='register')? true:false" style="cursor:pointer;" onclick=copyText('funnel.funnel_url+"/"+funnel.page_foler_name+"@-cf-veried-"+funnel.current_funnel+"-member-@"',1)><span class="input-group-text"><i class="fas fa-user-shield"></i></span></div>
						</div>
					</div>
					
					<div class="row col-md-12 mt-2 ">

						<div class="col-md-4 pt-3 pb-2 bg-white  rounded">
							<div class="custom-control custom-switch mb-2" v-on:click="doInitAbTurnOn()">
								<input type="checkbox" class="custom-control-input " id="customSwitches1" v-model="template_has_a_b_test">
								<label class="custom-control-label" for="customSwitches1">{{t('Use A/B Testing')}}</label>
							</div>
							<div class="custom-control custom-switch mb-2" id="gdprhandle">
								<input type="checkbox" class="custom-control-input " id="customSwitch4" v-model="page_settings.cookie_notice">
								<label class="custom-control-label" for="customSwitch4">{{t('Display GDPR Cookie Notice')}}</label>
							</div>
							<div class="custom-control custom-switch mb-2" data-toggle="tooltip" v-bind:title="t('Its not recomended to use the cache mode for Membership pages and Payment Confirmation Pages but you can use with other category like sales pages, optin generation pages etc according your requirement.')">
								<input type="checkbox" class="custom-control-input " id="customSwitchescache" v-model="page_settings.page_cache">
								<label class="custom-control-label" for="customSwitchescache">{{t('Create Page Cache')}}</label>
							</div>
							<div class="custom-control custom-switch mb-2" data-toggle="tooltip" v-bind:title="t('Cache will be turrened on automatically if you want to create AMP Version for the page.')">
								<input type="checkbox" class="custom-control-input " id="customSwitchamp" v-model="page_settings.active_amp" v-on:change="activeCacheForAMP">
								<label class="custom-control-label" for="customSwitchamp">{{t('Create Equivalent AMP Page')}}</label>
							</div>
							<div class="custom-control custom-switch mb-2" data-toggle="tooltip" title="<?php if(!get_option('zapier_auth_id')){echo t("You can not modify the setting until you create a Zapier authentication token");} ?>">
								<input type="checkbox" class="custom-control-input " id="customSwitchesZapier" v-model="page_settings.zapier_enable" <?php if(!get_option('zapier_auth_id')){echo "disabled=true";} ?>>
								<label class="custom-control-label" for="customSwitchesZapier">{{t('Send Leads to Zapier')}}</label>
							</div>
							<div class="custom-control custom-switch" v-if="(selected_template_category=='register')">
								<input type="checkbox" class="custom-control-input " id="customSwitch3" v-model="verifyed_membership_page">
								<label class="custom-control-label" for="customSwitch3">{{t('Verified Registration Page')}}</label>
							</div>


							<div class="" id="redirectioncntrol">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="customSwitch2" v-model="page_settings.redirect_for_post">
									<label class="custom-control-label" for="customSwitch2">{{t('Redirect Instead Of Going To The Next Page')}}</label>

								</div>
								<label style="margin-top:5px;margin-bottom:2px;">{{t('Enter Redirecton URL')}}</label>
								<input type="url" class="form-control form-control-sm" v-bind:placeholder="t('Enter URL')" v-model="page_settings.redirect_for_post_url">
							</div>
							<div class="form-group nopadding">
								<label for="category" class="mt-2 mb-0">{{t('Page Category')}}:</label>
								<select class="form-control form-control-sm mt-0" id="category" v-model="tempselected_category">
									<option value="all">{{t('Not Specific')}}</option>
									<option value="optin">{{t('Optin')}}</option>
									<option value="register">{{t('Register')}}</option>
									<option value="login">{{t('Login')}}</option>
									<option value="membership">{{t('Membership')}}</option>
									<option value="forgotpassword">{{t('Forgot Password')}}</option>
									<option value="sales">{{t('Sales')}}</option>
									<option value="orderform">{{t('Order Form')}}</option>
									<option value="oto">{{t('OTO')}}</option>
									<option value="checkout">{{t('Checkout')}}</option>
									<option value="confirm">{{t('Confirmation')}}</option>
									<option value="cancel">{{t('Cancelation Page')}}</option>
									<option value="thankyou">{{t('Thank You Page')}}</option>
									<option value="tandc">{{t('Terms and Conditions')}}</option>
									<option value="privacy_policy">{{t('Privacy Policy')}}</option>
									<!--<option value="404">Error 404</option>-->
								</select>
							</div>
							<div class="form-group">
								<label class="mb-0 mt-2">{{t('SMTP For The Project')}}</label>
								<select v-model='selected_smtp' class='form-control form-control-sm mt-0'>
									<option value='0'>{{t('No Mailer')}}</option>
									<option value='phpmailer'>{{t('PHP Mailer')}}</option>
									<?php
										$smtps = $data_arr['smtps'];
										if (is_object($smtps)) {
											if ($smtps->num_rows) {
												$smtps->data_seek(0);
											}
											while ($r = $smtps->fetch_object()) {
												echo "<option value='" . $r->id . "'>" . $r->title . "</option>";
											}
										}
										?>
								</select>
							</div>
							
							<!-- select list -->
							<div class="dropdown mb-2">
								<button class="btn   btn-info btn-block dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{t('Select Lists')}}</button>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="listslist">
									<?php
										$lists = $data_arr['lists'];
										if (is_object($lists)) {
											if ($lists->num_rows) {
												$lists->data_seek(0);
											}
											while ($r = $lists->fetch_object()) {
												echo '<div class="form-check pr-5"><input type="checkbox" value="' . $r->id . '" id="labellist"> <label class="form-check-label" for="labellist">' . $r->title . '</label></div>';
											}
										} else {
											echo "<div class='bg-danger text-white m-3 p-3'>".t('No Lists Created')."</div>";
										}
										?>
								</div>
							</div>
							<!--end select list -->

							<div class="dropdown mb-2">
								<button class="btn btn-info btn-block dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{t('Select Membership Access')}}</button>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<?php
										$regpages = $data_arr['registrationpages'];
										if (count($regpages) > 0) {
											foreach ($regpages as $regindex => $regvalue) {
												echo '<div class="form-check pr-5"><input type="checkbox" value="' . $regindex . '" v-model="selected_membership_pages"> <label class="pl-3">' . $regvalue . '</label></div>';
											}
										} else {
											echo "<div class='bg-danger text-white m-3 p-3'>".t("No Registration Page Created For Members")."</div>";
										}
										?>
								</div>
							</div>
							<!-- End MEmbership access -->
							<!-- Select Autoresponders-->
							<div class="dropdown mb-2">
								<button class="btn btn-info btn-block dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{t('Select Autoresponders')}}</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="autoreslist">
									<?php
										$allautoresponders = $data_arr['autoresponders'];
										$autorespondercount = 0;
										if (is_object($allautoresponders)) {
											if ($allautoresponders->num_rows) {
												$allautoresponders->data_seek(0);
											}
											if ($allautoresponders) {
												while ($r = $allautoresponders->fetch_object()) {
													++$autorespondercount;
													echo '<div class="form-check"><input class="mr-2" type="checkbox" id="check-responder" value="' . $r->id . '"><label class="form-check-label justify-content-center" for="check-responder">' . $r->autoresponder . '</label></div>';
												}
											}
										}
										if($plugins_ob && count($plugins_ob->autores_callbacks)>0)
										{
											foreach($plugins_ob->autores_callbacks as $plugin_autores_index=>$plugin_autores_val)
											{
												++$autorespondercount;
												echo '<div class="form-check"><input class="mr-2" type="checkbox" id="check-responder" value="' . $plugin_autores_index . '"><label class="form-check-label justify-content-center" for="check-responder">' .  $plugin_autores_val['name']. '</label></div>';
											}
										}
										if ($autorespondercount < 1) {
											echo "<div class='bg-danger text-white m-3 p-3'><strong>".t("No Autoresponders Added")."</strong></div>";
										}
										?>
								</div>
							</div>
							<!--End  Select Autoresponders-->
							<div class="dropdown mb-2">
								<button class="btn btn-info btn-block dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{t('Select Integrations')}}</button>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<?php
										$integrations_ob = $data_arr['integrations'];
										$integrations = $integrations_ob->getData('all');
										if($integrations->num_rows<1)
										{
											echo "<div class='bg-danger text-white m-3 p-3'>".t('No Integrations Created')."</div>";
										}
										while ($r = $integrations->fetch_object()) {
											echo '<div class="form-check pr-5"><input type="checkbox" value=' . $r->id . ' v-model="page_settings.snippet_integrations"> <label>' . $r->title . '</label></div>';
										}
										?>
								</div>
							</div>

							<!-- PaymentMtehod -->
							<div class="dropdown mb-2" v-if="(selected_template_category=='orderform')">
								<button class="btn btn-info dropdown-toggle btn-block mr-4" data-target="#paymentmethods" data-toggle="collapse">{{t('Select Payment Methods')}}</button>
								<div id="paymentmethods" class="collapse">

									<?php
										$ipnpaymenturl = get_option('install_url');
										$ipnpaymenturl = "'" . $ipnpaymenturl . "/index.php?page=do_payment&execute=1&qfnl_is_ipn=" . get_option('ipn_token');
										$ipnpaymenturl .= "&qfunnel_id='+current_funnel+'&qfolder='+page_foler_name"
										?>

									<?php

									echo '<div class="input-group" style="margin-top:1px;margin-bottom:1px"><div class="input-group-prepend"><span class="input-group-text"><input type="radio" value="cod" name="" v-model="selected_payment_method"></span></div><p class="form-control">Cash On Delivary</p></div>';


										$paymentmethods = $data_arr['paymentmethods'];
										$got_payment_methods=false;
										if (is_object($paymentmethods)) {
											$got_payment_methods=true;
											if ($paymentmethods->num_rows) {
												$paymentmethods->data_seek(0);
											}
											while ($r = $paymentmethods->fetch_object()) {
												if (strpos($r->method, "_ipn") > 0) {
													echo '<div class="input-group" style="margin-top:1px;margin-bottom:1px"><div class="input-group-prepend"><span class="input-group-text"><input type="radio" value="' . $r->id . '" name="" v-model="selected_payment_method"> ' . $r->title . ' ('.t('IPN').')</span></div><input type="text" class="form-control" v-bind:value="' . $ipnpaymenturl . '" onclick="copyText(this.value)" data-toggle="tooltip" v-bind:title="t(\'Copy To Clipboard\')"></div>';
												} else {
													echo '<div class="input-group" style="margin-top:1px;margin-bottom:1px"><div class="input-group-prepend"><span class="input-group-text"><input type="radio" value="' . $r->id . '" name="" v-model="selected_payment_method"></span></div><p class="form-control"> ' . $r->title . '</p></div>';
												}
											}
										}
										if($plugins_ob)
										{
											$plugin_saved_payment_methods=$plugins_ob->payment_methods_callbacks;
											if(is_array($plugin_saved_payment_methods))
											{
												foreach($plugin_saved_payment_methods as $plugin_saved_payment_methods_index=>$plugin_saved_payment_methods_val)
												{
													if (strpos($plugin_saved_payment_methods_val['credentials']['method'], "_ipn") > 0) {
														echo '<div class="input-group" style="margin-top:1px;margin-bottom:1px"><div class="input-group-prepend"><span class="input-group-text"><input type="radio" value="' . $plugin_saved_payment_methods_index . '" name="" v-model="selected_payment_method"> ' . $plugin_saved_payment_methods_val['credentials']['title'] . ' ('.t('IPN').')</span></div><input type="text" class="form-control" v-bind:value="' . $ipnpaymenturl . '" onclick="copyText(this.value)" data-toggle="tooltip" v-bind:title="t(\'Copy To Clipboard\')"></div>';
													} else {
														echo '<div class="input-group" style="margin-top:1px;margin-bottom:1px"><div class="input-group-prepend"><span class="input-group-text"><input type="radio" value="' . $plugin_saved_payment_methods_index . '" name="" v-model="selected_payment_method"></span></div><p class="form-control"> ' . $plugin_saved_payment_methods_val['credentials']['title'] . '</p></div>';
													}
												}
											}
										}
										if(!$got_payment_methods){
											echo "<div class='bg-danger text-white m-3 p-3'>".t('No Payment Methods Created')."</div>";
										}
										?>
								</div>
							</div>
							<!--End PaymentMtehod -->

							<!-- Select Product -->
							<div class="dropdown mb-2" v-if="(selected_template_category=='orderform')">
								<button class="btn btn-info dropdown-toggle btn-block mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Product</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<?php
										$products = $data_arr['products'];
										if (is_object($products)) {
											if ($products->num_rows) {
												$products->data_seek(0);
											}
											while ($r = $products->fetch_object()) {
												echo '<div class="form-check"><input type="radio" value="' . $r->id . '" name="" v-model="selected_product"><label>(#' . $r->productid . ') ' . $r->title . '</label></div>';
											}
										} else {
											echo "<div class='bg-danger text-white m-3 p-3'>".t('No Products Created')."</div>";
										}
										?>
								</div>
							</div>
							<!--End Select Product-->
						</div>
				
						<!-- end col-md-4 -->




						<div class="col-md-8 row script mt-2 ml-auto">
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="header">{{t('Header Script')}}:</label>
									<textarea class="form-control" id="quick-header" rows="8" v-bind:placeholder="t('Enter Header Script')" v-model="page_header_scripts"></textarea>
								</div>
								<div class="form-group">
									<label for="footer">{{t('Footer Script')}}:</label>
									<textarea class="form-control" id="quick-footer" rows="8" v-bind:placeholder="t('Enter Footer Script')" v-model="page_footer_scripts"></textarea>
								</div>
								</div>
								<div class="col-md-6 ">
								<div class="form-group">
									<label for="footer">{{t('Valid Input Names For The Project')}}:</label>
									<textarea class="form-control" id="quick-footer" rows="8" v-bind:placeholder="t('Enter Input Names. Please Enter One On Each Line')" v-bind:value="common_inputs_for_current_funnel.split(',').join('\n')" v-on:change="addFunnelAndPageValidInput('common_inputs_for_current_funnel',$event)"></textarea>
								</div>
								<div class="form-group">
									<label for="footer">{{t('Valid Input Names For This Page')}}:</label>
									<textarea class="form-control" id="quick-footer" rows="8" v-bind:placeholder="t('Enter Input Names. Please Enter One On Each Line')" v-bind:value="valid_inputs_pages.split(',').join('\n')" v-on:change="addFunnelAndPageValidInput('valid_inputs_pages',$event)"></textarea>
								</div>
							
							</div>
							
								
								
						</div>


					
						

					</div>






				</div>


				<!-- end first tab -->
				<!-- start second tab -->
				<div id="menu1" class="tab-pane fade " id="seodatas">

					<!-- seo datas -->
					<div class="row mt-4">
						<div class="col-md-6">

							<div class="form-group">

								<label for="title">{{t('Page Title')}}:</label>
								<input type="text" class="form-control" id="quick-title" v-bind:placeholder="t('Enter Title')" v-model="page_title">
							</div>

						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>{{t('Title Icon')}}</label>
								<input type="text" class="form-control" id="quick-icon" v-bind:placeholder="t('Enter Icon URL')" v-model="page_meta.icon">
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>{{t('Page Description')}}</label>
								<textarea class="form-control" rows="4" v-bind:placeholder="t('Enter Description')" v-model="page_meta.description"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>{{t('Keywords')}}</label>
								<textarea class="form-control" rows="4" v-bind:placeholder="t('Add Keywords. Please Enter One On Each Line')" v-bind:value="page_meta.keywords.split(',').join('\n')" v-on:change="addFunnelAndPageValidInput('page_meta.keywords',$event)"></textarea>
							</div>
						</div>
					</div>



					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>{{t('Robots Value')}}</label>
								<textarea class="form-control" rows="4" v-bind:placeholder="t('Enter Robots Data')" v-model="page_meta.robots"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>{{t('Copyright')}}</label>
								<textarea class="form-control" rows="4" v-bind:placeholder="t('Enter Copyright Description')" v-model="page_meta.copyright"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="title">{{t('DC.title')}}</label>
						<textarea class="form-control" v-bind:placeholder="t('Add DC.title')" v-model="page_meta.DC_title"></textarea>
					</div>



				</div>
</div>
</div>


<button type="button" class="btn theme-button btntosavepagesetting" v-on:click="updatecurrentfunnelsetting()" style="color:white;margin-top:10px;">Save Settings</button>
<span style="margin-left:10px;" v-bind:style="{color:(funnel_setting_err.indexOf('success')>=0)? 'green':'#ff0066'}">
<strong>{{t(funnel_setting_err)}}</strong>
</span>

<setting_toggle></setting_toggle>
</div>

<?php
$contents=ob_get_contents();
ob_end_clean();
return $contents;
} 
?>
