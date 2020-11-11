<?php
class Zapier_integration
{
    var $api_url;
    var $zap_token;
    var $load;
    function __construct($arr)
    {
        $this->api_url="http://cloudfunnels.in/membership/api/api_zapier";
        $this->zap_token=hash_hmac('sha1',get_option('zapier_token'),get_option('site_token'));
        $this->load=$arr['load'];
    }
    function addToZapierIntegration()
    {
        if(get_option('valid_user_data'))
        {
        $paymentdata=json_decode(cf_enc(get_option('valid_user_data'),'decrypt'));
        if(isset($paymentdata->custemail))
        {
        $callbackurl=get_option('install_url');
        $callbackurl .="/index.php?page=api_request";
        $arr=array('add_to_zap'=>1,'purchase_email'=>$paymentdata->custemail,'order_code'=>'','cf_verification_code'=>$this->zap_token,'callback_url'=>$callbackurl);
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$this->api_url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        $res=curl_exec($ch);
        curl_close($ch);
        $res=json_decode($res);
        if(isset($res->api_id))
        {
            if(!get_option('zapier_auth_id'))
            {
                add_option('zapier_auth_id',$res->api_id);
            }
            else
            {
                update_option('zapier_auth_id',$res->api_id);
            }
            return 1;
        }
    }
        }
    return 0;
    }
    function showLeadsToZapier($auth_id)
    {
        $user_ob=$this->load->loadUser();
        if($user_ob->userDataIsValid())
        {
        if($auth_id==$this->zap_token)
        {
        $optin_ob=$this->load->loadOptin();
        return $optin_ob->getOptionForSpecifcPagesforZapier();
        }
        else
        {
            return 0;
        }
        }
    }
}
?>