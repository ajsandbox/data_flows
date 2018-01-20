
<?php

// Abhinav : Sending the notification to slack channel
// Hook : <url_to_slack_hook>
// Abhinav : Todo : Need to set up a mechanism to remove special characters. 
// Abhinav : Todo : Need to set up a mechanism to setup an image link. 

$message = "*".$cityname." ".$platform." Data*\n".$output; 
$room = "oyo_search_results"; 
$icon = ":smile:"; 
$data = "payload=" . json_encode(array(         
		"channel"       =>  "#{$room}",
        "text"          =>  $message,
        "icon_emoji"    =>  $icon
    ));
$url = "<url_to_slack_hook>";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
echo var_dump($result);
if($result === false)
{
    echo 'Curl error: ' . curl_error($ch);
}
curl_close($ch);

?>