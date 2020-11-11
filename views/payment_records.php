<?php 
// print_r($info);
$mysqli=$info['mysqli'];
$pref=$info['dbpref'];
if (isset($_POST['delrecid'])) {
  $id = $_POST['delrecid'];
  $delete ="delete from `".$pref."payment_methods` where id=".$id;
  $mysqli->query($delete);
}
$date_between=dateBetween('createdon');
$start_from =0;
if(isset($_GET['pagecount']))
{
  $start_from=($_GET['pagecount']*get_option('qfnl_max_records_per_page'))-get_option('qfnl_max_records_per_page');
}
$hashcount=$start_from;
if(isset($_POST['onpage_search']) && strlen($_POST['onpage_search'])>0)
{
  $search_keywords=$mysqli->real_escape_string($_POST['onpage_search']);
  $query="select * from `".$pref."payment_methods` where `title` like '%".$search_keywords."%' or `method` like '%".$search_keywords."%' or `credentials` like '%:\"".$search_keywords."\"%' order by id desc";
}
else
{
    $timelimit_condition=1;
		if(strlen($date_between[0])>1)
		{
			$timelimit_condition=$date_between[0];
    }

    $order_by='`id` desc';
    if(isset($_GET['arrange_records_order']))
		{
			$order_by=base64_decode($_GET['arrange_records_order']);
    }
    
  $query = "SELECT * FROM `".$pref."payment_methods` where ".$timelimit_condition." order by ".$order_by." LIMIT ".$start_from.", ".get_option('qfnl_max_records_per_page')."";
}

$result = $mysqli->query($query);
$totalpage_query = $mysqli->query("SELECT COUNT(`id`) AS `countid` from `".$pref."payment_methods` where 1".$date_between[1]."");
$total_ob=$totalpage_query->fetch_object();
?>
<div class="container-fluid">
<div class="card pb-2  br-rounded" id="hidecard1">
    <div class="card-body pb-2" id="hidecard2">
<div class="row">
					
					<div class="col-md-2  mb-2">
					<?php echo createSearchBoxBydate(); ?>
					</div>
					<div class="col-md-3">
					<?php echo showRecordCountSelection(); ?>
					</div>
					<div class="col-md-3">
					<?php echo arranger(array('id'=>'date')); ?>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend ">
								<span class="input-group-text"><i class="fas fa-search"></i></span>
							</div>
							 <input type="text" class="form-control form-control-sm" placeholder="<?php w('Enter title, type or credentilas'); ?>" onkeyup="searchPaymentMethods(this.value)">
						</div>
					</div>
					</div>
</div>

<div class="col-sm-12 nopadding">
  <div class="table-responsive">
      <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th><?php w('Title'); ?></th>
          <th><?php w('Method'); ?></th>
          <th><?php w('Tax'); ?>(%)</th>
          <th><?php w('Date Created'); ?></th>
          <th><?php w('Options'); ?></th>
        </tr>
        </thead>
        <tbody id="keywordsearchresult">
<!-- keyword search -->          
<?php 
while($res= $result->fetch_assoc()){
$payment_methods_used_ob=$mysqli->query("select count(distinct(`funnelid`)) as `countid` from `".$pref."quick_pagefunnel` where `paymentmethod`='".$res['id']."'");
$payment_methods_used_num=0;
if($payment_methods_used_ob_r=$payment_methods_used_ob->fetch_object())
{
  $payment_methods_used_num=$payment_methods_used_ob_r->countid;
}

++$hashcount;
$num = $result->num_rows;
// print_r($res);
        $jsonarr = json_decode($res['credentials']);
        // print_r($jsonarr);
        $clientid = $jsonarr->client_id;
        $clientsec = $jsonarr->client_secret;
        $tax = $jsonarr->tax;

          $action="<table class='actionedittable'><tr><td><a href='index.php?page=payment_methods&payid=".$res['id']."'><button class='btn unstyled-button' style='' data-toggle='tooltip' title='".t('Edit')."'><i class='fas fa-edit text-primary'></i></button></a></td><td><form action='' method='post' onsubmit=\"return confirmDeletion(".$payment_methods_used_num.",'Payment Method')\"><button type='submit' class='btn unstyled-button' value='".$res['id']."' name='delrecid' data-toggle='tooltip' title='".t('Delete Record')."'><i class='fas fa-trash text-danger'></i></button></form></td></tr></table>";

          $paymentmethod_name=ucwords(str_replace("_"," ",$res['method']));
          $paymentmethod_name=t(str_replace("Ipn","IPN",$paymentmethod_name));
          $paymentmethod_name=str_replace("jvzoo","JVZoo",$paymentmethod_name);
          echo "<tr>
            <td>".t($hashcount)."</td>
            <td>".$res['title']."</td>
            <td>".$paymentmethod_name."</td>
            <td>".t($tax)."</td>
            <td>".date('d-M-Y h:ia',$res['createdon'])."</td>
            <td>".$action."</td>
          </tr>";
      }
     ?>
     <tr><td colspan=10 class="total-data">
    <?php w('Total Payment Methods'); ?>: <?php echo t($total_ob->countid); ?>
     </td></tr>
     <!-- /keyword search -->
     </tbody>
    </table>
    </div>
	<div class="col-sm-12 row nopadding">
    <div class="col-sm-6 mt-2">
    <?php 
      $nextpageurl=$_SERVER['REQUEST_URI']."&pagecount";
      $current_page=0;
      if(isset($_GET['pagecount']))
      {
        $current_page=$_GET['pagecount'];
      }
      echo createPager($total_ob->countid,$nextpageurl,$current_page);
     ?>
    </div>
    <div class="col-sm-6 mt-2 text-right">
    <a href="index.php?page=payment_methods"><button class="btn theme-button" ><i class="fas fa-pencil-alt"></i> <?php w('Create New'); ?></button></a>
    </div>
  </div>	
  
</div></div></div></div>
<script>
function searchPaymentMethods(search)
{
var ob=new OnPageSearch(search,"#keywordsearchresult");
ob.url=window.location.href;
ob.	search();
}
</script>
