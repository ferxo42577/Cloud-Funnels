<?php
if(!isset($_POST['ctransaction']))
        die('unathorized access.');

function jvzipnVerification($credentials) {
    $credentials=json_decode($credentials);
    $secretKey = $credentials->client_secret;
    $pop = "";
    $ipnFields = array();
    foreach ($_POST AS $key => $value) {
        if ($key == "cverify") {
            continue;
        }
        $ipnFields[] = $key;
    }
    sort($ipnFields);
    foreach ($ipnFields as $field) {
        // if Magic Quotes are enabled $_POST[$field] will need to be
        // un-escaped before being appended to $pop
        $pop = $pop . $_POST[$field] . "|";
    }
    $pop = $pop . $secretKey;
    $calcedVerify = sha1(mb_convert_encoding($pop, "UTF-8"));
    $calcedVerify = strtoupper(substr($calcedVerify,0,8));
    return $calcedVerify == $_POST["cverify"];
}

function addToJvzoo($credentials)
{
if(jvzipnVerification($credentials) == 1)
{
        //register sale
        if($_POST['ctransaction'] == 'SALE')
        {
            $data=$_POST;
			$data['payer_name']=$_POST['ccustname'];
			$data['payer_email']=$_POST['ccustemail'];
			$data['payment_id']=$_POST['ctransreceipt'];
            $_SESSION['total_paid'.get_option('site_token')]=$_POST['ctransamount']/100;
            $_SESSION['payment_currency'.get_option('site_token')]="USD";
            $_SESSION['ipn_tax'.get_option('site_token')]=0;
			return json_encode($data);
        }
}
else
{
	return 0;
}
}
?>