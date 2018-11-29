<?php
	/*$parameters =  array(
        'password' => 'aaaa102030',
        'email' => 'gilbertojb@gmail.com'
		);*/


	$parameters =  array(
	    "document" => "1058465019",
		"name" => "Pizzaria Mamma Mia",
		"phone" => "7139525835",
		"plan_id" => "1",
		"address" => array(
			"city" => "Sao Paulo",
			"complement" => "",
			"district" => "Massaranduba",
			"number" => "630",
			"state" => "BA",
			"street" => "Avenida Vicêncio Constantino Figueiredo",
			"zip_code" => "40435880"
		  ),
		  "contact" => array(
			"email" => "yguinho5@hotmail.com",
			"name" => "André Giovanni Fernandes",
			"phone_1" => "71989540587",
			"password" => "aaabbb102030"
		  )
		);
	
	$url = "http://api.epizzaonline.com.br/system/signup";    
	$content = json_encode($parameters);

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
			array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

	$json_response = curl_exec($curl);

	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status != 201 ) {
		die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
	}


	curl_close($curl);

	$response = json_decode($json_response, true);
	
	var_dump($response);
	
?>