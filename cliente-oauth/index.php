<?php

session_start();

if(isset($_SESSION['user'])){
    "Bienvenido " + $_SESSION['user'];
}else{
    $host = 'http://usuarios.hucap.com/app_dev.php/oauth/v2/auth';
    $uri = '?client_id=' . '1khc8rvtiltwks0c08o4skg08g8sws84sgwkok8gg0wg8o40o0';
    $uri .= '&redirect_uri=' . 'http://cliente-oauth/callback.php';
    $uri .= '&response_type=code';
    // $uri .= '&scope=' . config('services.eduauth.scope_login');
    // $uri .= '&st=' . substr(md5(microtime()), 0, 10);
    
    header('Location: ' . $host . $uri);
    die();
}
