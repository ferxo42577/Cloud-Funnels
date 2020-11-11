<?php
$res['title']="";
$res['fromemail']="";
$res['hostname']="";
$res['port']="";
$res['username']="";
$res['password']="";
$res['encryption']="";
$res['fromname']="";
$res['replyname']="";
$res['replyemail']="";
if (isset($_GET['id']))
 {
  //echo $_GET['id'];
$id = $_GET['id'];
$mysqli=$info['mysqli'];
$pref=$info['dbpref'];
$sql="select * from `".$pref."quick_smtp_setting` WHERE id=".$id;
//echo $sql;
$result = $mysqli->query($sql);
$res = $result->fetch_assoc();
}
?>
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
        <form method="post">
        <div class="form-group">
       <label ><?php w("Enter Title"); ?></label>
        <input type="text" class="form-control"  placeholder="<?php w("Title"); ?>"  name="title" value="<?php echo $res['title'];?>">
        </div>
             <div class="row">
            <div class="col">
        <div class="form-group">
      <label><?php w("SMTP Host"); ?></label>
       <input type="text" class="form-control"  placeholder="<?php w("eg."); ?> smtp.host.com" required name="hostname" value="<?php echo $res['hostname'];?>">
      </div>
      </div>
        <div class="col">   
        <div class="form-group">
     <label><?php w("SMTP Port"); ?></label>
    <input type="text" class="form-control"  placeholder="<?php w("eg."); ?> 587" name="port" value="<?php echo $res['port'];?>">
       </div>
     </div>
         <div class="col">   
        <div class="form-group">
     <label><?php w("Encryption"); ?></label>
     <input type="text" class="form-control"  placeholder="<?php w("eg.") ?> TLS" name="encryption" value="<?php echo $res['encryption'];?>">
       </div>

     </div>
     </div>
        <div class="row"> 
 <div class="col">
  <div class="form-group">
       <label ><?php w("From Name"); ?></label>
        <input type="text" class="form-control"  placeholder="<?php w("Your Name"); ?>"  name="fromname" value="<?php echo $res['fromname'];  ?>">
      </div>
    </div>
         <div class="col">
    <div class="form-group">
       <label ><?php w("Default From Mail"); ?></label>
        <input type="email" class="form-control"  placeholder="<?php w("Enter Default From Mail"); ?>"  name="fromemail" value="<?php echo $res['fromemail']; ?>">
      </div>
       </div>
  </div>
              <div class="row">
       <div class="col">
  <div class="form-group">
       <label ><?php w("Username"); ?></label>
        <input type="text" class="form-control"  placeholder="<?php w("eg."); ?> user@example.com"  name="username" value="<?php echo $res['username'];?>">
      </div>
    </div>
          <div class="col">
        <div class="form-group">
      <label><?php w("Password"); ?></label>
       <input type="password" class="form-control" placeholder="<?php w("Enter Password"); ?>"  required="" name="password" value="<?php echo $res['password'];?>">
      </div>
      </div>
     </div>

            <div class="row">
         <div class="col">   
        <div class="form-group">
     <label><?php w("Reply Name"); ?></label>
     <input type="text" class="form-control"  placeholder="<?php w("Your Name"); ?>" name="replyname" value="<?php echo $res['replyname'];  ?>">
       </div>
     </div>
          <div class="col">
        <div class="form-group">
      <label>Reply Email</label>
       <input type="email" class="form-control" name="replyemail" placeholder="<?php w("eg."); ?> Reply@gmail.com" value="<?php echo $res['replyemail'];  ?>">
      </div>
      </div>
     </div>
  
<div class="form-group">
  <span style="float:left;color:green;"><?php if(isset($_GET["id"]) && isset($_POST["save"])){echo "<strong>".t("Data Saved Successfully.")."</strong>";} ?></span>
  <button type="submit" class="btn theme-button btnclr float-right" name="save"><?php w("Save Settings"); ?></button>
  <br>
</div>
  </form>
</div>
</div></div>
<script>
  <?php
  if(isset($res['title']) && strlen($res['title'])>0)
  {
    echo 'modifytitle("'.$res['title'].'","SMTP");';
  }
  ?>
</script>  