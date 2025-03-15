<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$payload = [
    "mercure" => ["publish" => ["*"]]
];

$secret = "adel"; // Assure-toi que c'est la même clé que dans MERCURE_JWT_SECRET

$jwt = JWT::encode($payload, $secret, 'HS256');

echo $jwt;
?>
