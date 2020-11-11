<?php
function addToCOD($sell_ob,$credentials,$items,$description="")
{	
//==================================
    $err="";
    $credentials=json_decode($credentials);
    $itemarr=array();

    $sheepingcharge=0;
    $tax=0;
    $totalprice=0;
    $productid=0;
    $currency="USD";
    $producttitle="";

    $allproductdetail="";

    $all_price_detail=$sell_ob->getProductsPriceDependingOnMethod($credentials,$items);
    //'itemarr','sheepingcharge','tax','totalprice','currency','total', 'allproductdetail'
    if(is_array($all_price_detail))
    {
        foreach($all_price_detail as $all_price_detail_index=>$all_price_detail_val)
        {
            ${$all_price_detail_index}=$all_price_detail_val;
        }
    }
    
    $order_data_array=$_SESSION['order_form_data'.get_option('site_token')];

    $email=false;
    $cod_step=0;
    if(isset($_POST['process_otp']) && isset($_POST['codCustEmail']))
    {
        if(filter_var($_POST['codCustEmail'], FILTER_VALIDATE_EMAIL))
        {
            $email=$_POST['codCustEmail'];
            $_SESSION['cod_otp_email_'.get_option('site_token')]= $email;
            $_SESSION['order_form_data'.get_option('site_token')]['data']['email']= $email;
            $sequence_ob=$sell_ob->load->loadSequence();

            $otp= substr(str_shuffle('1234567890XCVBNMASDFGHJQWERTYUIOP@#$%^&*()+xcvbnm,ertyuiwertyui'), 0, 8);

            $_SESSION['cod_otp_token_'.get_option('site_token')]= $otp;

            $email_title= str_replace('{otp}', $otp, get_option('cod_otp_email_title'));

            $email_content= str_replace('{otp}',$otp, str_replace("\\\\r\\\\n","",str_replace("\&quot;","",str_replace("\\r\\n","",get_option('cod_otp_email_content')))));

            if($sequence_ob->sendMail($order_data_array['smtp'],'', $email,$email_title, $email_content, ""))
            {
                $cod_step=1;
            }
            else
            {
                $err="Unable to send mail please contact admin.";
            }
        }
        else
        {
            $err="Invalid Email Provided";
        }
    }
    else if(isset($_POST['reset_otp']))
    {
        if(isset($_SESSION['cod_otp_email_'.get_option('site_token')]))
        {unset($_SESSION['cod_otp_email_'.get_option('site_token')]);}

        if(isset($_SESSION['cod_otp_token_'.get_option('site_token')]))
        {unset($_SESSION['cod_otp_token_'.get_option('site_token')]);}
    }
    else if(isset($_POST['verify_otp']) && isset($_SESSION['cod_otp_token_'.get_option('site_token')]))
    {
        if($_SESSION['cod_otp_token_'.get_option('site_token')]===$_POST['codCustOTP'])
        {
            $_GET['execute']=1;
            $email=$_SESSION['cod_otp_email_'.get_option('site_token')];

            unset($_SESSION['cod_otp_email_'.get_option('site_token')]);

            unset($_SESSION['cod_otp_token_'.get_option('site_token')]);
            
            $name="";

            if(isset($order_data_array['data']['name']))
            {
                $name=$order_data_array['data']['name'];
            }
            else if(isset($order_data_array['data']['firstname']))
            {
                $name=$order_data_array['data']['firstname'];
                if(isset($order_data_array['data']['lastname']))
                {
                    $name .=" ".$order_data_array['data']['lastname'];
                }
            }

            $arr= array(
                'payer_name'=> $name,
                'payer_email'=> $email,
                'payment_id'=>  'cf_cod_'.$_POST['codCustOTP'].'_'.time(),
                'total_paid'=> $total,
                'payment_currency'=> $currency,
            );
            return json_encode($arr);
        }
        else
        {
            $cod_step=1;
            $err="OTP did not match, try again.";
        }
    }
    else
    {
        if(isset($order_data_array['data']['email']) && filter_var($order_data_array['data']['email'], FILTER_VALIDATE_EMAIL))
        {
            $email=$order_data_array['data']['email'];
            $_SESSION['cod_otp_email_'.get_option('site_token')]= $email;
        }
    }

 //=================================   
$allproductdetail .="<hr/>Total Price: ".number_format($totalprice,2)." ".$currency."<br>";

$allproductdetail .="Tax: ".number_format($tax,2)." ".$currency."<br>";

$allproductdetail .="Shipping Charge: ".number_format($sheepingcharge,2)." ".$currency;


$_SESSION['total_paid'.get_option('site_token')]=$total;
$_SESSION['payment_currency'.get_option('site_token')]=$currency;




lbl:
if(isset($_GET['execute']))
{

}
else
{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Purchase</title>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="assets/css/style.css">	
    </head>
    <body>
<div class="container-fluid">
<div class="row">	
<div class="col-sm-4 offset-sm-4" style="margin-top:50px;">
<div class="card exclude-pnl">
<div class="card-header" style="background:linear-gradient(#19334d,#19334d);">Cash On Delivary</div>
<div class="card-body">
<div class="paymentErrors alert alert-danger" style="display:none;"></div>

  <div class="card card-default" style="margin-bottom:10px;">
    <div class="card-header bg-default" style="font-size:15px;color:rgb(0,0,0)">
      Total <strong><?php echo number_format(round($total),2)." (".$currency.")" ?></strong> going to be paid,  <a data-toggle="collapse" href="#collapse1" style="color:#004080;"><u>View Detail</u></a>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="card-body"><?php echo $allproductdetail; ?></div>
      <div class="card-footer">Total: <?php echo number_format(round($total),2)." (".$currency.")" ?></div>
    </div>
  </div>

<form action="" method="POST" id="paymentForm">
<?php if($cod_step ===0){ ?>
<div class="alert alert-warning">In order to place this order you need to verify your email</div>

<div class="form-group">
<label for="email">Email</label>
<input type="email" name="codCustEmail" class="form-control" placeholder="Your Email Id" value="<?php if($email){echo $email;} ?>" required>
</div>
<?php }else if($cod_step ===1){ ?>
<div class="alert alert-info">We have sent the OTP successfully, please verify.</div>
<div class="form-group">
    <input type="text" id="idpotp" class="form-control" placeholder="Enter the OTP" name="codCustOTP">
</div>
<?php } ?>

<?php if(strlen(trim($err))>0){echo "<p class='text-center text-danger'>".$err."</p>";}else{echo "<br>";} ?>
<?php if($cod_step ===0){ ?>
<div class="form-group">
<input type="submit" name="process_otp" id="" class="btn form-control theme-button" value="Send OTP">
</div>
<?php }else if($cod_step ===1){ ?>
<div class="row">
<div class="col-sm-6"> <input type="submit" class="btn btn-primary btn-block" name="verify_otp" onclick="return (function(){if((document.querySelectorAll('#idpotp')[0].value).trim().length<1){return false}else{return true;}})()" value="Verify"></div>
    <div class="col-sm-6"><button type="submit" class="btn btn-danger btn-block" name="reset_otp">Try Again</button></div>
</div> 
<?php } ?>
</form>
</div>
</div>
</div>
</div>
</div>
    </body>
<style>
.panel
{
	-webkit-box-shadow: 2px 4px 9px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 4px 9px -2px rgba(0,0,0,0.75);
box-shadow: 2px 4px 9px -2px rgba(0,0,0,0.75);
}
</style>	
</html>
<?php }} ?>