<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/../vendor/autoload.php';


use Ay4t\Watsap\Client;

$config     = new \Ay4t\Watsap\Config\App();
$config->apiKey = 'your-api-key';
$config->deviceID = 'your-sender-number';

$client = new Client( $config );
$sent   = $client->sendText('081234567890', 'coba kirim wa lewat program');

var_dump($sent);