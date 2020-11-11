<?php
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
function addToRazorpay($sell_ob,$credentials,$items,$description="")
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


$all_price_detail=$sell_ob->getProductsPriceDependingOnMethod($credentials,$items);


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

$keyId=$credentials->client_id;
$keySecret=$credentials->client_secret;
$baseUrl =get_option('install_url')."/index.php/?page=do_payment&execute=1";

if(isset($_GET['execute']) && $_GET['execute']==1)
{

    require "razorpay_api/Razorpay.php";

    $success = true;
    $error = "Payment Failed";



    if (isset($_POST['razorpay_payment_id']) && strlen( trim($_POST['razorpay_payment_id']) ))
    {
        $api = new Razorpay\Api\Api($keyId, $keySecret);



        try
        {
            // Please note that the razorpay order ID must
            // come from a trusted source (session here, but
            // could be database or something else)
            $attributes = array(
                'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                'razorpay_signature' => $_POST['razorpay_signature']
            );
            $api->utility->verifyPaymentSignature($attributes);
        }
        catch(Razorpay\Api\Errors\SignatureVerificationError $e)
        {
            $success = false;
            $error = 'Razorpay Error : ' . $e->getMessage();
        }
    }

    //print_r($_POST);
    if ($success === true)
    {
        $response=array();
        $response['payer_name']=$name;
        $response['payer_email']=$email;
        $response['payer_id']=$_POST['razorpay_payment_id'];
        $responseMessage=json_encode($response);
    }
    else
    {
        $responseMessage=0;
       //echo "unable to laod payment page";
    }
    return $responseMessage;
}

else
{

    require('razorpay_api/Razorpay.php');

    // Create the Razorpay Order


    $api = new Razorpay\Api\Api($keyId, $keySecret);

    //
    // We create an razorpay order using orders api
    // Docs: https://docs.razorpay.com/docs/orders
    //
    $orderData = [
        'receipt'         => rand(10000,9999),
        'amount'          => $price, // 2000 rupees in paise
        'currency'        => $currency,
        'payment_capture' => 1 // auto capture
    ];

    $razorpayOrder = $api->order->create($orderData);
    $razorpayOrderId = $razorpayOrder['id'];

    $_SESSION['razorpay_order_id'] = $razorpayOrderId;

    $displayAmount = $amount = $orderData['amount'];

    $displayCurrency=$currency;

    if ($displayCurrency !== 'INR')
    {
        $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
        $exchange = json_decode(file_get_contents($url), true);

        $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
    }

    $address   =    (isset($order_data_array['data']['address']))? $order_data_array['data']['address']:'Not Specified';

    $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => $name,
        "prefill"           => [
        "name"              => $name,
        "email"             => $email,
        "contact"           => $phone,
        ],
        "notes"             => [
        "address"           => $address,
        "merchant_order_id" => mt_rand(100000,999999),
        ],
        "theme"             => [
        "color"             => "#F37254"
        ],
        "order_id"          => $razorpayOrderId,
    ];

    if ($displayCurrency !== 'INR')
    {
        $data['display_currency']  = $displayCurrency;
        $data['display_amount']    = $displayAmount;
    }

    $json = json_encode($data);
    ?>
    <html>
    <head>
    <title>Credit Card Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css"/>
    </head>
    <body class="bg-light">

    <div class="container-fluid">
    <div class="row">	
    <div class="col-sm-4 offset-sm-4" style="margin-top:50px;">
    <div class="card exclude-pnl">
    <div class="card-header" style="background:linear-gradient(#19334d,#19334d);">Process Payment</div>
    <div class="card-body">
        
    <div class="card card-default" style="margin-bottom:10px;">
        <div class="card-header bg-default" style="font-size:15px;color:rgb(0,0,0)">
        Total <strong><?php echo number_format(round($total),2)." (".$currency.")" ?></strong> going to be paid,  <a data-toggle="collapse" href="#collapse1" style="color:#004080;"><u>View Detail</u></a>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
        <div class="card-body"><?php echo $allproductdetail; ?></div>
        <div class="card-footer">Total: <?php echo number_format(round($total),2)." (".$currency.")" ?></div>
        </div>
    </div>

        <div class="form-group">
            <button id="rzp-button1" class="btn btn-warning btn-block">Pay</button>
        </div>

    </div></div></div></div></div>

        <!-- <div class="container py-5 ">
            <div class="mx-auto w-100 w-sm-75 w-md-50 py-5 border text-center">
                <h3 class="py-2">Process Payment</h3>

                <button id="rzp-button1" class="btn btn-primary px-4 py-2">Pay</button>
            </div>
        </div> -->
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <form name='razorpayform' action="<?php echo $baseUrl; ?>" method="POST">
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
        </form>
        <script>
        // // Checkout details as a json
        var options = <?php echo $json; ?>;

        /**
         * The entire list of Checkout fields is available at
         * https://docs.razorpay.com/docs/checkout-form#checkout-fields
         */
        options.handler = function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.razorpayform.submit();
        };

        // Boolean whether to show image inside a white frame. (default: true)
        options.theme.image_padding = false;

        options.modal = {
            ondismiss: function() {
                console.log("This code runs when the popup is closed");
            },
            // Boolean indicating whether pressing escape key 
            // should close the checkout form. (default: true)
            escape: true,
            // Boolean indicating whether clicking translucent blank
            // space outside checkout form should close the form. (default: false)
            backdropclose: false
        };

        var rzp = new Razorpay(options);

        document.getElementById('rzp-button1').onclick = function(e){
            rzp.open();
            e.preventDefault();
        }
        </script>
        </body>
        </html>
    <?php
    }
} 
?>