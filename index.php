<?php

use Psr\Http\Message\ServerRequestInterface;

function sendMessageToSlack(ServerRequestInterface $request)
{
    include 'config.php';
    $data = json_decode($request->getBody(), true);
    if (is_null($data)) {
        return 'Something went wrong: no data!';
    }

    if (!array_key_exists('message', $data)) {
        return 'Something went wrong: wrong payload!';
    }

    $text['text'] =  $data["message"];
    $text_to_send = json_encode($text); 

    $url = $slack_webhook;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = [
        "Content-Type: application/json",
        "Accept: application/json",
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $text_to_send);

    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}
