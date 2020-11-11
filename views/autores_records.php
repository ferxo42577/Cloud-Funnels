<?php
$mysqli=$info['mysqli'];
$pref=$info['dbpref'];
if (isset($_POST['autorespid'])) {
  $id = $_POST['autorespid'];
  $delete ="delete from `".$pref."quick_autoresponders` where id=".$id;
  $mysqli->query($delete);
}
$start_from=0;
if(isset($_GET['pagecount']))
{
  $start_from=($_GET['pagecount']*get_option('qfnl_max_records_per_page'))-get_option('qfnl_max_records_per_page');
}
$hashcount=$start_from;

$timelimit_condition=1;
  $date_between=dateBetween('date_created');
  if(strlen($date_between[0])>1)
  {
    $timelimit_condition=$date_between[0];
  }

if(isset($_POST['onpage_search']) && strlen($_POST['onpage_search']))
{
  $search_keywords=$mysqli->real_escape_string($_POST['onpage_search']);
 $query="select * from `".$pref."quick_autoresponders` where `autoresponder` like '%".$search_keywords."%' or `autoresponder_name` like '%".$search_keywords."%' or `autoresponder_detail` like '%:\"".$search_keywords."\"%' order by id desc";  
}
else
{

  $order_by='`id` desc';
  if(isset($_GET['arrange_records_order']))
  {
    $order_by=base64_decode($_GET['arrange_records_order']);
  }


$query = "SELECT * FROM `".$pref."quick_autoresponders` where ".$timelimit_condition." order by ".$order_by." LIMIT ".$start_from.", ".get_option('qfnl_max_records_per_page')."";
}
// echo $query;
$result = $mysqli->query($query);
// print_r($result);

$totalpage_query=$mysqli->query("SELECT count(`id`) as `countid` FROM `".$pref."quick_autoresponders` where ".$timelimit_condition."");
$total_ob=$totalpage_query->fetch_object();
?>

<div class="container-fluid">
<div class="card pb-2  br-rounded">
    <div class="card-body pb-2">
<div class="row">
					
					<div class="col-md-2 mb-2">
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
							 <input type="text" class="form-control form-control-sm" placeholder="<?php w("Search with autoresponder title, type, credentials"); ?>" onkeyup="searchAutoresponders(this.value)">
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
          <th><?php w("Title"); ?></th>
          <th><?php w("Type"); ?></th>
          <th><?php w("Date Created"); ?></th>
          <th><?php w("Options");?></th>
        </tr>
          </thead>
<tbody id="keywordsearchresult">
<!-- keyword search -->  
<?php 
// $sql="select * from `".$pref."quick_autoresponders`";

// $result = $mysqli->query($sql);
// $res = mysqli_fetch_all($result,MYSQLI_ASSOC);
while($res= $result->fetch_assoc()){

  $get_use_count_ob=$mysqli->query("select count(distinct(`funnelid`)) as `countid` from `".$pref."quick_pagefunnel` where `selares` like '".$res['id']."@' or `selares` like '%@".$res['id']."@%' or `selares` like '%@".$res['id']."'");
  $get_use_count=0;
  if($get_use_count_r=$get_use_count_ob->fetch_object())
  {
    $get_use_count=$get_use_count_r->countid;
  }
  
// print_r($res);
  ++$hashcount;
$num = $result->num_rows;

        // for ($i=0; $i < $num; $i++) { 
          $jsonarr = json_decode($res['autoresponder_detail']);
          if(json_last_error())
          {
            continue;
          }
          // print_r($jsonarr);
          if ($jsonarr->listid == "null") {
              $listidd = "";
              $campaignidd = $jsonarr->campaignid;
          }
          elseif ($jsonarr->campaignid == "null") {
            $campaignidd = "";
            $listidd = $jsonarr->listid;
          }

          $action="<table class='actionedittable'><tr><td><a href='index.php?page=autores_dashboard&auto=".$res['id']."'><button class='btn unstyled-button' style='' data-toggle='tooltip' title='".t("Edit")."'><i class=' text-primary fas fa-edit'></i></button></a></td><td><form action='' method='post' onsubmit=\"return confirmDeletion(".$get_use_count.",'Autoresponder')\"><button type='submit' class='btn unstyled-button' value='".$res['id']."' name='autorespid' data-toggle='tooltip' title='".t("Delete Record")."'><i class='text-danger fas fa-trash'></i></button></form></td></tr></table>";
          
          $autoresponder_name=str_replace("_"," ", ucwords($res['autoresponder_name']));
        echo "<tr>
          <td>".t($hashcount)."</td>
          <td>".$res['autoresponder']."</td>
          <td>".$autoresponder_name."</td>
          <td>".date('d-M-Y h:ia',$res['date_created'])."</td>
          <td>".$action."</td>
        </tr>";
      }
     ?>
 <tr><td class="total-data" colspan=10><?php w("Total Autoresponders"); ?>: <?php echo t($total_ob->countid); ?></td></tr>
 <!-- /keyword search -->    
</tbody>     
    </table>
    </div>
<div class="col-md-12 row nopadding">
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
<div class="col-sm-6 text-right mt-2"> 
	<a href="index.php?page=autores_dashboard"><button class="btn theme-button"><i class="fas fa-pencil-alt"></i> <?php w("Create New"); ?></button></a>
</div>	
</div>	
    </div>
  </div></div></div>

<script>
function searchAutoresponders(search)
{
var ob=new OnPageSearch(search,"#keywordsearchresult");
ob.url=window.location.href;
ob.	search();
}
</script>
<style type="text/css">
  .tablest{
    padding: 40px;
  }

</style>