<?php
function addToThriveCart($credentials)
{
    $credentials=json_decode($credentials);
    //client_secret
    if(isset($_POST['event']) && $_POST['event']=='order.success')
    {
        $secret=trim($credentials->client_secret);
        if((strlen($secret)<1)|| (isset($_POST['thrivecart_secret']) && $secret==$_POST['thrivecart_secret'] ))
        {
            $customer=(is_object($_POST['customer']))? $_POST['customer']:json_decode($_POST['customer']);
            $order=(is_object($_POST['order']))? $_POST['order']:json_decode($_POST['order']);
            $data=$_POST;
            $data['payment_id']=$_POST['order_id'];
            $data['payer_email']=$customer->email;
            $data['payer_name']=$customer->name;
            
            $_SESSION['total_paid'.get_option('site_token')]=$order->total;
            $_SESSION['payment_currency'.get_option('site_token')]=$_POST['currency'];
            $_SESSION['ipn_tax'.get_option('site_token')]=$order->tax;
            
            return json_encode($data);
        }
    }
    return 0;
}
?>