<?php 
if (isset($_GET['payid'])) {
  $mysqli = $info['mysqli'];
  $pref = $info['dbpref'];
  $payid = $_GET['payid'];
  $select = "select * from `".$pref."payment_methods` where id=".$payid;
  $res = $mysqli->query($select);
  
  while($row = $res->fetch_assoc()){
        $jsonarr = json_decode($row['credentials']);
        $clientid = $jsonarr->client_id;
        $clientsec = $jsonarr->client_secret;
        $tax = $jsonarr->tax;
        $salt=(isset($jsonarr->salt))? $jsonarr->salt:'';
        $title = $row['title'];
        $payid = $row['id'];
        $payname = $row['method'];
        $pay_type=(isset($jsonarr->pay_type))? $jsonarr->pay_type:'';
  }
}
?>

<div class="container-fluid">
<div class="row">
<div class="col-sm-12"> 
    <div id="vuepayment">

      <input type="hidden" id="payid" value="<?php if(isset($payid)){ echo $payid; } else{ echo ""; } ?>">
      <input type="hidden" id="paytitle" value="<?php if(isset($title)){ echo $title; } else{ echo ""; } ?>">
      <input type="hidden" id="payclientid" value="<?php if(isset($clientid)){ echo $clientid; } else{ echo ""; } ?>">
      <input type="hidden" id="payclientsec" value="<?php if(isset($clientsec)){ echo $clientsec; } else{ echo ""; } ?>">
      <input type="hidden" id="paytax" value="<?php if(isset($tax)){ echo $tax; } else{ echo ""; } ?>">
      <input type="hidden" id="payname" value="<?php if(isset($payname)){ echo $payname; } else{ echo ""; } ?>">
      <input type="hidden" id="paysalt" value="<?php if(isset($salt)){ echo $salt; } else{ echo ""; } ?>">
      <input type="hidden" id="pay_type" value="<?php if(isset($pay_type)){ echo $pay_type;}else{ echo ""; } ?>">

      <div class="baserow row" v-if="baserow">
      <div class="col-md-4">
                <div class="card    cursor-pointer">
                  <div class="card-body"><img src="./assets/img/paypal.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/paypal.png'" v-on:click="showForm('paypal')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Paypal</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card    cursor-pointer">
                  <div class="card-body"><img src="./assets/img/stripe.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/stripe.png'" v-on:click="showForm('stripe')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Stripe</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/instamojo.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/instamojo.jpg'" v-on:click="showForm('instamojo')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Instamojo</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/payu.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/payu.jpg'" v-on:click="showForm('payu')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Payu Money</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card    cursor-pointer">
                  <div class="card-body"><img src="./assets/img/authorizenet.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/authorizenet.png'" v-on:click="showForm('authorizenet')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Authorize.net</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/ccavenue.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/ccavenue.jpg'" v-on:click="showForm('ccavenue')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">CCAvenue</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/razorpay.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/razorpay.jpg'" v-on:click="showForm('razorpay')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Razorpay</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/midtrans.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/midtrans.jpg'" v-on:click="showForm('midtrans')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Midtrans</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/toyyibpay.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/toyyibpay.jpg'" v-on:click="showForm('toyyibpay')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">toyyibPay</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/xendit.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/xendit.jpg'" v-on:click="showForm('xendit')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Xendit</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card    cursor-pointer">
                  <div class="card-body"><img src="./assets/img/jvzoo.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/jvzoo.png'" v-on:click="showForm('jvzoo_ipn')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Jvzoo</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card    cursor-pointer">
                  <div class="card-body"><img src="./assets/img/warrior-plus.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/warrior-plus.png'" v-on:click="showForm('warriorplus_ipn')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Warrior Plus</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/paydotcom.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/paydotcom.png'" v-on:click="showForm('paydotcom_ipn')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Paydotcom</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card    cursor-pointer">
                  <div class="card-body"><img src="./assets/img/paykickstart.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/paykickstart.png'" v-on:click="showForm('paykickstart_ipn')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">Paykickstart</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/thrivecart.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/thrivecart.png'" v-on:click="showForm('thrivecart_ipn')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">ThriveCart</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card cursor-pointer">
                  <div class="card-body"><img src="./assets/img/clickbank.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/clickbank.png'" v-on:click="showForm('clickbank_ipn')" alt="Integration" class="card-img-top img-fluid">
                    <div class="card-block border-top">
                      <h4 class="card-title">ClickBank</h4>
                      <p class="card-text">{{t('Click the image for the integration')}}</p>
                    </div>
                  </div>
                </div>
              </div>
     </div>

