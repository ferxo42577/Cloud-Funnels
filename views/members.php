<?php
$optins_ob=$data_arr['optinob'];
$funnel=$data_arr['funnel'];
if(isset($_POST['deletemember']))
{
$optins_ob->deleteOptin($_POST['deletemember']);
}
?>
<div class="container-fluid">
<div class="card pb-2  br-rounded" id="hidecard1">
    <div class="card-body pb-2" id="hidecard2">
<div class="row">
<div class="col-md-2 mb-2">
<?php echo createSearchBoxBydate(); ?>
</div>
<div class="col-md-3">
<?php echo showRecordCountSelection(); ?>
</div>
<div class="col-md-3">
<?php echo arranger(array('id'=>'Date')); ?>
</div>
<div class="form-group col-md-4">
<div class="input-group input-group-sm mb-3   float-right">
<div class="input-group-prepend ">
<span class="input-group-text"><i class="fas fa-search"></i></span>
</div>
<input type="text" class="form-control form-control-sm" placeholder="<?php w('Enter name, email, IP or extra fields'); ?>" onkeyup="searchMember(this.value)">
						</div>
</div>
</div>

<div class="row membercontainer">
<div class="col-sm-12">
<?php
$countpage=0;
if(isset($_GET['page_count'])){$countpage=$_GET['page_count'];}

if(isset($_GET['funnelid']))
{
$optin_datas=$optins_ob->visualOptisForFunnels($_GET['funnelid'],$countpage);
}
else
{
$optin_datas=$optins_ob->visualOptisForFunnels('all',$countpage);
}

//echo $optin_datas['extracols'];
?>

<div class="table-responsive">
<table class="table table-striped">
<?php
//optins for specific funnel
 if(isset($_GET['funnelid'])){
 ?>
<thead><th>#</th><th><?php w('Name'); ?></th><th><?php w('Email') ?></th>
<?php
$extracountcols=0;
if($optin_datas['extracols'] !=0)
{
	for($i=0;$i<count($optin_datas['extracols']);$i++)
	{
		if(in_array($optin_datas['extracols'][$i],array('name','email','password','reenterpassword')))
		{
			continue;
		}
		++$extracountcols;
		echo "<th>".$optin_datas['extracols'][$i]."</th>";
	}
}
?>
<th><?php w('Last&nbsp;IP'); ?></th><th><?php w('Last&nbsp;Loggedin'); ?></th><th><?php w('Action'); ?></th></thead>
<tbody id="srchmember">
<!--srch-->
<?php
$hashcount=0;

if(isset($_GET['page_count']))
{
	$hashcount=($_GET['page_count']*get_option('qfnl_max_records_per_page'))-get_option('qfnl_max_records_per_page');
}
$count=0;
$lastid=0;
if($optin_datas['leads'])
{
$lastid=$optin_datas['leads']->num_rows;
while($r=$optin_datas['leads']->fetch_object())
{
	++$hashcount;
	++$count;
	$action="<table class='actionedittable'><tr><td><button class='btn unstyled-button' data-toggle='tooltip' title='".t('Edit Data')."' onclick=editMemberData(".$r->id.",'".base64_encode($r->name)."','".$r->email."','".base64_encode($r->exf)."','".base64_encode(date('d-M-Y h:ia',$r->date_created))."','".base64_encode($r->ip_created)."')><i class='fas fa-edit text-primary'></i></button></td><td><form action='' method='post' onsubmit=\"return confirmDeletion('0','members')\"><input type='hidden' name='deletemember' value='".$r->id."'><button type='submit' class='btn unstyled-button' data-toggle='tooltip' title='".t('Cancel Membership/Delete Record')."'><i class='fas fa-trash text-danger'></i></button></form></td></tr></table>";

	$pagefunnel_data=$funnel->getPageFunnel($r->pageid,'','','id');

	if(!$pagefunnel_data){continue;}

	echo"<tr><td>".t($hashcount)."</td><td>".$r->name."</td><td>".$r->email."</td>";
if($optin_datas['extracols'] !=0)
{
	for($i=0;$i<count($optin_datas['extracols']);$i++)
	{
		if(in_array($optin_datas['extracols'][$i],array('name','email','password','reenterpassword')))
		{
			continue;
		}
		$jsn=json_decode($r->exf);
		$customrow=$optin_datas['extracols'][$i];
		if(isset($jsn->$customrow))
		{
			$jsn=$jsn->$customrow;
		}
		else
		{
			$jsn="NA";
		}
		echo "<td>".$jsn."</td>";
	}
}

$last_signindadate=$r->date_lastsignin;
if(is_numeric($last_signindadate))
{
  $last_signindadate=date('d-M-Y h:ia',$r->date_lastsignin);
}
else {
  $last_signindadate="N/A";
}

echo "<td>".(($r->ip_lastsignin !='N/A')? $r->ip_lastsignin:$r->ip_created)."</td><td>".$last_signindadate."</td><td>".$action."</td></tr>";
}
 }
?>
<tr><td colspan=10 class="total-data"><?php w('Total Members') ?> <?php echo t(number_format($optin_datas['total'])); ?></td></tr>
<!--/srch-->
</tbody>
<?php
 }
 //ends here for specific
 ?>
</table>
</div>

