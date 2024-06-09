<?php
error_reporting(0);
function completeTask($id,$headers){
$url = "https://api.yescoin.gold/task/finishTask";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $id);
return curl_exec($ch);
}
//$token = file_get_contents("token.txt");
$headers = [
    "accept: application/json, text/plain, */*",
    "accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7",
    "content-type: application/json",
    "origin: https://www.yescoin.gold",
    //"priority: u=1, i",
    "referer: https://www.yescoin.gold/",
    "token: GANTI TOKEN DISINI",
    "user-agent: GANTU USER AGENT DISINI"
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.yescoin.gold/task/getCommonTaskList");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);
$responseData = json_decode($response, true);
if ($responseData && isset($responseData['data'])) {
    foreach ($responseData['data'] as $task) {
       $taskId = $task['taskId'];
       $complete = completeTask($taskId,$headers);
	   $jsT = json_decode($complete, true);
	   if($jsT['code'] == 0){
				$bonusAmount = $jsT['data']['bonusAmount'];
		   		$coin = number_format($bonusAmount,0,',','.');
        echo "\033[32mSuccess Bonus: ".$coin." coin\033[0m\n";
	   }else{
		echo "\033[32m".$taskId." : ".$jsT['message']." \033[0m\n";
	   }
    }
} else {
        echo "\033[31mInvalid!\033[0m\n";  
}

?>
