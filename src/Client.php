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
    }

    private function findJsonData($string) {
        // Definisikan pola regular expression untuk mencocokkan data JSON
        $pattern = '/\{(?:[^{}]|(?R))*\}/';
    
        // Cari semua kecocokan pola di dalam string
        preg_match_all($pattern, $string, $matches);
    
        // Hasilnya adalah array dari data JSON yang ditemukan
        return $matches[0];
    }
    
    /**
     * Proses request ke server dengan Guzzlehttp/guzzle
     */
    protected function exec(string $endpoint, string $method = 'GET',array $data = []){
        $client = new \GuzzleHttp\Client();
        $result     = [];
        try {

            $response = $client->request( $method, $this->config->baseURL . $endpoint, [
                RequestOptions::JSON => $data
            ] );
            $result = json_decode($response->getBody()->getContents());
        } catch (\GuzzleHttp\Exception\ClientException $th) {
            $result = $th->getMessage();

            // mencari json di dalam string $result
            $find_json_data = $this->findJsonData($result);
            if (count($find_json_data) > 0) {
                $result = json_decode($find_json_data[0]);
            }
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
