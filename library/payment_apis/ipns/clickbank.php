<?php
function addToClickbank($credentials)
{
    $credentials=json_decode($credentials);
    //client_secret
    $secretKey=$credentials->client_secret; // secret key from your ClickBank account
 
    // get JSON from raw body...
    $message = json_decode(file_get_contents('php://input'));
 
    // Pull out the encrypted notification and the initialization vector for
    // AES/CBC/PKCS5Padding decryption
    $encrypted = $message->{'notification'};
    $iv = $message->{'iv'};
    error_log("IV: $iv");
 
    // decrypt the body...
    $decrypted = trim(
    openssl_decrypt(base64_decode($encrypted),
    'AES-256-CBC',
    substr(sha1($secretKey), 0, 32),
    OPENSSL_RAW_DATA,
    base64_decode($iv)), "\0..\32");
  
    error_log("Decrypted: $decrypted");
 
    ////UTF8 Encoding, remove escape back slashes, and convert the decrypted string to a JSON object...
    $sanitizedData = utf8_encode(stripslashes($decrypted));
    $order = json_decode($decrypted);

        if(isset($order->transactionType) && ($order->transactionType=='SALE'))
        {
            $data=(array)$order;
            $customer=(is_object($order->customer))? $order->customer:json_encode($order->customer);
            $shipping=(is_object($customer->shipping))? $customer->shipping:json_encode($customer->shipping);
            $data['payment_id']=$order->receipt;
            $data['payer_email']=$shipping->email;
            $data['payer_name']=$shipping->fullName;
            
            $_SESSION['total_paid'.get_option('site_token')]=$order->totalAccountAmount;
            $_SESSION['payment_currency'.get_option('site_token')]='USD';
            $_SESSION['ipn_tax'.get_option('site_token')]=0;
            return json_encode($data);
        }
        return 0;

}
?>