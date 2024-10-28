<?php
namespace App\Transactions;


class Option {
    public static function cred()
    {
        /**
         * Environment
         */
        $sandbox = true; // false = Production | true = Homologation

        /**
         * Credentials of Production
         */
        $clientIdProd = "Client_Id_4960e7c5711d3da630f484149dcec0cb31dedc53";
        $clientSecretProd = "Client_Secret_1ef2795dc64448ca07ca0ef6a7f8fd63b17c1b06";
        $pathCertificateProd = realpath(__DIR__ . "/producao_cert.pem"); // Absolute path to the certificate in .pem or .p12 format

        /**
         * Credentials of Homologation
         */
        $clientIdHomolog = "Client_Id_2ddc471d4e6622ff51e674d4782809b46707d7b9";
        $clientSecretHomolog = "Client_Secret_08ad13fc0ffa8eef5c7581e84f5da607ca14b144";
        $pathCertificateHomolog = realpath(__DIR__ . "/homologacao_cert.pem"); // Absolute path to the certificate in .pem or .p12 format

        /**
         * Array with credentials for sending requests
         */
        return [
           "clientId" => ($sandbox) ? $clientIdHomolog : $clientIdProd,
            "clientSecret" => ($sandbox) ? $clientSecretHomolog : $clientSecretProd,
            "certificate" => ($sandbox) ? $pathCertificateHomolog : $pathCertificateProd,
            "pwdCertificate" => "", // Optional | Default = ""
            "sandbox" => $sandbox, // Optional | Default = false
            "debug" => false, // Optional | Default = false
            "timeout" => 30, // Optional | Default = 30
        ];
    }
}