<?php
use markroland\Ontraport\Ontraport as Ontra;
use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;

class Autoresponder
{
	var $mysqli;   
	var $dbpref;  
	function __construct($arr)
	{
		$this->mysqli=$arr['mysqli'];
		$this->dbpref=$arr['dbpref'];
	}
	function saveApiDetails()
	{     
     	$mysqli=$this->mysqli;
		$pref=$this->dbpref;
		$apikey = $_POST['apikey'];
		$apiurl = $_POST['apiurl'];
		$autotype = $_POST['autotype'];
		$listid = $_POST['listid'];
		$campid = $_POST['campid'];
		$access_token = $_POST['accesstoken'];
		$appid = $_POST['appid'];
		$email = $_POST['email'];
		$date= time();
		$title = $_POST['title'];
		$autoid = $_POST['autoid'];
		
		$apikey = $mysqli->real_escape_string($apikey);
		$apiurl = $mysqli->real_escape_string($apiurl);
		$autotype = $mysqli->real_escape_string($autotype);
		$listid = $mysqli->real_escape_string($listid);
		$campid = $mysqli->real_escape_string($campid);
		$access_token = $mysqli->real_escape_string($access_token);
		$appid = $mysqli->real_escape_string($appid);
		$email = $mysqli->real_escape_string($email);
		$title = $mysqli->real_escape_string($title);
		$autoid = $mysqli->real_escape_string($autoid);

		$jsonarr = array('apikey'=>$apikey,'apiurl'=>$apiurl,'listid'=>$listid,'campaignid'=>$campid,'accesstoken'=>$access_token,'appid'=>$appid);

		$jsonencode = json_encode($jsonarr);

	
			if (is_numeric($autoid)) {
			$sql = "UPDATE `".$pref."quick_autoresponders` set `autoresponder`='".$title."',`autoresponder_name`='".$autotype."',`autoresponder_detail`='".$jsonencode."' where `id`='".$autoid."'";
			}
			else{
		$sql="INSERT INTO `".$pref."quick_autoresponders` (`autoresponder`, `autoresponder_name`, `autoresponder_detail`, `exf`, `date_created`) VALUES ('".$title."','".$autotype."','".$jsonencode."','','".$date."')";
	}
// 	print_r($sql);
if($autotype=="mailengine")
{
	$autheticate_mailengine=self::mailengine($jsonencode,"",$email);
	if($autheticate_mailengine)
	{
	if($mysqli->query($sql))
	{
		return 1;
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
if($autotype=="mailerlite")
{
	$autheticate_mailerlite=self::mailerlite($jsonencode,"",$email);
	if($autheticate_mailerlite)
	{
	if($mysqli->query($sql))
	{
		return 1;
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
if($autotype=="mautic")
{
	$authenticate_mautic=self::mautic($jsonencode,"",$email);
	if($authenticate_mautic && $mysqli->query($sql))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
if($autotype=="sendiio")
{
	$autheticate_sendiio=self::sendiio($jsonencode,"",$email);
	if($autheticate_sendiio)
	{
	if($mysqli->query($sql))
	{
		return 1;
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
if($autotype=='mailwizz')
{
	$auth_mailwizz=self::mailwizz($jsonencode,"",$email, $test = false);
	if($auth_mailwizz && $mysqli->query($sql))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
if($autotype=="moosend")
{
	$autheticate_moosend=self::moosend($jsonencode,"",$email);
	if($autheticate_moosend)
	{
	if($mysqli->query($sql))
	{
		return 1;
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
if($autotype=="mymailit")
{
	$autheticate_mymailit=self::mymailit($jsonencode,"",$email);
	if($autheticate_mymailit)
	{
	if($mysqli->query($sql))
	{
		return 1;
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
if($autotype == "activecampaign") {
	require_once("activecampaign/includes/ActiveCampaign.class.php");
	$ac = new ActiveCampaign($apiurl,$apikey);
	// TEST API CREDENTIALS.
	// print_r($ac->credentials_test());
	if ($ac->credentials_test() == 1) {
		if($mysqli->query($sql)){
			return 1;
		}
		else{
			return 0;  
		}
	}
}
elseif ($autotype == "mailchimp" ) {
$data_center = substr($apikey,strpos($apikey,'-')+1);
 
$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $listid .'/members';
 
$json = json_encode([
    'email_address' => $email,
    'status'        => 'subscribed', //pass 'subscribed' or 'pending'
]);
 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apikey);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
$result = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
// echo $status_code;
// print_r($result);
if($status_code == 200){
if($mysqli->query($sql)){
			return 1;
		}
		else{
			return 0;  
		}
	}
}
elseif($autotype == "getresponse") {
$addcontacturl = 'https://api.getresponse.com/v3/contacts/';
$data = array (
'email' => $email,
'campaign' => array('campaignId'=> $campid),
);  
$data_string = json_encode($data); 
$ch = curl_init($addcontacturl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',
    'X-Auth-Token: api-key '.$apikey,
)           
);                                                                                        
$result = curl_exec($ch); // Print this If you want to verfify
// print_r($result);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
// echo $status_code;//Returns status code 202 on success
if ($status_code == 202) {
	if($mysqli->query($sql)){
			return 1;
		}
		else{
			return 0;  
		}
}
}
elseif ($autotype == 'constantcont') {
$header[] = "Authorization: Bearer ".$access_token;
$header[] = 'Content-Type: application/json';

$url = "https://api.constantcontact.com/v2/contacts?action_by=ACTION_BY_VISITOR&api_key=".$apikey;
$body = '{
"lists": [
{
"id": "'.$listid.'"
}
],
"confirmed": false,
"email_addresses": [
{
"email_address": "'.$email.'"
}
]
}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
// print_r($status_code); // Returns 201 on success
// print_r($response);
if ($status_code == 201) {
	if($mysqli->query($sql)){
			return 1;
		}
		else{
			return 0;  
		}
}
}

elseif ($autotype == "ontraport") {
	include('ontraport/src/Ontraport.php');
$client = new Ontra($appid,$apikey);
$response = $client->addContact(
	array(
			'Contact Information' => array(
			'Email' => $email
		)
	)
);
// echo $response;

$myXMLData =
"<?xml version='1.0' encoding='UTF-8'?>".$response;

$xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
// print_r($xml);

$json = json_encode($xml);
$array = json_decode($json,TRUE);
// print_r($array[status]);


if($array['status'] ==  "Success"){ 
		if($mysqli->query($sql)){
			return 1;
		}
		else{
			return 0;  
		}
}
else{
    return 0;
}
}

elseif ($autotype == "hubspot") {
	$arr = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => $email
                )
            )
        );
        $post_json = json_encode($arr);
        $hapikey = $apikey;
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact?hapikey=' . $hapikey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_errors = curl_error($ch);
        curl_close($ch);
        if ($status_code == 200) {
        	if($mysqli->query($sql)){
			return 1;
		}
		else{
			return 0;  
		}
        }
}
elseif ($autotype == "aweber")
{
	$add_to_aweber=self::aweber($jsonencode,"",$email);
	if($add_to_aweber===1 && $mysqli->query($sql))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
	else{
		return 0;
	}

}
//generate Auth Mautic
function mautic($credentials,$name,$email,$doo="process")
{
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		return 0;
	}
	$file=rtrim(str_replace("\\","/",__DIR__),"/");
	$file .="/vendor/autoload.php";
	require_once($file);

	$credentials=json_decode($credentials);

	$settings = array(
		'userName'   => $credentials->appid,             // Create a new user       
		'password'   =>  $credentials->apikey             // Make it a secure password
	);
	
	// Initiate the auth object specifying to use BasicAuth
	$initAuth = new ApiAuth();
	$auth = $initAuth->newAuth($settings, 'BasicAuth');

	$apiUrl     = $credentials->apiurl;
	$api        = new MauticApi();
	$contactApi = $api->newApi("contacts", $auth, $apiUrl);

	if(isset($_POST['autotype']) && $_POST['autotype']=='mautic')
	{
		$name="Cloud Funnels";
	}

	$namearr=explode(' ',$name);
	$firstname=$namearr[0];
	$arrlen=count($namearr);
	$lastname="";

	if($arrlen>1)
	{
	$lastname=$namearr[$arrlen-1];
	}

	$data = array(
		'firstname' => $firstname,
		'lastname'  => $lastname,
		'email'     => $email,
		//'ipAddress' => $_SERVER['REMOTE_ADDR'],
		'overwriteWithBlank' => true,
	);
	
	$contact = $contactApi->create($data);
	//print_r($contact);
	//echo $contact;
	if(is_array($contact) && isset($contact['contact']['id']) )
	{
		$listid=trim($credentials->listid);
		if(strlen($listid)>0)
		{
			$segmentApi = $api->newApi("segments", $auth, $apiUrl);
			$response = $segmentApi->addContact($listid, $contact['contact']['id']);
			//print_r($response);
			if (isset($response['success'])) {
				return 1;
			}else{return 0;}
		}else
		{
			return 1;
		}
		//echo $contact['contact']['id'];
	}
	else
	{
		return 0;
	}
	die();
}
//Add emails to list using API
function mailengine($credentials_jsn,$name="",$email="")
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$email = $mysqli->real_escape_string($email);
	$name = $mysqli->real_escape_string($name);
	if(filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$jsonarr = $credentials_jsn; 
		$jsondecode = json_decode($jsonarr);
	
		$apikey = $jsondecode->apikey;
		$apiurl = $jsondecode->apiurl;
		$listid = $jsondecode->listid;

		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$apiurl);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,array('wqaddsubscriber'=>1,'api_auth_key'=>$apikey,'list_id'=>$listid,'name'=>$name,'email'=>$email));
		$res=curl_exec($ch);
		curl_close($ch);
		$res=json_decode($res);
		$jsnerr=json_last_error();
		if($jsnerr ===0)
		{
			return $res->added;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return 0;
	}
}
function activecampaign($credentials_jsn,$name,$email)
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$email = $mysqli->real_escape_string($email);
	$name = $mysqli->real_escape_string($name);


	$namearr=explode(' ',$name);
	$firstname=$namearr[0];
	$arrlen=count($namearr);
	$lastname="";

	if($arrlen>1)
	{
	$lastname=$namearr[$arrlen-1];
	}

	$jsonarr = $credentials_jsn; 
	$jsondecode = json_decode($jsonarr);
	// print_r($jsondecode);
	$apikey = $jsondecode->apikey;
	$apiurl = $jsondecode->apiurl;
	$listid = $jsondecode->listid;
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	require_once("activecampaign/includes/ActiveCampaign.class.php");
	$ac = new ActiveCampaign($apiurl,$apikey);
	// print_r($ac->credentials_test());
	if ($ac->credentials_test() == 1) {
			$contact = array(
		"first_name" => $firstname,
		"last_name" => $lastname,
		"email"     => $email,
		"p[".$listid."]"      => $listid,
		"status[".$listid."]" => 1, // "Active" status and 2 for "Unsubscribed" Status

	);
	$contact_sync = $ac->api("contact/sync", $contact);
	if (!(int)$contact_sync->success) {
		// request failed
		return 0;
	}
    // successful request
	return 1;
	}
	else{
		return 0;
	}
}
else{
	return 0;
}
	
}

function constantcont($credentials_jsn,$name,$email)
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$email = $mysqli->real_escape_string($email);
	$name = $mysqli->real_escape_string($name);


	$namearr=explode(' ',$name);
	$firstname=$namearr[0];
	$arrlen=count($namearr);
	$lastname="";
	if($arrlen>1)
	{
	$lastname=$namearr[$arrlen-1];
	}

	$jsonarr = $credentials_jsn; 
	$jsondecode = json_decode($jsonarr);
	// print_r($jsondecode);
	$apikey = $jsondecode->apikey;
	$accesstoken = $jsondecode->accesstoken;
	$listId = $jsondecode->listid;

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

	$url = "https://api.constantcontact.com/v2/contacts?email=".$email."&status=ALL&limit=50&api_key=".$apikey;

$header[] = "Authorization: Bearer ".$accesstoken;
$header[] = 'Content-Type: application/json';

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = json_decode(curl_exec($ch));
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);


if(!$response->results){
$url = "https://api.constantcontact.com/v2/contacts?action_by=ACTION_BY_VISITOR&api_key=".$apikey;
$body = '{
"lists": [
{
"id": "'.$listId.'"
}
],       
"confirmed": false,
"email_addresses": [
{
"email_address": "'.$email.'"
}
],
"first_name": "'.$firstname.'",
"last_name": "'.$lastname.'",
}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
// print_r($status_code); // Returns 201 on success
// print_r($response);
if ($status_code == 201) {
	return 1;
}
else{
	return 0;
}

}
else{
	return 0;
}
	}
	else{
		return 0;
	}

}

function getresponse($credentials_jsn,$name,$email)
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$email = $mysqli->real_escape_string($email);
	$name = $mysqli->real_escape_string($name);

	$jsonarr = $credentials_jsn; 
	$jsondecode = json_decode($jsonarr);
	// print_r($jsondecode);
	$apikey = $jsondecode->apikey;
	$accesstoken = $jsondecode->accesstoken;
	$campaignid = $jsondecode->campaignid;

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

$addcontacturl = 'https://api.getresponse.com/v3/contacts/';
$data = array (
'name' => $name,
'email' => $email,
'dayOfCycle' => 0, //Autoresponder Day
'campaign' => array('campaignId'=> $campaignid)
);  
$data_string = json_encode($data); 
$ch = curl_init($addcontacturl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',
    'X-Auth-Token: api-key '.$apikey,
)           
);                                                                                         

$result = curl_exec($ch); 
// print_r($result);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
// echo $status_code;//Returns status code 202 on success
if ($status_code == 202) {
	return 1;
}
else{
	return 0;
}

	}
	else{
		return 0;
	}

}

function hubspot($credentials_jsn,$name,$email)
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$email = $mysqli->real_escape_string($email);
	$name = $mysqli->real_escape_string($name);


