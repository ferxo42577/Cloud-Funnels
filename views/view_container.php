<?php
ob_start();
if(isset($_POST['cf_do_change_language']))
{
    registerTranslation($_POST['cf_do_change_language']);
    update_option('app_language',$_POST['cf_do_change_language']);
    update_option('qfnl_setup_token',time());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <title>
    <?php if(isset($_GET['page']) && ($_GET['page']=="create_funnel")){
       echo  (isset($_GET['id']))? "Edit Funnel -CloudFunnels":"Create Funnel -CloudFunnels";
    } else{echo w($title).'-CloudFunnels';} ?>
    </title>
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <!--Toaster Popup message CSS -->
  
    <!-- Custom CSS -->
    <link href="assets/theme-assets/dist/css/style.css" rel="stylesheet">
    <link href="assets/theme-assets/dist/css/style.min.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="assets/theme-assets/dist/css/pages/dashboard1.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
global $is_gcp;
if($is_gcp)
{
    global $gcp_bucket;
	global $gcp_bucket_url;
    echo "<script>var global_req_is_gcp=true;</script>";
}
else
{
    echo "<script>var global_req_is_gcp=false;</script>";
}
?>
<!-- language -->
<?php
$lang_setup_token=time();
if(get_option('qfnl_setup_token'))
{
    $lang_setup_token=get_option('qfnl_setup_token');
}

$lang_setup_version=get_option('qfnl_current_version');

if(!$is_gcp){ ?>
    <script src="./lang/cache.js?v=<?php echo $lang_setup_token; ?>"></script>
<?php }else{ ?>
     <script src="<?php echo $gcp_bucket_url."/lang/cache.js?v=".$lang_setup_token; ?>"></script>
<?php } ?>
<script src="./assets/js/html_entities.js?v=<?php echo $lang_setup_version; ?>"></script>
<script src="./assets/js/lang.js?v=<?php echo $lang_setup_version; ?>"></script>
<!-- /language -->

<?php echo $header; ?>
<?php if(isset($plugin_loader) && $plugin_loader){
   echo $plugin_loader->attachToContent('admin_head',array());
} ?>
</head>

<body class="dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">CloudFunnels</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php?page=login">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                          
                            <!-- Light Logo icon -->
                            <img src="assets/theme-assets/assets/images/logo.png" alt="homepage" class="light-logo img-responsive" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                        <img src="assets/theme-assets/assets/images/logo-text.png" alt="homepage" class="light-logo" /></a>
                         <!-- Light Logo text -->
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User Profile -->
                        <!-- ============================================================== -->
						<script>
						var showprofile=0;
						function viewProfileContainer(){
							if(showprofile==0)
							{
								document.getElementById("profilecontroldiv").style.display="block";
								showprofile=1;
							}
                           else
							{
								document.getElementById("profilecontroldiv").style.display="none";
								showprofile=0;
							}

							}
						</script>
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" id="profilepicopener" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="viewProfileContainer()"><img src="<?php  
                            $site_token_for_dashboard=get_option('site_token');
                            echo $_SESSION['user_profile_picture'.$site_token_for_dashboard]; ?>" alt="user" class=""> <span class="hidden-md-down"><?php echo $_SESSION['user_name'.$site_token_for_dashboard]; ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY bg-dark text-white" id="profilecontroldiv" style="display:none;">
                                <!-- text-->
                                <a href="index.php?page=createmultiuser&id=<?php echo $_SESSION['user'.$site_token_for_dashboard] ?>" class="dropdown-item text-white"><i class="ti-user"></i> <?php w('My Profile'); ?></a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <?php if(!$_SESSION['user_plan_type'.$site_token_for_dashboard]){  ?>
                                <a href="http://getcloudfunnels.in/cloudfunnelspro" class="dropdown-item text-white"><i class="far fa-arrow-alt-circle-up"></i> <?php w('Upgrade to Pro'); ?></a>
                                <div class="dropdown-divider"></div>
                                <?php } ?>
                                <!-- text-->
                                <a href="index.php?page=logout" class="dropdown-item text-white"><i class="fa fa-power-off"></i> <?php w('Logout'); ?></a>
                                <!-- text-->
                            </div>
                        </li>
                    </ul>
                    <i class="fas fa-globe globelanguagechanger" data-toggle="tooltip" title="Select Language"></i>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!--<li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="assets/theme-assets/assets/images/users/1.jpg" alt="user-img" class="img-circle"><span class="hide-menu">Mark Jeckson</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>-->

                        <?php
                        $dashboard_permission_page_arr=array();
                        if(isset($_SESSION['permission_page_arr'.$site_token_for_dashboard]) && is_array($_SESSION['permission_page_arr'.$site_token_for_dashboard]))
                        {
                            $dashboard_permission_page_arr= $_SESSION['permission_page_arr'.$site_token_for_dashboard];  
                        }
                        ?>

                        <?php if(in_array('dashboard',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-dashboard"> <a class="waves-effect waves-dark" href="index.php?page=dashboard" aria-expanded="false"><i class='fas fa-tachometer-alt'></i> <span class="hide-menu"><?php w('Dashboard'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('all_funnels',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
                        <li id="li-funnels"> <a class="waves-effect waves-dark" href="index.php?page=all_funnels" aria-expanded="false"><i class='fas fa-funnel-dollar'></i> <span class="hide-menu"><?php w('Funnels and Sites'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('membership_funnels',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-membership"> <a class="waves-effect waves-dark" href="index.php?page=membership_funnels" aria-expanded="false"><i class='fas fa-users'></i> <span class="hide-menu"><?php w('Members') ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('media',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-media"> <a class="waves-effect waves-dark" href="index.php?page=media" aria-expanded="false"><i class='fas fa-photo-video'></i> <span class="hide-menu"><?php w('Media') ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('analysis',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-analysis"> <a class="waves-effect waves-dark" href="index.php?page=analysis" aria-expanded="false"><i class='fas fa-chart-pie'></i> <span class="hide-menu"><?php w('Analysis'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('products',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-products"> <a class="waves-effect waves-dark" href="index.php?page=products" aria-expanded="false"><i class='fas fa-box-open'></i> <span class="hide-menu"><?php w('Products'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('sales',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-sales"> <a class="waves-effect waves-dark" href="index.php?page=sales" aria-expanded="false"><i class='fas fa-hand-holding-usd'></i> <span class="hide-menu"><?php w('Sales'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('payment_records',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						 <li id="li-payment"> <a class="waves-effect waves-dark" href="index.php?page=payment_records" aria-expanded="false"><i class="fas fa-money-check-alt"></i> <span class="hide-menu"><?php w('Payment Methods') ?></span></a>
                        </li>
                        <?php } ?>

                        <?php if(in_array('autores_records',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>

						  <li id="li-autoresponders"> <a class="waves-effect waves-dark" href="index.php?page=autores_records" aria-expanded="false"><i class="fas fa-mail-bulk"></i> <span class="hide-menu"><?php w('Auto Responders'); ?></span></a>
                        </li>
                        <?php } ?>

                        <?php if(in_array('integrations',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						 <li id="li-integrations"> <a class="waves-effect waves-dark" href="index.php?page=integrations" aria-expanded="false"><i class="fas fa-puzzle-piece"></i> <span class="hide-menu"> <?php w('Integrations'); ?></span></a>
                        </li>
                        <?php } ?>

                        <?php
                        if(!$is_gcp){ 
                        if(in_array('plugins',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						 <li id="li-integrations"> <a class="waves-effect waves-dark" href="index.php?page=plugins" aria-expanded="false"><i class="fas fa-plug"></i> <span class="hide-menu"> <?php w('Plugins'); ?></span></a>
                        </li>
                        <?php }} ?>
                        <!-- All Plugin menues -->
                            <?php 
                            if(isset($_GET['page']) && $_GET['page']=='createmultiuser')
                            {$GLOBALS['user_screen_plugin_pages']=array();}
                            if(isset($plugin_menues) && is_array($plugin_menues) && count($plugin_menues)){
                              foreach($plugin_menues as $plugin_menue_index=>$plugin_menues_data){
                              $is_current_menu_submenu=false;
                              if(isset($plugin_page) && isset($plugin_page[0]['parent_slug']) && $plugin_page[0]['parent_slug']==$plugin_menue_index)
                              {
                                $is_current_menu_submenu=true;
                              } 
                            ?>
                            <?php 
                            if(in_array($plugin_menue_index,$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){
                            if(isset($GLOBALS['user_screen_plugin_pages']))
                            {
                                $GLOBALS['user_screen_plugin_pages'][$plugin_menue_index]=$plugin_menues_data[0]['menu_title'];
                            }
                                ?>
                            <li id="li-zapier_integration<?php if(isset($is_current_menu_submenu) && $is_current_menu_submenu){echo " active";} ?>"> <a class="waves-effect waves-dark<?php if(isset($is_current_menu_submenu) && $is_current_menu_submenu){echo ' active';} ?>" href="index.php?page=<?php echo $plugin_menue_index; ?>" aria-expanded="false">
                            <?php if(strlen(trim($plugin_menues_data[0]['icon_url']))>0){ 
                                echo '<i><img src="'.$plugin_menues_data[0]['icon_url'].'" style="max-height:16px;margin-bottom:5px;"></i>';
                             }else{ ?>
                            <i class="fas fa-bullseye"></i>
                            <?php } ?>
                            <span class="hide-menu"><?php echo $plugin_menues_data[0]['menu_title']; ?></span></a>
                            </li>
                            <?php
                            if((isset($is_current_menu_submenu) && $is_current_menu_submenu)||(isset($_GET['page']) && $_GET['page']==$plugin_menue_index))
                            {
                                if(isset($plugin_menues_data[0]['submenu']) && $plugin_menues_data[0]['submenu'])
                                {
                                    $cf_submenu_isactiveclass="";
                                    if(isset($_GET['page']) && $_GET['page']==$plugin_menue_index)
                                    {
                                        $cf_submenu_isactiveclass=' cf-plugin-submenu-active';
                                    }
                                    echo "<span class='cf-plugin-submenu".$cf_submenu_isactiveclass."'><a href='index.php?page=".$plugin_menue_index."'>".$plugin_menues_data[0]['submenu']."</a></span>";
                                }
                            }
                            if($is_current_menu_submenu || $plugin_menue_index==$_GET['page'])
                            {
                                for($i=1;$i<count($plugin_menues_data);$i++)
                                {
                                    $cf_submenu_isactiveclass="";
                                    if($plugin_menues_data[$i]['menu_slug']==$_GET['page'])
                                    {
                                        $cf_submenu_isactiveclass=" cf-plugin-submenu-active";
                                    }
                                    echo "<span class='cf-plugin-submenu ".$cf_submenu_isactiveclass."'><a href='index.php?page=".$plugin_menues_data[$i]['menu_slug']."'>".$plugin_menues_data[$i]['menu_title']."</a></span>";
                                }
                            }
                            ?>
                            <?php } ?> 

                            <?php }} ?>
                        <!-- /All Plugin menues -->
                        <?php if(in_array('zapier_integration',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						 <li id="li-zapier_integration"> <a class="waves-effect waves-dark" href="index.php?page=zapier_integration" aria-expanded="false"><i class="zap-sidebar-icon">ZAP &nbsp;</i> <span class="hide-menu"><?php w('Zapier Integration'); ?></span></a>
                        </li>
                        <?php } ?>    
                        
                        <?php if(in_array('listrecords',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-lists"> <a class="waves-effect waves-dark" href="index.php?page=listrecords" aria-expanded="false"><i class="fas fa-clipboard-list"></i> <span class="hide-menu"><?php w('Lists'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('compose_mail',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-compose_mail"> <a class="waves-effect waves-dark" href="index.php?page=compose_mail" aria-expanded="false"><i class="fas fa-paper-plane"></i> <span class="hide-menu"><?php w('Compose&nbsp;Mail'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('sequence_records',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-sequence"> <a class="waves-effect waves-dark" href="index.php?page=sequence_records" aria-expanded="false"><i class="fas fa-calendar-alt"></i> <span class="hide-menu"><?php w('Sequences'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('sentemailsdetails',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-mailing-history"> <a class="waves-effect waves-dark" href="index.php?page=sentemailsdetails" aria-expanded="false"><i class="fas fa-mail-bulk"></i> <span class="hide-menu"><?php w('Mailing History'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('smtp_table',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						 <li id="li-smtps"> <a class="waves-effect waves-dark" href="index.php?page=smtp_table" aria-expanded="false"><i class="fas fa-at"></i><span class="hide-menu"><?php w('SMTPs'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('multiuser_table',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-users"> <a class="waves-effect waves-dark" href="index.php?page=multiuser_table" aria-expanded="false"><i class="fas fa-users-cog"></i><span class="hide-menu"><?php w('Users'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('gdpr',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
                        <li id="li-grpr"> <a class="waves-effect waves-dark" href="index.php?page=gdpr" aria-expanded="false"><i class="fas fa-user-lock"></i><span class="hide-menu"><?php w('GDPR Settings'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('settings',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
						<li id="li-settings"> <a class="waves-effect waves-dark" href="index.php?page=settings" aria-expanded="false"><i class="fas fa-cog"></i><span class="hide-menu"><?php w('Settings'); ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if(in_array('app_guide',$dashboard_permission_page_arr)||in_array('admin',$dashboard_permission_page_arr)){ ?>
                        <li id="li-guide"> <a class="waves-effect waves-dark" href="index.php?page=app_guide" aria-expanded="false"><i class="fas fa-question-circle"></i><span class="hide-menu"><?php w('Help'); ?></span></a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <?php if(!$plugin_page)
                { ?>
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor" id="commoncontainerid"><?php echo w($title); ?></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <?php echo w($data_arr['page_description']); ?>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <div class="card-group">

                </div>
                <?php } ?>
                <!-- ============================================================== -->
                <!-- End Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Over Visitor, Our income , slaes different and  sales prediction -->
                <!-- ============================================================== -->
                <div class="row">
				<?php require_once($content); ?>
				</div>
                <!-- ============================================================== -->
                <!-- Comment - table -->
                <!-- ============================================================== -->
                <div class="row">
                </div>
                <!-- ============================================================== -->
                <!-- End Comment - chats -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Over Visitor, Our income , slaes different and  sales prediction -->
                <!-- ============================================================== -->
                <div class="row">

                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Todo, chat, notification -->
                <!-- ============================================================== -->
                <div class="row">
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">

                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
        <div class="row">
           <div class="col cf_main_footer_element">
           <?php if(!$plugin_page){ ?>
           <a onclick='viewTutorial("<?php
           //$data_arr['tutorial_link']="";
            echo (isset($data_arr['tutorial_link']) && filter_var($data_arr['tutorial_link'],FILTER_VALIDATE_URL))? $data_arr['tutorial_link']:"https://cloudfunnels.in/membership/members#tutorials" ?>")' style="cursor:pointer;color: rgb(31, 87, 202);"><i class="fas fa-play"></i>&nbsp;<?php w('Watch Tutorials'); ?></a>
           <?php } ?>
           </div>
           <div class="col text-right"><a href="https://teknikforce.com" target="_BLANK"><img class="image-responsive" src="assets/img/tekniklogo.png" style="max-width:180px !important;"></a></div> 
        </div>   
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap popper Core JavaScript -->
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/theme-assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="assets/theme-assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/theme-assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/theme-assets/dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <!-- Popup message jquery -->
    <!-- Chart JS -->
    <script src="assets/theme-assets/dist/js/dashboard1.js"></script>
    <?php echo $footer; ?>
    
    <?php if(isset($plugin_loader) && $plugin_loader){
    echo $plugin_loader->attachToContent('admin_footer',array());
    } ?>

</body>
<script src="assets/js/auto_update.js"></script>
<script>
    try
    {
    var containerautoupdate=new qfnlAutoUpdate();
    <?php 
        global $is_gcp;
        global $self_hosted_gcp; 
        if($is_gcp)
        {
            echo "containerautoupdate.is_gcp=1;";
            if($self_hosted_gcp)
            {
                echo "containerautoupdate.is_self_hosted_gcp=1;";
            }
        } 
    ?>
    containerautoupdate.init();
    }catch(errr){}
function sidebarSelectorForUnreservedPages()
{
    //selectors are present inside commanded array
    /*['li-dashboard','li-funnels','li-membership','li-products','li-sales','li-payment','li-autoresponders','li-integrations','li-lists','li-sequence','li-mailing-history','li-smtps','li-users','li-grpr','li-settings','li-guide','li-zapier_integration']*/
    try
    {
        <?php
        if(isset($_GET['page']))
        {
            $selectedli_viewcontainer=0;
            if($_GET['page']=="create_funnel" || $_GET['page']=="optins")
            {
                //funnels
                $selectedli_viewcontainer="li-funnels";
            }
            elseif($_GET["page"]=="members")
            {
                //membership
                $selectedli_viewcontainer="li-membership";
            }
            elseif($_GET['page']=="analysis")
            {
                //analysis
                $selectedli_viewcontainer="li-analysis";
            }
            elseif($_GET['page']=="payment_methods")
            {
                //payment methods
                $selectedli_viewcontainer="li-payment";
            }
            elseif($_GET['page']=="autores_dashboard")
            {
                //auto responders
                $selectedli_viewcontainer="li-autoresponders";
            }
            elseif($_GET['page']=="createlist")
            {
                //lists
                $selectedli_viewcontainer="li-lists";
            }
            elseif($_GET['page']=="sequence")
            {
                //sequences
                $selectedli_viewcontainer="li-sequence";
            }
            elseif($_GET['page']=="compose_mail")
            {
                //sequences
                $selectedli_viewcontainer="li-compose_mail";
            }
            elseif($_GET['page']=="sentemailsdetails")
            {
                $selectedli_viewcontainer="li-mailing-history";
            }
            elseif($_GET['page']=="smtp_create")
            {
                $selectedli_viewcontainer="li-smtps";
            }
            elseif($_GET['page']=="createmultiuser")
            {
                $selectedli_viewcontainer="li-users"; 
            }
            if( $selectedli_viewcontainer !==0)
            {
                echo '
                var lidoc=document.getElementById("sidebarnav").querySelectorAll("li#'.$selectedli_viewcontainer.'")[0];
                lidoc.classList.add("active");
                lidoc.getElementsByTagName("a")[0].classList.add("active");
                ';
            }
        }
        ?>
        //sidebarnav
    }
    catch(errrrrr)
    {console.log(errrrrr)}
}
sidebarSelectorForUnreservedPages();

(function(){
    let doc=document.querySelectorAll(".globelanguagechanger")[0];
    doc.onclick=function(){
        let popup=document.createElement("div");
        let langs={};
        let selected_lang=`<?php echo ((get_option('app_language'))? get_option('app_language'):'lang_english_en'); ?>`;
        <?php 
            global $cf_available_languages;
            if(is_array($cf_available_languages))
            {
                echo "langs=JSON.parse(`".json_encode($cf_available_languages)."`);"; 
            }
        ?>
        popup.classList.add('lang_changer_popup');
        let langs_div=``;
        for(let i in langs)
        {
            langs_div +=((i==selected_lang)? `<div class='specific text-primary' code='${i}'><i class='fas fa-check text-success'></i>&nbsp;&nbsp;<strong>${langs[i]}</strong></div>`:`<div class='specific' code='${i}'><strong>${langs[i]}</strong></div>`);
        }
        let content=`<div class="card pnl" style="margin-bottom:0px;">
        <div class="card-header">
            <div class="row">
                <div class="col-10"><?php w('Select Language'); ?></div>
                <div class="col-2 text-right closelanguageselector"><i class="fas fa-times-circle" style="cursor:pointer;"></i></div>
            </div>
        </div>
        <div class="card-body">${langs_div}</div>
        </div>`;
        popup.innerHTML=content;
        document.body.appendChild(popup);
        setTimeout(function(){
            document.querySelectorAll(".lang_changer_popup .specific").forEach(doc=>{
                doc.addEventListener('click',function(){
                    let code=this.getAttribute('code');
                    let frm=document.createElement("form");
                    frm.action="";
                    frm.method="POST";
                    let inp=document.createElement('input');
                    inp.type="hidden";
                    inp.name="cf_do_change_language";
                    inp.value=code;
                    frm.appendChild(inp);
                    document.body.appendChild(frm);
                    frm.submit();
                });
            });
            document.querySelectorAll(".closelanguageselector")[0].onclick=function(){
                document.body.removeChild(popup);
            };
        },200);
    };
})();


</script>
</html>
<?php
$container_page_content=ob_get_contents();
ob_get_clean();
$container_page_content=str_replace("@@qfnl_install_url@@",get_option('install_url'),$container_page_content);
echo $container_page_content;
?>