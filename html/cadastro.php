<?php
    require_once(dirname(__DIR__)."/php/utils/utils.php");
    require_once(dirname(__DIR__)."/php/routes/user/cadastrar.php");

    session_start();

    if (isset($_SESSION['user'])) {
        header('Location: ./index.php');
    };
    
    if (isMetodo("POST")) {
        echo cadastrar();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Cadastrar</title>
</head>

<body>
    <div class="container-fluid d-flex flex-column align-items-center">
        <h1 class="h1 mt-3 text-uppercase fw-bold">Cadastrar</h1>

        <form class="mt-3 p-5 border rounded-2" method="POST" action="cadastro.php" style="width: 100%; max-width: 500px;">

            <div class="mb-3">
                <label for="inputNome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="inputNome" name="name">
            </div>

            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="login">
            </div>

            <div class="mb-3">
                <label for="inputPassword" class="form-label">Senha</label>
                <input type="password" class="form-control" id="inputPassword" name="password">
            </div>

            <button type="submit" class="btn btn-primary w-100 text-uppercase fw-bold">Cadastrar</button>
        </form>

        <a class="mt-4" href="login.php">Já é cadastrado?</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>