<div class="col-md-12 row nopadding">
<div class="col-sm-6 mt-2">
<?php
$paging_url=$_SERVER['REQUEST_URI']."&page_count";
$pagecount=0;
if(isset($_GET['page_count']))
{
	$pagecount=$_GET['page_count'];
}
echo createPager($optin_datas['total'],$paging_url,$pagecount,$lastid);
?>
</div>
<div class="col-sm-6 mt-2 text-right">
<form action="index.php?page=export_csv" method="post"><button type="submit" class="btn theme-button"  name="membersto_csv" value="<?php if(isset($_GET['funnelid'])){ echo $_GET['funnelid']; } ?>"><i class="fas fa-file-download"></i> <?php w('Export To CSV'); ?></button></form>
</div>
</div>

</div>
</div>
</div></div></div>
<script>
function searchMember(search)
{
	var request=new ajaxRequest();
	request.postRequestCb("index.php?page=members&funnelid=<?php echo $_GET['funnelid']; ?>",{"searchmember":search},function(data){
		var str="<!--srch-->";
		var first=data.indexOf(str)+str.length;
		var last=data.indexOf("<!--/srch-->");
		document.getElementById("srchmember").innerHTML=data.substr(first,last-first);
	})
}

function editMemberData(id,name,email,exf,addedon,regip)
{
	var bdy=document.getElementsByClassName("membercontainer")[0];
		var div=document.createElement("div");
		var style="top:50%;left:55%;transform:translate(-50%,-50%);position:fixed;z-index:99999999;width:100%;max-width:800px;";
		var head="<div class='col-sm-8 col-offset-4' style='"+style+"'><div class='card pnl visual-pnl'><div class='card-header' style='font-size:16px !important;position:relative;'>"+t('Edit User')+"<strong><i id='deltemplateselectiondiv' class='fa fa-times-circle' style='font-size:20px;color:white;right:10px;top:8px;position:absolute;cursor:pointer;'></i></strong></div><div class='card-body tmpltbdydiv' style='max-height:800px;overflow-y:auto;'>"
		var footer="</div><div class='card-footer'><button id='updateuserdetail' class='btn theme-button'><strong>"+t('Save')+"</strong></button> <strong><span style='margin-left:10px;color:' id='usrdatasaveerr'></span></strong> </div></div></div>";
		var body="<div class='card-body upusrbdy' style='max-height:180px;overflow-y:auto;'><div class='form-group'>";
		body +="<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>"+t('Name')+"</span></div><input type='text' id='name' placeholder='"+t('Enter Name')+"' value='"+atob(name)+"' class='form-control'></div>";

		body +="<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>"+t('Email')+"</span></div><input type='text' id='email' placeholder='"+t('Enter Email')+"' value='"+email+"' class='form-control'></div>";

		body +="<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>"+t('Password')+"</span></div><input type='password' id='password' placeholder='"+t('Enter Password')+"' class='form-control'></div>";

		body +="<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>"+t('Re-Enter Password')+"</span></div><input type='password' id='reenterpassword' placeholder='"+t('Enter Password')+"' class='form-control'></div>";

		body +="<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>"+t('Ragistration Date')+"</span></div><p class='form-control'>"+atob(addedon)+"</p></div>";

		body +="<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>"+t('Registration IP')+"</span></div><p class='form-control'>"+atob(regip)+"</p></div>";

		var extras="<div class='alert alert-warning'>"+t('No Extrafield Available')+"</div>";
		var exf=atob(exf);
		try{exf=exf.trim();}catch(err){}
		if(exf.length>2)
		{
			exf= exf.replace(/&quot;/g, '"');
        	exf= exf.replace(/(?:\r\n|\r|\n)/g, '');
			exf=JSON.parse(exf);
			extras="";
			for(i in exf)
			{
				extras +="<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>"+i+"</span></div><input type='text' id='"+i+"' value='"+exf[i]+"' class='form-control'></div>";
			}
		}

	    body +="<button data-toggle='collapse' data-target='.exfdatadiv' class='btn btn-outline-info  btn-block' style='margin-top:5px;'>"+t('Edit Extra Fields')+"</button><div class='collapse exfdatadiv'>"+extras+"</div>";

		body +="</div></div><style>.upusrbdy .input-group{margin-top:2px;margin-bottom:2px;}</style>";
		div.innerHTML=head+body+footer;

		bdy.appendChild(div);
		doEscapePopup(function(){bdy.removeChild(div);});
		document.getElementById("deltemplateselectiondiv").onclick=function(){
			bdy.removeChild(div);
		}
		document.getElementById("updateuserdetail").onclick=function(e)
		{
			var request=new ajaxRequest();
			var userdatas=document.querySelectorAll('.upusrbdy')[0].getElementsByTagName("input");
			var senddata={};
			senddata_ob={"updatememberdata":1,"funnelid":<?php echo $_GET['funnelid']; ?>,"userid":id};
			for(var i=0;i<userdatas.length;i++)
			{
				try
				{
				var field=userdatas[i].getAttribute("id");
                var val=userdatas[i].value;
				senddata_ob[field]=val;
				}
				catch(err){console.log(err);}
			}

			e.target.disabled=true;
			var errdiv=document.getElementById("usrdatasaveerr");
			errdiv.innerHTML="";
			request.postRequestCb('req.php',senddata_ob,function(data){
				e.target.disabled=false;
                if(data.trim()!='1')
                {
					errdiv.innerHTML="<span style='color:#800033;'>"+t(data.trim())+"</span>";
				}
                else
				{
					errdiv.innerHTML="<font style='color:green;'>"+t('Saved Successfully')+"</font>"
				}
			});
		}
}

</script>
