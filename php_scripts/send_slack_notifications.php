
<?php

/*
// Abhinav : Sending the notification to slack channel
// Send a JSON string as the payload parameter in a POST request
// Send a JSON string as the body of a POST request

Formatting 
* Message builder : https://api.slack.com/docs/messages/builder?msg=%7B%22text%22%3A%22I%20am%20a%20test%20message%20http%3A%2F%2Fslack.com%22%2C%22attachments%22%3A%5B%7B%22text%22%3A%22And%20here%E2%80%99s%20an%20attachment!%22%7D%5D%7D
* Slack markup language
	* Defining links : "<https://honeybadger.io/path/to/event/|ReferenceError> - UI is not defined"
	* Bold : "asdfasdfasdf *BOLD THIS* "
	* Multiline : "asdfasf \n sfasdfasdf"

Sending attachments 
https://api.slack.com/docs/message-attachments

Abhinav : Future - Add support for message buttons. 

*/

$url = "https://hooks.slack.com/services/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";

$room = "general"; 
$icon = ":fox:"; 
$username = "Trigger Alerts";


// Abhinav : Format the message and the attachments. Can send multiple attachments. 
$message = "This is a test"; 
$attachments = array([
    'fallback' => 'Lorem ipsum',
    'pretext'  => 'Lorem ipsum',
    'color'    => '#ff6600',
    'fields'   => array(
        [
            'title' => 'Title',
            'value' => 'Lorem ipsum',
            'short' => true
        ],
        [
            'title' => 'Notes',
            'value' => 'Lorem ipsum',
            'short' => true
        ]
    ),
    // 'author_name'   =>   'Bobby Tables',
	// 'author_link'   =>   'http://flickr.com/bobby/',
	// 'author_icon'   =>   'http://flickr.com/icons/bobby.jpg',
	'title'         =>   'Slack API Documentation',
	'title_link'    =>   'https://api.slack.com/',
	'text'          =>   'Optional text that appears within the attachment',
	'image_url'     =>   'http://my-website.com/path/to/image.jpg',
	'thumb_url'     =>   'http://example.com/path/to/thumb.png',
	'footer'        =>   'Slack API',
	'footer_icon'   =>   'https://platform.slack-edge.com/img/default_application_icon.png',
	'ts'            =>    123456789
]);

$multiple_attachments = array(
	[
	    'fallback' => 'Lorem ipsum',
	    'pretext'  => 'Lorem ipsum',
	    'color'    => '#ff6600',
	    'fields'   => array(
	        [
	            'title' => 'Title',
	            'value' => 'Lorem ipsum',
	            'short' => true
	        ],
	        [
	            'title' => 'Notes',
	            'value' => 'Lorem ipsum',
	            'short' => true
	        ]
	    )
	],
	[
	    'fallback' => 'Lorem ipsum',
	    'pretext'  => 'Lorem ipsum',
	    'color'    => '#ff6600',
	    'fields'   => array(
	        [
	            'title' => 'Title',
	            'value' => 'Lorem ipsum',
	            'short' => true
	        ],
	        [
	            'title' => 'Notes',
	            'value' => 'Lorem ipsum',
	            'short' => true
	        ]
	    )
	],
);


// Abhinav :  Send the calls and error handling here
$data = "payload=" . json_encode(array(         
		"channel"       =>  "#{$room}",
        "text"          =>  $message,
        "icon_emoji"    =>  $icon,
        "username"      =>  $username,
        "attachments"   =>  $multiple_attachments
    ));

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