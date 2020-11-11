<?php
function addToPayDotCom($credentials)
{
$input = file_get_contents('php://input');

$json = @json_decode($input, true);

$credentials=json_decode($credentials);

$secret =$credentials->client_secret;

$secret = substr(sha1($secret), 0, 32);

$notification = base64_decode($json['notification']);

$iv = base64_decode($json['iv']);

$decoded = openssl_decrypt(
    $notification,
    'AES-256-CBC',
    $secret,
    OPENSSL_RAW_DATA,
    $iv
);
        $jsn=$decoded;
        $data = json_decode($decoded, true);
        if(!is_object($data)){return 0;}

        $transaction=$data->transactionInfo;

        if(isset($transaction->transactionType))
        {
        if($transaction->transactionType !='SALE')
        {
            return 0;
        }
        }else{return 0;}

        $payerdata=$data->billingInfo;
        $arr=array();
        $arr['payer_name']=$payerdata->fullName;
		$arr['payer_email']=$payerdata->email;
		$arr['payment_id']=$transaction->transactionIdentifier;
		$_SESSION['total_paid'.get_option('site_token')]=$transaction->paidAmount;
		$_SESSION['payment_currency'.get_option('site_token')]=$transaction->currency;
        $_SESSION['ipn_tax'.get_option('site_token')]=0;
        $data=(array)$data;
        return array_merge($data,$arr);
}
?>