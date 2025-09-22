<?php

//Join Us : @Hack666m

function getAccessToken($file){
    require 'vendor/autoload.php';
    $serviceAccountFilePath = "$file";
    $serviceAccount = json_decode(file_get_contents($serviceAccountFilePath), true);

    // Generate the JWT using the service account credentials
    $clientEmail = $serviceAccount['client_email'];
    $privateKey = $serviceAccount['private_key'];
    
    $payload = [
        "iss" => $clientEmail,
        "scope" => "https://www.googleapis.com/auth/firebase.messaging",
        "aud" => "https://www.googleapis.com/oauth2/v4/token",
        "iat" => time(),
        "exp" => time() + 3600
    ];

    $jwt = Firebase\JWT\JWT::encode($payload, $privateKey, 'RS256');

    // Get the OAuth 2.0 access token
    $requestBody = [
        "grant_type" => "urn:ietf:params:oauth:grant-type:jwt-bearer",
        "assertion" => $jwt
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/oauth2/v4/token");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    
    $response = curl_exec($ch);
    curl_close($ch);

    $accessToken = json_decode($response)->access_token;

    return $accessToken;
}

$access = getAccessToken("madproject-ea758-firebase-adminsdk-lga9x-1562e414bc.json");

echo $access;

//Join Us : @Hack666m
