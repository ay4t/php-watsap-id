<?php

namespace Ay4t\Watsap;

use Ay4t\Watsap\Config\App;
use GuzzleHttp\RequestOptions;

class Client
{
    private $config;

    /**
     * Constructor
     */
    public function __construct( App $config = null )
    {
        ( $config ) ? $this->config = $config : $this->config = new App();
        var_dump($this->config);
    }

    /**
     * Proses request ke server dengan Guzzlehttp/guzzle
     */
    protected function exec(string $endpoint, string $method = 'GET',array $data = []){
        $client = new \GuzzleHttp\Client();
        $response = $client->request( $method, $this->config->baseURL . $endpoint, [
            RequestOptions::JSON => $data
        ] );
        
        $result     = [];

        try {
            $result = json_decode($response->getBody()->getContents());
        } catch (\Throwable $th) {
            $result = $th->getMessage();
        }

        return $result;
    }

    /**
     * Kirim pesan teks
     * @param string $number
     * @param string $message
     */
    public function sendText( string $number, string $message )
    {
        return $this->exec('/send-message', 'POST', [
            'id_device' => $this->config->deviceID,
            'api_key' => $this->config->apiKey,
            'sender' => $this->config->deviceID,
            'number'   => $number,
            'message'   => $message
        ]);
    }
}
