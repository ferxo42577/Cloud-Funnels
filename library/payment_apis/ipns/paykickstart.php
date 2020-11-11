<?php
function is_valid_paykickstart_ipn($data, $secret_key)
{
    $paramStrArr = array();
    $paramStr = NULL;
    foreach($data as $key=>$value)
    {
        if($key == "verification_code") continue;
        if(!$key OR !$value) continue;
        $paramStrArr[] = (string) $value;
    }
    ksort( $paramStrArr, SORT_STRING );
    $paramStr = implode("|", $paramStrArr);
    $encKey = hash_hmac( 'sha1', $paramStr, $secret_key );
    return $encKey == $data["verification_code"] ;
}

function addToPaykickstart($credentials)
{
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
         $credentials=json_decode($credentials);
         if(is_valid_paykickstart_ipn($_POST,$credentials->client_secret))
         {
            if($_POST['event']=="sales")
            {
            $data=$_POST;     
            $data['payer_name']=$_POST['buyer_first_name']." ".$_POST['buyer_last_name'];
		    $data['payer_email']=$_POST['buyer_email'];
		    $data['payment_id']=$_POST['transaction_id'];
		    $_SESSION['total_paid'.get_option('site_token')]=$_POST['amount'];
            $_SESSION['payment_currency'.get_option('site_token')]='USD';
            $temptax=0;
            if(is_numeric($_POST['tax_amount'])){$temptax=$_POST['tax_amount'];}
            $_SESSION['ipn_tax'.get_option('site_token')]=$temptax;  
            return json_encode($data);
            }
            else
            {
                return 0;
            }      
         }
         else
         {return 0;}
    }
    else
    {
        return 0;
    }
}
?>