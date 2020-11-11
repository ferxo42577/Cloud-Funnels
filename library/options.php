<?php
$GLOBALS['mysqli']=$mysqli;
$GLOBALS['dbpref']=$dbpref;
$GLOBALS['qfnl_global_vars']=array();
/*----------------Options starts here-------------------*/
function add_option($name,$value)
{
	$globalvars=$GLOBALS['qfnl_global_vars'];
	$mysqli=$GLOBALS['mysqli'];
	$pref=$GLOBALS['dbpref'];
	$table=$pref."options";


	$name=$mysqli->real_escape_string($name);
	$value=$mysqli->real_escape_string($value);


	if(get_option($name)===false)
	{
	$qry=$mysqli->query("insert into `".$table."` (`option_name`, `option_value`, `createdon`) values ('".$name."','".$value."','".date('d-M-Y h:i')."')");
	$globalvars[$name]=$value;
	$GLOBALS['qfnl_global_vars']=$globalvars;
	}
	else{return false;}
}
function get_option($name)
{
	$globalvars=$GLOBALS['qfnl_global_vars'];
	$mysqli=$GLOBALS['mysqli'];
	$pref=$GLOBALS['dbpref'];
	$table=$pref."options";

	$name=$mysqli->real_escape_string($name);

	if(isset($globalvars[$name]))
	{
		return $globalvars[$name];
	}
	else
	{
	$qry=$mysqli->query("select `option_value` from `".$table."` where `option_name`='".$name."'");
	if($qry->num_rows<1)
	{
		return false;
	}
	else
	{
		$data=$qry->fetch_object();
		$globalvars[$name]=$data->option_value;
		$GLOBALS['qfnl_global_vars']=$globalvars;
		return $data->option_value;
	}
	}
}
function update_option($name,$value)
{
	$globalvars=$GLOBALS['qfnl_global_vars'];
	$mysqli=$GLOBALS['mysqli'];
	$pref=$GLOBALS['dbpref'];
	$table=$pref."options";

	$name=$mysqli->real_escape_string($name);
	$value=$mysqli->real_escape_string($value);

	if(get_option($name)===false)
	{
		add_option($name,$value);
	}
	else
	{
		$mysqli->query("update `".$table."` set `option_value`='".$value."' where `option_name`='".$name."'");
	}
	$globalvars[$name]=$value;
	$GLOBALS['qfnl_global_vars']=$globalvars;
}
function delete_option($name)
{
	$globalvars=$GLOBALS['qfnl_global_vars'];
	$mysqli=$GLOBALS['mysqli'];
	$pref=$GLOBALS['dbpref'];
	$table=$pref."options";
	$mysqli->query("delete from `".$table."` where `option_name`='".$name."'");
	unset($globalvars[$name]);
	$GLOBALS['qfnl_global_vars']=$globalvars;
}
/*--------------------options ends here-----------------*/

/*--------------------add_query_arg function------------*/
function add_query_arg($arg1,$arg2,$arg3="")
{
	$create_url=function($url,$args){
		$url_arr=parse_url($url);
		$params="";
		$all_args=array();
		if(isset($url_arr['query']))
		{
			parse_str($url_arr['query'],$temp_all_args);
			$all_args=$temp_all_args;
		}
		
		foreach($args as $index=>$arg)
		{
			$all_args[$index]=$arg;
		}

		$new_arr=array();
		foreach($all_args as $index=>$arg)
		{
			array_push($new_arr,$index."=".$arg);
		}
		$params="?";
		$params .=implode("&",$new_arr);


		$new_url="";
		if(isset($url_arr['scheme']))
		{
			$new_url .=$url_arr['scheme']."://";
		}
		if(isset($url_arr['host']))
		{
			$new_url .=$url_arr['host'];
		}
		if(isset($url_arr['path']))
		{
			$new_url .=$url_arr['path'];
		}
		return $new_url.$params;
	};
	if(is_array($arg1))
	{
		$url=$arg2;
		return $create_url($url,$arg1);
	}
	else
	{
		$url=$arg3;
		$arr=array($arg1=>$arg2);
		return $create_url($url,$arr);
	}
}
function showRecordCountSelection()
{
	if(isset($_POST['qfnl_max_records_per_page']) && is_numeric($_POST['qfnl_max_records_per_page']))
	{
		update_option('qfnl_max_records_per_page',$_POST['qfnl_max_records_per_page']);
	}
	$options="";
	$range_arr=array(10, 25, 50, 100, 250, 500, get_option('qfnl_max_countable_rows'));

	$got_selection=false;

	for($i=0;$i<count($range_arr);$i++)
	{
		$selected="";
		if($range_arr[$i]==get_option('qfnl_max_records_per_page'))
		{
			$selected="selected";
			$got_selection=true;
		}
		elseif(($i==(count($range_arr)-1)) && (!$got_selection))
		{
			$selected="selected";
		}
		$selected=($range_arr[$i]==get_option('qfnl_max_records_per_page'))? "selected":"";
		$opt_text=(($i==(count($range_arr)-1)))? 'All':$range_arr[$i];
		$options .="<option value='".$range_arr[$i]."' ".$selected.">".t($opt_text)."</option>";
	}

	return "<div class='form-group'><form action='' method='post'>
	<div class='input-group input-group-sm'>
	<div class='input-group-prepend'>
	<span class='input-group-text'>".t('Number of items per page')."</span>
	</div>
	<select name='qfnl_max_records_per_page' class='form-control qfnl_max_records_per_page form-control-sm'>
	".$options."
	</select>
	</div>
	<input type='submit' class='qfnl_max_records_per_page_btn' style='display:none;'>
	</form></div>";	
}


