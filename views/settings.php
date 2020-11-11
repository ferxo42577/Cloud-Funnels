<?php
  global $is_gcp;
  global $self_hosted_gcp;
  global $cf_available_languages;
?>
<div class="container-fluid">
  <div class="card pb-2  br-rounded" id="hidecard1">
  <ul class="nav nav-tabs md-tabs nav-justified theme-nav rounded-top  d-flex flex-column flex-sm-row" role="tablist">


<li class="nav-item  ">
  <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
    <i class="fas fa-cog pr-2"></i><?php w("General Settings"); ?></a>
</li>

<li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#salessetting" role="tab">
        <i class="fas fa-cog pr-2"></i><?php w("Sales Settings"); ?></a>
</li>

<li class="nav-item">
  <a class="nav-link " data-toggle="tab" href="#membershipsetting" role="tab">
    <i class="fas fa-cog pr-2"></i><?php w("Membership Settings"); ?></a>
</li>

<li class="nav-item">
  <a class="nav-link" data-toggle="tab" href="#404page" role="tab">
    <i class="fas fa-cog pr-2"></i><?php w("404 Page Setup"); ?></a>
</li>

<li class="nav-item">
  <a class="nav-link" data-toggle="tab" href="#setuperror" role="tab">
    <i class="fas fa-cog pr-2"></i><?php w("Setup Membership Error Texts"); ?></a>
</li>

