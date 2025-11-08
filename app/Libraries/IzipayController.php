<?php

namespace App\Libraries;

use App\Models\IzipayCredentialsModel;

class IzipayController
{
    private static $_DEFAULT_USERNAME = null;
    private static $_DEFAULT_PASSWORD = null;
    private static $_DEFAULT_PUBLIC_KEY = null;
    private static $_DEFAULT_HMAC_SHA256 = null;
    private static $_DEFAULT_ENDPOINT_APIREST = null;

    private $_username = null;
    private $_password = null;
    private $_publicKey = null;
    private $_hmacSha256 = null;
    private $_endpointApiRest = null;

    public function __construct()
    {
        // Obtener credenciales desde la base de datos
        $this->loadCredentialsFromDatabase();

        $this->_username = self::$_DEFAULT_USERNAME;
        $this->_password = self::$_DEFAULT_PASSWORD;
        $this->_publicKey = self::$_DEFAULT_PUBLIC_KEY;
        $this->_hmacSha256 = self::$_DEFAULT_HMAC_SHA256;
        $this->_endpointApiRest = self::$_DEFAULT_ENDPOINT_APIREST;
    }

    private function loadCredentialsFromDatabase()
    {
        // Instanciar el modelo de credenciales
        $credentialsModel = new IzipayCredentialsModel();
        $credentials = $credentialsModel->first();

        // Configurar las credenciales obtenidas de la base de datos
        self::$_DEFAULT_USERNAME = $credentials['username'];
        self::$_DEFAULT_PASSWORD = $credentials['password'];
        self::$_DEFAULT_PUBLIC_KEY = $credentials['public_key'];
        self::$_DEFAULT_HMAC_SHA256 = $credentials['hmac_sha256'];
        self::$_DEFAULT_ENDPOINT_APIREST = $credentials['endpoint_api_rest'];
    }

    public static function setDefaultUsername($defaultUsername)
    {
        static::$_DEFAULT_USERNAME = $defaultUsername;
    }

    public static function setDefaultPassword($defaultPassword)
    {
        static::$_DEFAULT_PASSWORD = $defaultPassword;
    }

    public static function setDefaultPublicKey($defaultPublicKey)
    {
        static::$_DEFAULT_PUBLIC_KEY = $defaultPublicKey;
    }

    public static function setDefaultHmacSha256($defaultHmacSha256)
    {
        static::$_DEFAULT_HMAC_SHA256 = $defaultHmacSha256;
    }

    public static function setDefaultEndpointApiRest($defaultEndpointSha256)
    {
        static::$_DEFAULT_ENDPOINT_APIREST = $defaultEndpointSha256;
    }

    public function getEndpointApiRest()
    {
        return $this->_endpointApiRest;
    }

    public function getPublicKey()
    {
        return $this->_publicKey;
    }

    public function post($target, $array)
    {
        if (extension_loaded("curl")) {
            return $this->postWithCurl($target, $array);
        }
    }

    public function getUrlFromTarget($target)
    {
        $url = $this->_endpointApiRest . "/api-payment/" . $target;
        $url = preg_replace('/([^:])(\/{2,})/', '$1/', $url);

        return $url;
    }

    public function postWithCurl($target, $array)
    {
        $auth = $this->_username . ":" . $this->_password;
        $url = $this->getUrlFromTarget($target);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERPWD, $auth);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($array));
        $raw_response = curl_exec($curl);
        $response = json_decode($raw_response, true);
        return $response;
    }

    public function checkHash()
    {
        $supportedHashAlgorithms = array("sha256_hmac");

        if (!in_array($_POST["kr-hash-algorithm"], $supportedHashAlgorithms)) {
            return false;
        }

        if ($_POST['kr-hash-algorithm'] == "sha256_hmac") {
            $key = $this->_hmacSha256;
        } else {
            return false;
        }

        $krAnswer = $_POST["kr-answer"];
        $calculatedHash = hash_hmac("sha256", $krAnswer, $key);

        if (hash_equals($_POST['kr-hash'], $calculatedHash)) {
            return true;
        } else {
            return false;
        }
    }
}
