<?php
    require_once(dirname(dirname(__DIR__))."/utils/utils.php");
    require_once(dirname(dirname(__DIR__))."/utils/alert.php");
    require_once(dirname(dirname(__DIR__))."/dao/userDAO.php");

    function logar() {
        if (isMetodo("POST")) {
            $lista = ["login", "password"];

            if (!parametrosValidos($_POST, $lista)) {
                return alert("Preencha todos os campos!");
                die();
            }

            if (!filterIsEmail($_POST["login"])) {
                return alert("Login deve ser email!");
                die();
            }

            try {
                $user = UserDAO::readByLogin($_POST["login"], $_POST["password"]);

                if (count($user) == 0 OR !password_verify($_POST["password"], $user[0]["password"])) {
                    return alert("Login ou senha incorretos!");
                    die();
                }
                
                unset($user[0]["password"]);
                unset($user[0]["date"]);

                session_start();
                $_SESSION["user"] = $user[0];
                
                header('Location: ./index.php');

            } catch (Exception $e) {
                return alert($e->getMessage());
            }
        }
    }
?>