<?php

namespace Ay4t\Watsap;

use Ay4t\Watsap\Config\App;

class Client
{
    private $config;

    /**
     * Constructor
     */
    public function __construct( App $config = null )
    {
        ( $config ) ? $this->config = $config : $this->config = new App();
    }

    /**
     * Proses request ke server dengan Guzzlehttp/guzzle
     */
    protected function exec( string $method = 'GET', string $endpoint, array $data = []){
        $client = new \GuzzleHttp\Client();
        $response = $client->request( $method, $this->config->baseURL . $endpoint, [] );
    }

    /**
     * Kirim pesan teks
     * @param string $number
     * @param string $message
     */
    public function sendText( string $number, string $message )
    {
        return $this->exec( 'POST', '/send-message', [
            'id_device' => $this->config->deviceID,
            'api-key' => $this->config->apiKey,
            'no_hp'   => $number,
            'pesan'   => $message
        ]);
    }
}