function arrayIndexToStr($text,$arr)
{
	if(is_array($arr))
	{
		foreach($arr as $index=>$data)
		{
			if(is_array($data)||is_object($data)){continue;}
			$text=str_replace("{".$index."}",$data,$text);
		}
	}
	return $text;
}
function linkBuilderAccordingCurrentURL($current)
{
		$url_arr=parse_url($current);
		$query_arr=array();
		if(isset($url_arr['query']))
		{
		parse_str($url_arr['query'],$arr);
		$query_arr=$arr;
		}

		$current_get=(isset($_GET))? $_GET:array();
		foreach($current_get as $index=>$data)
		{
			if(!isset($query_arr[$index]))
			{
				$query_arr[$index]=$data;
			}
		}
		
		$query="";
		foreach($query_arr as $index=>$data)
		{
			$query .=$index."=".$data."&";
		}
		
		$query=rtrim($query,"&");
		return $url_arr['path']."?".$query;
}
function createPager($total,$nextpageurl="",$page_count=0,$lastid=0)
{
	ob_start();
	echo '<ul class="pagination qfnlpagination" style="cursor:pointer;">';

	if($page_count>0)
	{
	echo '<li class="page-item"><a class="page-link" id="historyback">'.t('Previous').'</a></li>';
	}
	$gotnextactive=0;
	$gotactive=0;
	if(is_numeric($total))
	{
	$pagescount=ceil($total/get_option('qfnl_max_records_per_page'));
	if($pagescount>=1)
	{
		 $dotshow=0;
		for($i=1;$i<=$pagescount;$i++)
		{

     if(!($i==1||$i==2||$i==$pagescount||$i==$pagescount-1||$i==$page_count||$i==$page_count-1||$i==$page_count+1))
		 {
			 ++$dotshow;
       if($dotshow==1){echo "<li class='page-item'><a class='page-link'>...</a></li>";}
			 continue;
		 }

		 $dotshow=0;

			$activeli="";
			if($page_count>0)
			{
			if($i==$page_count)
			{
			$activeli="active";
			++$gotactive;
			goto lbl;
			}
			if($gotactive==1)
			{
				$gotnextactive=$i;
		  	$gotactive=0;
			}
			}
	  lbl:
			$nextexecutable_page=$nextpageurl.'='.$i;
			$nextexecutable_page=linkBuilderAccordingCurrentURL($nextexecutable_page);
			echo '<li class="page-item '.$activeli.'"><a class="page-link" href="'.$nextexecutable_page.'">'.t($i).'</a></li>';
			$lastid=$i+1;
		}
		if($gotnextactive==0){$gotnextactive=2;}
	}
    }

	if($gotnextactive>0)
	{
		echo '<li class="page-item"><a class="page-link" href="'.$nextpageurl.'='.$gotnextactive.'">'.t('Next').'</a></li>';
	}
	echo '</ul>';
	$content=ob_get_contents();
	ob_end_clean();
	return $content;
}
function createSearchBoxBydate()
{
	ob_start();
 $today=date('d-m-Y');

	$select='<select class="form-control form-control-sm " name="fromdays"><option value=0>'.t('Select Days').'</option><option value=1>'.t('All Days').'</option><option value="'.$today.'">'.t('Today').'</option><option value="'.date('d-m-Y h:ia',strtotime($today." -7 days")).'">'.t('Last 7 days').'</option><option value="'.date('d-m-Y h:ia',strtotime($today." -15 days")).'">'.t('Last 15 days').'</option><option value="'.date('d-m-Y h:ia',strtotime($today." -30 days")).'">'.t('Last 30 days').'</option><option value="'.date('d-m-Y h:ia',strtotime($today." -60 days")).'">'.t('Last 60 days').'</option>
	<option value="'.date('d-m-Y h:ia',strtotime($today." -90 days")).'">'.t('Last 90 days').'</option><option value="'.date('d-m-Y h:ia',strtotime($today." -180 days")).'">'.t('Last 180 days').'</option><option value="'.date('d-m-Y h:ia',strtotime($today." -365 days")).'">'.t('Last 365 days').'</option></select>';

	$hiddeninputs="";

	foreach($_GET as $index=>$data)
	{
		if(!in_array($index,array('fromdays','fromdate','todate')))
		{
			$hiddeninputs.="<input type='hidden' name='".$index."' value='".$data."'>";
		}
	}

	echo '<div class="srchcontainer" style=""><button class="btn  dropdown-toggle btn-sm btn-block" style="">'.t('Search By Date').'</button><div
	 class="datesearchformdata"><div class="form-group">
	 <form action="" method="GET" onsubmit="return validateDateField()">
	 '.$hiddeninputs.'
	 	 <span id="searchspancontainer">
	 '.$select.'<label class="text-white">'.t('Search By Date').'</label>
	 <div class="input-group input-group-sm mb-2"><div class="input-group-prepend"><p class="input-group-text">'.t('From').' </p></div><input type="date" name="fromdate" class="form-control form-control-sm" value="'.date('Y-m-d').'"></div>
	 <div class="input-group input-group-sm mb-2"><div class="input-group-prepend"><p class="input-group-text">'.t('To').' </p></div><input type="date" class="form-control form-control-sm" value="'.date('Y-m-d').'" name="todate"></div>
	 </span>
	 <button type="submit" class="form-control btn theme-button" style="margin-top:5px;" id="srchdatebtn"> '.t('Search').'</button>
	 </form>
	</div></div></div>';
	$data=ob_get_contents();
	ob_end_clean();
	return $data;
}
function dateBetween($search,$table=null,$date_time_format=false)
{
	//get sql between str for search....[0] for all [1] and
	$datebetween="";
	$datebetween_all="";

	$search=($table===null)? "`".$search."`":"`".$table."`.".$search."";
	
	if(isset($_GET['fromdate']))
	{
		if(strlen($_GET['fromdate'])>2)
		{
		$getfromdate=array_reverse(explode("-",$_GET['fromdate']));
		$fromdate=implode('-',$getfromdate);
		$fromdate=strtotime($fromdate);

		$gettodate=array_reverse(explode("-",$_GET['todate']));
		$todate=implode('-',$gettodate);
		$todate.=" 11:59pm";
		$todate=strtotime($todate);

		if($date_time_format)
		{
			$fromdate="'".date('Y-m-d H:i:s', $fromdate)."'";
			$todate="'".date('Y-m-d H:i:s', $todate)."'";
		}
		
		$datebetween=" and ".$search." between ".$fromdate." and ".$todate."";
		$datebetween_all=" ".$search." between ".$fromdate." and ".$todate."";
		}
	}
	if(isset($_GET['fromdays']))
	{
		if(strlen($_GET['fromdays'])>2)
		{
			$fromdate=strtotime($_GET['fromdays']);
			$todate=time();

			if($date_time_format)
			{
				$fromdate="'".date('Y-m-d H:i:s', $fromdate)."'";
				$todate="'".date('Y-m-d H:i:s', $todate)."'";
			}

			$datebetween=" and ".$search." between ".$fromdate." and ".$todate."";
			$datebetween_all=" ".$search." between ".$fromdate." and ".$todate."";
		}
	}
	return array($datebetween_all,$datebetween);
}
function timeConvert($format='s',$time,$do=0)
{
	//time convert between different zone
  //$do=0 default to another|$do=1 another to default
	//$format  s for unix time
	if($do==0)
	{
	$default="UTC";
	$convert=get_option('time_zone');
	}
	if($do==1)
	{
		$convert="UTC";
		$default=get_option('time_zone');
	}
	date_default_timezone_set($default);
	if(is_numeric($time)){$time=date("d-M-Y h:ia",$time);}
	$date = new DateTime($time, new DateTimeZone($default));

	$date->setTimezone(new DateTimeZone($convert));
	if($format=='s')
	{$time=strtotime($date->format('d-M-Y h:ia'));}
	else {$time=$date->format($format);}
	date_default_timezone_set("UTC");
	return $time;
}

