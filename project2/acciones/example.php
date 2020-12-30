<?php
set_time_limit(0);
$api_key = '72cc34357f672e454be7b0db9162c7c396aa0bf370a4b588220ce922e2701e72';
$service_name = 'Tinder';
$country = 'UK';
$max_wait_time = 600;
// Get Phone Number & Activation ID
$url = "https://www.smsactivate.com/api/sms.php?action=get_number&service_name=".$service_name."&country=".$country."&api_key=".$api_key;
$content = json_decode(Return_Content($url));
// Check For Error
if(isset($content->error)){
	die($content->error);
}
// Set Variables
$activation_id = $content->activation_id;
$number = $content->number;
$balance = $content->balance;

// USE PHONE NUMBER

// END USE PHONE NUMBER

// Lookup SMS
$url = "https://www.smsactivate.com/api/sms.php?action=get_sms&activation_id=".$activation_id."&api_key=".$api_key;
for($i=0;$i<($max_wait_time/10);$i++){
	$content = json_decode(Return_Content($url));
	// Check For Error
	if(isset($content->error)){
		die($content->error);
	}
	// Check Status
	if($content->status=="SMS Received"){
		$activation_code = $content->verification_code;
		$full_sms = $content->full_sms;

		echo json_encode($activation_code);
		break;
	}if($content->status=="Awaiting SMS"){
		// SMS Not Yet Arrived
		sleep(10);
	}if($content->status=="Cancelled"){
		die($content->status);
	}if($content->status=="Not Found"){
		die($content->status);
	}
}
// Use $activation_code




// CURL Get URL
function Return_Content($url){
    $ch = curl_init();	
	curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => true, 
    CURLOPT_HEADER => 0,
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_CONNECTTIMEOUT => 10,
	CURLOPT_TIMEOUT => 120,
	CURLOPT_SSL_VERIFYHOST => 0,
	CURLOPT_SSL_VERIFYPEER => 0,
	));
    curl_setopt($ch, CURLOPT_URL, $url); 
    $result = curl_exec($ch);  
    curl_close($ch);
	return $result;
	}
?>