<div id="editformcontainer" style="display:none;"> 
     <div class="overlay" style="" v-if="jvzoo_ipn">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
     {{t('${1} IPN Settings',['JVZOO'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('jvzoo_ipn')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="ititle" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secret Key')" v-model="iclient_secret" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveIPN('jvzoo_ipn')">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>


<div class="overlay" style="" v-if="warriorplus_ipn">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} IPN Settings',['Warrior+Plus'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('warriorplus_ipn')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="ititle" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secret')" v-model="iclient_secret" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveIPN('warriorplus_ipn')">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="paykickstart_ipn">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} IPN Settings',['Paykickstart'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('paykickstart_ipn')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="ititle" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secret')" v-model="iclient_secret" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveIPN('paykickstart_ipn')">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="paydotcom_ipn">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} IPN Settings',['PayDotCom'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('paydotcom_ipn')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="ititle" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secret')" v-model="iclient_secret" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveIPN('paydotcom_ipn')">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="thrivecart_ipn">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('ThriveCart IPN Settings')}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('thrivecart_ipn')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="ititle" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secret')" v-model="iclient_secret" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveIPN('thrivecart_ipn')">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>
<div class="overlay" style="" v-if="clickbank_ipn">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} IPN Settings',['ClickBank'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('clickbank_ipn')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="ititle" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secret')" v-model="iclient_secret" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveIPN('clickbank_ipn')">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

     <div class="overlay" style="" v-if="paypal">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
      {{t('${1} Payment Settings',['Paypal'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('paypal')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="ptitle" required="">
  </div>

      <div class="form-group">
    <label for="title">{{t('Enter Client ID')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Client ID')" v-model="pclient_id" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Client Secret')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Client Secret')" v-model="pclient_secret" required="">
  </div>

  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  v-bind:placeholder="t('Enter Applicable Tax')" v-model="ptax" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="savepaypal">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="stripe">
  <div class="api-forms">
    <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} Payment Settings',['Stripe'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('stripe')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">
      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="stitle" required="">
  </div>

      <div class="form-group">
    <label for="title">{{t('Enter Official ID')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Official ID')" v-model="sclient_id" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Client Secret')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Client Secret')" v-model="sclient_secret" required="">
  </div>

  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  v-bind:placeholder="t('Enter Applicable Tax')" v-model="stax" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="savestripe">{{t('Save')}}</button>
</div>

  </form>
  </div>
  </div> 
</div>
</div>

<div class="overlay" style="" v-if="authorizenet">
  <div class="api-forms">
    <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} Payment Settings',['Authorize.net'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('authorizenet')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="atitle" required="">
  </div>

      <div class="form-group">
    <label for="title">{{t('Enter API Login ID')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter API Login ID')" v-model="aclient_id" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Transaction Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Transaction Key')" v-model="aclient_secret" required="">
  </div>

  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  placeholder="Enter Applicable Tax" v-model="atax" required="">
  </div>

  <center><span style="color:#FF1493;font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveauthorizenet">{{t('Save')}}</button>
</div>

  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="instamojo">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} Payment Settings',['Instamojo'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('instamojo')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body" style="max-height:600px; overflow:auto;">
      <!-- <div class="alert alert-warning">
        In case of testing the payment method with test credentials, add "@cf_test@" before the API key.
        <p><strong>Example:</strong><br>
        If your test API key is 1234 write @cf_test@1234 at API key field
        </p>
        **Make sure you removed the text "@cf_test@" when you are trying with an API key that created for production mode.
      </div> -->
      <form method="post">
      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="imtitle" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter API Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter API Key')" v-model="imclient_id" required="">
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Enter Auth Token')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Auth Token')" v-model="imclient_secret" required="">
  </div>
<div class="form-group">
    <label for="api-key">{{t('Enter Private Salt')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Private Salt')" v-model="imclient_salt" required="">
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  v-bind:placeholder="t('Enter Applicable Tax')" v-model="imtax" required="">
  </div>
  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveinstamojo">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="payu">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} Payment Settings',['Payu Money'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('payu')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body" style="max-height:600px; overflow:auto;">
      <form method="post">
      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="payu_title" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Merchant Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Merchant Key')" v-model="payuclient_id" required="">
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Enter Merchant Salt')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Merchant Salt')" v-model="payu_salt" required="">
  </div>
<div class="form-group">
    <label for="api-key">{{t('Select Test or Live Mode')}}</label>
    <select v-model="payu_type" class="form-control">
      <option value="1">{{t('Live')}}</option>
      <option value="0">{{t('Sandbox/Test')}}</option>
    </select>
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  v-bind:placeholder="t('Enter Applicable Tax')" v-model="payu_tax" required="">
  </div>
  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="savePayu">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="xendit">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} Payment Settings',['Xendit'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('xendit')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="xndtitle" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Public Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Puhbic key')" v-model="xndpublic_key" required="">
    </div>
    <div class="form-group">
    <label for="api-key">{{t('Enter Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secret')" v-model="xndsecret_key" required="">
    </div>
    <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  v-bind:placeholder="t('Enter Applicable Tax')" v-model="xndtax" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveXendit('xendit')">{{t("Save")}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="razorpay">
  <div class="api-forms">
    <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
      {{t('${1} Payment Settings',['Razorpay'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('razorpay')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">
      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="rptitle" required="">
  </div>

      <div class="form-group">
    <label for="title">{{t('Enter Key ID')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Key ID')" v-model="rpkey_id" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secret Key')" v-model="rpsecret_key" required="">
  </div>

  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}<</label>
    <input type="number" class="form-control"  v-bind:placeholder="t('Enter Applicable Tax')" v-model="rptax" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saverazorpay">{{t('Save')}}</button>
</div>

  </form>
  </div>
  </div> 
</div>
</div>

<div class="overlay" style="" v-if="midtrans" >
      <div class="api-forms" style="overflow: auto;">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} Payment Settings',['Midtrans'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('midtrans')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">
     <div class="form-group">
    <label for="title">{{t('Callback URL for successful payment')}}</label>
    <input type="text" class="form-control" value="<?php echo get_option('install_url'); ?>/index.php?page=do_payment&execute=1&success=true" />
  </div>
  <div class="form-group">
    <label for="title">{{t('Callback URL for canceled payment')}}</label>
    <input type="text" class="form-control" value="<?php echo get_option('install_url'); ?>/index.php?page=do_payment&execute=1&success=false" />
  </div>

  <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="mid_title" required="">
  </div>

  <div class="form-group">
    <label for="api-key">{{t('Enter Merchant Id')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Merchant Id')" v-model="mid_client_id" required="">
  </div>
  
  <div class="form-group">
    <label for="api-key">{{t('Enter  Client Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Client Key')" v-model="mid_client_secret" required="">
  </div>
<div class="form-group">
    <label for="api-key">{{t('Enter Server Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Server Key')" v-model="mid_client_salt" required="">
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Select Test or Live Mode')}}</label>
    <select v-model="mid_type" class="form-control">
      <option value="1">{{t('Live')}}</option>
      <option value="0">{{t('Sandbox/Test')}}</option>
    </select>
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  v-bind:placeholder="t('Enter Applicable Tax')" v-model="mid_tax" required="">
  </div>
 
  <center><span style="font-size:16px;font-weight: bold;" v-html="err"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="savemidtrans">Save</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="toyyibpay" >
      <div class="api-forms" style="overflow: auto;">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('Toyyibpay Payment Settings')}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('toyyibpay')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">
      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="toy_title" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Category Code')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Category Code')" v-model="toy_client_id" required="">
  </div>
  
  <div class="form-group">
    <label for="api-key">{{t('Enter  Secret Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Secrect Key')" v-model="toy_client_secret" required="">
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Select Test or Live Mode')}}</label>
    <select v-model="toy_type" class="form-control">
      <option value="1">{{t('Live')}}</option>
      <option value="0">{{t('Sandbox/Test')}}</option>
    </select>
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  v-bind:placeholder="t('Enter Applicable Tax')" v-model="toy_tax" required="">
  </div>
 
  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="savetoyyibpay">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>

<div class="overlay" style="" v-if="ccavenue">
      <div class="api-forms">
      <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    <div class="col-md-10">
    {{t('${1} Payment Settings',['CCAvenue'])}}
    </div>
    <div class="col-md-2 float-right">
      <span class="closebutton" v-on:click="closeForm('ccavenue')"><i class="fas fa-times-circle"></i></span>
     </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">

      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="ccav_title" required="">
  </div>

    <div class="form-group">
    <label for="api-key">{{t('Enter Merchant Id')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Merchant Id')" v-model="ccav_client_id" required="">
  </div>
  
  <div class="form-group">
    <label for="api-key">{{t('Enter Access Code')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Access Code')" v-model="ccav_client_secret" required="">
  </div>
<div class="form-group">
    <label for="api-key">{{t('Enter Working Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Working Key')" v-model="ccav_client_salt" required="">
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Select Test or Live Mode')}}</label>
    <select v-model="ccav_type" class="form-control">
      <option value="1">{{t('Live')}}</option>
      <option value="0">{{t('Sandbox/Test')}}</option>
    </select>
  </div>
  <div class="form-group">
    <label for="api-key">{{t('Enter Tax (Will be applied as a percentage)')}}</label>
    <input type="number" class="form-control"  placeholder="t('Enter Applicable Tax')" v-model="ccav_tax" required="">
  </div>
 
  <center><span style="font-size:16px;font-weight: bold;" v-html="err"></span></center>
                  
  <div class="form-group">
  <button type="button" class="btn theme-button form-control btnclr" v-on:click="saveccavenue">{{t('Save')}}</button>
</div>
  </form> 
</div>
</div>
</div>
</div>



</div>

   </div>
 
</div>
</div>
</div>
<script>
  document.onreadystatechange=function(){
    alert(this.readyState);
    if(document.readyState=="complete")
    {alert("test");
      setTimeout(
        function(){
     document.getElementById("editformcontainer").style.display="block";
        },1000);
    }
  };
 
            
  <?php if(isset($title) && strlen($title)>0){echo 'modifytitle("'.$title.'","Payment Integration");';} ?>

</script> 
<style>
.baserow .col-sm-4
{
  margin-bottom:15px;
}
</style>