	$namearr=explode(' ',$name);
	$firstname=$namearr[0];
	$arrlen=count($namearr);
	$lastname="";
	if($arrlen>1)
	{
	$lastname=$namearr[$arrlen-1];
	}

	$jsonarr = $credentials_jsn; 
	$jsondecode = json_decode($jsonarr);
	// print_r($jsondecode);
	$apikey = $jsondecode->apikey;

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$arr = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => $email
                ),
            array(
                    'property' => 'firstname',
                    'value' => $firstname
                ),
            array(
            		'property' => 'lastname',
            		'value' => $lastname
            )
        )
        );
        $post_json = json_encode($arr);
       
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact?hapikey=' . $apikey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_errors = curl_error($ch);
        curl_close($ch);

        // echo "curl Errors: " . $curl_errors;
        // echo "<br>";
        // echo "Status code: " . $status_code;//Status code 200 for success
        // echo "<br>";
        // echo "Response: " . $response;
        if ($status_code == 200) {
        	return 1;
        }
        else{
        	return 0;
        }

    }
    else{
    	return 0;
    }

}

function mailchimp($credentials_jsn,$name,$email)
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$email = $mysqli->real_escape_string($email);
	$name = $mysqli->real_escape_string($name);


	$namearr=explode(' ',$name);
	$firstname=$namearr[0];
	$arrlen=count($namearr);
	$lastname="";
	if($arrlen>1)
	{
	$lastname=$namearr[$arrlen-1];
	}

	$jsonarr =$credentials_jsn; 
	$jsondecode = json_decode($jsonarr);
	// print_r($jsondecode);
	$apikey = $jsondecode->apikey;
	$listid = $jsondecode->listid;

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

