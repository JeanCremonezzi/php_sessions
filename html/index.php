<?php
    require_once(dirname(__DIR__)."/php/utils/utils.php");
    require_once(dirname(__DIR__)."/php/utils/messagesList.php");
    require_once(dirname(__DIR__)."/php/routes/message/postar.php");
    require_once(dirname(__DIR__)."/php/routes/message/messages.php");

    session_start();
    
    if (!isset($_SESSION['user'])) {
        header('Location: ./login.php');
    }

    if (isMetodo("POST")) {
        echo postar();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Mensagens</title>
</head>

<body>
    <div class="container-fluid d-flex flex-column align-items-center">
        <h1 class="h1 mt-3 text-uppercase fw-bold">Mensagens de <?= $_SESSION["user"]["name"] ?></h1>
        <a href="./logout.php">Logout</a>

        <form class="mt-3 p-3 border rounded-2" method="POST" action="./index.php" style="width: 100%; max-width: 700px;">

            <div class="mb-3">
                <label for="inputMessage" class="form-label">Mensagem</label>
                <textarea class="form-control" placeholder="Deixe sua mensagem" id="inputMessage" maxlength="500" style="height: 150px;" name="message"></textarea>
            </div>

            <input type="text" name="userId" value="<?= $_SESSION["user"]["id"] ?>" hidden>

            <button type="submit" class="btn btn-primary w-100 text-uppercase fw-bold">POSTAR</button>
        </form>

        <h2 class="h2 mt-5 text-uppercase fw-bold text-muted">Mensagens</h2>
        <div class="p-3 border rounded-2" style="width: 100%; max-width: 700px;">
            <?= messagesList(messages($_SESSION["user"]["id"])) ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>