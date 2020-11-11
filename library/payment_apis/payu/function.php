<?php
function addToPayu($sell_ob,$credentials,$items,$description="")
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

    $file=__DIR__;
    $file=rtrim(str_replace("\\","/",$file),"/");


    $order_data_array=$_SESSION['order_form_data'.get_option('site_token')];
    $MERCHANT_KEY = $credentials->client_id;
    $SALT = $credentials->salt;
    $total=$total;

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

    $cb_url =get_option('install_url')."/index.php/?page=do_payment&execute=1";
    if(!isset($_GET['execute']))
    {
        require_once($file."/index.php");
    }
    else
    {
        if(isset($_GET['success']) && $_GET['success']=='1')
        {
            require_once($file."/response.php");
            if($stat)
            {
                return $stat;
            }
            else
            {
                return 0;
            }
        }else{ return 0; }
    }
}
?>