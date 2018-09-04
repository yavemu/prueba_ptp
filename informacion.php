<?php
    require_once('lib/func.php');
   
    // Redireccionar al index en caso de no existir los dos parametros requeridos para continuar
    if (!is_numeric($_POST['bankCode']) or empty($_POST['bankName'] )) {
        header("Location: http://localhost/prueba_ptp/");
    }

    // Obtener la informacion previamente "quemada" que se puede modificar en el formulario de persona
    $getData = dataInformacion($_POST['bankCode'],$_POST['bankName']);
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
<div class="container">

    <div class="row jumbotron">

        <div class="col-12">
            <h2>Ingresar / Modificar la información Persona </h2>
            <hr>
        </div>

        <form class="col-sm-6" action="transaccion.php" method="POST">

            <div class="form-group">
              <label for="reference">Referencia: </label>
              <input type="text" name="reference" id="reference" value="<?= $getData['reference']; ?>" class="form-control" maxlength="32" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción: </label>
                <textarea name="description" id="description" class="form-control" rows="3" maxlength="255" required><?= $getData['description']; ?></textarea>
            </div>

            <div class="form-group">
              <label for="totalAmount">Cantidad Total: </label>
              <input type="number" name="totalAmount" id="totalAmount" value="<?= $getData['totalAmount']; ?>" class="form-control" maxlength="32" min="1" required>
            </div>

            <div class="form-group">
              <label for="firstName">Nombre(s): </label>
              <input type="text" name="firstName" id="firstName" value="<?= $getData['firstName']; ?>" class="form-control" maxlength="60" required>
            </div>

            <div class="form-group">
              <label for="lastName">Apellidos: </label>
              <input type="text" name="lastName" id="lastName" value="<?= $getData['lastName']; ?>" class="form-control" maxlength="60" required>
            </div>

            <div class="form-group">
              <label for="company">Compañia: </label>
              <input type="text" name="company" id="company" value="<?= $getData['company']; ?>" class="form-control" maxlength="60" required>
            </div>

            <div class="form-group">
              <label for="address">Dirección Residencia: </label>
              <input type="text" name="address" id="address" value="<?= $getData['address']; ?>" class="form-control" maxlength="100" required>
            </div>
            
            <div class="form-group">
              <label for="city">Ciudad: </label>
              <input type="text" name="city" id="city" value="<?= $getData['city']; ?>" class="form-control" maxlength="50" required>
            </div>
            
            <div class="form-group">
              <label for="province">Departamento: </label>
              <input type="text" name="province" id="province" value="<?= $getData['province']; ?>" class="form-control" maxlength="50" required>
            </div>
            
            <div class="form-group">
              <label for="phone">Teléfono: </label>
              <input type="number" name="phone" id="phone" value="<?= $getData['phone']; ?>" class="form-control" maxlength="30" required>
            </div>
            
            <div class="form-group">
              <label for="mobile">Celular: </label>
              <input type="number" name="mobile" id="mobile" value="<?= $getData['mobile']; ?>" class="form-control" maxlength="30" required>
            </div>

            <input type="hidden" name="bankCode" value="<?= $getData['bankCode']; ?>">
            <input type="hidden" name="bankInterface" value="<?= $getData['bankInterface']; ?>">
            <input type="hidden" name="country" value="<?= $getData['country']; ?>">
            <input type="hidden" name="postalCode" value="<?= $getData['postalCode']; ?>">

            <div class="form-group">
                <label for="documentType">Tipo de documento: </label>
                <select class="form-control" id="documentType" name="documentType" required>
                    <option value='CC' selected>Cédula de ciudanía colombiana</option>
                    <option value='CE'>Cédula de extranjería</option>
                    <option value='TI'>Tarjeta de identidad</option>
                    <option value='PPN'>Pasaporte</option>
                    <option value='NIT'>Número de identificación tributaria</option>
                    <option value='SSN'>Social Security Number</option>
                </select>
            </div>

            <div class="form-group">
              <label for="document">Numero Documento: </label>
              <input type="number" name="document" id="document" value="<?= $getData['document']; ?>" class="form-control" maxlength="12" min="1" required>
            </div>

            <div class="form-group">
                <label for="emailAddress">Correo Electronico: </label>
                <input type="email" name="emailAddress" id="emailAddress" value="<?= $getData['emailAddress']; ?>" class="form-control" maxlength="80" required>
            </div>

            <input type="submit" value="Continuar" class="btn btn-success btn-block" >
        </form>
    </div>

</div>
</body>
</html>
