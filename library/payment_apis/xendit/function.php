<?php
use Xendit\Xendit;
function addToXendit($sell_ob,$credentials,$items,$description="")
{

require 'xendit/src/Xendit.php';
require 'xendit/src/Invoice.php';
require 'vendor/autoload.php';

	$credentials=json_decode($credentials);
	$itemarr=array();
	$sheepingcharge=0;
	$tax=0;
	$totalprice=0;
	$productid=0;
	$currency="IDR";
	$producttitle="";
	$external_id="";

	$allproductdetail="";

	$order_data_array=$_SESSION['order_form_data'.get_option('site_token')];


	$all_price_detail=$sell_ob->getProductsPriceDependingOnMethod($credentials,$items);


	if(is_array($all_price_detail))
	{
	    foreach($all_price_detail as $all_price_detail_index=>$all_price_detail_val)
	    {
	        ${$all_price_detail_index}=$all_price_detail_val;
	    }
	}

    $allproductdetail .="Total Price: ".number_format($totalprice,2,",",".")." ".$currency."\n";
	$allproductdetail .="Tax: ".number_format($tax,2,",",".")." ".$currency."\n";
	$allproductdetail .="Shipping Charge: ".number_format($sheepingcharge,2,",",".")." ".$currency;

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

	$keySecret=$credentials->client_secret;
	$baseUrl =get_option('install_url')."/index.php/?page=do_payment&execute=1";
	//Api Key
	Xendit::setApiKey($keySecret);


	if(!isset($_GET['execute']))
	{

		$params = 
		[   'external_id'           => "payment_id_".bin2hex(random_bytes(10))."",
		    'payer_email'           => $email,
		    'description'           => $description,
		    'amount'                => (int)$price,
		    "success_redirect_url"  =>  $baseUrl."&success=true",
		    "failure_redirect_url"  => $baseUrl."&success=false",
		    "currency"              => $currency
		];

		try
		{
			$createInvoice = \Xendit\Invoice::create($params);
			$invoice_id = $createInvoice['id'];
			$_SESSION['invoice_result_fetch_id']=$invoice_id;

			$getInvoice = \Xendit\Invoice::retrieve($invoice_id);
			$invoice_redirect_url=$getInvoice['invoice_url'];
			try{
			    if(isset($invoice_redirect_url) && !empty($invoice_redirect_url)){
    
    			echo "<script>window.open('".$invoice_redirect_url."','_self')</script>";
    			
    			}
    			else{
    			    echo "Sorry Unable to load Payment page";
    			}
			}
			catch(\Xendit\Exceptions\ApiException $e){
			echo "Sorry Unable to load Payment page ".$e->getMessage();
		    }
		}
		catch(\Xendit\Exceptions\ApiException $e){
			echo "Sorry Unable to load Payment page ".$e->getMessage();
		}
	}
	else
	{
		if(  isset($_GET['success']) && $_GET['success'] == 'true')
		{
			$responseMessage="";
			$resultInvoice = \Xendit\Invoice::retrieve($_SESSION['invoice_result_fetch_id']);
			if(($_SESSION['invoice_result_fetch_id']===$resultInvoice['id']) && !empty($_SESSION['invoice_result_fetch_id']))
			{   
				if(strtolower($resultInvoice['status'])=="paid" || strtolower($resultInvoice['status'])=="settled")
				{
				    $response['payer_name']=$name;
    			    $response['payer_email']=$resultInvoice['payer_email'];
    			    $response['id']=$resultInvoice['id'];
    			    $responseMessage=json_encode($response);
    			    
    			    return $responseMessage;
				}else{
				    return 0;
				}
				
			}else{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
}
?>
	
