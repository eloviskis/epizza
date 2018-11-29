<?php


function request_api($endpoint,$method,$labels)
{
	$api_url = "http://api.epizzaonline.com.br/";
	
	
	$content = json_encode($labels);

	$curl = curl_init($api_url.$endpoint);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
			array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

	$json_response = curl_exec($curl);

	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status != 200 ) {
		die("Error: call to URL $api_url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
	}


	curl_close($curl);

	return json_decode($json_response, true);
	
}
/*
// login
$parameters = array(
  'email' => 'gilbertojb@gmail.com',
  'password' => 'aaaa102030'
);


var_dump(request_api('admin/auth/signin','POST',$parameters));
*/

function request_api_text_plan($endpoint,$auth)
{
	$api_url = "http://api.epizzaonline.com.br/";
	
	

	$curl = curl_init($api_url.$endpoint);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
										  'Authorization: Bearer '.$auth,
										  'Content-Type: text/plain; charset=utf-8',
										]);

	$json_response = curl_exec($curl);

	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status != 200 ) {
		die("Error: call to URL $api_url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
	}


	curl_close($curl);

	return $json_response;
	
}

var_dump(request_api_text_plan('admin/accounts','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9hcGkuZXBpenphb25saW5lLmNvbS5ici9hZG1pbi9hdXRoL3NpZ25pbiIsImlhdCI6MTU0MjkxNzg0NSwiZXhwIjoxNTQyOTIxNDQ1LCJuYmYiOjE1NDI5MTc4NDUsImp0aSI6ImFiVFo4eGJ2RjBxcU5QZUwifQ.0fiwhBdosE48qr7qLN15DS3VhVVpOOVFx5GzdiW3jzo'));