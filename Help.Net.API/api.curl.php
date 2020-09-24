<?php

// PHP cURL Basics
// 

curl_init();      // initializes a cURL session
curl_setopt();    // changes the cURL session behavior with options
curl_exec();      // executes the started cURL session
curl_close();     // closes the cURL session and deletes the variable made by curl_init();


// PHP cURL POST Request
// A POST request is usually made to send user collected data to a server.

$postRequest = array(
    'firstFieldData' => 'foo',
    'secondFieldData' => 'bar'
);

$cURLConnection = curl_init('http://hostname.tld/api');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);

// $apiResponse - available data from the API request
$jsonArrayResponse - json_decode($apiResponse);



// PHP cURL GET Request
// A GET request retrieves data from a server. This can be a website’s HTML, an API response or other resources.



$cURLConnection = curl_init();

curl_setopt($cURLConnection, CURLOPT_URL, 'https://hostname.tld/phone-list');
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$phoneList = curl_exec($cURLConnection);
curl_close($cURLConnection);

$jsonArrayResponse - json_decode($phoneList);



// PHP cURL Header
// You can also set custom headers in your cURL requests. For this, we’ll use the curl_setopt() function.

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Header-Key: Header-Value',
    'Header-Key-2: Header-Value-2'
));