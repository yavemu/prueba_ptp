<?php
session_start(); 
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

class CnxClass
{
    private $seed;
    private $login;
    private $key;
    private $tranKey;
    private $url;

    public function __construct()
    {
        $this->seed = date('c');
        $this->login = '6dd490faf9cb87a9862245da41170ff2';
        $this->key = "024h1IlD";
        $this->tranKey = sha1($this->seed.$this->key);
        $this->url = 'https://test.placetopay.com/soap/pse/?wsdl';
    }

    
    public function getBankList()
    {
        try {
            $client = new SoapClient($this->url);
            $result = $client->getBankList( ["auth"=>[ "login" => $this->login,"tranKey" => $this->tranKey,"seed" => $this->seed]] );
            return $result;
        } catch ( SoapFault $e ) {
            echo $e->getMessage();
        }
    }
    
    public function getTransactionInformation(int $id)
    {
        try {
            $client = new SoapClient($this->url);
            $result = $client->getTransactionInformation([
                    "auth"=>[ "login" => $this->login,"tranKey" => $this->tranKey,"seed" => $this->seed],
                    "transactionID" => $id
                ] 
            );
            return $result;
        } catch ( SoapFault $e ) {
            echo $e->getMessage();
        }
    }
    
    public function createTransaction(array $data)
    {
        $transaction = [
            'bankCode' => $data['bankCode'],
            'bankInterface' => $data['bankInterface'],
            'returnURL' => 'http://localhost/prueba_ptp/',
            'reference' => $data['reference'],
            'description' => $data['description'],
            'language' => 'ES',
            'currency' => 'COP',
            'totalAmount' => $data['totalAmount'],
            'taxAmount' => 100,
            'devolutionBase' => 100,
            'tipAmount' => 0,
            'payer'=>[
                'documentType' => $data['documentType'],
                'document' => $data['document'],
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'company' => $data['company'],
                'emailAddress' => $data['emailAddress'],
                'address' => $data['address'],
                'city' => $data['city'],
                'province' => $data['province'],
                'country' => $data['country'],
                'phone' => $data['phone'],
                'mobile' => $data['mobile'],
                'postalCode' => $data['postalCode'],
            ],
            'buyer'=>[
                'documentType' => 'CC',
                'document' => 1040732444,
                'firstName' => 'YAMid',
                'lastName' => 'Velez Munoz',
                'company' => 'Compania de pruebas',
                'emailAddress' => 'yavemu@gmail.com',
                'address' => 'Carrera 5 # 16',
                'city' => 'Medellin',
                'province' => 'Antioquia',
                'country' => 'CO',
                'phone' => '0345551212',
                'mobile' => '3203202020',
                'postalCode' => '00015',
            ],
            'shipping'=>[
                'documentType' => 'CC',
                'document' => 9876543210,
                'firstName' => 'Place to pay',
                'lastName' => 'Transacciones',
                'company' => 'Compania de pruebas',
                'emailAddress' => 'placetopay@gmail.com',
                'address' => 'Calle 20 # 52 -1',
                'city' => 'Medellin',
                'province' => 'Antioquia',
                'country' => 'CO',
                'phone' => '0345551212',
                'mobile' => '3203202020',
                'postalCode' => '00015',
            ],
            'ipAddress' => '123.123.123.123',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'],
        ];

        try {
            $client = new SoapClient($this->url);
            $result = $client->createTransaction([
                "auth"=>[ "login" => $this->login,"tranKey" => $this->tranKey,"seed" => $this->seed],
                "transaction"=>$transaction,
                ]
            );
            return $result;
        } catch ( SoapFault $e ) {
            echo $e->getMessage();
        } 
    }
}