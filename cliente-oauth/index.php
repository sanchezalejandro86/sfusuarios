<?php

include 'config.php';

session_start();

if(isset($_SESSION['user'])){
    echo "Bienvenido " . $_SESSION['user'];
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
