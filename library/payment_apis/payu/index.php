<?php
$PAYU_BASE_URL =($credentials->pay_type=='1')? "https://secure.payu.in":"https://sandboxsecure.payu.in";

$action = '';

$posted = array(
	'key'=>$MERCHANT_KEY,
	'amount'=>$total,
	'surl'=>$cb_url.'&success=1',
	'furl'=>$cb_url.'&success=0',
	'curl'=>$cb_url.'&success=0',
	'service_provider' =>'payu_paisa',
	'productinfo'=>'Process payment for the selected products',
);

$pre_posted=$posted;

if(isset($_POST['process_payu']))
{
	foreach($posted as $key=>$value)
	{
		$_POST[$key]=$value;
	}
}

if(!empty($_POST) && isset($_POST['process_payu'])) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>Purchase</title>

  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>

  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">	

  </head>
  <body onload="submitPayuForm()">


	<div class="container-fluid">
  	<div class="row">	
  	<div class="col-sm-4 offset-sm-4" style="margin-top:50px;">
	<div class="card exclude-pnl">
	<div class="card-header" style="background:linear-gradient(#19334d,#19334d);">Process Payment</div>
	<div class="card-body">
		<?php if($formError){ ?>
			<div class="paymentErrors alert alert-danger" style="display:none;">Please fill all mandatory fields.</div>
		<?php } ?>

		<div class="card card-default" style="margin-bottom:10px;">
			<div class="card-header bg-default" style="font-size:15px;color:rgb(0,0,0)">
			Total <strong><?php echo number_format(round($total),2)." (".$currency.")" ?></strong> going to be paid,  <a data-toggle="collapse" href="#collapse1" style="color:#004080;"><u>View Detail</u></a>
			</div>
			<div id="collapse1" class="panel-collapse collapse">
			<div class="card-body"><?php echo $allproductdetail; ?></div>
			<div class="card-footer">Total: <?php echo number_format(round($total),2)." (".$currency.")" ?></div>
			</div>
		</div>

	  <form action="<?php echo $action; ?>" method="post" name="payuForm">

		<?php
			if(isset($_POST['process_payu']))
			{
				foreach($pre_posted as $pre_posted_index=>$pre_posted_value)
				{
					echo "<input type='hidden' name='".$pre_posted_index."' value='".$pre_posted_value."'>";
				}
			}
		?>

		<input type="hidden" name="hash" value="<?php echo $hash ?>"/>
		<input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
		<div class="form-group">
			<input class="form-control" name="firstname" id="firstname" value="<?php echo (empty($name)) ? '' : $name; ?>" placeholder="Enter your name"/>
		</div>

		<div class="form-group">
			<input class="form-control" name="email" id="email" value="<?php echo (empty($email)) ? '' : $email; ?>" placeholder="Enter your email id"/>
		</div>

		<div class="form-group">
			<input class="form-control" name="phone" value="<?php echo (empty($phone)) ? '' : $phone; ?>" placeholder="Enter your phone number"/>
		</div>

		<?php if(!$hash) { ?>
            <button type="submit" name="process_payu" class="btn btn-warning btn-block">Pay</button>
          <?php } ?>

	  </form>

	</div>
	</div>
	</div>
	</div>
	</div>
  </body>
</html>
