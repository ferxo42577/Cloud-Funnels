<?php
$funnel_id=0;
if(isset($_GET['funnel_id']))
{
	$funnel_id=	$_GET['funnel_id'];
}

$funnelsetting=funnelSettingsPopup($data_arr);
?>
<input type="hidden" id="hostname" value="<?php
		if(get_option('qfnl_router_mode')=='1')
		{
		echo get_option('install_url');
		}
		else
		{
		$protocol=$data_arr['protocol'];
		echo $protocol.$_SERVER['HTTP_HOST'];
		}
		?>">
<div class="container-fluid" id="funnel">
	<!-- <div class="row">
		<div class="col-sm-12">
			<is_ajax_loading v-if="is_ajax_loading"></is_ajax_loading>
		</div>
	</div> -->
	<div class="row">
	<div class="col-sm-12">
	<div class="form-group">
	
	<?php if(!$funnel_id){ ?>
	
	<div class="row mt-5" id='step_1' v-if="(current_step=='step_1')? true : false">
		<div class="col-sm-4 mw120 mx-auto">
	<div class="card visual-pnl shadow">
		<div class="card-header theme-text bg-white border-bottom-0">{{t('Create Project')}}</div>
		<div class="card-body">
		
		<span v-html="t(err)" class="text-danger small mt-1"></span>

		<div class="form-group">
		<label>{{t('Funnel Name')}}</label>
		<input type="text" class="form-control" v-model="funnel_name" v-on:keyup="urlSuggester()" v-bind:placeholder="t('Add a Title')">
		</div>
		
		<div class="form-group">
		<label>{{t('Funnel Type')}}</label>
		<select class="form-control" v-model="funnel_type"><option value='0'>{{t('Select Funnel Type')}}</option><option value='webinar'>{{t('Webinar')}}</option>
		<option value='membership'>{{t('Membership')}}</option>
		<option value="sales">{{t('Sales')}}</option><option value="blank">{{t('Custom')}}</option></select>
		</div>
		
		<div class="form-group">
		<label>{{t('Funnel URL')}}</label>
		<?php
		$trans_install_url="";
		if((get_option('qfnl_router_mode')=='1')){$trans_install_url= get_option('install_url');}else{$trans_install_url= $_SERVER['HTTP_HOST'];}
		?>
		<input type="text" class="form-control" name="dirurl" v-model="funnel_url" data-toggle='tooltip' title="<?php w("Don't change Base URL i.e \${1} but you can change path and protocol", array($trans_install_url)); ?>">
		</div>

		<label class="mt-2" data-toggle="tooltip" title="index.php or index.html"><input type="checkbox" v-model="funnel_modify_pre_index"> {{t('Overwrite funnel if already exists')}}</label>
		
		<button type="button" class="btn theme-button float-right mt-2" style="margin-top:8px;float:right" name="createdir" v-on:click="createFunnel()"><i class="fas fa-check"></i> {{t('Create')}}</button>
		
		</div>
		
	</div>
	</div></div>
	<!-- Funnel Cloner-->
	<div class="row mb-2" v-if="current_step=='step_2'">
		<div class="col-sm-12 text-right" v-if="!funnel_cloner_opened">
			<button class="btn btn-primary theme-button" v-on:click="toggleFunnelCloner()"><i class="fas fa-copy"></i>&nbsp;<?php w('Copy&nbsp;Funnel');?>&nbsp;<?php if(!$_SESSION['user_plan_type'.$site_token_for_dashboard]){echo "(".t('Pro&nbsp;Only').")";} ?></button>
		</div>
		<div class="col-sm-12 d-flex justify-content-center" v-else>
			<funnel_cloner v-bind:toggle="toggleFunnelCloner"></funnel_cloner>
		</div>
	</div>
	
	<div class="row labelscontainer" id="step_2" v-if="(current_step=='step_2')? true : false" v-bind:style="{display:(funnel_cloner_opened)? 'none':'block'}">
	
	<div class="col-sm-12" v-bind:style="{display:(funnel_setting_view)? 'block':'none'}">
	<?php echo $funnelsetting; ?>
	</div>
	<div id="templateinstalldiv_container" class="col-sm-12" v-bind:style="{display:(templatecontaineropened)? 'block':'none'}">
	
	</div>

	<div class="col-sm-12" v-bind:style="{display:(funnel_setting_view||templatecontaineropened)? 'none':'block'}">	
<!-- start funnel webinar -->
	<div v-if="selectedFunnelType('webinar')">
	<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" v-html="t('Project&nbsp;${1}&nbsp;Created At',[`<i>${funnel_name}</i>`])"></span></div><p class="form-control">{{funnel_url}}</p><div class="input-group-append" data-toggle="tooltip" v-bind:title="t('Open URL')"><span class="input-group-text"><a v-bind:href="funnel_url" target="_BLANK"><i class="fas fa-eye"></i></a></span></div><div class="input-group-append" data-toggle='tooltip' v-bind:title="t('Copy Project URL')" style="cursor:pointer;" onclick=copyText('funnel.funnel_url',1)><span class="input-group-text"><i class="fas fa-copy"></i></span></div></div>
	
	<div class="row">
	<div class="col-md-3  mx-auto mnubtn-container-parent">
	<div id="lblbtncontainer" class="mnubtn-container">
	<h4 class="card-header card-header-copy p-3 mb-2">{{t('Select Page Type')}}</h4>
    <?php
	$showsavedlabels=0;
	if(isset($data_arr['labelbtn']))
	{
		if(strlen($data_arr['labelbtn'])>4)
		{
			echo $data_arr['labelbtn'];
			++$showsavedlabels;
		}
	}
	
	if($showsavedlabels<1)
	{
	?>

	<button  lbl="1" category="optin" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Registration Page</button>
	
	<button lbl="2" category="thankyou" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Thankyou Page</button>
	
	<?php } ?>
	</div>
	
	<qfnl-addnew-lbl></qfnl-addnew-lbl>
 
	</div>
	
		<div class="col-md-9  mx-auto">
			<div class="row">
			<div class="col-md-6 mx-auto" id="template_a">
					<template-detail v-bind:fid="current_funnel" name="a" v-bind:lbl="template_selector_btn">
					</template-detail>
				</div>
				
				<div class="col-md-6  mx-auto " id="template_b" v-if="template_has_a_b_test">
					<template-detail v-bind:fid="current_funnel" name="b" v-bind:lbl="template_selector_btn">
					</template-detail>
				</div>
		</div>
		<!-- settings popup -->
		<setting_toggle></setting_toggle>
		</div>
		</div>
	</div>
<!-- ends funnel -->
<!-- start funnel Membership -->
	<div v-if="selectedFunnelType('membership')">
	<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Project&nbsp;<i>{{funnel_name}}</i>&nbsp;Created At</span></div><p class="form-control">{{funnel_url}}</p><div class="input-group-append" data-toggle="tooltip" title="Open URL"><span class="input-group-text"><a v-bind:href="funnel_url" target="_BLANK"><i class="fas fa-eye"></i></a></span></div><div class="input-group-append" data-toggle='tooltip' title='Copy Project URL' style="cursor:pointer;" onclick=copyText('funnel.funnel_url',1)><span class="input-group-text"><i class="fas fa-copy"></i></span></div></div>
	<div class="row">
	<div class="col-md-3  mx-auto mnubtn-container-parent">
	<div id="lblbtncontainer" class="mnubtn-container" >
	<h4 class="card-header card-header-copy p-3 mb-2">{{t('Select Page Type')}}</h4>
    <?php
	$showsavedlabels=0;
	if(isset($data_arr['labelbtn']))
	{
		if(strlen($data_arr['labelbtn'])>4)
		{
			echo $data_arr['labelbtn'];
			++$showsavedlabels;
		}
	}
	
	if($showsavedlabels<1)
	{
	?>

	<button  lbl="1" category="register" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Registration Page</button>
	
	<button  lbl="1" category="login" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span>Login Page</button>
	
	<button lbl="3" category="membership" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Membership Page</button>
	
	<button lbl="4" category="forgotpassword" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Forgot Password Page</button>
	
	<?php } ?>
	</div>
	
	<qfnl-addnew-lbl></qfnl-addnew-lbl>
 
	</div>
	
	<div class="col-md-9  mx-auto">
			<div class="row">
			<div class="col-md-6 mx-auto" id="template_a">
					<template-detail v-bind:fid="current_funnel" name="a" v-bind:lbl="template_selector_btn">
					</template-detail>
				</div>
				
				<div class="col-md-6  mx-auto " id="template_b" v-if="template_has_a_b_test">
					<template-detail v-bind:fid="current_funnel" name="b" v-bind:lbl="template_selector_btn">
					</template-detail>
				</div>
		</div>
		<!-- settings popup -->
		<setting_toggle></setting_toggle>	
		</div>
		</div>
	</div>
<!-- ends funnel -->

<!-- Sales Funnel -->

	<div v-if="selectedFunnelType('sales')">
	<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Project&nbsp;<i>{{funnel_name}}</i>&nbsp;Created At</span></div><p class="form-control">{{funnel_url}}</p><div class="input-group-append" data-toggle="tooltip" title="Open URL"><span class="input-group-text"><a v-bind:href="funnel_url" target="_BLANK"><i class="fas fa-eye"></i></a></span></div><div class="input-group-append" data-toggle='tooltip' title='Copy Project URL' style="cursor:pointer;" onclick=copyText('funnel.funnel_url',1)><span class="input-group-text"><i class="fas fa-copy"></i></span></div></div>
	<div class="row">
	<div class="col-md-3  mx-auto mnubtn-container-parent" >
	<div id="lblbtncontainer" class="mnubtn-container" >
	<h4 class="card-header card-header-copy p-3 mb-2">{{t('Select Page Type')}}</h4>
    <?php
	$showsavedlabels=0;
	if(isset($data_arr['labelbtn']))
	{
		if(strlen($data_arr['labelbtn'])>4)
		{
			echo $data_arr['labelbtn'];
			++$showsavedlabels;
		}
	}
	
	if($showsavedlabels<1)
	{
	?>

	<button  lbl="1" category="optin" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Optin</button>
	
	<button  lbl="2" category="sales" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span>Salespage</button>
	
	<button lbl="3" category="orderform" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Order Form</button>
	
	<button lbl="4" category="confirm" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Confirmation Page</button>
	
	<button lbl="5" category="cancel" class="btn btn-outline-secondary btn-block mnubtn" v-on:mousedown="changePosition($event),activeMenuBtn($event)" v-on:mouseup="catchElement($event)" v-on:contextmenu="deleteCurrent($event)" style="cursor:move"><span class=""></span> Cancelation Page</button>
	
	<?php } ?>
	</div>
	
	<qfnl-addnew-lbl></qfnl-addnew-lbl>
 
	</div>
	
	<div class="col-md-9  mx-auto">
			<div class="row">
				<div class="col-md-6 mx-auto" id="template_a">
					<template-detail v-bind:fid="current_funnel" name="a" v-bind:lbl="template_selector_btn">
					</template-detail>
				</div>
				
				<div class="col-md-6  mx-auto " id="template_b" v-if="template_has_a_b_test">
					<template-detail v-bind:fid="current_funnel" name="b" v-bind:lbl="template_selector_btn">
					</template-detail>
				</div>
		</div>
		<!-- settings popup -->
		<setting_toggle></setting_toggle>	
		</div>
		</div>
	</div>

<!-- Blank Funnel/Blank Website -->	

<div v-if="selectedFunnelType('blank')">
<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Project&nbsp;<i>{{funnel_name}}</i>&nbsp;Created At</span></div><p class="form-control">{{funnel_url}}</p><div class="input-group-append" data-toggle="tooltip" title="Open URL"><span class="input-group-text"><a v-bind:href="funnel_url" target="_BLANK"><i class="fas fa-eye"></i></a></span></div><div class="input-group-append" data-toggle='tooltip' title='Copy Project URL' style="cursor:pointer;" onclick=copyText('funnel.funnel_url',1)><span class="input-group-text"><i class="fas fa-copy"></i></span></div></div>
	<div class="row">
	<div class="col-md-3  mx-auto mnubtn-container-parent">
	<div id="lblbtncontainer" class="mnubtn-container" >
	<h4 class="card-header card-header-copy p-3 mb-2">{{t('Select Page Type')}}</h4>
    <?php
	$showsavedlabels=0;
	if(isset($data_arr['labelbtn']))
	{
		if(strlen($data_arr['labelbtn'])>4)
		{
			echo $data_arr['labelbtn'];
			++$showsavedlabels;
		}
	}
	
	if($showsavedlabels<1)
	{
	?>
	
	<?php } ?>
	</div>
	
	<qfnl-addnew-lbl></qfnl-addnew-lbl>
 
	</div>
	
	<div class="col-md-9  mx-auto">
		<div class="row">
				<div class="col-md-6 mx-auto" id="template_a">
					<template-detail v-bind:fid="current_funnel" name="a" v-bind:lbl="template_selector_btn">
					</template-detail>
				</div>
				
				<div class="col-md-6  mx-auto " id="template_b" v-if="template_has_a_b_test">
					<template-detail v-bind:fid="current_funnel" name="b" v-bind:lbl="template_selector_btn">
					</template-detail>
				</div>
		</div>
		<!-- settings popup -->
		<setting_toggle></setting_toggle>	
		</div>

		</div>
	</div>

<!-- ends funnel -->
	</div>
	</div>
	
	<?php }else{ ?>
	
	
	
	
	
	<?php } ?>
	</div>
	</div>
	</div>
</div>