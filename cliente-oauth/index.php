<?php

include 'config.php';

session_start();

if(isset($_SESSION['user'])){
    echo "Bienvenido " . $_SESSION['user'] . '<br />';
    
    echo "Articulos <br />";
    
    $resource = $host . '/api/articles';
    
    $response = curl_post($resource, [], [CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $_SESSION['auth-token']->access_token]]);
    $articles = json_decode($response);

    var_dump($articles);
    
     session_destroy();
}else{
    $host .= '/oauth/v2/auth';
    $uri = '?client_id=' . $client_id;
    $uri .= '&redirect_uri=' . $redirect_uri;
    $uri .= '&response_type=code';
    // $uri .= '&scope=' . config('services.eduauth.scope_login');
    // $uri .= '&st=' . substr(md5(microtime()), 0, 10);
    
    header('Location: ' . $host . $uri);
    die();
}
