
<?php

include 'ArrayToTextTable.php'; 

// Abhinav : Create the dates and call the API

date_default_timezone_set("Asia/Kolkata");

$tod_date = new DateTime('today');
$tom_date = new DateTime('tomorrow');

$checkindate = $tod_date->format('d')."%2F".$tod_date->format('m')."%2F2016";
$checkoutdate = $tom_date->format('d')."%2F".$tom_date->format('m')."%2F2016";

$cityname = "Gurgaon"; 
$platform = "Web";

$url = "http://www.oyorooms.com/api/search/hotels?additional_fields=best_image%2Croom_pricing%2Cavailability%2Crestrictions%2Call_tags%2Cimages%2Chotel_images%2Ccategory%2Camenities%2Cdominant_color%2Cnew_applicable_filters%2Cadditional_charge_info&available_room_count%5Bcheckin%5D=".$checkindate."&available_room_count%5Bcheckout%5D=".$checkoutdate."&available_room_count%5Bmin_count%5D=1&fields=id%2Cname%2Ccity%2Cstreet%2Ccategory%2Cgeo_location%2Call_tags%2Call_tags_with_details%2Ccategory%2Chotel_type%2Calternate_name&filters%5Bcoordinates%5D%5Blatitude%5D=&filters%5Bcoordinates%5D%5Blongitude%5D=&filters%5Bcoordinates%5D%5Bcity%5D=Gurgaon&pre_apply_coupon_switch=true&rooms_config=1%2C0%2C0&show_prioritization_scores_breakup=true&source=Web+Booking";

// Abhinav : Fetch the data and create array

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);

if($result === false)
{
    echo 'Curl error: ' . curl_error($ch);
}
curl_close($ch);

$p_a = json_decode($result, true);

var_dump($p_a); 

$data = array(); 

for ($count=0;$count<=150;$count++){
    $discountvalue = round(($p_a['hotels'][$count]['pricing'][0]-$p_a['hotels'][$count]['reduced_room_pricing'][0])/$p_a['hotels'][$count]['pricing'][0]*100);
    $data[] = array(
        'ID'=>$p_a['hotels'][$count]['id'], 
        'Hotel'=>$p_a['hotels'][$count]['name'], 
        'Before'=>$p_a['hotels'][$count]['pricing'][0], 
        'After'=> $p_a['hotels'][$count]['reduced_room_pricing'][0],
        'Dis'=> $discountvalue,
        'Priority'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['total']), 
        'MG'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['m_g']),
        'Inventory'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['inventory']),
        'Location'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['location']),
        'CX'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['cust_ex']),
        'H Listing'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['hotel_listing']),
        'C3'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['c3']),
        'Manual'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['manual_param']),
        'Pricing'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['pricing']),
        'FScore'=> round($p_a['hotels'][$count]['prioritization_scores_breakup']['flagship_score'])
        );
}

// Abhinav : Convert the array into a text or an HTML table 

$renderer = new ArrayToTextTable($data);
$renderer->showHeaders(true);

ob_start(); // Abhinav : Capture the terminal output here 
$renderer->render();
$output = ob_get_clean();


?>