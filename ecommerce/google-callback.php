<?php
session_start();

require "google-config.php";

if(!isset($_GET['code'])){
    die("No code received from Google");
}

$code = $_GET['code'];

$token_url = "https://oauth2.googleapis.com/token";

$data = [
    "code" => $code,
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "redirect_uri" => $redirect_uri,
    "grant_type" => "authorization_code"
];

$options = [
    "http" => [
        "method" => "POST",
        "header" => "Content-Type: application/x-www-form-urlencoded",
        "content" => http_build_query($data)
    ]
];

$response = file_get_contents($token_url,false,stream_context_create($options));

$token = json_decode($response,true);

$access_token = $token['access_token'];

$user_info = file_get_contents(
"https://www.googleapis.com/oauth2/v2/userinfo?access_token=".$access_token
);

$user = json_decode($user_info,true);

$_SESSION['user'] = $user;

header("Location:../index.php");
exit;
?>