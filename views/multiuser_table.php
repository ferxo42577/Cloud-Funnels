<?php 
// print_r($info);
$mysqli=$info['mysqli'];
$pref=$info['dbpref'];
if (isset($_POST['userid'])) 
{
  $id = $_POST['userid'];
  $delete ="delete from `".$pref."users` where id=".$id;
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

if(isset($_POST['onpage_search']) && strlen($_POST['onpage_search'])>0)
{
  $_POST['onpage_search']=$mysqli->real_escape_string($_POST['onpage_search']);
  $query = "SELECT * FROM `".$pref."users` where name like '%".$_POST['onpage_search']."%' or email like '%".$_POST['onpage_search']."%'";
}
else
{
 $order_by='`id` desc';
 if(isset($_GET['arrange_records_order']))
 {
   $order_by=base64_decode($_GET['arrange_records_order']);
 }
$query = "SELECT * FROM `".$pref."users` where ".$timelimit_condition." order by ".$order_by." LIMIT ".$start_from.", ".get_option('qfnl_max_records_per_page')."";
}

$result = $mysqli->query($query);

$countrows_query=$mysqli->query("select count(`id`) as `countid` from `".$pref."users` where ".$timelimit_condition."");
$countrows_ob=$countrows_query->fetch_object();
$countrows=$countrows_ob->countid;
?>
<div class="container-fluid">
<div class="card pb-2  br-rounded">
    <div class="card-body pb-2">
<div class="row">
					<div class="col-md-2">
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
							 <input type="text" class="form-control form-control-sm" placeholder="<?php w("Search With User's Name or Email"); ?>" onkeyup="searchUser(this.value)">
						</div>
					</div>
					</div>
</div>
<div class="row">
<div class="col-md-12 ">
  <div class="table-responsive">
      <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th><?php w("Name"); ?></th>
          <th><?php w("Email"); ?></th>
          <th><?php w("Date Created"); ?></th>
          <th><?php w("Action"); ?></th>
        </tr>
      </thead>
      <tbody id="keywordsearchresult">
      <!-- keyword search -->
<?php 
while($res= $result->fetch_assoc()){

++$hashcount;

   $action="<table class='actionedittable'><tr><td><a href='index.php?page=createmultiuser&id=".$res['id']."'><button class='btn unstyled-button' style='' data-toggle='tooltip' title='".t("Edit")."'><i class='fas fa-edit text-primary'></i></button></a></td><td><form action='' method='post' onsubmit='return confirmDeletion()'><button type='submit' class='btn unstyled-button' value='".$res['id']."' name='userid' data-toggle='tooltip' title='".t("Delete User")."'><i class='fas fa-trash text-danger'></i></button></form></td></tr></table>";

        echo "<tr>
          <td>".t($hashcount)."</td>
          <td>".$res['name']."</td>
          <td>".$res['email']."</td>
          <td>".date('d-M-Y h:ia',$res['date_created'])."</td>
          <td>".$action."</td>
        </tr>";
      }
     ?>
   <tr><td colspan=10 class='total-data'><?php w("Total Users"); ?>: <?php echo t(number_format($countrows)); ?></td></tr>
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
  echo createPager($countrows,$nextpageurl,$current_page);
  ?>
  </div>
  <div class="col-sm-6 text-right mt-2">
  <a href="index.php?page=createmultiuser"><button class="btn theme-button"><i class="fas fa-pencil-alt"></i> <?php w("Create New"); ?></button></a>
  </div>
  </div>
</div></div></div>
</div></div>
<script>
function searchUser(search)
{
var ob=new OnPageSearch(search,"#keywordsearchresult");
ob.url="<?php echo getProtocol();?>";
ob.url +="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>";
ob.	search();
}
</script>