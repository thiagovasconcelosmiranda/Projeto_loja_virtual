<?php
namespace App\Transactions;

require_once __DIR__ . "/../../vendor/autoload.php";

use Efi\Exception\EfiException;
use Efi\EfiPay;
use App\Helpers\helper;
use App\Models\PaymentCar;
use App\Transactions\Option;
use App\Http\Controllers\CarController;
use Exception;

class Pix
{
    public static function cobv()
    {
        $date = date('Y-m-d');
        $firstName = helper::findByAddressClient()['firstName'];
        $lastName = helper::findByAddressClient()['lastName'];
        
        $infoCpf = helper::findByPersonalData()['cpf'];
        $cpf = str_replace('.', '', $infoCpf);
        $cpf = str_replace('-', '', $cpf);


        $cep = helper::findByAddressFrete()['cep'];
        $cep = str_replace('-', '', $cep);

        $logradouro = helper::findByAddressFrete()['end'];
        $city = helper::findByAddressFrete()['city'];
        $name = $firstName . " " . $lastName;
        $uf = helper::findByAddressFrete()['uf'];

        $options = Option::cred();
        $params = [
            "txid" => "00000000000000000000000000000000000" //  Transaction unique identifier
        ];

        $body = [
            "calendario" => [
                "dataDeVencimento" => $date,
                "validadeAposVencimento" => 2000
            ],
            "devedor" => [
                "nome" => $name,
                "cpf" => strval($cpf),
                //"cnpj" => "12345678000100"
                "email" => helper::auth()['email'],
                "logradouro" => $logradouro,
                "cidade" => $city,
                "uf" => $uf,
                "cep" => $cep
            ],
            "valor" => [
                "original" => self::paymentCarSoma(),
            ],
            "chave" => "629ef95d-f232-4d5a-91e7-cfb30f3b52a3", // Pix key registered in the authenticated Efí account
            "solicitacaoPagador" => "Enter the order number or identifier.",
        ];

        try {
            $api = new EfiPay($options);
            $pix = $api->pixCreateDueCharge($params, $body);

            if ($pix["txid"]) {
                $params = [
                    "id" => $pix["loc"]["id"]
                ];
            }

            $qrcode = $api->pixGenerateQRCode($params);

            $car = new CarController();
            $car->deleteAll();
            
            return $qrcode;

        } catch (EfiException $e) {
            print_r($e->code . "<br>");
            print_r($e->error . "<br>");
            print_r($e->errorDescription) . "<br>";
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    private static function paymentCarSoma()
    {
        $frete = helper::findByFrete();
        $data = PaymentCar::select('subtotal')
            ->sum('subtotal');
        $soma = ($data + $frete['price']);
        return strval($soma);
    }
}