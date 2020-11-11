<?php
$mysqli = $info['mysqli'];
$dbpref = $info['dbpref'];
$load=$data_arr['load'];
$funnel_ob=$load->loadFunnel();
$funnels_data=$funnel_ob->getAllFunnelForView(0,"",5);

$sales_ob=$load->loadSell();
$sales_data=$sales_ob->visualOptisForSales('all',0,"",5);

$members_ob=$load->loadMember();
$members_data=

//total visitor

$viewquery=$mysqli->query("select sum(viewcount) as `sumvisits` from `".$dbpref."quick_pagefunnel`");

$totalviews=0;
if($viewquery)
{
    $r=$viewquery->fetch_object();
    if($r->sumvisits>0)
    {
    $totalviews=$r->sumvisits;
    }
}
// print_r($salescount);

$member = "select count(`id`) as `countid` from `".$dbpref."quick_member`";
$query = $mysqli->query($member);
$membercount=0;
if($query)
{
	$r=$query->fetch_object();
	$membercount = $r->countid;
}

// print_r($membercount);

$sentmails = "select * from `".$dbpref."quick_subscription_mail_schedule` where status=0 or status=1 or status=2";
$query = $mysqli->query($sentmails);
$sentmailscount = $query->num_rows;
// print_r($sentmailscount);

$sent = "select count(`id`) as `countid` from `".$dbpref."quick_subscription_mail_schedule` where status in ('1','2','3')";
$query = $mysqli->query($sent);
$sentcount=0;
if($query)
{
$r=$query->fetch_object();
$sentcount = $r->countid;
}

$seen = "select count(`id`) as `countid` from `".$dbpref."quick_subscription_mail_schedule` where status in ('2','3')";
$query = $mysqli->query($seen);
$seencount=0;
if($query)
{
$r=$query->fetch_object();
$seencount = $r->countid;
}

$totalmembers_qry=$mysqli->query("select count(`id`) as `countid` from `".$dbpref."quick_member`");
$totalmembers=0;
if($totalmembers_qry)
{
	$tatalmemberob=$totalmembers_qry->fetch_object();
	$totalmembers=$tatalmemberob->countid;
}


?>

