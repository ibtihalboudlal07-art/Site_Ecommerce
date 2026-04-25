<?php
session_start();

require_once __DIR__ . "/config.php";

$auth_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    "client_id" => $client_id,
    "redirect_uri" => $redirect_uri,
    "response_type" => "code",
    "scope" => "email profile"
]);

header("Location: $auth_url");
exit;
?>