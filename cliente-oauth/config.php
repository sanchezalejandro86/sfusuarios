<?php

$host = 'http://usuarios.hc.com/app_dev.php';
$client_id = '4_4ag4h45sgrggg80cwcsk0c88owc80ck8c0ccsok4sso0w4os88';
$secret = 'i8t0bdky3mgcc0wkwco4s4cggok0o8owo0ssgo8o4gw04480o';
$redirect_uri = 'http://cliente-oauth/callback.php';

function curl_post($url, array $post = NULL, array $options = array())
{
	$defaults = array(
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_URL => $url,
			CURLOPT_FRESH_CONNECT => 1,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_FORBID_REUSE => 1,
			CURLOPT_TIMEOUT => 4,
			CURLOPT_POSTFIELDS => http_build_query($post)
	);

	$ch = curl_init();
	curl_setopt_array($ch, ($options + $defaults));
	if( ! $result = curl_exec($ch))
	{
		trigger_error(curl_error($ch));
	}
	curl_close($ch);
	return $result;
}