function cfLoopCreator($type,$html)
{
	$hasbody=0;
	if(strpos($html,"<body>")>=0)
	{
		++$hasbody;
	}
$dom=new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($html);
$xpath=new DOMXPath($dom);
$qry=$xpath->query("//*[@cf-loop='".$type."']");
foreach($qry as $data)
{
	$inner_html=cfLoopInnerHTML($data);
	$inner_html="{".$type."}".$inner_html."{/".$type."}";
	while($data->childNodes->length)
    {
        $data->removeChild($data->firstChild);
    }
	$fragment = $data->ownerDocument->createDocumentFragment();
    $fragment->appendXML($inner_html);
	$data->appendChild($fragment);
}
$html=$dom->saveHTML();
if($hasbody<1)
{
$start=strpos($html,"<body>")+6;
$end=strpos($html,"</body>")-$start;
$html=substr($html,$start,$end);
}
return $html;
}

function cfLoopInnerHTML(DOMNode $element) 
{ 
    $innerHTML = ""; 
    $children  = $element->childNodes;

    foreach ($children as $child) 
    { 
        $innerHTML .= $element->ownerDocument->saveHTML($child);
    }

    return $innerHTML; 
}

function getProtocol()
	{
	//get current protocol	
	if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {

		return "https://";
	}
	return "http://";
	}
