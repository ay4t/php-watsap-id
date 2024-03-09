## PHP Library API Client untuk Watsap.id
Library ini digunakan untuk mengirim pesan ke nomor whatsapp menggunakan API dari watsap.id

## Contoh Penggunaan
```php
use Ay4t\Watsap\Client;

$config     = new \Ay4t\Watsap\Config\App();
$config->apiKey = 'your-api-key';
$config->deviceID = 'your-sender-number';

$client = new Client( $config );
$sent   = $client->sendText('081234567890', 'coba kirim wa lewat program');

var_dump($sent);
```
## Pengembangan
Jika Anda ingin berkontribusi dalam pengembangan library ini, silahkan fork repository ini dan kirimkan pull request. dengan senang hati saya akan menerima kontribusi Anda.