<?php
namespace App\Transactions;

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Helpers\helper;
use Efi\Exception\EfiException;
use Efi\EfiPay;
use App\Transactions\Option;
use App\Http\Controllers\CarController;
use Exception;

class Billet
{
    
    public static function billet()
    {
        $response = ['error' => ''];

        $date = date('Y-m-d');
        $expire_at = date('Y-m-d', strtotime("+2 days", strtotime($date)));
        $email = helper::auth()['email'];
        $firstName = helper::findByPersonalData()['firstName'];
        $lastName = helper::findByPersonalData()['lastName'];

        $infoCpf = helper::findByPersonalData()['cpf'];
        $cpf = str_replace('.', '', $infoCpf);
        $cpf = str_replace('-', '', $cpf);

        $cep = helper::findByAddressFrete()['cep'];
        $cep = str_replace('-', '', $cep);

        $logradouro = helper::findByAddressFrete()['end'];
        $number = helper::findByAddressFrete()['number'];
        $city = helper::findByAddressFrete()['city'];
        $name = $firstName . " " . $lastName;
        $uf = helper::findByAddressFrete()['uf'];

        $options = Option::cred();

        $metadata = [
            "custom_id" => "Order_00001",
            "notification_url" => "https://your-domain.com.br/notification/"
        ];

        $customer = [
            "name" => $name,
            "cpf" => strval($cpf),
            "email" => $email,
            "address" => [
                "street" => $logradouro,
                "number" => $number,
                "neighborhood" => "",
                "zipcode" => $cep,
                "city" => $city,
                "state" => $uf
            ],
        ];


        $conditional_discount = [
            "type" => "percentage", // "currency", "percentage"
            "value" => 500,
            "until_date" => $expire_at
        ];

        $configurations = [
            "fine" => 200,
            "interest" => 33
        ];

        $bankingBillet = [
            "expire_at" => $expire_at,
            "message" => "This is a space\n of up to 80 characters\n to tell\n your client something",
            "customer" => $customer,
            "conditional_discount" => $conditional_discount,
            "configurations" => $configurations,
        ];

        $payment = [
            "banking_billet" => $bankingBillet
        ];

        $body = [
            "items" => self::listPaymentCar(),
            "metadata" => $metadata,
            "payment" => $payment
        ];

        try {
            $api = new EfiPay($options);
            $res = $api->createOneStepCharge($params = [], $body);

            $response['inf'] = $res;

            //deletar o carrinho
            $car = new CarController();
            $car->deleteAll();

        } catch (EfiException $e) {
            $response['error'] = $e->errorDescription;
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }

    private static function listPaymentCar()
    {
        $list = [];
        $frete = helper::findByFrete();
        $price = ($frete['price'] * 100);

        $paymentCar = helper::showPaymentCard();
        foreach ($paymentCar as $item) {
            $value = ($item['subtotal'] * 100);
            $list[] = [
                "name" => $item['description'],
                "amount" => $item['qtd'],
                "value" => intval($value) 
            ];
        }
        $list[] = [
            'name' => 'Frete '. $frete['name'] . ' - ' . $frete['company'],
            'value' => intval($price)
        ];
        return $list;
        
    }
    
    public static function sendBilletEmail($charge_id)
    {
        /**
         * Detailed endpoint documentation
         * https://dev.efipay.com.br/docs/api-cobrancas/boleto/#reenvio-do-boleto-bancário-para-o-email-desejado
         */

        $options = Option::cred();
        $params = [
            "id" => $charge_id
        ];

        $body = [
            "email" => helper::auth()['email']
        ];

        try {
            $api = new EfiPay($options);
            $response = $api->sendBilletEmail($params, $body);
            return $response;
        } catch (EfiException $e) {
            // print_r($e->errorDescription) . "<br>";
        } catch (Exception $e) {
            // print_r($e->getMessage());
        }
    }
}