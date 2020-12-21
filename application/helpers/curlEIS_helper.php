<?php
function getISI($isi)
{
    $cURLConnection = curl_init(API_URL());
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $isi);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $apiResponse = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    return json_decode($apiResponse, TRUE);
}

function getAPIKU($isi)
{
    $cURLConnection = curl_init(API_URL());
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $isi);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $apiResponse = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    return $apiResponse;
}