function getOS()
{
//get current visitor operating system	
	$user_agent = (isset($_SERVER['HTTP_USER_AGENT']))? $_SERVER['HTTP_USER_AGENT']:'Unknown';
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser() 
{
  //get current visitor browser
  $user_agent = (isset($_SERVER['HTTP_USER_AGENT']))? $_SERVER['HTTP_USER_AGENT']: 'Unknown';
  $browser        = "Unknown Browser";
  $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Mobile Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function getIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function getLocation($ip=false)
{
  //get current visitor location
  if($ip===false)
  {
	  $ip=getIP();
  }
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, "https://pro.ip-api.com/json/".$ip."?key=hKTTGTDeZib1VzK");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  $data=json_decode($data,true);
  return $data;
}
 function getDevice()
 {
 	require_once("mobile_detect.php");
	$detect = new Mobile_Detect;
	// DETECTION ENGINE
	$data= "DESKTOP";
	if($detect->isMobile()) 
	{
		$data= "MOBILE";
	}
	elseif($detect->isTablet())
	{
		$data="TABLET";
	}
	else
	{
		$data="DESKTOP";
	}

return $data;
 }
function arranger($type_arr=array(),$get_parameter="arrange_records_order")
{
	ob_start();
	$hiddeninputs="";
	foreach($_GET as $index=>$data)
	{
		if($index==$get_parameter){continue;}
		$hiddeninputs .="<input type='hidden' name='".$index."' value='".$data."'>";
	}
	echo '<form action="" methoed="get"><div class="form-group"><div class="input-group input-group-sm"><div class="input-group-prepend">
	<span class="input-group-text">'.t('Arrange By').' </span>
	</div>
	'.$hiddeninputs.'
	<select name="'.$get_parameter.'" class="form-control form-control-sm" onchange="document.getElementById(\'constarrengerorder\').click()">';
	foreach($type_arr as $index=>$data)
	{
		$selected_asc="";
		$selected_desc="";
		if(isset($_GET[$get_parameter]))
		{
			if($_GET[$get_parameter]==base64_encode($index." asc"))
			{
				$selected_asc="selected";
			}
			elseif($_GET[$get_parameter]==base64_encode($index." desc"))
			{
				$selected_desc="selected";
			}
		}

		echo "
		<option value='".base64_encode($index." desc")."' ".$selected_desc.">".t("\${1} Descending",array(ucwords($data)))."</option>
		<option value='".base64_encode($index." asc")."' ".$selected_asc.">".t("\${1} Ascending", array(ucwords($data)) )."</option>
		";
	}
	echo '
	</select>
	<button type="submit" id="constarrengerorder" style="display:none;"></button>
	</div></div></form>';
	$content=ob_get_contents();
	ob_end_clean();
	return $content;
}
function modifyHtaccess($doo="create",$dir)
{
   global $is_gcp;
   if(!$is_gcp)
   {
   $dir=str_replace("\\","/",$dir);
   $file=$dir."/".".htaccess";
   $data="#cf-qfnl-rewrite-start\n";
   $data .="RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteRule ^((cf-admin)|(cf-login))+(/){0,1}$ index.php?page=login&cf-admin=1 [L]
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteRule ^(.+)(/){0,1}(.*)(/){0,1}$ index.php?funnel_view=1&get_funnel=$1/$2 [L]";
   $data .="\n#cf-qfnl-rewrite-end\n";

   if($doo=="create")
   {
	if(is_file($file) && !get_option('backup_htaccess') && filesize($file)>0)
	{
		$fr=fopen($file,'r');
		add_option('backup_htaccess',fread($fr,filesize($file)));
		fclose($fr);
	}
	$ht_data=$data;
	if(file_exists($file))
	{
		$fp=fopen($file,'r');
		$current_ht_data=fread($fp,filesize($file));
		if(strpos($current_ht_data,$data) ===false)
		{
			$ht_data .="\n".$current_ht_data;
		}
		else
		{
			$ht_data=$current_ht_data;
		}
		fclose($fp);
	}
   $fp=fopen($file,"w+");
   fwrite($fp,$ht_data);
   fclose($fp);
   }
   elseif(is_file($file) && $doo=="delete" && filesize($file)>0)
   {
	   $fpp=fopen($file,"rb");
	   $file_data=fread($fpp,filesize($file));
	   fclose($fpp);
	   $fpw=fopen($file,"w");
	   $file_data=str_replace($data,"",$file_data);
	   fwrite($fpw,$file_data);
	   fclose($fpw);
   }
  }
}
function cf_enc($string,$do="encrypt")
{
	$token=get_option('site_token');
	$token .="cloudfunnels can do it";
	
	$method = "AES-256-CBC";
	$key= hash("sha256",$token);
	$iv=substr(hash('sha256','--'.$token),0,16);
	
	if($do=="encrypt")
	{
		$data=base64_encode(openssl_encrypt($string,$method,$key,0,$iv));
	}
	elseif($do=="decrypt")
	{
		$data=openssl_decrypt(base64_decode($string),$method,$key,0,$iv);
	}
	else
	{
		$data=$string;
	}
	return $data;
}
function getBsSixtyFourLogos($type="logo")
{
	if($type=="logo")
	{
		return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAoCAYAAAC8cqlMAAAACXBIWXMAAAsTAAALEwEAmpwYAAAF7mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDUgNzkuMTYzNDk5LCAyMDE4LzA4LzEzLTE2OjQwOjIyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXA6Q3JlYXRlRGF0ZT0iMjAxOS0wOC0yMVQyMTowMzo0NCswODowMCIgeG1wOk1vZGlmeURhdGU9IjIwMTktMDgtMjdUMjM6NDM6MzMrMDg6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMTktMDgtMjdUMjM6NDM6MzMrMDg6MDAiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6ZDYwZWNmNWMtNjdjMi01MjRlLWI5ODQtMWUzZTQ4ODAxNjFhIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkVDRDU0MTlFQkZFNDExRTk5MTU3RDk0QTk2MTE0MDMzIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6RUNENTQxOUVCRkU0MTFFOTkxNTdEOTRBOTYxMTQwMzMiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpFQ0Q1NDE5QkJGRTQxMUU5OTE1N0Q5NEE5NjExNDAzMyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpFQ0Q1NDE5Q0JGRTQxMUU5OTE1N0Q5NEE5NjExNDAzMyIvPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDpkNjBlY2Y1Yy02N2MyLTUyNGUtYjk4NC0xZTNlNDg4MDE2MWEiIHN0RXZ0OndoZW49IjIwMTktMDgtMjdUMjM6NDM6MzMrMDg6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE5IChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz43Ve3eAAAH3klEQVRYhbXZe5RVVR0H8M+5M8DwnBEERcAkEEQxUFR8lS2k1MwXPXwsWz4WJZmCGGZLyx5qtpZUSpoWmaYrpaC0li1fGalEqZSWT1yiIArIa4bHdOdx7z39sc9lzlzuDOPM9bfWWXufs5/f/dv7+/v99oniOAZ133jShySzMboQxzftaGje+MS8o00fP6Tig1RXvMf28hlchyFRJKMQz8klC1dp+TCBTMSfiy+t+Xh2pqa6YWj/3t9DodKDZSrc335YgFMxvd1AUSTOFb6SbcmPx31J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";
	}
	elseif($type=="logo-text")
	{
		return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAAWCAYAAAAisWU6AAAACXBIWXMAAAsTAAALEwEAmpwYAAAG0GlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDUgNzkuMTYzNDk5LCAyMDE4LzA4LzEzLTE2OjQwOjIyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXA6Q3JlYXRlRGF0ZT0iMjAxOS0wOC0yMVQyMTowMzo0NCswODowMCIgeG1wOk1vZGlmeURhdGU9IjIwMTktMDgtMjdUMjM6NDc6MDgrMDg6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMTktMDgtMjdUMjM6NDc6MDgrMDg6MDAiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6Zjg2NDdkZGEtZDBiNC1kZDQyLTg2YjgtOTg5ZDRiMjE0MTA5IiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6NjhiMmVjY2ItZjBiNS1lMjQ4LWJhZTgtYmZkOTQzNDQ5NDdiIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6RUNENTQxOUVCRkU0MTFFOTkxNTdEOTRBOTYxMTQwMzMiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpFQ0Q1NDE5QkJGRTQxMUU5OTE1N0Q5NEE5NjExNDAzMyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpFQ0Q1NDE5Q0JGRTQxMUU5OTE1N0Q5NEE5NjExNDAzMyIvPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDoxMjI3OTM5YS0wMzZmLTQwNGYtOTM5MC1iYTY0NTg1ODUxNzciIHN0RXZ0OndoZW49IjIwMTktMDgtMjdUMjM6NDc6MDgrMDg6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE5IChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6Zjg2NDdkZGEtZDBiNC1kZDQyLTg2YjgtOTg5ZDRiMjE0MTA5IiBzdEV2dDp3aGVuPSIyMDE5LTA4LTI3VDIzOjQ3OjA4KzA4OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxOSAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5k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";
	}
}
function cf_rmdir($dir)
    {
         if (cf_dir_exists($dir))
   		{
        	$objects = scandir($dir);

			foreach ($objects as $object)
			{
				if ($object != "." && $object != "..")
				{
					if (!is_file($dir . "/" . $object))
					{
						cf_rmdir($dir . "/" . $object);
					}
					else
					{
						unlink($dir . "/" . $object);
					}
				}
			}

			reset($objects);
        	rmdir($dir);
    	}
	}
	function register_tiny_editor($selector)
	{
		$script="";
		if(!isset($GLOBALS['tiny_asset_loaded']))
		{
			$ins_url= get_option('install_url');

			$script .='<script type="text/javascript" src="'.$ins_url.'/assets/js/jscolor.js"></script>
			<script type="text/javascript" src="'.$ins_url.'/assets/js/tinymce/jquery.tinymce.min.js"></script>
			<script type="text/javascript" src="'.$ins_url.'/assets/js/tinymce/tinymce.min.js"></script>
			<script type="text/javascript" src="'.$ins_url.'/assets/js/load_tiny.js"></script>
			';
			$GLOBALS['tiny_asset_loaded']=1;
		}
		if(is_array($selector))
		{  foreach($selector as $sel)
			{
				$script .="<script>cfLoadTinyMceEditor(`".$sel."`);</script>";
			}
		}
		else
		{
			$script .="<script>cfLoadTinyMceEditor(`".$selector."`);</script>";
		}
		echo $script;
	}
?>
