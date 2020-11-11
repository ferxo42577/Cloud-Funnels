<?php 
// print_r($info);
if (isset($_GET['auto'])) {
  // echo $_GET['auto'];
$id = $_GET['auto'];
$mysqli=$info['mysqli'];
$pref=$info['dbpref'];
$sql="select * from `".$pref."quick_autoresponders` WHERE id=".$id;

$result = $mysqli->query($sql);
$res = $result->fetch_assoc();
$num = $result->num_rows;
// print_r($res);
$jsonarr = json_decode($res['autoresponder_detail']);
// print_r($jsonarr->apikey);
$id = $res['id'];
$title = $res['autoresponder'];
$autoresponder_name=$res['autoresponder_name'];
$japikey = $jsonarr->apikey;
$japiurl = $jsonarr->apiurl;
$jlistid = $jsonarr->listid;
$jaccesstoken = $jsonarr->accesstoken;
$jcampid = $jsonarr->campaignid;
$jappid = $jsonarr->appid;

}
?>

<div class="container-fluid">
<div class="row">
<div class="col-sm-12"> 

    <div id="vueshowforms">

      <input type="hidden" id="autoid" value="<?php if(isset($id)){ echo $id; } else{ echo ""; } ?>">
      <input type="hidden" id="autoname" value="<?php if(isset($autoresponder_name)){ echo $autoresponder_name; } else{ echo ""; } ?>">
      <input type="hidden" id="edittitle" value="<?php if(isset($title)){ echo $title; } else{ echo ""; } ?>">
      <input type="hidden" id="editapikey" value="<?php if(isset($japikey)){ echo $japikey; } else{ echo ""; } ?>">
      <input type="hidden" id="editapiurl" value="<?php if(isset($japiurl)){ echo $japiurl; } else{ echo ""; } ?>">
      <input type="hidden" id="editlistid" value="<?php if(isset($jlistid)){ echo $jlistid; } else{ echo ""; } ?>">
      <input type="hidden" id="editaccesstkn" value="<?php if(isset($jaccesstoken)){ echo $jaccesstoken; } else{ echo ""; } ?>">
      <input type="hidden" id="editcampid" value="<?php if(isset($jcampid)){ echo $jcampid; } else{ echo ""; } ?>">
      <input type="hidden" id="editappid" value="<?php if(isset($jappid)){ echo $jappid; }else{ echo ""; } ?>">

<div class="baserow row" v-if="mainblock">
  

<div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/mailengine.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/mailengine.png'" v-on:click="showForm('mailengine')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Mail Engine</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/activecampaign.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/activecampaign.png'" v-on:click="showForm('activecampaign')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Active Campaign</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/constant_contact.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/constant_contact.png'" v-on:click="showForm('constantcont')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Constant Contact</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>    
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/get-response.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/get-response.png'"  v-on:click="showForm('getresponse')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Get Response</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>    
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/HubSpot.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/HubSpot.png'"  v-on:click="showForm('hubspot')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">HubSpot</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>    
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/Mailchimp-Logo.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/Mailchimp-Logo.png'"  v-on:click="showForm('mailchimp')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Mail Chimp</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>    
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/ontraportlogo.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/ontraportlogo.png'" v-on:click="showForm('ontraport')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">OntraPort</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>    
           
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/aweber.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/aweber.png'" v-on:click="showForm('aweber')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Aweber</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/sendiio.png" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/sendiio.png'" v-on:click="showForm('sendiio')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Sendiio</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/mymailit.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/mymailit.jpg'" v-on:click="showForm('mymailit')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">myMailIt</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/mailwizz.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/mailwizz.jpg'" v-on:click="showForm('mailwizz')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Mailwizz</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/moosend.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/moosend.jpg'" v-on:click="showForm('moosend')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">MooSend</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/mautic.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/mautic.jpg'" v-on:click="showForm('mautic')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">Mautic</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pnl cursor-pointer">
                <div class="card-body"><img src="./assets/img/mailerlite.jpg" onmouseover="this.src='./assets/img/hover-logo.png'" onmouseout="this.src='./assets/img/mailerlite.jpg'" v-on:click="showForm('mailerlite')" alt="Integration" class="card-img-top img-fluid">
                  <div class="card-block border-top">
                    <h4 class="card-title">MailerLite</h4>
                    <p class="card-text">{{t('Click the image for the integration')}}</p>
                  </div>
                </div>
              </div>
            </div>

            </div>
               
                


            
