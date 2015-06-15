<?php

//getting the question from param 
$ques=$_GET["q"];
$str= rawurldecode($ques); 

//explode the string into parts and find city and type of request
$str_parts=explode(" ",$str);
$size=sizeof($str_parts);

//the last word is city name
$city1= $str_parts[$size-1];
$city1=explode('?',$city1);
$city=$city1[0];
//echo $city;


//get data from API
$service_url = "http://api.openweathermap.org/data/2.5/weather?q=".$city;
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
//echo 'response ok!';

//end of API

//show answer according to type of query

if (strpos($str,'temperature') !== false){
	$reply=$decoded->main->temp." K";

}

elseif (strpos($str,'humidity') !== false){
	$reply=$decoded->main->humidity."";
	
}
elseif (strpos($str,'Clouds')!==false || strpos($str,'clouds')!==false){
	$str= $decoded->weather[0]->main;
	
	if($str=="Clouds") $reply="YES";
	else $reply="NO";

}
elseif (strpos($str,'Rain')!==false || strpos($str,'rain')!==false){
	$str= $decoded->weather[0]->main;
	
	if($str=="Rain") $reply="YES";
	else $reply="NO";
}
elseif (strpos($str,'Clear')!==false || strpos($str,'clear')!==false){
	$str= $decoded->weather[0]->main;
	
	if($str=="Clear") $reply="YES";
	else $reply="NO";
}
else{
	$reply="Dear Kitty, I don't understand what you said!";
}

//Json response
$data = array('answer'=>$reply);
header('Content-Type: application/json');
echo json_encode($data);


//weather coding




//process answers based on type of question




	//now Make JSON response and show
	/*$data = array('answer'=>$reply);
	header('Content-Type: application/json');
	echo json_encode($data);
	*/



?>
