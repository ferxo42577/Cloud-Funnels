<?php
function addToWarriorPlus($credentials)
{
	if($_SERVER['REQUEST_METHOD'] !=="POST"){return 0;}
	if(isset($_POST['WP_ITEM_NAME']))
	{
		$credentials=json_decode($credentials);
		if($_POST['WP_ACTION']=='sale')
		{
		if((strlen(trim($credentials->client_secret))<1)|| (isset($_POST['WP_SECURITYKEY']) && $_POST['WP_SECURITYKEY']==$credentials->client_secret))
		{
		$data=$_POST;

		$data['payment_id']=$_POST['WP_SALEID'];
		$data['payer_email']=$_POST['WP_BUYER_EMAIL'];
		$data['payer_name']=$_POST['WP_BUYER_NAME'];
		
		$_SESSION['total_paid'.get_option('site_token')]=$_POST['WP_SALE_AMOUNT'];
		$_SESSION['payment_currency'.get_option('site_token')]=$_POST['WP_SALE_CURRENCY'];
		$_SESSION['ipn_tax'.get_option('site_token')]=0;

		return json_encode($data);
		}
		else
		{
			return 0;
		}
		}
		else
		{
			return 0;
		}
	}
	else
	{
		return 0;
	}
}

?>