<div id="editorformcontainer" style="display:none;">
<!-- Mail Engine Starts -->           
<div class="overlay" v-if="mailengine">
  <div class="api-forms">
   <div class="card pnl visual-pnl">
  <div class="card-header">
     <div class="row">
    
    <div class="col-md-12">
                            {{t('${1} API Settings',['MailEngine'])}}
                            <span class="closebutton" v-on:click="closeForm('mailengine')"><i class="fas fa-times-circle"></i></span>
                          </div>
  </div>
  </div>
    <div class="card-body">
      <form method="post">
      <div class="form-group">
    <label for="title">{{t('Enter Title')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Title')" v-model="mailengine_title" required="">
  </div>

      <div class="form-group">
    <label for="api-key">{{t('Enter API Key')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter API Key')" v-model="mailengine_apikey" required="">
  </div>
  
    <div class="form-group">
    <label for="api-url">{{t('Enter API URL')}}</label>
    <input type="url" class="form-control"  v-bind:placeholder="t('Enter API URL')" v-model="mailengine_apiurl" required="">
  </div>

  <div class="form-group">
    <label for="api-url">{{t('Enter List ID')}}</label>
    <input type="text" class="form-control" v-bind:placeholder="t('Enter List ID')" v-model="mailengine_listid" required="">
  </div>

  <div class="form-group">
    <label for="email">{{t('Enter Email')}}</label>
    <input type="text" class="form-control"  v-bind:placeholder="t('Enter Unique Email ID Which Not Present In List')" v-model="mailengine_email" required="">
  </div>

  <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

  <div class="form-group">
  <button type="button" class="btn theme-button  form-control btnclr" v-on:click="saveMailEngine($event)">{{t('Authenticate & Save')}}</button>
</div>

  </form>
    </div>
  </div>
</div>
</div>
<!-- -------- -->
                <div class="overlay" v-if="activecampaign">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['ActiveCampaign'])}}
                            <span class="closebutton" v-on:click="closeForm('activecampaign')"><i class="fas fa-times-circle"></i></span>
                          </div>

                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="active_title" required="">
                          </div>

                          <div class="form-group">
                            <label for="api-key">{{t('Enter API Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Key')" v-model="active_apikey" required="">
                          </div>

                          <div class="form-group">
                            <label for="api-url">{{t('Enter API URL')}}</label>
                            <input type="url" class="form-control" v-bind:placeholder="t('Enter API URL')" v-model="active_apiurl" required="">
                          </div>

                          <div class="form-group">
                            <label for="api-url">{{t('Enter List ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter List ID')" v-model="active_listid" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  form-control btnclr" v-on:click="saveactivecampaign($event)">{{t('Authenticate & Save')}}</button>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" v-if="mailchimp">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['MailChimp'])}}
                            <span class="closebutton" v-on:click="closeForm('mailchimp')"><i class="fas fa-times-circle"></i></span>
                          </div>

                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="mail_title" required="">
                          </div>


                          <div class="form-group">
                            <label for="api-key">{{t('Enter API Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Key')" v-model="mail_apikey" required="">
                          </div>

                          <div class="form-group">
                            <label for="list-id">{{t('Enter List ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter List ID')" v-model="mail_listid" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="mail_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  form-control btnclr" v-on:click="savemailchimp($event)">{{t('Authenticate & Save')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" style="" v-if="getresponse">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['GetResponse'])}}
                            <span class="closebutton" v-on:click="closeForm('getresponse')"><i class="fas fa-times-circle"></i></span>
                          </div>

                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="get_title" required="">
                          </div>

                          <div class="form-group">
                            <label for="api-key">{{t('Enter API Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Key')" v-model="get_apikey" required="">
                          </div>

                          <div class="form-group">
                            <label for="campaign-id">{{t('Enter Campaign ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Campaign ID')" v-model="get_campaignid" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="get_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="savegetresponse($event)">{{t('Authenticate & Save')}}</button>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" style="" v-if="constantcont">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['ConstantContact'])}}
                            <span class="closebutton" v-on:click="closeForm('constantcont')"><i class="fas fa-times-circle"></i></span>
                          </div>

                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="const_title" required="">
                          </div>

                          <div class="form-group">
                            <label for="api-key">{{t('Enter API Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Key')" v-model="const_apikey" required="">
                          </div>

                          <div class="form-group">
                            <label for="campaign-id">{{t('Enter Access Token')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Access Token')" v-model="const_token" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="const_email" required="">
                          </div>

                          <div class="form-group">
                            <label for="campaign-id">{{t('Enter List ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter List ID')" v-model="const_listid" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="saveconstantcont($event)">{{t('Authenticate & Save')}}</button>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" style="" v-if="ontraport">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['Ontraport'])}}
                            <span class="closebutton" v-on:click="closeForm('ontraport')"><i class="fas fa-times-circle"></i></span>
                          </div>

                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="ontra_title" required="">
                          </div>

                          <div class="form-group">
                            <label for="api-key">{{t('Enter API Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Key')" v-model="ontra_apikey" required="">
                          </div>

                          <div class="form-group">
                            <label for="campaign-id">{{t('Enter APP ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter APP ID')" v-model="ontra_appid" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="ontra_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="saveontraport($event)">{{t('Authenticate & Save')}}</button>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" style="" v-if="hubspot">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings')}}
                            <span class="closebutton" v-on:click="closeForm('hubspot')"><i class="fas fa-times-circle"></i></span>
                          </div>

                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="hub_title" required="">
                          </div>


                          <div class="form-group">
                            <label for="api-key">{{t('Enter HAPI Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter HAPI Key')" v-model="hub_apikey" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="hub_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="savehubspot($event)">{{t('Authenticate & Save')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" style="" v-if="aweber">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['Aweber'])}}
                            <span class="closebutton" v-on:click="closeForm('aweber')"><i class="fas fa-times-circle"></i></span>
                          </div>



                        </div>
                      </div>
                      <div class="card-body">
                      <div class="alert alert-info">
                        <span class="text-primary" style="cursor:pointer;" onclick="(function(){window.open('http://cloudfunnels.in/membership/api/aweber/create','_blank','location=yes,height=570,width=520,scrollbars=yes,status=yes');})()"><strong>
                        <?php w('${1}Click Here${2} to generate Aweber credentials',array(
                          "",
                          "</strong></span>"
                        )); ?>
                      </div>
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="cus_title" required="">
                          </div>
                          <div class="form-group">
                            <label for="account-id">{{t('Enter Authentication ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Authentication ID')" v-model="acc_id" required="">
                          </div>

                          <div class="form-group">
                            <label for="list-id">{{t('Enter List Id')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter List ID')" v-model="list_id" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="email" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="cus_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="saveaweber">{{t('Authenticate & Save')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="overlay" v-if="mailwizz">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['MailWizz'])}}
                            <span class="closebutton" v-on:click="closeForm('mailwizz')"><i class="fas fa-times-circle"></i></span>
                          </div>

                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="mailwizz_title" required="">
                          </div>
                          <div class="form-group">
                            <label for="api-url">{{t('Enter API URL')}}</label>
                            <input type="url" class="form-control" v-bind:placeholder="t('Enter API URL')" v-model="mailwizz_apiurl" required="">
                          </div>
                          <div class="form-group">
                            <label for="api-url">{{t('Enter API Public Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Public Key')" v-model="mailwizz_apipublic" required="">
                          </div>
                          <div class="form-group">
                            <label for="api-url">{{t('Enter API Private Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Private Key')" v-model="mailwizz_apiprivate" required="">
                          </div>

                          <div class="form-group">
                            <label for="api-url">{{t('Enter List ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter List ID')" v-model="mailwizz_listid" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="email" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="mailwizz_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="err"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  form-control btnclr" v-on:click="saveMailwizz($event)">{{t('Authenticate & Save')}}</button>
                          </div>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" style="" v-if="moosend">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['Moosend'])}}
                            <span class="closebutton" v-on:click="closeForm('moosend')"><i class="fas fa-times-circle"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" placeholder="Enter Title" v-model="moos_title" required="">
                          </div>

                          <div class="form-group">
                            <label for="consumer-key">{{t('Enter API Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Key')" v-model="moos_apikey" required="">
                          </div>

                          <div class="form-group">
                            <label for="list-id">{{t('Enter List ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter List ID')" v-model="moos_listid" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="email" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="moos_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="saveMoosend($event)">{{t('Authenticate & Save')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" style="" v-if="mautic">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['Mautic'])}}
                            <span class="closebutton" v-on:click="closeForm('mautic')"><i class="fas fa-times-circle"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="alert alert-warning">
                        If the API credentials not working please follow the direction given below in your Mautic App.<br>
                        In  Configuration -> System Settings -> Path to the cache directory | you HAVE TO change the Path to the cache directory to a path outside of the Mautic installation location.
                        </div>
                        <form method="post">

                        <div class="form-group">
                            <label for="">{{t('Enter Title')}}</label>
                            <input type="text" v-bind:placeholder="t('Enter Title')" class="form-control" v-model="mautic_title">
                          </div>

                          <div class="form-group">
                            <label for="title">{{t('Enter the base URL for for your Mautic installation')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter URL')" v-model="mautic_apiurl" required="">
                          </div>

                          <div class="form-group">
                            <label for="consumer-key">{{t('Enter Username')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Username')" v-model="mautic_api_key" required="">
                          </div>

                          <div class="form-group">
                            <label for="consumer-key">{{t('Enter Password')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Password')" v-model="mautic_api_secret" required="">
                          </div>

                          <div class="form-group">
                            <label for="list-id">{{t('Enter List/Segment ID')}} ({{t('optional')}})</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter List/Segment ID')" v-model="mautic_api_listid" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="email" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="mautic_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="err"></span></center>
                          <div class="form-group">
                              <button type="button" class="btn theme-button  btnclr form-control" v-on:click="saveMautic($event)">{{t('Authenticate & Save')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="overlay" style="" v-if="sendiio">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                            {{t('${1} API Settings',['Sendiio'])}}
                            <span class="closebutton" v-on:click="closeForm('sendiio')"><i class="fas fa-times-circle"></i></span>
                          </div>



                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="sendiio_title" required="">
                          </div>

                          <div class="form-group">
                            <label for="consumer-key">{{t('Enter API Token')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Key')" v-model="sendiio_apikey" required="">
                          </div>

                          <div class="form-group">
                            <label for="consumer-secret">{{t('Enter API Secret')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter API Secret')" v-model="sendiio_secret" required="">
                          </div>

                          <div class="form-group">
                            <label for="list-id">{{t('Enter List ID')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter List ID')" v-model="sendiio_listid" required="">
                          </div>

                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="email" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="sendiio_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" v-html="err"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="saveSendiio($event)">{{t('Authenticate & Save')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="overlay" style="" v-if="mymailit">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                          {{t('${1} API Settings',['Mymailit'])}}
                            <span class="closebutton" v-on:click="closeForm('mymailit')"><i class="fas fa-times-circle"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="alert alert-warning"><i class="fas fa-info-circle"></i>&nbsp;{{t('After authentication, Please check your connected list manually whether it sored the email that you entered here for authentication')}}</div>
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="mymailit_title" required="">
                          </div>
                          <div class="form-group">
                            <label for="consumer-key">{{t('Enter Form Id')}}&nbsp;<strong style="cursor:pointer;">(<span class="text-primary" v-on:click="getMyMailItId()">{{t('Generate Form ID From Your MyMailIt Standard Form Embed Code')}}</span>)</strong></label>
                            <input type="text" class="form-control mymailitformid" v-bind:placeholder="t('Enter Form Id')" v-model="mymailit_apikey" required="">
                          </div>
                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="email" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="mymailit_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" class="mymailiterr" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="saveMymailit($event)">{{t('Authenticate & Save')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="overlay" style="" v-if="mailerlite">
                  <div class="api-forms">
                    <div class="card pnl visual-pnl">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-12">
                          {{t('${1} API Settings',['Mailer-Lite'])}}
                            <span class="closebutton" v-on:click="closeForm('mailerlite')"><i class="fas fa-times-circle"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="title">{{t('Enter Title')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Title')" v-model="mailerlite_title" required="">
                          </div>
                          <div class="form-group">
                            <label for="consumer-key">{{t('Enter Api Key')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Api Key')" v-model="mailerlite_apikey" required="">
                          </div>
                          <div class="form-group">
                            <label for="consumer-key">{{t('Enter Group Id')}}</label>
                            <input type="text" class="form-control" v-bind:placeholder="t('Enter Group Id')" v-model="mailerlite_listid" required="">
                          </div>
                          <div class="form-group">
                            <label for="email">{{t('Enter Email')}}</label>
                            <input type="email" class="form-control" v-bind:placeholder="t('Enter Unique Email ID Not Present In List')" v-model="mailerlite_email" required="">
                          </div>

                          <center><span style="font-size:16px;font-weight: bold;" class="err" v-html="t(err)"></span></center>

                          <div class="form-group">
                            <button type="button" class="btn theme-button  btnclr form-control" v-on:click="saveMailerlite($event)">{{t('Authenticate & Save')}}</button>
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
  <?php
  if(isset($title) && strlen($title)>0)
  {
  echo 'modifytitle("'.$title.'","Autoresponders");';
  }
  ?>
</script>
<style>
  .api-forms .card-body
  {
    max-height:500px;
    overflow:auto;
  }
</style>  