<?php
require_once('config.php');

function listaBancos()
{
    $class = new CnxClass();
    $bankList = $class->getBankList();

    return $bankList->getBankListResult->item;
}

function dataInformacion($bankCode,$bankInterface)
{
    
    $data['bankCode'] =  $bankInterface;
    $data['bankInterface'] = $bankCode;
    $data['reference'] = 'Referencia prueba ';
    $data['description'] = 'Prueba Tecnica Yamid';
    $data['totalAmount'] = 10000;
    $data['firstName'] = 'Yamid';
    $data['lastName'] = 'Velez';
    $data['company'] = 'NA .S.A';
    $data['emailAddress'] = 'yavemu';
    $data['address'] = 'Calle 5 # 16';
    $data['city'] = 'Medellín';
    $data['province'] = 'Antioquia';
    $data['country'] = 'CO';
    $data['phone'] = 3120001234;
    $data['mobile'] = 3120001234;
    $data['postalCode'] = 0;

    return $data;
}

function enviarDataTransaccion(array $data)
{
    $class = new CnxClass();
    $transactionResult =  $class->createTransaction($data);

    $idTransaccion =  $transactionResult->createTransactionResult->transactionID;
    $urlPTP =  $transactionResult->createTransactionResult->bankURL;

    $_SESSION['historicoTransacciones'][$idTransaccion] = $transactionResult->createTransactionResult;

    //  Redireccionar a la ultima transaccion realizada
    header("Location: ".$urlPTP );
}

function obtenerHistoricoTransacciones()
{
    $historicoTransacciones = [];
    if (!empty($_SESSION['historicoTransacciones'])) 
    {
        $class = new CnxClass();

        foreach ($_SESSION['historicoTransacciones'] as $key => $value) 
        {
            $dataTrans = $class->getTransactionInformation($key);
            $historicoTransacciones[] = json_decode(json_encode($dataTrans->getTransactionInformationResult), True);
        }
    }

    return $historicoTransacciones;
}


?>