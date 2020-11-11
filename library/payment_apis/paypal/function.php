<?php
function addToPaypal($sell_ob,$credentials,$items,$description="")
{	
require __DIR__  . '/api/autoload.php';

$credentials=json_decode($credentials);


$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            $credentials->client_id,     // ClientID
            $credentials->client_secret      // ClientSecret
        )
);

$payment_mode="live";

$sandbox_session_name="paypal_use_sandbox_".get_option('site_token');

$modelbl_counter=0;
modelbl:
if(isset($_SESSION[$sandbox_session_name]) && $_SESSION[$sandbox_session_name]==="sandbox")
{
    $payment_mode="sandbox";
}

$apiContext->setConfig(
    array(
      'mode' => $payment_mode
    )
);


$itemarr=array();

$sheepingcharge=0;
$tax=0;
$totalprice=0;

$currency="USD";
/*
for($i=0;$i<count($items);$i++)
{
	if($i==0)
	{
	$currency=$items[$i]['currency'];
	}
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


$_SESSION['total_paid'.get_option('site_token')]=$total;
$_SESSION['payment_currency'.get_option('site_token')]=$currency;

if(!isset($_GET['execute']))
{
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod("paypal");

for($i=0;$i<count($items);$i++)
{
	$item = new \PayPal\Api\Item();
	$item->setName($items[$i]['title'])
    ->setCurrency($currency)
    ->setQuantity(1)
    ->setSku($items[$i]['productid']) // Similar to `item_number` in Classic API
    ->setPrice($items[$i]['price']);
	array_push($itemarr,$item);
}

$itemList = new \PayPal\Api\ItemList();
$itemList->setItems($itemarr);

$details = new \PayPal\Api\Details();
$details->setShipping($sheepingcharge)
    ->setTax($tax)
    ->setSubtotal($totalprice);
	

	
$amount = new \PayPal\Api\Amount();
$amount->setCurrency($currency)
    ->setTotal($total)
    ->setDetails($details);

$_SESSION['paypal_invoice_id'.get_option('site_token')]=uniqid();

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription($description)
    ->setInvoiceNumber($_SESSION['paypal_invoice_id'.get_option('site_token')]);
	
$baseUrl =get_option('install_url')."/index.php/?page=do_payment&execute=1";
$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl($baseUrl."&success=true")
    ->setCancelUrl($baseUrl."&success=false");	
	
	$payment = new \PayPal\Api\Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));
    $request = clone $payment;
    
$continue_to_paypal_paymentpage=true;
	try {
    $payment->create($apiContext);
} catch (Exception $ex) {//print_r($ex);
    if($modelbl_counter<1)
    {
        $modelbl_counter=1;
        $_SESSION[$sandbox_session_name]="sandbox";
        goto modelbl;
    }
    elseif(isset($_SESSION[$sandbox_session_name]))
    {
        unset($_SESSION[$sandbox_session_name]);
    }

    $continue_to_paypal_paymentpage=false;
    //die();
}
    if($continue_to_paypal_paymentpage)
    {
        $approvalUrl = $payment->getApprovalLink();
        echo "<script>window.location='".$approvalUrl."'</script>";
    }
    else
    {
        echo "Something wrong, Unable to load payment page";
    }
}
else
{
	if (isset($_GET['success']) && $_GET['success'] == 'true') 
	{
		 $paymentId = $_GET['paymentId'];
    $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
	
	 $execution = new \PayPal\Api\PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);
	$unable=0;
	try 
	 {
		$result = $payment->execute($execution, $apiContext);

      try {
            $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
        } catch (Exception $ex) {
			$unable=1;
            exit(1);
        }
    } catch (Exception $ex) {
		$unable=1;
        exit(1);
    }
    if($unable===0)
	{
    return $payment->toJSON();
	}
	else
	{
		return 0;
	}
} else
{
	return 0;
}
}	
}

?>