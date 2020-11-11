<?php
$current_base_dir=str_replace("\\","/",__DIR__);
require_once($current_base_dir."/gcp/gcp.php");
require_once($current_base_dir.'/library/lang.php');

//env check---------
if($is_gcp && isset($_SERVER["REQUEST_URI"]))
{
	$env_current_url=parse_url($_SERVER["REQUEST_URI"]);

	if(isset($env_current_url['path']))
	{
		$env_current_path=ltrim($env_current_url['path'],"/");

		$env_current_path_arr=explode("/",$env_current_path);
		if(!($env_current_path_arr[count($env_current_path_arr)-1]=="index.php"))
		{
			$env_current_path_arr=explode(".",$env_current_path);
			if(count($env_current_path_arr)>0 && $env_current_path_arr[count($env_current_path_arr)-1]=='php' && is_file($env_current_path))
			{
				require_once($current_base_dir."/".$env_current_path);
				die();
			}
		}
	}
}
//env check---------
session_start();

require_once("library/esc_html.php");
if(isset($_GET["cfhttp"]))
{
	foreach($_GET as $cfhttp_data_index=>$cfhttp_data_val)
	{
		$_GET[$cfhttp_data_index]=js_html_entity_decode(base64_decode($cfhttp_data_val));
	}
}
if(isset($_POST["cfhttp"]))
{
	foreach($_POST as $cfhttp_data_index=>$cfhttp_data_val)
	{
		$_POST[$cfhttp_data_index]=js_html_entity_decode(base64_decode($cfhttp_data_val));
	}
}

$auth_pages=array('create_config','login','logout','forgot_password');
if(!is_file($GLOBALS["config_file"]))
{
	if($_GET['page'] !=='create_config')
	{
	header("Location: index.php?page=create_config");
	//exit;
	}
}