$data_center = substr($apikey,strpos($apikey,'-')+1);
 
$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $listid .'/members';
 
$json = json_encode([
    'email_address' => $email,
    'status'        => 'subscribed', //pass 'subscribed' or 'pending'
    'merge_fields'  => array(
        'FNAME' => $firstname,
        'LNAME'    => $lastname,
         ),
]);
 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apikey);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
$result = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
// echo $status_code;
// print_r($result);
if ($status_code == 200) {
	return 1;
}
else{
	return 0;
}
}
else{
	return 0;
}

}

function ontraport($credentials_jsn,$name,$email)
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$email = $mysqli->real_escape_string($email);
	$name = $mysqli->real_escape_string($name);


	$namearr=explode(' ',$name);
	$firstname=$namearr[0];
	$lastname="";
	$arrlen=count($namearr);
	if($arrlen>1)
	{
	$lastname=$namearr[$arrlen-1];
	}

	$jsonarr = $credentials_jsn; 
	$jsondecode = json_decode($jsonarr);
	// print_r($jsondecode);
	$apikey = $jsondecode->apikey;
	$appid = $jsondecode->appid;

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	include('ontraport/src/Ontraport.php');
$client = new Ontra($appid,$apikey);
$response = $client->addContact(
	array(
			'Contact Information' => array(
			'First Name' => $firstname,
			'Last Name' => $lastname,
			'Email' => $email
		)
	)
);
$myXMLData =
"<?xml version='1.0' encoding='UTF-8'?>".$response;

$xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
// print_r($xml);

$json = json_encode($xml);
$array = json_decode($json,TRUE);
// print_r($array[status]);


if($array['status'] ==  "Success"){ 
			return 1;
}
else{
    return 0;
}

}
else{
	return 0;
}
}

function aweber($credentials_jsn,$name,$email)
{
	$data=json_decode($credentials_jsn);
	$arr=array(
		'aweber_auth_token'=>$data->appid,
		'aweber_url_token'=>$data->listid,
		'name'=>$name,
		'email'=>$email
	);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://cloudfunnels.in/membership/api/aweber/add_subscriber");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_POST,true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
	$res=curl_exec($ch);
	if(trim($res)==='1')
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function sendiio($credentials_jsn,$name,$email)
{
	$credentials_jsn=json_decode($credentials_jsn);
	$listid = $credentials_jsn->listid;
	$apitoken = $credentials_jsn->apikey;
	$apisecret = $credentials_jsn->accesstoken;

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

	$url = 'https://sendiio.com/api/v1/lists/subscribe/json';

	$send_arr=array('email_list_id' => $listid,
	'email' => $email);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('token: '.$apitoken.'','secret: '.$apisecret.''));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $send_arr);
	$result = curl_exec($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	$objv = json_decode($result);

	if ($objv->error === 0) {
	return 1;
	}
	else{
	return 0;
	}
	}
	else{
	return 0;
	}
}
function mymailit($credentials_jsn,$name,$email)
{
	$credentials_jsn=json_decode($credentials_jsn);
	//form id
	$formid = $credentials_jsn->apikey;
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
		$url = 'https://www.mymailit.com/members/forms/dosignup.php';
		$send_arr=array('P' => $formid,'name' => $name,
		'email' => $email);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $send_arr);
		$result = curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		//echo $status_code;
		if ($status_code == 200) 
		{
			return 1;
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
function mailwizz($credentials_jsn,$name="",$email="", $test = false)
{
	$file=rtrim(str_replace("\\",'/',__DIR__),"/");
	$file .="/mailwizz-php-sdk-master/MailWizzApi/Autoloader.php";
	require_once($file);

	MailWizzApi_Autoloader::register();

	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$email = $mysqli->real_escape_string($email);
	$name = $mysqli->real_escape_string($name);
	
	/*
	if ($test) {
		$jsonarr = $credentials_jsn; 
		$jsondecode = json_decode($jsonarr);
		
		$config_data = [
		    'apiUrl'        => $jsondecode->apiurl,
		    'publicKey'     => $jsondecode->apikey,
		    'privateKey'    => $jsondecode->accesstoken,
		];
		
		$config = new MailWizzApi_Config($config_data);
		
		MailWizzApi_Base::setConfig($config);
		
		$endpoint = new MailWizzApi_Endpoint_Lists();
		
		$response = $endpoint->getList($jsondecode->listid);
		
		if ($response->getIsSuccess()) {
			return 1;	
		} else {
			return 0;
		}
	}
	*/
	if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$jsonarr = $credentials_jsn; 
		$jsondecode = json_decode($jsonarr);
		
		$config = new MailWizzApi_Config([
		    'apiUrl'        => $jsondecode->apiurl,
		    'publicKey'     => $jsondecode->apikey,
		    'privateKey'    => $jsondecode->accesstoken,
		]);
		
		MailWizzApi_Base::setConfig($config);
		
		$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
		
		//$names = explode(' ', $name);

		$namearr=explode(' ',$name);
		$firstname=$namearr[0];
		$arrlen=count($namearr);
		$lastname="";

		if($arrlen>1)
		{
			$lastname=$namearr[$arrlen-1];
		}
		
		$response = $endpoint->create($jsondecode->listid, [
		    'EMAIL'    => $email, // the confirmation email will be sent!!! Use valid email address
		    'FNAME'    => $firstname,
		    'LNAME'    => $lastname
		]);
		
		//PC::debug(json_encode($response));
		
		
		if ($response->getIsSuccess()) {
			return 1;	
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}
function moosend($credentials_jsn,$name,$email)
{
	$credentials_jsn=json_decode($credentials_jsn);
	$listid = $credentials_jsn->listid;
	$apikey = $credentials_jsn->apikey;

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

	$url='https://api.moosend.com/v3/subscribers/'.$listid.'/subscribe.json?apikey='.$apikey;
	
	$json = json_encode([
    'Name' => $name,
    'Email' => $email, 
]);


	$ch = curl_init($url);
//	curl_setopt($ch, CURLOPT_HTTPHEADER, array('token: '.$apitoken.'','secret: '.$apisecret.''));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	$result = curl_exec($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	$objmoos = json_decode($result);
	

	if ($objmoos->Code === 0) {
	return 1;
	}
	else{
	return 0;
	}
	}
	else{
	return 0;
	}
}
function addToAutoresponder($id,$name,$email)
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$sql = "select * from `".$pref."quick_autoresponders` where id=".$id;
	// print_r($sql);
	$res = $mysqli->query($sql);
	// print_r($res);
	$count = $res->num_rows;
	if($count == 1)
	{
	$resultt = $res->fetch_assoc();
	$autoname = $resultt['autoresponder_name'];
	$credentials=$resultt['autoresponder_detail'];
	return self::$autoname($credentials,$name,$email);
	}
}
function mailerlite($credentials_jsn , $name,$email )
{
	$credentials_jsn=json_decode($credentials_jsn);
	//form id
	
	$apikey = $credentials_jsn->apikey;
	$groupid = $credentials_jsn->listid;
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
		
		$data = [
		  "email" =>  $email,
		  "name"  =>  $name
		        
		];
		$data=json_encode($data);
        $ch = curl_init();
        
        curl_setopt_array($ch, array(
          CURLOPT_URL             =>   "https://api.mailerlite.com/api/v2/groups/".$groupid."/subscribers",
          CURLOPT_RETURNTRANSFER  =>   true,
          CURLOPT_ENCODING        =>   "",
          CURLOPT_MAXREDIRS       =>   10,
          CURLOPT_TIMEOUT         =>   0,
          CURLOPT_FOLLOWLOCATION  =>   true,
          CURLOPT_HTTP_VERSION    =>   CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST   =>   "POST",
          CURLOPT_POSTFIELDS      =>   $data,
          CURLOPT_HTTPHEADER => array(
            "X-MailerLite-ApiKey: ".$apikey."",
            "Content-Type: application/json",
            )
        ));
        
		$response = curl_exec($ch);
		//echo $response;
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
        curl_close($ch);
		if ($status_code == 200) 
		{
			return 1;
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
function getAllAutoresponders()
{
	$mysqli=$this->mysqli;
	$pref=$this->dbpref;
	$sql = "select * from `".$pref."quick_autoresponders` order by id desc";
	$qry=$mysqli->query($sql);
	if($qry->num_rows>0)
	{
		return $qry;
	}
	else
	{
		return 0;
	}
}

}
?>    