<div class="container-fluid  no-padding">
    <?php if($funnels_data['total_rows']>0){ ?>
    <div class="row">
        <div class="col-sm-12" id="crdcontainer">
            <div class="col-md-12 nopadding ">
            <div class="row">
            <div class="col-md-12 dashboard-nav d-flex">
            <ul class="dashboard-topnav">
            <a href="index.php?page=create_funnel"><li><i class="fas fa-funnel-dollar"></i>&nbsp;<?php w('Create&nbsp;Funnel'); ?></li></a>
            <a href="index.php?page=products"><li><i class="fas fa-box-open"></i>&nbsp;<?php w('Create&nbsp;Product'); ?></li></a>
            <a href="index.php?page=createlist"><li><i class="fas fa-clipboard-list"></i>&nbsp;<?php w('Create&nbsp;List'); ?></li></a>
            <a href="index.php?page=compose_mail"><li><i class="fas fa-paper-plane"></i>&nbsp;<?php w('Send&nbsp;A&nbsp;Mailer'); ?></li></a>
            <a href="index.php?page=sales"><li><i class="fas fa-hand-holding-usd"></i>&nbsp;<?php w('See&nbsp;Sales'); ?></li></a>
            <a href="index.php?page=multiuser_table"><li><i class="fas fa-users-cog"></i>&nbsp;<?php w('See&nbsp;Users'); ?></li></a>
            </ul>
            </div>
</div>
   <div class="row">
		<div class="col-md-3 nopadding">
		
                <!-- <div class="col-sm-2"></div> -->
            <div class="col-md-12 hovers mt-1 order-md-second order-sm-first">
                <a href="index.php?page=all_funnels">
                    <div class="wqmlrdesc blockone ">
                        <p class="subtitle"><?php w('Funnels Count') ?></p>
                        <div class="row nopadding">
						<i class=" mr-auto fas fa-funnel-dollar fa-x2"></i>
                        <h2 class="blocknumber"><?php w(number_format($funnels_data['total_rows'])); ?></h2>
                    </div>
                    </div>
                </a>
            </div>

            <div class="col-md-12 hovers">
                <a href="index.php?page=sales">
					<div class="wqmlrdesc blockone ">
						<p class="subtitle"><?php w('Total Sales'); ?></p>
						<div class="row nopadding">
						<i class=" mr-auto fas fa-hand-holding-usd fa-x2"></i>
                        <h2 class="blocknumber"><?php w(number_format($sales_data['total'])); ?></h2>
            	        </div>
					    </div>
				</a>
			</div>
            <div class="col-md-12 hovers">
                <a href="index.php?page=all_funnels">
					<div class="wqmlrdesc blockone ">
						<p class="subtitle"><?php w('Total Visits'); ?></p>
						<div class="row nopadding">
						<i class=" mr-auto fas fa-eye fa-x2"></i>
                        <h2 class="blocknumber"><?php w(number_format($totalviews));?></h2>
                        </div>
					</div>
				</a>
            </div>

            <!-- <div class="col-sm-2"></div> -->
            <div class="col-md-12 hovers" >
                <a href="index.php?page=membership_funnels">
					<div class="wqmlrdesc blockone ">
						<p class="subtitle"><?php w('Members'); ?></p>
					<div class="row nopadding">
						<i class=" mr-auto fas fa-users  fa-x2"></i>
                        <h2 class="blocknumber"><?php w(number_format($totalmembers)); ?></h2>
                    </div>
					</div>
				</a>
            </div>

            <div class="col-md-12 hovers">
                <a href="index.php?page=sentemailsdetails">
				<div class="wqmlrdesc blockone ">
				<p class="subtitle"><?php w('Sent Mails'); ?></p>
				<div class="row nopadding">
				    <i class="mr-auto fas fa-envelope fa-x2"></i>
                    <h2 class="blocknumber"><?php w(number_format($sentcount)); ?></h2>
                </div>
				</div>
				</a>
            </div>

            <div class="col-md-12 hovers">
                <a href="index.php?page=sentemailsdetails">
				<div class="wqmlrdesc blockone ">
				<p class="subtitle"><?php w('Mails Opened'); ?></p>
				<div class="row nopadding">
				<i class="mr-auto fas fa-envelope-open-text fa-x2"></i>
                <h2 class="blocknumber"><?php w(number_format($seencount)); ?></h2>
                </div>
				</div>
				</a>
            </div>
            <!-- <div class="col-sm-1"></div> -->
        
        </div>


        <!-- <h4 style="margin-top:15px;margin-left:-9px;margin-right:-9px;padding-left:15px;padding-top:10px;padding-bottom:10px; background: linear-gradient(#3d5c5c,#3d5c5c);color:white;border-radius:2px;margin-bottom:0px;">Latest Emails</h4> -->
        <br>
<!-- grapes-->

<?php
$lastthirtydays=array();
$lastthirtydayviews=array();
$lastthirtdayconverts=array();
$lastthirtydaysmembers=array();
$lastthirtdaymails=array();
$lastthirtdayopens=array();
$lastthirtdayunsubs=array();
$lastthirtydaylinksvisits=array();

for($i=0;$i<=29;$i++)
{
        $temponeofthirtydays=date('d-M-Y',strtotime(date('d-M-Y')."-".$i."days"));
		$lastthirtydays[$temponeofthirtydays]=0;
		$lastthirtydayviews[$temponeofthirtydays]=0;
		$lastthirtdayconverts[$temponeofthirtydays]=0;
		$lastthirtydaysmembers[$temponeofthirtydays]=0;
		$lastthirtdaymails[$temponeofthirtydays]=0;
		$lastthirtdayopens[$temponeofthirtydays]=0;
        $lastthirtdayunsubs[$temponeofthirtydays]=0;
        $lastthirtydaylinksvisits[$temponeofthirtydays]=0;
}
//members

$lastthirtymembershipquery=$mysqli->query("select `date_created` from `".$dbpref."quick_member` where `date_created`>=".strtotime(date('d-M-Y')."-29days")." and email not in('',' ')");
if($lastthirtymembershipquery->num_rows)
{
	while($r=$lastthirtymembershipquery->fetch_object())
	{
		++$lastthirtydaysmembers[date('d-M-Y',$r->date_created)];
	}
}

//visits
$visitsviewlastthirtyquery=$mysqli->query("select `visitedon` from `".$dbpref."site_visit_record` where `visitedon`>=".strtotime(date('d-M-Y')."-29days")." ");
if($visitsviewlastthirtyquery->num_rows)
{
	while($r=$visitsviewlastthirtyquery->fetch_object())
	{
	++$lastthirtydayviews[date('d-M-Y',$r->visitedon)];
	}
}
//convertedon
$convertlastthirtyquery=$mysqli->query("select `convertedon` from `".$dbpref."site_visit_record` where `convertedon`>=".strtotime(date('d-M-Y')."-29days")." and `convert_optinid` not in('0')");
if($convertlastthirtyquery->num_rows)
{
	while($r=$convertlastthirtyquery->fetch_object())
	{
	++$lastthirtdayconverts[date('d-M-Y',$r->convertedon)];
	}
}
//sales
$saleslastthirtyquery=$mysqli->query("select `addedon` from `".$dbpref."all_sales` where `addedon`>=".strtotime(date('d-M-Y')."-29days")."");

if($saleslastthirtyquery->num_rows)
{
	while($r=$saleslastthirtyquery->fetch_object())
	{
	++$lastthirtydays[date('d-M-Y',$r->addedon)];
	}
}


//sent mails
$totalsentlastthirtyquery=$mysqli->query("select `time` from `".$dbpref."quick_subscription_mail_schedule` where `time`>=".strtotime(date('d-M-Y')."-29days")." and `status` in ('1','2','3')");
// print_r($totalsentlastthirtyquery);
if($totalsentlastthirtyquery->num_rows)
{
  while($r=$totalsentlastthirtyquery->fetch_object())
  {
  ++$lastthirtdaymails[date('d-M-Y',$r->time)];
  }
}


//opened
$openedlastthirtyquery=$mysqli->query("select `time` from `".$dbpref."quick_subscription_mail_schedule` where `time`>=".strtotime(date('d-M-Y')."-29days")." and `status` in ('2','3')");

if($openedlastthirtyquery->num_rows)
{
  while($r=$openedlastthirtyquery->fetch_object())
  {
  ++$lastthirtdayopens[date('d-M-Y',$r->time)];
  }
}

//unsubs
$unsubslastthirtyquery=$mysqli->query("select `time` from `".$dbpref."quick_subscription_mail_schedule` where `time`>=".strtotime(date('d-M-Y')."-29days")." and `status` in ('3')");
if($unsubslastthirtyquery->num_rows)
{
  while($r=$unsubslastthirtyquery->fetch_object())
  {
  ++$lastthirtdayunsubs[date('d-M-Y',$r->time)];
  }
}
//links visits
$linksvisitsthirtyquery=$mysqli->query("select `createdon` from `".$dbpref."email_links_visits` where `visited`='1' and `createdon`>=".strtotime(date('d-M-Y')."-29days")."");
if($linksvisitsthirtyquery->num_rows)
{
    while($r=$linksvisitsthirtyquery->fetch_object())
    {
        //$lastthirtydaylinksvisits
        ++$lastthirtydaylinksvisits[date('d-M-Y',$r->createdon)];
    }
}


$saleslastthirtydatearr=array();
$saleslastthirtysalesarr=array();
$lastthirtydays=array_reverse($lastthirtydays);
foreach($lastthirtydays as $lastthirtydaysindex=>$lastthirtydaysdata)
{
	array_push($saleslastthirtydatearr,"'".date('d-M',strtotime($lastthirtydaysindex))."'");
	array_push($saleslastthirtysalesarr,$lastthirtydaysdata);
}


$lastthirtydayviews=array_reverse($lastthirtydayviews);
$viewslastthirtydatearr=array();
$viewslastthirtyviewsarr=array();
foreach($lastthirtydayviews as $lastthirtydayviewsindex=>$lastthirtydayviewsdata)
{
	array_push($viewslastthirtydatearr,"'".date('d-M',strtotime($lastthirtydayviewsindex))."'");
	array_push($viewslastthirtyviewsarr,$lastthirtydayviewsdata);
}
$lastthirtdayconverts=array_reverse($lastthirtdayconverts);
$convertslastthirtydatearr=array();
$convertslastthirtyconvertsarr=array();
foreach($lastthirtdayconverts as $lastthirtydayconvertsindex=>$lastthirtydayconvertsdata)
{
	array_push($convertslastthirtydatearr,"'".date('d-M',strtotime($lastthirtydayconvertsindex))."'");
	array_push($convertslastthirtyconvertsarr,$lastthirtydayconvertsdata);
}

$lastthirtydaysmembers=array_reverse($lastthirtydaysmembers);
$lastthirtydaysmembersdatearr=array();
$lastthirtydaysmemberscountarr=array();

foreach($lastthirtydaysmembers as $lastthirtydaysmembersindex=>$lastthirtydaysmembersvalue)
{
	array_push($lastthirtydaysmembersdatearr,"'".date('d-M',strtotime($lastthirtydaysmembersindex))."'");
	array_push($lastthirtydaysmemberscountarr,$lastthirtydaysmembersvalue);
}

$lastthirtdaymails=array_reverse($lastthirtdaymails);
$sentmailslastthirtydatearr=array();
$totalmailslastthirtytotalarr=array();
foreach($lastthirtdaymails as $lastthirtydaytotalindex=>$lastthirtydaytotalsentdata)
{
  array_push($sentmailslastthirtydatearr,"'".date('d-M',strtotime($lastthirtydaytotalindex))."'");
  array_push($totalmailslastthirtytotalarr,$lastthirtydaytotalsentdata);
}
//print_r($totalmailslastthirtytotalarr);
// print_r(implode(',', $totalmailslastthirtytotalarr));

$lastthirtdayopens=array_reverse($lastthirtdayopens);
$openslastthirtydatearr=array();
$opensmailslastthirtyopensarr=array();
foreach($lastthirtdayopens as $lastthirtydayopensindex=>$lastthirtydayopensdata)
{
  array_push($openslastthirtydatearr,"'".date('d-M',strtotime($lastthirtydayopensindex))."'");
  array_push($opensmailslastthirtyopensarr,$lastthirtydayopensdata);
}


$lastthirtdayunsubs=array_reverse($lastthirtdayunsubs);
$unsubslastthirtydatearr=array();
$unsubsmailslastthirtyunsubsarr=array();
foreach($lastthirtdayunsubs as $lastthirtydayunsubsindex=>$lastthirtydayunsubsdata)
{
  array_push($unsubslastthirtydatearr,"'".date('d-M',strtotime($lastthirtydayunsubsindex))."'");
  array_push($unsubsmailslastthirtyunsubsarr,$lastthirtydayunsubsdata);
}

$lastthirtydaylinksvisits=array_reverse($lastthirtydaylinksvisits);
$linksvisirsdatesarr=array();
$linksvisitsthirdaysarr=array();
foreach($lastthirtydaylinksvisits as $lastthirtydaylinksvisitsindex=> $lastthirtydaylinksvisitsval)
{
    array_push($linksvisirsdatesarr,date('d-M',strtotime($lastthirtydaylinksvisitsindex)));
    array_push($linksvisitsthirdaysarr,$lastthirtydaylinksvisitsval);
}

//print_r($viewslastthirtydatearr);
?>

<div class="col-md-9 order-md-first order-2">
<div class="graph-class  justify-content-center  ">
<div class="row justify-content-center">
        <div class="col-md-12">
	    <div class="card pnl">
		<div class="card-header"><?php w("30 Day's Sales"); ?></div>
        <div class="card-body qfnldashboardgraph"><canvas id="qfnlsaleschart"></canvas></div>
        </div>
        </div>

        <div class="col-md-12 ">
	    <div class="card pnl ">
		<div class="card-header"><?php w("30 Day's Website Visits & Converted Visitors"); ?></div>
        <div class="card-body qfnldashboardgraph"><canvas id="qfnlsitevisitschart"></canvas></div>
        </div>
        </div>

        </div>
</div>
</div>
</div>
</div>


<div class="row  justify-content-center ">

        <div class="col-md-6">
	    <div class="card pnl">
	    <div class="card-header"><?php w("30 Day's Mail Sending Report"); ?></div>
        <div class="card-body qfnldashboardgraph"><canvas id="qfnlsitesequencechart"></canvas></div>
        </div>
        </div>

        <div class="col-md-6">
	    <div class="card pnl">
	    <div class="card-header"><?php w("30 Day's Membership Report"); ?></div>
        <div class="card-body qfnldashboardgraph"><canvas id="qfnlmembershipchart"></canvas></div>
        </div>
        </div>
</div>

<script>
//sales chart creat

var saleschart_ob=new createChart("qfnlsaleschart","");
saleschart_ob.labels=[<?php echo implode(',',$saleslastthirtydatearr); ?>];
saleschart_ob.append({
label: t('Sales'),
data: [<?php echo implode(',',$saleslastthirtysalesarr); ?>],
borderColor: "#3e95cd",
	fill: false
});
saleschart_ob.draw();
//visits and converted chart
var viewconvert_ob=new createChart("qfnlsitevisitschart","");
viewconvert_ob.labels=[<?php echo implode(',',$viewslastthirtydatearr); ?>];
viewconvert_ob.append({
label: t('Views'),
data: [<?php echo implode(',',$viewslastthirtyviewsarr); ?>],
borderColor: "#3e95cd",
	fill: false
});
viewconvert_ob.append({
label: t('Conversion'),
data: [<?php echo implode(',',$convertslastthirtyconvertsarr); ?>],
borderColor: "#00e600",
	fill: false
});
viewconvert_ob.draw();
//membership chart
var membershipchart_ob=new createChart("qfnlmembershipchart","");
membershipchart_ob.labels=[<?php echo implode(',',$lastthirtydaysmembersdatearr); ?>];
membershipchart_ob.append({
label: t('Members'),
data: [<?php echo implode(',',$lastthirtydaysmemberscountarr); ?>],
borderColor: "#3e95cd",
	fill: false
});
membershipchart_ob.draw();
//Last 30days emails
var sequence_ob=new createChart("qfnlsitesequencechart","");
sequence_ob.labels=[<?php echo implode(',',$sentmailslastthirtydatearr); ?>];
sequence_ob.append({
label: t('Sent Mails'),
data: [<?php echo implode(',',$totalmailslastthirtytotalarr); ?>],
borderColor: "#3e95cd",
  fill: false
});
sequence_ob.append({
label: t('Opened'),
data: [<?php echo implode(',',$opensmailslastthirtyopensarr); ?>],
borderColor: "#00e600",
  fill: false
});
sequence_ob.append({
label: t('Links Visits'),
data: [<?php echo implode(',',$linksvisitsthirdaysarr); ?>],
borderColor: "#000080",
  fill: false
});
sequence_ob.append({
label: t('UnSubscribers'),
data: [<?php echo implode(',',$unsubsmailslastthirtyunsubsarr); ?>],
borderColor: "#FF0000",
  fill: false
});
sequence_ob.draw();

</script>

<!-- Sales Table -->
<div class="row justify-content-center">
    <div class="col-md-12 col-sm-11">
<div class="card pnl">
    <div class="card-header"><?php w('Latest Funnels'); ?></div>
    <div class="card-body">
        <div class="table-responsive">
 <table class="table table-striped">
<thead><th>#</th><th><?php w('Project'); ?></th><th><?php w('Type'); ?></th><th><?php w('Pages'); ?></th><th><?php w('Visits'); ?></th><th><?php w('Converted'); ?></th><th><?php w('Bounces'); ?></th><th><?php w('Created&nbsp;On') ?></th></thead>
<tbody>
<?php
$hashcount=0;
if($funnels_data['rows'])
{
while($r=$funnels_data['rows']->fetch_object())
{
++$hashcount;

//$funneldata=$funnel_ob->getFunnel($r->funnel_id,$select="`name`,`baseurl`");
$sumdata=$funnel_ob->totalSumCountsFunelPages($r->funnel_id);
$action="<table class='actionedittable'><tr><td><a href='index.php?page=create_funnel&id=".$r->funnel_id."'><button class='btn btn-info'><i class='fas fa-pen-fancy'></i></button></a></td><td><a href='index.php?page=optins&funnelid=".$r->funnel_id."'><button class='btn btn-success'><i class='fas fa-users'></i></button></a></td><td><form action='' method='post'><input type='hidden' name='delfunnel' value='".$r->funnel_id."'><button type='submit' class='btn btn-danger'><i class='fas fa-trash'></i></button></form></td></tr></table>";

$bounces=$r->ab_viewcount-$r->ab_convertcount;

$converted_percentage=0;
$bounces_percentage=0;
if($bounces<0){$bounces=0;}
if($r->ab_viewcount>0)
{
    $converted_percentage=number_format((($r->ab_convertcount/$r->ab_viewcount)*100),2);

	$bounces_percentage=number_format((($bounces/$r->ab_viewcount)*100),2);
}

$display_funnel_type=$r->funnel_type;
if($display_funnel_type=="blank")
{
	$display_funnel_type="Custom";
}
$display_funnel_type=ucfirst($display_funnel_type);
echo "<tr><td>".t($hashcount)."</td><td><a href='".$r->funnel_baseurl."' target='_BLANK'>".$r->funnel_name."</a></td><td>".t($display_funnel_type)."</td><td>".t(number_format($r->sumpages))."</td><td>".t(number_format($r->ab_viewcount))."</td><td class=''>".t(number_format($r->ab_convertcount))." <span class='percentage'>".t($converted_percentage)."%</span></td><td class=''>".t(number_format($bounces))." <span class='percentage'>".t($bounces_percentage)."%</span></td><td>".date('d-M-Y h:ia',$r->funnelcreatedon)."</td></tr>";
}
}
?>
</tbody>
</table>
       </div>
       <div class="text-right"><a href="index.php?page=all_funnels"><button class="btn theme-button mt-2"><?php w('All Funnels') ?></button></a></div>
            </div>
        </div>
    </div>
</div>

<!-- Members Table -->
<div class="row justify-content-center">
    <div class="col-md-12 col-sm-11 sortable">
<div class="card pnl">
    <div class="card-header"><?php w('Latest Sales'); ?></div>
    <div class="card-body">
        <div class="table-responsive">

	  <table class="table table-striped">
<thead><th>#</th><th><?php w('Product') ?></th><th><?php w('Purchase&nbsp;Name'); ?></th><th><?php w('Purchase&nbsp;Email') ?></th><th><?php w('Payment&nbsp;Id'); ?></th><th><?php w('Other&nbsp;Products'); ?></th><th><?php w('Date'); ?></th></thead>
<tbody id="srchmember">
<!--srch-->
<?php
$hashcount=0;

while($r=$sales_data['sales']->fetch_object())
{
	++$hashcount;

	$shippedclass="btn-warning";
	if($r->shipped=="1")
	{
	$shippedclass="btn-success";
	}
	$date=date('d-M-Y h:ia',$r->addedon);

	$product="";

	$productdata=$sales_ob->getProduct($r->productid);

	if($productdata)
	{
	$product="(#".$productdata->productid.") ".$productdata->title."";

		$product="<a href='index.php?page=products&product_id=".$r->productid."' target='_BLANK'>".$product."</a>";
    }

    $parent_product="N/A";
    $mysqli=$info['mysqli'];
    $dbpref=$info['dbpref'];
    $checkotherproducts_query=$mysqli->query("select `id`,`productid`,`title` from `".$dbpref."all_products` where id in(select `productid` from `".$dbpref."all_sales` where `parent` in('".$r->productid."') and `payment_id`='".$r->payment_id."')");

    if($checkotherproducts_query->num_rows>0)
    {
    $parent_product="";
    while($tempr=$checkotherproducts_query->fetch_object())
    {
        $parent_product .="<a href='index.php?page=products&product_id=".$tempr->id."'>(#".$tempr->productid.") ".$tempr->title."</a> ,";
    }
    $parent_product=rtrim($parent_product," ,");
    }


	echo "<tr><td>".t($hashcount)."</td><td>".$product."</td><td>".$r->purchase_name."</td><td>".$r->purchase_email."</td><td>".$r->payment_id."</td><td>".$parent_product."</td><td>".$date."</td></tr>";
}
?>
<!--/srch-->
</tbody>

</table>
       </div>
       <div class="text-right"><a href="index.php?page=sales"><button class="btn theme-button mt-2"><?php w('All Sales'); ?></button></a></div>
            </div>
        </div>
    </div>
</div>
<!-- Sequence Table -->
<div class="row justify-content-center">
    <div class="col-md-12 col-sm-11">
<div class="card pnl">
    <div class="card-header"><?php w('Latest Email Sequences'); ?></div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped">
       <thead>
      <tr class="">
          <th>#</th>
          <th><?php w('Sequence&nbsp;Title'); ?></th>
          <th><?php w('Total&nbsp;Mails&nbsp;Sent'); ?></th>
          <th><?php w('Total&nbsp;Opened'); ?></th>
          <th><?php w('Total&nbsp;Unopens'); ?></th>
          <th><?php w('Links&nbsp;Visits'); ?></th>
		  <th><?php w('Unsubscribes') ?></th>
          <th><?php w('Last&nbsp;Sent'); ?></th>
      </tr>
      </thead>
       <tbody>
	   <?php
		$table=$dbpref."quick_sequence";
        $sql="select `id`,`title` from `".$table."` where `sequence` not in ('compose') and `id` in (select `seqid` from `".$dbpref."quick_subscription_mail_schedule` order by time desc)limit 5";
		$resultseq = $mysqli->query($sql);
$count=0;
  while($row =$resultseq->fetch_assoc())
                               {
						   ++$count;
                           $sql3="select count(`id`) from `".$dbpref."quick_subscription_mail_schedule`  where seqid='".$row['id']."' and status in('1','2','3')";
                          // echo $sql3;

                                   $result = $mysqli->query($sql3);
                                   // print_r($result);
                                    $totalsent=0;
                          while ($total = $result->fetch_assoc()) {
                            $totalsent = $total['count(`id`)'];
                          }


 $sql2="select count(`id`) as `countid` from `".$dbpref."quick_subscription_mail_schedule`  where seqid='".$row['id']."' and status='2' ";
 //echo $sql2;

 $res=$mysqli->query($sql2);
 //print_r($res);
 $totalopen=0;
 if($r= $res->fetch_assoc())
 {
   $totalopen=$r['countid'];
 }

 $sql5="select count(`id`) as `countid` from `".$dbpref."quick_subscription_mail_schedule`  where seqid='".$row['id']."' and status='3' ";
 //echo $sql2;

 $res=$mysqli->query($sql5);
 //print_r($res);
 $totalunsubscribe=0;
 if($r= $res->fetch_assoc())
 {
 	$totalunsubscribe=$r['countid'];
 }

$query="select count(`id`) as `countid` from `".$dbpref."quick_subscription_mail_schedule`  where seqid='".$row['id']."' and status=1 ";
$resul=$mysqli->query($query);
 // print_r($res);
 $totalunopen=0;
if($r = $resul->fetch_assoc())
 {
   $totalunopen=$r['countid'];
 }

 $query=$mysqli->query("select count(`id`) as `countvisits` from `".$dbpref."email_links_visits` where `sequence_id`='".$row['id']."' and `visited`='1'");

 $totllinksvisits=0;
if($r=$query->fetch_object())
{
    $totllinksvisits=$r->countvisits; 
}

$lastmailsentquery=$mysqli->query("select max(`time`) `maxtime` from `".$dbpref."quick_subscription_mail_schedule` where status not in('0','-1') and time not in('0') and `seqid`='".$row['id']."'");

$lastsent="N/A";
if($r=$lastmailsentquery->fetch_object())
{
    $lastsent=date('d-M-Y h:ia',$r->maxtime);
}
$query="select count(`id`) as `countid` from `".$dbpref."quick_subscription_mail_schedule`  where `seqid`='".$row['id']."' and `status`='0'";
//echo $query;
$unsentresultt=$mysqli->query($query);
$unsents=0;
 while ($unsents_ob = $unsentresultt->fetch_assoc())
 {
  $unsents=$unsents_ob['countid'];
 }
$totalunsent="";
$persantage_opened=0;
$persentage_unopened=0;
$persentage_linksvisits=0;
$persentage_unsubscribes=0;
if($totalsent>0)
{
    $persantage_opened=number_format(($totalopen/$totalsent)*100,2);
    $persentage_unopened=number_format(($totalunopen/$totalsent)*100,2);
    $persentage_linksvisits=number_format(($totllinksvisits/$totalsent)*100,2);
    $persentage_unsubscribes=number_format(($totalunsubscribe/$totalsent)*100,2);
}

if($unsents>0)
    {
    $totalunsent='(<a href="index.php?page=sentemailsdetails&status=notsent&seqid='.$row['id'].'" style="color:#e60073">'.t('Unable&nbsp;to&nbsp;send:&nbsp;').''.t(number_format($unsents)).'</a>)';
    }

echo"<tr><td>".t($count)."</td><td><a href='index.php?page=sequence&seqid=".$row['id']."'>".$row['title']."</a></td><td><a href='index.php?page=sentemailsdetails&status=sent&seqid=".$row['id']."'>".t(number_format($totalsent))."</a> ".$totalunsent."</td><td><a href='index.php?page=sentemailsdetails&status=opened&seqid=".$row['id']."'>".t(number_format($totalopen))." (".$persantage_opened."%)</a></td><td><a href='index.php?page=sentemailsdetails&status=unopened&seqid=".$row['id']."'>".t(number_format($totalunopen))." (".t($persentage_unopened)."%)</a></td><td><a href='index.php?page=sentemailsdetails&status=links_visits&seqid=".$row['id']."'>".t(number_format($totllinksvisits))." (".t($persentage_linksvisits)."%)</a></td><td><a href='index.php?page=sentemailsdetails&status=unsubscribe&seqid=".$row['id']."'>".t(number_format($totalunsubscribe))." (".t($persentage_unsubscribes)."%)</a></td>
				<td>".$lastsent."</td></tr>";
                           }


   ?>

        </tbody>
       </table>
       </div>

       <div class="text-right"><a href="index.php?page=sentemailsdetails"><button class="btn theme-button mt-2"><?php w('All Sequences'); ?></button></a></div>

            </div>
        </div>
    </div>

</div>

      
</div>
</div>
<?php }else{ ?>
    <div class="row " >
            <div class="col-lg-5 dash-init mx-auto align-self-center">
                <div class="card">
                    <div class="card-header bg-white theme-text"><?php w('Welcome To CloudFunnels'); ?></div>
                    <div class="card-body text-center">
                        
                      <div class="p-3">  <h3 class="theme-text card-text"><?php w('Start off something awesome'); ?></h3></div>
                       <div class="p-3"> <a href="index.php?page=create_funnel" class="btn btn-app theme-button" role="button"><i class="fas fa-funnel-dollar"></i><?php w('Create a funnel now'); ?></a></div>
                    </div>
                </div>
            </div>
        </div>
<!--<div class="row">
    <div class="col-sm-12 dash-init">
        <center>
            <img src="assets/img/logo-text.png" alt="CloudFunnels Logo">
            <h3 class="theme-text dashboaed-init-text">Start off something awesome</h3>
            <a href="index.php?page=create_funnel"><button class="btn btn-primary theme-button"><i class="fas fa-funnel-dollar"></i>&nbsp;&nbsp;Create a funnel now</button></a>
        </center>
    
    </div>
</div>-->

<?php } ?>
</div>
<script>
var globdiv;
function viewPurchaseDetail(id){
 var request=new ajaxRequest();
 var div=document.createElement("div");
 div.setAttribute('class','row');
 var container="<div class='col-sm-6' style='top:60%;left:60%;position:fixed;transform:translate(-50%,-50%);z-index:9999999;'><div class='card pnl visual-pnl'><div class='card-header'>Detail <i class='fas fa-times closethidiv' style='color:white;right:20px;top:20px;position:absolute;cursor:pointer;'></i></div><div class='card-body purchasedetailqmlr' style='max-height:400px;overflow-y:auto;'>"+t("Loading...")+"</div></div></div>";
 div.innerHTML=container;
 //alert(div);
 var maindiv=document.getElementById("crdcontainer");
 try{maindiv.removeChild(globdiv);}catch(err){console.log(err.message);}
 globdiv=div;
 maindiv.appendChild(div);
 document.getElementsByClassName("closethidiv")[0].onclick=function(){maindiv.removeChild(div);};
request.postRequestCb('req.php',{"viewpurchasedetail":id},function(data){
	var arr=data.trim();
	if(arr.length>2)
	{
        arr=arr.split('@sbreak@');
        arr[0] = arr[0].replace(/&quot;/g, '"');
        arr[0] = arr[0].replace(/(?:\r\n|\r|\n)/g, '');
		var shipping=JSON.parse(arr[0]);
		try
		{
		var shippingtable="<div class='table-responsive'><table class='table table-striped'><thead><tr><th colspan=2>"+t('Shipping Detail')+"</th></tr></thead><tbody>";
		for(var i in shipping)
		{
			shippingtable +="<tr><td>"+i+"</td><td>"+shipping[i]+"</td></tr>";
		}
		}catch(err){console.log(err.message);}

        var steppayment=arr[3];
        shippingtable=steppayment+shippingtable;

		shippingtable +="</tbody><thead ><th colspan=2>Payment Method</th></thead><tbody>";
		try{shippingtable +="<tr><td colspan=2>"+arr[1]+"</td></tr>";}catch(err){console.log(err.message);}
		shippingtable +="</tbody></table></div>";

	}
	document.getElementsByClassName("purchasedetailqmlr")[0].innerHTML=shippingtable;
});
}
authPurchaseData();
</script>