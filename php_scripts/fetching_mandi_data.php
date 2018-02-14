<?php

/*
JSON decoding can be done in two ways :- 
$object = json_decode( $output );
$total_results = $object->total_results;
OR 
(Using associative arrays)
$array = json_decode( $output, true );
$total_results = $array['total_results'];

https://www.taniarascia.com/how-to-use-json-data-with-php-or-javascript/
*/

// Abhinav : Settings
$baseURL = 'https://api.data.gov.in/resource/9ef84268-d588-465a-a308-a864a43d0070';
$apikey = '579b464db66ec23bdd0000014a4975fa71a04b066c3de6fd8754fa38';

// Abhinav : Get the total number of records
$url = $baseURL.'?format=json&api-key='.$apikey.'&limit=2'; // path to your JSON file
$result = file_get_contents($url);
$jsonresult = json_decode($result,true);
// echo $jsonresult["total"];

// Abhinav : Get all records
$newurl = $baseURL.'?format=json&api-key='.$apikey.'&limit='.$jsonresult["total"]; // path to your JSON file
$result = file_get_contents($newurl);
$jsonresultnew = json_decode($result,true);
$docs = $jsonresultnew["records"];

// Abhinav : Get the file handle 
$my_file = __DIR__.'/indian_mandi_prices__'.date('m-d-Y_hia').'__'.$jsonresult["total"].'.csv';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);

// Store data in file

foreach($docs as $doc)
{	
	$data = "^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["timestamp"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["state"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["district"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["market"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["commodity"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["variety"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["arrival_date"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["min_price"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["max_price"])))."^";
	$data = $data.trim(preg_replace('/\s\s+/', ' ',json_encode($doc["modal_price"])))."^";
	fwrite($handle, $data);
	fwrite($handle, "\n");
}

fclose($handle);

?>
