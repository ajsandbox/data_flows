
<?php

/*

Abhinav : This is just the tip of the iceberg. 

Can later extend this to following :- 

1) Listen to the updates (This would enable two way conversations) - Commands
2) Send HTML text etc, Photo, Audio Files, Documents, Voice, Videos, SendLocation, SendContacts, Gaming etc
3) Take payments

Note to self : Instead of doing to scratch, it would probably be better to use an SDK. 
Other notes : https://telegram-bot-sdk.readme.io/reference#getme

*/

$apiToken = "548772740:AAGMLl3C2HtVXAUTl_NBQWAwbqEwCMbeZ9k";
$data = [
    'chat_id' => '-271306555',
    'text' => 'Sending from the PHP script!'
];
$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

?>