<?php
function addToInstamojo($sell_ob,$credentials,$items,$description="")
{	
$credentials=json_decode($credentials);
$itemarr=array();
$sheepingcharge=0;
$tax=0;
$totalprice=0;
$productid=0;
$currency="INR";
$producttitle="";

$allproductdetail="";

$order_data_array=$_SESSION['order_form_data'.get_option('site_token')];
/*
for($i=0;$i<count($items);$i++)
{
	if($i==0)
	{
	$currency=$items[$i]['currency'];
	$producttitle=$items[$i]['title']." .";
	$productid=$items[$i]['productid'];
	}
	$allproductdetail .=$items[$i]['title'];
	$sheepingcharge=$sheepingcharge+$items[$i]['shipping'];
	$tax=$tax+$items[$i]['tax'];
	
	$totalprice=$totalprice+$items[$i]['price'];
}
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

//$product_name = $allproductdetail;
$allproductdetail .="Total Price: ".number_format($totalprice,2)." ".$currency."\n";
$allproductdetail .="Tax: ".number_format($tax,2)." ".$currency."\n";
$allproductdetail .="Shipping Charge: ".number_format($sheepingcharge,2)." ".$currency;

$allproductdetail=str_replace("<br>","\n",$allproductdetail);

$_SESSION['total_paid'.get_option('site_token')]=$total;
$_SESSION['payment_currency'.get_option('site_token')]=$currency;


$price = $total;
$name="User";
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
$phone = (isset($order_data_array['data']['phone']))? $order_data_array['data']['phone']:'';
$email = (isset($order_data_array['data']['email']))? $order_data_array['data']['email']:'';

$ccid=trim($credentials->client_id);
$ccs=$credentials->client_secret;

if(strpos($ccid,'test_')===0)
{
    $instpth='https://test.instamojo.com/api/1.1/';//needs to chnge this path to production.. 
}
else
{
    $instpth='https://www.instamojo.com/api/1.1/';
}

if(isset($_GET['execute']) && $_GET['execute']==1)
{
include 'src/instamojo.php';

$api2 = new Instamojo\Instamojo($ccid,$ccs,$instpth);
$payid = $_GET["payment_request_id"];

try {
    $response2 = $api2->paymentRequestStatus($payid);
    if(isset($response2['status']) && (strtolower($response2['status'])==='completed'))
    {
        $payment_id=$response2['payments'][0]['payment_id'];
        $custName=$response2['payments'][0]['buyer_name'];
        $custEmail=$response2['payments'][0]['buyer_email']; 

        $paymenyResponse=array();
        $paymenyResponse['id']=$payment_id;
        $paymenyResponse['payer_name']=$custName;
        $paymenyResponse['payer_email']=$custEmail;	
        $paymentMessage = json_encode($paymenyResponse);
        return $paymentMessage;
    }
    else
    {
        return 0;
    }
    
}
catch (Exception $e) {
    //print('Error: ' . $e->getMessage());
    return 0;
}
}

else
{
$_SESSION["instamozo_salt_".get_option('site_token')]=$credentials->salt;


include 'src/instamojo.php';

$api = new Instamojo\Instamojo($ccid,$ccs,$instpth);
//print_r($api);
$redirect_url=get_option('install_url')."/index.php?page=do_payment&execute=1";
//echo "<br>Redirect URL is ".$redirect_url;
$product_name="Product Purchase";
try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => false,
        "send_sms" => false,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => $redirect_url,
        /*"webhook" => "https://mechmarketers.com/vibhore_cloud_funnels/library/payment_apis/instamojo/webhook.php"*/
        ));
    $pay_ulr = $response['longurl'];
  //  echo $pay_ulr;
    echo "<script>window.location=`".$pay_ulr."`</script>";
    exit();
}
catch (Exception $e) {
    //print('Error: ' . $e->getMessage());
    die("Unable to process");
}
}

} 
?>