</ul>

  <div class="card-body pb-2" id="hidecard2">
    

        <div class="col-lg-8 offset-lg-2 settingpage">
          <form action="" method="post" enctype="multipart/form-data">
                <div class="tab-content ">
                  <div id="home" class="tab-pane fade in active show ">
                    <h3 class="theme-text  text-sm-center text-md-left"><?php w("General Settings"); ?></h3>
                    <div class="form-group">
                    <label><?php w("Version"); ?></label>
                    <p class="form-control"><?php w("Current version"); ?> <?php echo t(get_option('qfnl_current_version')); ?></p>
                    </div>
                    <div class="form-group">
                      <label><?php w("Installation URL"); ?></label>
                      <input type="url" class="form-control" placeholder="<?php w("Enter installation url"); ?>" name="install_url" value="<?php echo get_option('install_url'); ?>">
                    </div>
                    <?php if(!$is_gcp){ ?>
                              <div class="form-group" data-toggle="tooltip" title="<?php w("If you turn off the router mode it will not work for the funnels whic were created with router mode and vice versa"); ?>">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><input type="checkbox" name="qfnl_router_mode" onchange="routerConfirmDeletion(this)" <?php if (get_option('qfnl_router_mode') == '1') {
                                                                                                                                                            echo "checked";
                                                                                                                                                          } ?>></span>
                                  </div>
                                  <p class="form-control"><?php w("Use Router Mode For Funnels"); ?></p>
                                </div>
                              </div>
                    <?php } ?>
                                                                                                                                              <div class="form-group">
                            <div class="input-group" data-toggle='tooltip' title='<?php w("If you are turning the setting on then please make sure the protocol for the `Installation URL` is also `https` and you are allowed to use HTTPS on this site. (Please clear cache for the funnels after turning it on.)"); ?>'>
                            <div class="input-group-prepend"><span class='input-group-text'><input type="checkbox" name="force_https_funnels_pages" <?php if(get_option('force_https_funnels_pages')=='1'){echo "checked";} ?>></span></div>
                      <p class="form-control"><?php w("Force Loading Pages with HTTPS"); ?><p>                                                                      
                      </div>
                      </div>
                    <?php if($is_gcp && $self_hosted_gcp){ ?>
                    <div class="form-group">
                        <label><?php w("Bucket for storing static files(including directory)"); ?></label>
                        <input type="text" name="self_gcp_bucket" class="form-control" placeholder="<?php w("Enter bucket name for storing static files(including directory)"); ?>"
                        value="<?php echo get_option('self_gcp_bucket'); ?>"
                        >
                    </div>
                    <?php } ?>

                    <div class="form-group">
                      <label><?php w("Select Language"); ?></label>
                      <select name="app_language" class="form-control">
                        <?php
                          foreach($cf_available_languages as $cf_available_languages_index=>$cf_available_languages_value)
                          {
                            $temp_lang_selected="";
                            if(get_option('app_language')==$cf_available_languages_index)
                            {
                              $temp_lang_selected=" selected";
                            }
                            echo "<option value='".$cf_available_languages_index."'".$temp_lang_selected.">".$cf_available_languages_value."</option>";
                          }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <input type="checkbox" name="disable_page_preview" value=1 <?php if(get_option('disable_page_preview')){echo "checked";} ?>>
                          </span>
                        </div>
                        <p class="form-control">Disable page preview to increase performance</p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label><?php w("Default SMTP"); ?></label>
                      <select name="default_smtp" class="form-control">
                        <option value="php" <?php if (get_option('default_smtp') == 'php') {
                                              echo "selected";
                                            } ?>><?php w("Hosting Mailer(PHP Mailer)"); ?></option>
                        <?php
                        $smtp_ob = $info['load']->loadSMTP();
                        $smtps = $smtp_ob->getSMTP('', 1);/*load all*/
                        if ($smtps) {
                          while ($r = $smtps->fetch_object()) {
                            $checked = "";
                            if ($r->id == get_option('default_smtp')) {
                              $checked = "selected";
                            }
                            echo "<option value='" . $r->id . "' " . $checked . ">" . $r->title . "</option>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><input type="checkbox" <?php if(get_option('spin_email')){ echo "checked";} ?> name='spin_email'></span>
                        </div>
                        <p class="form-control"><?php w("Use spinner for emails"); ?></p>
                      </div>
                    </div>
                    <?php if(!$is_gcp){ ?>
                    <div class="form-group">
                      <label><?php w("CRON Command For Email Sequence"); ?></label>
                      <input type="text" class="form-control" value="wget -O - <?php $apiurl = get_option('install_url');
                                                                                $apiurl .= "/index.php?page=schedule_api_runserver";
                                                                                echo $apiurl; ?> >/dev/null 2>&1">
                    </div>
                    <?php }else{ ?>
                    <div class="form-group">
                      <label><?php w("API URL for CRON to send sequenced emails"); ?></label>
                      <input type="text" class="form-control" value="<?php $apiurl = get_option('install_url');
                                                                                $apiurl .= "/index.php?page=schedule_api_runserver";
                                                                                echo $apiurl; ?>">
                    </div>
                    <?php } ?>
                    <div class="form-group">
                      <label><?php w("IPN Security Key"); ?></label>
                      <input type="text" class="form-control" name="ipn_token" id="ipn_token" placeholder="<?php w("Enter Security Key"); ?>" value="<?php echo get_option('ipn_token'); ?>">
                    </div>
                  </div>
                  <div id="salessetting" class="tab-pane fade">
                    <h3 class="theme-text"><?php w("Notification setting for sales."); ?></h3>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><input type="checkbox" <?php if(get_option('sales_notif_email_to_admin_check')){ echo "checked";} ?> name='sales_notif_email_to_admin_check'>
                          </span>
                        </div>
                        <p class="form-control"><?php w("Send notification for sales."); ?>
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><?php w("Choose SMTP"); ?></label>
                      <select name="sales_notif_email_smtp" class="form-control">
                        <option value="php" <?php if (get_option('default_smtp') == 'php') {
                              echo "selected";
                              } ?>><?php w("Hosting Mailer(PHP Mailer)"); ?></option>
                        <?php
                        $smtp_ob = $info['load']->loadSMTP();
                        $smtps = $smtp_ob->getSMTP('', 1);/*load all*/
                        if ($smtps) {
                          while ($r = $smtps->fetch_object()) {
                            $checked = "";
                            if ($r->id == get_option("sales_notif_email_smtp" )) {
                              $checked = "selected";
                            }
                            echo "<option value='" . $r->id . "' " . $checked . ">" . $r->title . "</option>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label><?php w("Choose Product"); ?></label>
                      <div class="dropdown">
                        <button type="button" class="btn border btn-block dropdown-toggle" data-toggle="dropdown">
                          <?php w("Select Product"); ?>
                        </button>
                        <div id="allprooducts" class="dropdown-menu btn-block  pl-2" style="overflow-y: auto;max-height: 150px;"><!-- <label>&nbsp;<input class="mr-3" type="checkbox" name="sales_notif_email_product[]" value="all">all</label> -->
                          <?php 
                          
                          $products_ob = $info['load']->loadSell();
                          $products = $products_ob->getProductIdTitle();/*load all*/
                            
                            if (is_object($products)) {
                              if ($products->num_rows > 0) {
                                
                                $send_product_email = explode(",", get_option( "sales_notif_email_products"));

                                while ($r = $products->fetch_object()) {
                                  if( $send_product_email[0]!=null )
                                  {
                                    if(in_array( $r->id, $send_product_email ) )
                                    {
                                      echo ' <div class=""><label>&nbsp;<input type="checkbox" checked class="mr-3" name="sales_notif_email_product[]" value="'  .  $r->id  . '">' .  $r->title .  ' </label></div>';
                                    
                                    }
                                    else{
                                      echo ' <div class=""><label>&nbsp;<input type="checkbox" class="mr-3" name="sales_notif_email_product[]" value="' .  $r->id  . '" >' .  $r->title .  ' </label></div>';
                                    }
                                  }
                                  else{
                                    echo ' <div class=""><label>&nbsp;<input type="checkbox" class="mr-3" name="sales_notif_email_product[]" value="' .  $r->id  . '" checked>' .  $r->title .  ' </label></div>';
                                  }
                                }
                              }
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><?php w("Add emails where to send notification (One on each line)"); ?></label>
                      <textarea rows="2" class="form-control" name="sales_notif_email_to_admin" id="sales_notif_email_to_admin" placeholder="<?php w("Add email"); ?>"><?php $sales_notif_email_admin= get_option("sales_notif_email_to_admin" );$emails = explode(",", $sales_notif_email_admin);foreach ($emails as $email) {echo str_ireplace(" ", "", trim($email))."\r\n";}?></textarea>
                    </div>
                    <h3 class="theme-text mt-5">Cash on delivary email content setup</h3>
                    <div class="form-group mt-4">
                      <div class="alert alert-info">Use the variable <strong>{otp}</strong> any where to replace the OTP.</div>
                      <label>Email Title</label>
                      <input type="text" placeholder="Enter Email Title" class="form-control" name="cod_otp_email_title" value="<?php echo htmlentities(get_option('cod_otp_email_title')) ?>">
                    </div>
                    <div class="form-group">
                      <title>Email Email Content</title>
                      <textarea id="cod_otp_email_content" name="cod_otp_email_content"><?php echo str_replace("\\\\r\\\\n","",str_replace("\&quot;","",str_replace("\\r\\n","",htmlentities(get_option('cod_otp_email_content'))))); ?></textarea>
                      <?php register_tiny_editor('#cod_otp_email_content'); ?>
                    </div>
                  </div>
                  <div id="membershipsetting" class="tab-pane fade">
                  <h3 class="theme-text "><?php w("Membership Settings"); ?></h3>
                    <div class="form-group">
                      <label><?php w("Valid Regular-Expression For Membership Passwords"); ?></label>
                      <input type="text" class="form-control" name="secure_password_regex" id="secure_password_regex" placeholder="<?php w("Enter Regular Expression"); ?>" value="<?php echo htmlentities(base64_decode(get_option('secure_password_regex'))); ?>">
                    </div>
                    <div class="form-group">
                      <?php
                      $fpwdemail = get_option('members_fpwd_mail');
                      $fpwdemail = explode("@fpwdemlbrk@", $fpwdemail);
                      ?>
                      <label><?php w("Forgot Password Email Title For Members"); ?></label>
                      <input type="text" name="fpwdemltitle" class="form-control" value="<?php
                      echo  str_replace("\\","",$fpwdemail[0]); ?>" placeholder="<?php w("Enter Title"); ?>">
                      <label><?php w("Forgot Password Email Content For Members"); ?></label>
                      <textarea name="members_fpwd_mail" class="form-control" placeholder="<?php w("Enter Message"); ?>"><?php if (isset($fpwdemail[1])) {
                                                                                                            echo str_replace("\\","",$fpwdemail[1]);
                                                                                                          } ?></textarea>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <input type="checkbox" name="qfnl_cancel_membership_withsales" <?php if (get_option('qfnl_cancel_membership_withsales') == '1') {
                                                                                              echo "checked";
                                                                                            } ?>>
                          </span>
                        </div>
                        <p class="form-control"><?php w("Cancel membership on purchase cancelation"); ?></p>
                      </div>
                    </div>
                  </div>
                  <div id="404page" class="tab-pane fade">
                  <h3 class="theme-text "><?php w("404 Page Setup"); ?></h3>
                    <div class="form-group">
                      <label><?php w("Select 404 page theme"); ?></label>
                      <div class="input-group">
                        <select class="form-control" name="default_404_page_template" id="default_404_page_template">
                          <?php
                          $unwanterpagetemplate = get_option('default_404_page_template');
                          for ($i = 1; $i <= 2; $i++) {
                            $unwanterpagetemplateselected = ($unwanterpagetemplate == $i) ? "selected" : "";
                            echo "<option value='" . $i . "' " . $unwanterpagetemplateselected . ">".t("Template \${1}",array($i))."</option>";
                          }
                          ?>
                        </select>
                        <div class="input-group-append" style="cursor:pointer;" onclick="window.open('<?php echo get_option('install_url') . '/' . time() . '/?loadtemplate='; ?>'+document.getElementById('default_404_page_template').value,'_blank')"><span class="input-group-text">
                            <i class="fas fa-eye" style="color:#4F5467 !important;"></i>
                          </span></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><?php w("Add Your Go-back Page URL"); ?></label>
                      <input type="url" class="form-control" placeholder="<?php w("Enter Go-Back URL"); ?>" value="<?php echo get_option('default_404_page_url'); ?>" name="default_404_page_url">
                    </div>
                    <div class="form-group">
                      <label><?php w("Add Your Go-back Page Button Text"); ?></label>
                      <input type="text" class="form-control" placeholder="<?php w("Enter Go-Back Button Text"); ?>" value="<?php echo get_option('default_404_page_button_text'); ?>" name="default_404_page_button_text">
                    </div>
                    <div class="form-group">
                      <label><?php w("Add Your Preferred Logo To Display"); ?></label>
                      <div class="input-group">
                        <textarea class="form-control pimg404" style="resize:none;" disabled><?php if (filter_var(get_option('default_404_page_logo'), FILTER_VALIDATE_URL)) {
                                                          echo get_option('default_404_page_logo');
                                                        } else {
                                                          echo t("No Image Uploaded.");
                                                        } ?></textarea>
                        <?php if (filter_var(get_option('default_404_page_logo'), FILTER_VALIDATE_URL)) {
                          echo "<div class='input-group-append'><span class='input-group-text'><a href='" . get_option('default_404_page_logo') . "' target='_BLANK'><i class='fas fa-eye'></i></span></a></div>";
                                                        } ?>                                
                                                       
                        <div class="input-group-append 404imgurl"><span class="input-group-text" style="cursor:pointer;"><i class="fas fa-arrow-circle-up"></i>&nbsp;<?php w("Upload"); ?></span></div>
                        <div class="input-group-append deleteinvalidimage"><span class="input-group-text" style="cursor:pointer;"><i class="fas fa-trash"></i>&nbsp; <?php w("Delete"); ?></span></div>
                        <input type="file" accept="image/*" name="default_404_page_logo" id="default_404_page_logo" style="display:none;">
                        <input type="hidden" name="hiddeninvalidfileurl" id="hiddeninvalidfileurl" value="<?php echo get_option('default_404_page_logo'); ?>">
                      </div>
                      <script>
                        document.getElementsByClassName("deleteinvalidimage")[0].onclick = function() {
                          if (confirmDeletion()) {
                            document.getElementById('hiddeninvalidfileurl').value = '';
                            document.getElementsByClassName("pimg404")[0].innerHTML = t("Please Save To Delete The Image Completely.");
                          }
                        };
                        document.getElementsByClassName("404imgurl")[0].onclick = function() {
                          var invalidfile_doc = document.getElementById("default_404_page_logo");
                          invalidfile_doc.click();
                          invalidfile_doc.onchange = function() {
                            document.getElementsByClassName("pimg404")[0].innerHTML = invalidfile_doc.value;
                          };
                        };
                      </script>
                    </div>
                  </div>
                  <div id="setuperror" class="tab-pane fade">
                  <h3 class="theme-text "><?php w("Setup Membership Error Texts"); ?></h3>
                    <div class="form-group">
                      <label><?php w("Display Alert For Insecure Passwords In Membership"); ?></label>
                      <input type="text" class="form-control" name="not_secure_password_alert" id="not_secure_password_alert" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('not_secure_password_alert')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Authentication Error Alert For Forgot Password"); ?></label>
                      <input type="text" class="form-control" name="fpwd_auth_error" id="fpwd_auth_error" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('fpwd_auth_error')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Error For Passwords That Don’t Match"); ?></label>
                      <input type="text" class="form-control" name="pwd_mismatch_err" id="pwd_mismatch_err" placeholder="<?php w("Enter Text To Display") ?>" value="<?php echo htmlentities(get_option('pwd_mismatch_err')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Error To Display For The User, Trying To Re-Register"); ?></label>
                      <input type="text" class="form-control" name="re_register_err" id="re_register_err" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('re_register_err')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Error For Invalid Email"); ?></label>
                      <input type="text" class="form-control" name="invalid_email_err" id="invalid_email_err" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('invalid_email_err')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Error for unauthorized access"); ?></label>
                      <input type="text" class="form-control" name="un_auth_access_err" id="un_auth_access_err" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('un_auth_access_err')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Error For Non-existing Users"); ?></label>
                      <input type="text" class="form-control" name="usr_does_not_exist_err" id="usr_does_not_exist_err" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('usr_does_not_exist_err')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Invalid Login Credentials Error"); ?></label>
                      <input type="text" class="form-control" name="invalid_login_credntials_err" id="invalid_login_credntials_err" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('invalid_login_credntials_err')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Error For Unsent Emails"); ?></label>
                      <input type="text" class="form-control" name="snd_email_err" id="snd_email_err" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('snd_email_err')); ?>">
                    </div>
                    <div class="form-group">
                      <label><?php w("Error For Membership Cancelation"); ?></label>
                      <input type="text" class="form-control" name="qfnl_membership_cancelation_message" id="snd_email_err" placeholder="<?php w("Enter Text To Display"); ?>" value="<?php echo htmlentities(get_option('qfnl_membership_cancelation_message')); ?>">
                    </div>
                  </div>
                </div>

            <div class="form-group">
              <input type="submit" name="save_settings" id="savesetting" class="btn theme-button btnclr float-right" style="margin-bottom:10px;" value="<?php w("Save Setting"); ?>" onsubmit="return false">
            </div>

            <br>
          </form>
        </div>
 
    </div>
  </div>
</div>
<script>
  function routerConfirmDeletion(doc) {
    if (!confirmDeletion()) {
      if (doc.checked) {
        doc.checked = false;
      } else {
        doc.checked = true;
      }
    }
  }
</script>
<style>
.nav-tabs a.nav-link
{
  height: 100%;
  vertical-align: middle;
}
</style>