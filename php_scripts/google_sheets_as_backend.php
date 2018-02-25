<?php

/*

Abhinav : 
Can be used if we dont want a backend for prototyping 

Sample sheet 
Spreadsheet : https://docs.google.com/spreadsheets/d/1x9slI6Ycm1v_5IP3RQHjFz0KWJ3jbocikw0-pS5fEww/edit#gid=0
Shareable link : https://docs.google.com/spreadsheets/d/1x9slI6Ycm1v_5IP3RQHjFz0KWJ3jbocikw0-pS5fEww/edit?usp=sharing
Published to web : https://docs.google.com/spreadsheets/d/e/2PACX-1vTYArAvESEP-q1lLV4zIb8NxWIFdn4h8bM6dlkKzp_pW3DekMSbIrXo3-UEUElMmY6Knrl-BJQ1deCk/pubhtml

*/

$spreadsheetID = "1x9slI6Ycm1v_5IP3RQHjFz0KWJ3jbocikw0-pS5fEww";
$url = "https://spreadsheets.google.com/feeds/list/".$spreadsheetID."/od6/public/basic?alt=json"; // path to your JSON file
$result = file_get_contents($url);
$jsonresult = json_decode($result,true);
var_dump($jsonresult);

/* 

Further development : One has options of being able to query it, filter it etc. 

For using airtable to access :- 
https://medium.com/row-and-table/an-basic-intro-to-the-airtable-api-9ef978bb0729

*/

?>
