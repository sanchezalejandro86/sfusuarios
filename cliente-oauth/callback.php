<?php

include 'config.php';

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

