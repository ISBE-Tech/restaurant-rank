<?php

$json = json_decode(file_get_contents('restaurants.json'));
$userrequest = array(
	'Price'		=> 1,
	'Steaks'	=> 10,
	'Shakes'	=> 10
);

//Possible weight implementation on attributes
$sortedrestaurants = array();
$oprestaurant = $opsum = INF;
for($i = 0; $i < sizeof($json->Restaurants); $i++) {
	$sum = 0;
	foreach($json->Restaurants[$i] as $name => $attributes) {
		foreach($userrequest as $attrib => $value) {
			if(property_exists($attributes, $attrib)) $sum += pow(($attributes->$attrib - $value),2);
			else $sum += pow($value,2);
		}
	}
	
	$sortedrestaurants[$i] = array(
		'sum'	=>	$sum,
		'data'	=>	$json->Restaurants[$i]
	);
	if($sum < $opsum) {
		$oprestaurant = $json->Restaurants[$i];
		$opsum = $sum;
	}
}

function cmp_restaurants($a, $b) {
	if(array_key_exists('sum', $a) && array_key_exists('sum', $b)) return $a['sum'] - $b['sum'];
	return 0;
}

usort($sortedrestaurants, 'cmp_restaurants');
for($i = 0; $i < sizeof($sortedrestaurants); $i++) {
	$sortedrestaurants[$i] = $sortedrestaurants[$i]['data'];
}

echo utf8_encode(json_encode($sortedrestaurants));

?>