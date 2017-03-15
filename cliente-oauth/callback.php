<?php

include 'config.php';

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

session_start();

if(isset($_REQUEST['error']) && $_REQUEST['error'] === "access_denied"){
    header('HTTP/1.0 403 Forbidden');
    echo 'No esta autorizado!';
    exit;
}

$urlToken = $host . '/oauth/v2/token';
$params = [
    'client_id' => $client_id,
    'grant_type' => 'authorization_code',
    'client_secret' => $secret,
//     'scope' => '',
    'redirect_uri' => $redirect_uri,
    'code' => $_REQUEST['code']
];

$response = curl_post($urlToken, $params);
$jsonResponse = json_decode($response);

$_SESSION['auth-token'] = $jsonResponse;

$resource = $host . '/api/user';

$response = curl_post($resource, [], [CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $_SESSION['auth-token']->access_token]]);

$user = json_decode($response);
$_SESSION['user'] = $user->username;

header('Location: http://cliente-oauth/index.php');
die();

