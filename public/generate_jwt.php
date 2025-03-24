<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';
use Firebase\JWT\JWT;

$payload = [
    "mercure" => [
        "publish" => ["*"],
        "subscribe" => ["*"]
    ]
];

$secret = "adel"; // Doit être IDENTIQUE à MERCURE_SUBSCRIBER_JWT_KEY

$jwt = JWT::encode($payload, $secret, 'HS256');

header('Content-Type: text/plain');
echo $jwt;
/// curl -N -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOlsiKiJdLCJzdWJzY3JpYmUiOlsiKiJdfX0.mxHnUzrWTUIaPt2nAaf7m6yqo_olTesrTK1yxvWPAu0"      -H "Accept: text/event-stream"      "http://localhost:3000/.well-known/mercure?topic=chat"

?>
