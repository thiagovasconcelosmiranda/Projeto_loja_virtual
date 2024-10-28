<?php
namespace App\Transactions;

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Helpers\helper;
use Efi\Exception\EfiException;
use Efi\EfiPay;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Client\RequestClientController;
use App\Http\Controllers\Client\Request_productsController;
use Exception;

class Card
{
  public static function createCard($info)
  {
    $array = [];

    if (isset($info)) {
      /**
       * Detailed endpoint documentation
       * https://dev.efipay.com.br/docs/api-cobrancas/cartao#criação-de-cobrança-por-cartão-de-crédito-em-one-step-um-passo
       */

      //Tratamento das infomações
      $birth = date('Y-m-d', strtotime(helper::findByPersonalData()['birth']));

      $cep = helper::findByAddressFrete()['cep'];
      $cep = str_replace('-', '', $cep);
      
      $cpf = str_replace('.', '', $info['cpf']);
      $cpf = str_replace('-', '', $cpf);
      //

      $options = Option::cred();

      $paymentToken = $info['payment_token'];

      $customer = [
        "name" => $info['name'],
        "cpf" => $cpf,
        "phone_number" => helper::findByPersonalData()['phone'],
        "email" => helper::auth()['email'],
        "birth" => strval($birth)
      ];

      $billingAddress = [
        "street" => helper::findByAddressFrete()['end'],
        "number" => intval(helper::findByAddressFrete()['number']),
        "neighborhood" => helper::findByAddressFrete()['bairro'],
        "zipcode" => $cep,
        "city" => helper::findByAddressFrete()['city'],
        "state" => helper::findByAddressFrete()['uf']
      ];

      $credit_card = [
        "customer" => $customer,
        "installments" => intval($info['installment']),
        "billing_address" => $billingAddress,
        "payment_token" => $paymentToken,
        "message" => "This is a space\n of up to 80 characters\n to tell\n your client something"
      ];

      $payment = [
        "credit_card" => $credit_card
      ];

      $body = [
        "items" => self::listPaymentCar(),
        "payment" => $payment
      ];

      try {
        $api = new EfiPay($options);
        $response = $api->createOneStepCharge($params = [], $body);
        $array['response'] = $response;

        if ($response['data']['status'] == 'approved') {
         self::requestCreate();
        }
      } catch (EfiException $e) {
        $array['error'] = [
          'code' => $e->code,
          'error' => $e->error,
          'description' => $e->errorDescription,
        ];
      } catch (Exception $e) {
        $array['error'] = $e->getMessage();
      }

    } else {
      $array['error'] = 'Dados não enviados!';
    }
    return $array;
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
      'name' => 'Frete ' . $frete['name'] . ' - ' . $frete['company'],
      'value' => intval($price)
    ];
    return $list;
  }

  private static function requestCreate()
  {
    $p = new PaymentController();
    $r = new RequestClientController();
    $rc = new Request_productsController();

    $status = 'Pagamento confirmado';
    $ref = rand(1, 99999);

    $paymentCars = $p->findByPaymentCar();

    if (count($paymentCars) > 0) {
      foreach ($paymentCars as $item) {
        $item['ref'] = $ref;
        $item['status'] = $status;
        $item['payment'] = 'cartõo de crédito';

        if ($rc->create($item)) {
          $r->create($item);
        }
      }
    }
  }
}