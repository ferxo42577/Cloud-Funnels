<?php
$current_app_version='4.2.8';
/*=======Reminder: Never change comments from this file=========*/
//GCP-INIT
$is_gcp=0;$self_hosted_gcp=0;
//GCP-INIT-END

//$_SERVER['DOCUMENT_ROOT']=rtrim($_SERVER['DOCUMENT_ROOT'],"/");
//$_SERVER['DOCUMENT_ROOT']=rtrim($_SERVER['DOCUMENT_ROOT'],"\\");


$document_root=__DIR__;

$document_root=rtrim(str_replace("\\","/",$document_root),"/");
$document_root_arr=explode("/",$document_root);
array_pop($document_root_arr);
$document_root=implode("/",$document_root_arr);
$document_root=rtrim(str_replace("\\","/",$document_root),"/");

//<GCP_BUILD>
                        //</GCP_BUILD>
$GLOBALS["config_file"]=($is_gcp)? $gcp_config_dir."/config.php":"config.php";

if(!function_exists('cf_dir_exists'))
{
	function cf_dir_exists($dir)
	{
		global $is_gcp;
		$dir=rtrim($dir,"/");
		if($is_gcp && strpos(trim($dir),"gs://")===0)
		{
			if(count(scandir($dir))>0)
			{
				return 1;
			}
			else
			{
				$temp_dir=explode("/",str_replace("gs://","",$dir));
				if(count($temp_dir)>0)
				{
					//$find_arr=array_slice($temp_dir,1,count($temp_dir));
					//$find=implode("/",$find_arr);
					$find=$temp_dir[count($temp_dir)-1];
					unset($temp_dir[count($temp_dir)-1]);
					$temp_dir=implode("/",$temp_dir);
					$arr=scandir("gs://".$temp_dir);
					$search=array_search($find."/",$arr);
					if(!$search)
					{
						$search=array_search($find,$arr);
					}
					if($search !==false && ($search===0 || $search>0))
					{
						return 1;
					}
				}
				else
				{
					return 0;
				}
			}

		}
		elseif(is_dir($dir))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

}

if(!function_exists('cf_fwrite'))
{
	function cf_fwrite($file,$content)
	{
		$stat=false;
		global $is_gcp;
		if($is_gcp)
		{
			if(is_file($file))
			{
				unlink($file);
			}
			if(file_put_contents($file, $content))
			{$stat=true;}
		}
		else
		{
			$fp=fopen($file,"w");
			if(fwrite($fp,$content))
			{
				$stat =true;
			}
			fclose($fp);
		}
		return $stat;
	}
}

if(!function_exists('gcp_files_get_content'))
{
	function gcp_files_get_content($file_name)
	{
		clearstatcache();
		ob_start();
		readfile($file_name);
		$content=ob_get_clean();
		return $content;
	}
}
?>