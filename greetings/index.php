<?php

//getting the question from param : hello
$ques=$_GET["q"];
$str= rawurldecode($ques); 

//explode the string into parts
$str_arr=explode('!', $str,2);
$greet_msg=$str_arr['0'];


//process answers based on type of question



	if($greet_msg=="Hello"){
		$reply="Hello, Kitty!"."I am fine! How are you?";
		echo $reply;
	}
	elseif($greet_msg=="Hi"){
		$reply="Hello, Kitty!"."My name is Rezwan";
		echo $reply;
	}
	elseif($greet_msg=="Good morning"||$greet_msg=="Good evening"||$greet_msg=="Good night"){
		$reply="Hello, Kitty!"."It’s a pleasure to meet you!";
		echo $reply;
	}
	else{
		$reply="Hello, Kitty!"."I don't understand what you want to say,but,I am very happy to meet you!";
	}

	//now Make JSON response and show
	$data = array('answer'=>$reply);
	header('Content-Type: application/json');
	echo json_encode($data);



?>
