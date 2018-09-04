<?php
    require_once('lib/func.php');
    
    // Obtener la lista de Bancos
    $bankList = listaBancos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba PlaceToPay</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body>
<div class="container mb-4">

    <div class="row jumbotron">

        <div class="col-12">
            <h2>Obtener Entidades Financieras</h2>
            <hr>
        </div>

        <form action="informacion.php" method="POST">
            <div class="form-group">
                <label for="bankCode">Indique el tipo de cuenta:</label>
                <select class="form-control" id="bankCode" name="bankCode" required>
                    <option value='0'>Persona</option>
                    <option value='1'>Empresa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bankName">Seleccione la Entidad Financiera:</label>
                <select class="form-control" id="bankName" name="bankName" required>
                    <?php 
                        foreach ($bankList as $key => $bank) { 
                            if ($bank->bankCode == 1022) { 
                        ?>
                                <option value="<?= $bank->bankCode ?>" selected> <?= $bank->bankName ?> </option>
                        <?php
                            } else {
                        ?>
                                <option value="<?= $bank->bankCode ?>" > <?= $bank->bankName ?> </option>
                        <?php
                            }
                        } 
                    ?>
                </select>
            </div>
            <input type="submit" value="Continuar" class="btn btn-success btn-block" >
        </form>
    </div>

    <div class="col-12">
        <h2>Historico Transacciones</h2>
        <hr>
        
    
        <?php 
            $transacciones =  obtenerHistoricoTransacciones(); 
            if (count($transacciones) == 0) { ?>
            <div class="alert alert-warning" role="alert">
               Aún no se tiene transacciones registradas en esta session.
            </div>
                
        <?php } ?>

        <div class="accordion" id="accordionExample">
        
            <?php foreach ($transacciones as $key => $tran) { ?>

                <?php if ($tran['transactionState']=='OK') {
                    $color = 'success';
                } else if ($tran['transactionState']=='NOT_AUTHORIZED') {
                    $color = 'dark';
                } else if ($tran['transactionState']=='PENDING') {
                    $color = 'warning';
                } else if ($tran['transactionState']=='FAILED') {
                    $color = 'danger';
                }
                ?>

                
                    <div class="card alert alert-<?= $color ?>">
                        <div class="card-header" id="heading<?= $key ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapse<?= $key ?>">
                                    Transacción #<?= $tran['transactionID']." - <b>".$tran['responseReasonText'] ?></b>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?= $key ?>" class="collapse hide" aria-labelledby="heading<?= $key ?>" data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tbody>
                                        <?php foreach ($tran as $name => $value) { ?>
                                            <tr>
                                                <th scope="row"><?= strtoupper($name) ?></th>
                                                <td><?= $value ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            </div>
    </div>


</div>
</body>
</html>