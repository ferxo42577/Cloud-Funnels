<?php
function addToStripe($sell_ob,$credentials,$items,$description="")
{	
$credentials=json_decode($credentials);
$itemarr=array();

$sheepingcharge=0;
$tax=0;
$totalprice=0;
$productid=0;
$currency="USD";
$producttitle="";

$allproductdetail="";
/*
for($i=0;$i<count($items);$i++)
{
	if($i==0)
	{
	$currency=$items[$i]['currency'];
	$producttitle=$items[$i]['title'];
	$productid=$items[$i]['productid'];
	}
	$allproductdetail .=$items[$i]['title']." (Price: ".number_format($items[$i]['price'],2)." ".$currency.")<br>";
	$sheepingcharge=$sheepingcharge+$items[$i]['shipping'];
	$tax=$tax+$items[$i]['tax'];
	
	$totalprice=$totalprice+$items[$i]['price'];
	
	
}
$tax=$tax+($totalprice *($credentials->tax/100));
$total=$totalprice+$tax+$sheepingcharge;
*/

$all_price_detail=$sell_ob->getProductsPriceDependingOnMethod($credentials,$items);
//'itemarr','sheepingcharge','tax','totalprice','currency','total', 'allproductdetail'
if(is_array($all_price_detail))
{
    foreach($all_price_detail as $all_price_detail_index=>$all_price_detail_val)
    {
        ${$all_price_detail_index}=$all_price_detail_val;
    }
}

$allproductdetail .="<hr/>Total Price: ".number_format($totalprice,2)." ".$currency."<br>";

$allproductdetail .="Tax: ".number_format($tax,2)." ".$currency."<br>";

$allproductdetail .="Shipping Charge: ".number_format($sheepingcharge,2)." ".$currency;


$_SESSION['total_paid'.get_option('site_token')]=$total;
$_SESSION['payment_currency'.get_option('site_token')]=$currency;

if(isset($_GET['execute']))
{
//check if stripe token exist to proceed with payment
if(!empty($_POST['stripeToken'])){
// get token and user details
$stripeToken = $_POST['stripeToken'];
$custName = $_POST['custName'];
$custEmail = $_POST['custEmail'];
$cardNumber = $_POST['cardNumber'];
$cardCVC = $_POST['cardCVC'];
$cardExpMonth = $_POST['cardExpMonth'];
$cardExpYear = $_POST['cardExpYear'];
//include Stripe PHP library
require_once('stripe_api/init.php');
//set stripe secret key and publishable key
$stripe = array(
"secret_key" => $credentials->client_secret,
"publishable_key" => $credentials->client_id,
);
\Stripe\Stripe::setApiKey($stripe['secret_key']);
//add customer to stripe
$customer = \Stripe\Customer::create(array(
'email' => $custEmail,
'source' => $stripeToken
));
// item details for which payment made
$itemName = $producttitle;
$itemNumber = $productid;
$itemPrice = round($total*100);
$currency = $currency;
$orderID = time();
$orderID .=substr(str_shuffle('zxcvnmasdfghjklqwertyuiop1234567890QWERTYUIOPSDFGHJKLZXCVBNM'),0,5);
// details for which payment performed

$payDetails = \Stripe\Charge::create(array(
'customer' => $customer->id,
'amount' => $itemPrice,
'currency' => $currency,
'description' => $itemName,
'metadata' => array(
'order_id' => $orderID
)
));
// get payment details
$paymenyResponse = $payDetails->jsonSerialize();
// check whether the payment is successful
if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
// transaction details
$amountPaid = $paymenyResponse['amount'];
$balanceTransaction = $paymenyResponse['balance_transaction'];
$paidCurrency = $paymenyResponse['currency'];
$paymentStatus = $paymenyResponse['status'];
$paymentDate = date("Y-m-d H:i:s");
//insert tansaction details into database
//if order inserted successfully
if($paymentStatus == 'succeeded'){
$paymenyResponse['payer_name']=$custName;
$paymenyResponse['payer_email']=$custEmail;	
$paymentMessage = json_encode($paymenyResponse);
} else{
$paymentMessage =0;
}
} else{
$paymentMessage =0;
}
} else{
$paymentMessage =0;
}
return $paymentMessage;
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
       <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
       <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">		
        <script>
		// set your stripe publishable key
		Stripe.setPublishableKey('<?php echo $credentials->client_id; ?>');
		$(document).ready(function() {
		$("#paymentForm").submit(function(event) {
		$('#makePayment').attr("disabled", "disabled");
		// create stripe token to make payment
		Stripe.createToken({
		number: $('#cardNumber').val(),
		cvc: $('#cardCVC').val(),
		exp_month: $('#cardExpMonth').val(),
		exp_year: $('#cardExpYear').val()
		}, handleStripeResponse);
		return false;
		});
		});
		// handle the response from stripe
		function handleStripeResponse(status, response) {
		console.log(JSON.stringify(response));
		if (response.error) {
		$('#makePayment').removeAttr("disabled");
		if(response.error.message.length>0)
		{$(".paymentErrors").html(response.error.message);$(".paymentErrors").css('display','block');}
	    else
		{
		$(".paymentErrors").css('display','none');	
		}
		} else {
		var payForm = $("#paymentForm");
      //get stripe token id from response
      var stripeToken = response['id'];
    //set the token into the form hidden input to make payment
    payForm.append("<input type='hidden' name='stripeToken' value='" + stripeToken + "' />");
    payForm.get(0).submit();
   }
   }</script>		
    </head>
    <body>
<div class="container-fluid">
<div class="row">	
<div class="col-sm-4 offset-sm-4" style="margin-top:50px;">
<div class="card exclude-pnl">
<div class="card-header" style="background:linear-gradient(#19334d,#19334d);">Card Payment</div>
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

<form action="index.php?page=do_payment&execute=1" method="POST" id="paymentForm">
<div class="form-group">
<label for="name">Name</label>
<input type="text" name="custName" class="form-control" placeholder="Your Name">
</div>
<div class="form-group">
<label for="email">Email</label>
<input type="email" name="custEmail" class="form-control" placeholder="Your Email Id">
</div>
<div class="form-group">
<label>Card Number</label>
<input type="text" name="cardNumber" size="20" autocomplete="off" id="cardNumber" class="form-control" placeholder="Card Number"/>
</div>
<div class="form-group">
<div class="row">
<div class="col">
<label>CVC</label>
<input type="text" name="cardCVC" size="4" autocomplete="off" id="cardCVC" class="form-control"  placeholder="CVC"/>
</div>
<div class="col">
<label>Expiration (MM/YYYY)</label>
<div class="row">
<div class="col">
<input type="text" name="cardExpMonth" placeholder="MM" size="2" id="cardExpMonth" class="form-control" />
</div>
<div class="col">
<input type="text" name="cardExpYear" placeholder="YYYY" size="4" id="cardExpYear" class="form-control" />
</div>
</div>
</div>

</div>
</div>
<br>
<div class="form-group">
<input type="submit" id="makePayment" class="btn form-control theme-button" value="Make Payment">
</div>
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