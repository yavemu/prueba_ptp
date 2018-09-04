<?php
    require_once('lib/func.php');

    // Redireccionar al index en caso de no existir los dos parametros requeridos para continuar
    if (empty($_POST['emailAddress'] )) {
        header("Location: http://localhost/prueba_ptp/");
    }

    enviarDataTransaccion($_POST);
?>