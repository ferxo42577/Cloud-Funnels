<?php
function addToToyyibpay($sell_ob,$credentials,$items,$description="")
{

$credentials=json_decode($credentials);
$itemarr=array();
$sheepingcharge=0;
$tax=0;
$totalprice=0;
$productid=0;
$currency="IDR";
$producttitle="";

$allproductdetail="";

$order_data_array=$_SESSION['order_form_data'.get_option('site_token')];

$all_price_detail=$sell_ob->getProductsPriceDependingOnMethod($credentials,$items);
//'itemarr','sheepingcharge','tax','totalprice','currency','total', 'allproductdetail'
if(is_array($all_price_detail))
{
    foreach($all_price_detail as $all_price_detail_index=>$all_price_detail_val)
    {
        ${$all_price_detail_index}=$all_price_detail_val;
    }
}

$allproductdetail .="Total Price: ".number_format($totalprice,2)." ".$currency."\n";
$allproductdetail .="Tax: ".number_format($tax,2)." ".$currency."\n";
$allproductdetail .="Shipping Charge: ".number_format($sheepingcharge,2)." ".$currency;
$allproductdetail=str_replace("<br>","\n",$allproductdetail);

$_SESSION['total_paid'.get_option('site_token')]=$total;
$_SESSION['payment_currency'.get_option('site_token')]=$currency;

$price = $total*100;
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

$group_id=trim($credentials->client_id);
$secret_key=trim($credentials->client_secret);

$ccav_path_req=($credentials->pay_type=='1')?"https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction":"https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
//echo "ccavenue required path".$ccav_path_req;

$billName=(isset($items[0]['title']) && !empty($items[0]['title']))?$items[0]['title']:"";

if(isset($_GET['execute']))
{
	$get_data = array(
	    'billCode' => $_GET['billcode'],
	    'billpaymentStatus' => $_GET['status_id']
	);  

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/getBillTransactions');  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $get_data);

	$fetch_result = curl_exec($ch);
	$info = curl_getinfo($ch);
	$fetch_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	$decode_data=json_decode($fetch_result);
	if($fetch_status_code==200 && isset($_GET['status_id']) && !empty($_GET['status_id']) && $_GET['status_id']==1){

		$response=array();
        $response['payer_name']=$name;
        $response['payer_email']=$email;
        $response['payer_id']="Bill Code :: ".$_GET['billcode']." and Transaction id :: ".$decode_data[0]->billpaymentInvoiceNo;

        $responseMessage=json_encode($response);
        return $responseMessage;

        exit();

	}else{
		return 0;
		
		exit();
	}
}
else
{
$redirect_url=get_option('install_url')."/index.php?page=do_payment&execute=1";

$toyyibpay_path_req=($credentials->pay_type=='1') ? "https://toyyibpay.com/index.php/api/createBill":"https://dev.toyyibpay.com/index.php/api/createBill";

	
  $user_data = array(
    'userSecretKey'=>$secret_key,
    'categoryCode'=>$group_id,
    'billName'=>$billName."'s bill",
    'billDescription'=> (isset($description) && !empty($description)) ? $description:"" ,
    'billPriceSetting'=>0,
    'billPayorInfo'=>1,
    'billAmount'=>$price,
    'billReturnUrl'=>$redirect_url,
    'billCallbackUrl'=>$redirect_url,
    'billExternalReferenceNo' => mt_rand(),
    'billTo'=>$name,
    'billEmail'=>$email,
    'billPhone'=>$phone,
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>'0',
    'billDisplayMerchant'=>1,
    'billContentEmail'=>'Thank you for purchasing our product!',
    'billChargeToCustomer'=>1
  );  

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, $toyyibpay_path_req);  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $user_data);

  $result = curl_exec($curl);
  $info = curl_getinfo($curl);
	$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  curl_close($curl);
  $obj = json_decode($result);
  $BillCode = ($obj[0]->BillCode);

  if (isset($status_code) && $status_code==200) {

  header("Location: https://dev.toyyibpay.com/".$BillCode."");

  }


}

} 
?>