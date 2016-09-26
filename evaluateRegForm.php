<?php

$xml = file_get_contents("requestTemplate.xml");

foreach($_POST as $fieldName => $value) {

	if ($fieldName == "submit") {}
	else {
		$target = "%" . $fieldName . "%";
		$xml = str_replace($target, $value, $xml);
	}
	
}

$url = "https://xml.sphonic.net";

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);

$data = curl_exec($curl);

curl_close($curl);

$array_data = json_decode(json_encode(simplexml_load_string($data)), true);

print_r('<pre>');
print_r($array_data);
print_r('</pre>');