class FunnelIndex
{
	var $load;
	var $view_dir;
	var $asset_dir;
	var $config_pages;
	var $base_dir;
	function __construct()
	{
		global $is_gcp;
		global $self_hosted_gcp;

		if($is_gcp)
		{
		global $gcp_bucket;
		global $gcp_bucket_url;
		}

		date_default_timezone_set('UTC');
		$dir=str_replace("\\",'/',__DIR__);
		$this->base_dir=rtrim($dir,'/');

		require_once($this->base_dir."/library/library.php");
		$this->load=new Library();

		$this->view_dir=$dir."/views";
		$this->asset_dir=$dir."/assets";

		$this->config_pages=array('create_config','login','forgot_password','do_payment','schedule_api','mail_track','do_unsubscribe','do_redirect','data_requests','load_static_scripts','api_request','show_cf_narand','mmbr_lgout','do_payment_execute','ajax','callback_api', 'schedule_api_runserver');

		if(is_file($GLOBALS["config_file"]))
        {
		if(!$is_gcp)
		{	
		require_once($GLOBALS["config_file"]);
		}
		else
		{
			$fp_gcp=fopen($GLOBALS["config_file"],'r');

			eval(preg_replace("/((<\?php)|(\?>))+/","",file_get_contents($GLOBALS["config_file"])));

			fclose($fp_gcp);

			if($is_gcp && $self_hosted_gcp)
			{
				$gcp_bucket=get_option('self_gcp_bucket');
				$gcp_bucket=rtrim($gcp_bucket,"/");
				$gcp_bucket_url="https://storage.googleapis.com/".str_replace("gs://","",$gcp_bucket);		
			}
		}

		//language_handler_script
		$executable_language=(get_option('app_language'));
		if(!$executable_language)
		{
			$executable_language="lang_english_en";
			add_option('app_language',$executable_language);
		}
		getCachedTranslation($executable_language);
		
		$this->load->setInfo('mysqli',$mysqli);
		$this->load->setInfo('dbpref',$dbpref);
		$this->load->setInfo('base_dir',$dir);
		if(function_exists('get_option') && get_option('qfnl_current_version'))
		{
		$this->load->setInfo('app_version',get_option('qfnl_current_version'));	
		}
		
		$user=$this->load->loadUser();
        $hasuser=$user->getAllUsers();

		//print_r($hasuser);

        if($hasuser)
		{
		if(isset($_GET['page']))
		{
			if($_GET['page']=='create_config')
			{
				header('Location: index.php?page=login');
			}
		}
		$this->load->setInfo('view_dir',$this->view_dir);
		}
		else
		{
			unlink($GLOBALS["config_file"]);
			header("location: index.php");
			//exit;
		}
		}

		if(function_exists('get_option'))
		{
			//this block should be present at the end of this constructor
			$main_load=$this->load;
			require_once($this->base_dir."/library/plugin_options.php");
		}
	}
	function loadPage()
	{
		//load page
		$page='index';
		$load=$this->load->secure();

		if(isset($_GET['page']))
		{
			$page=$_GET['page'];

			if(!in_array($page,$this->config_pages))
			{
				$userdetail=$this->load->loadUser();
				if(!$userdetail->isLoggedin())
				{
					if(!in_array($_GET['page'],$this->config_pages))
					{
						$temp_index_site_token=get_option('site_token');

						$get_page=$_GET['page'];
						unset($_GET['page']);

						foreach($_GET as $gt_index=>$gt_value)
						{
							$get_page .="&".$gt_index."=".$gt_value;
						}

						$_SESSION['last_visited_page'.$temp_index_site_token]=$get_page;
					}
					header('Location: index.php?page=login');
					die();
				}
				elseif(!$userdetail->hasPermission())
				{
					header('Location: index.php?page=no_permission');
					die();
				}
			}
			$GLOBALS['inside_administration_page']=true;
		}

		if(count($_GET)<1|| !isset($_GET['page']))
		{
		$hasfunnelinbase_ob=$this->load->loadFunnel();
		if($hasfunnelinbase_ob->do_route && count($_GET)<1)
		{
			if($hasfunnelinbase_ob->hasFunnelInBase())
			{
				self::loadFunnelView(1);
			}
			else
			{
				header("Location: ".get_option('install_url')."/index.php?page=login");
			}
		}
		else
		{
		require_once($this->base_dir.'/controller/router.php');
		}
		}
		else
		{
		require_once($this->base_dir.'/controller/router.php');
		}
	}
	function loadFunnelView($autoloadbase_index=0)
	{
			$plugin_loader=false;
			if(isset($GLOBALS['plugin_loader']))
			{
				//init code
				$plugin_loader=$GLOBALS['plugin_loader'];
				$plugin_loader->processInit();
			}
			global $is_gcp;
			if($is_gcp)
			{
				global $gcp_bucket;
			}
			$ob=$this->load;
			$mysqli=$this->load->getInfo('mysqli');
			$dbpref=$this->load->getInfo('dbpref');

			$index_exists=0;

			$parsed_url=parse_url($_SERVER['REQUEST_URI']);
			if(isset($parsed_url['query']))
			{
				parse_str($parsed_url['query'],$get_query_args);
				foreach($get_query_args as $get_query_args_index=>$get_query_args_data)
				{
					$_GET[$get_query_args_index]=$get_query_args_data;
				}
			}

			if(isset($_GET['get_funnel']) || $autoloadbase_index==1)
			{
				if($autoloadbase_index===1)
				{
					$_GET['get_funnel']="";
				}

				$_GET['get_funnel']=rtrim($_GET['get_funnel'],"/");

				$isjscss=0;

				$required_file=($is_gcp)? $gcp_bucket."/":"";

				if(preg_match("/(\.(js|css))+$/",$_GET['get_funnel']))
				{
				++$isjscss;
				
				$required_file .="public_funnels/".$_GET['get_funnel'];


				if(is_file($required_file))
				{
				$currentscriptextension=pathinfo($required_file);
				if($currentscriptextension['extension']=='js')
				{
				header('content-type: application/javascript');
				}
				else{
				header('content-type: text/'.$currentscriptextension['extension']);}
				}
				}
				else
				{
				$required_file .="public_funnels/".$_GET['get_funnel']."/index.php";
				}
				$required_file=str_replace("//","/",$required_file);
				if($is_gcp)
				{
					$required_file=str_replace("gs:/","gs://",$required_file);
				}

				if(is_file($required_file))
				{
				++$index_exists;
				if($is_gcp)
				{
					$replace_dir=pathinfo($required_file);
					
					//$gcp_fp=fopen($required_file,"r");	
					$gcp_filecontent=file_get_contents($required_file);
					//fclose($gcp_fp);

					if($isjscss)
					{
						echo $gcp_filecontent;
					}
					else
					{
						$gcp_filecontent=preg_replace("/((<\?php)|(\?>))+/","",$gcp_filecontent);
						$rplcdir=$replace_dir['dirname'];
						$gcp_filecontent=str_replace('__DIR__','"'.$rplcdir.'"',$gcp_filecontent);
						eval($gcp_filecontent);
					}
				}
				else
				{
				require_once($required_file);
				}
				}
			}
			if($index_exists<1)
			{
				//echo "<h1>--Something Wrong--</h1>";
				$this->load->loadFourHunderdFour();
			}
	}
}
$ob=new FunnelIndex();
if($is_gcp==1)
{
	$_SERVER['REQUEST_URI']=str_replace('?cf_cache=type','',$_SERVER['REQUEST_URI']);
	$gcp_uri=parse_url($_SERVER['REQUEST_URI']);
	$gcp_uri_arr=array();
	$gcp_do_loadfunnel=0;

	if(isset($gcp_uri['path']))
	{
		$gcp_uri['path']=trim($gcp_uri['path'],"/");
		$gcp_uri_arr=explode("/",$gcp_uri['path']);
	}
	if(!is_file($gcp_uri['path']))
	{
	if(in_array('cf-admin',$gcp_uri_arr)||in_array('cf-login',$gcp_uri_arr))
	{
		$_GET['cf-admin']=1;
	}

	elseif(count($gcp_uri_arr)>0)
	{
		if(!(count($gcp_uri_arr)==1 && strlen(trim($gcp_uri_arr[0]))<1))
		{
		$_GET['funnel_view']=1;
		$_GET['get_funnel']=implode("/",$gcp_uri_arr);
		}
	}

	}
}
if(!isset($_GET['funnel_view']) || !(get_option('qfnl_router_mode')=='1') || isset($_GET['cf-admin']) || isset($_GET['cf-login']))
{
if(isset($_GET['cf-admin']) || isset($_GET['cf-login']))
{
	$currenturl=getProtocol();
	$currenturl .=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."/index.php?page=login";
	$currenturl=preg_replace("/(cf-login|cf-admin)+(\/)*/","",$currenturl);
	header("location: ".$currenturl."");
}

$ob->loadPage();
}
elseif(isset($_GET['funnel_view']))
{
$ob->loadFunnelView();	
}
?>
