<?php
    require_once(dirname(dirname(__DIR__))."/utils/utils.php");
    require_once(dirname(dirname(__DIR__))."/utils/alert.php");
    require_once(dirname(dirname(__DIR__))."/dao/userDAO.php");

    function cadastrar() {
        if(isMetodo("POST")) {
            $lista = ["name", "login", "password"];

            if (!parametrosValidos($_POST, $lista)) {
                return alert("Preencha todos os campos!");
                die();
            }

            if (!filterIsEmail($_POST["login"])) {
                return alert("Login deve ser email!");
                die();
            }

            try {
                if (UserDAO::loginExists($_POST["login"])) {
                    return alert("Login já existe!");
                    die();
                }

                $user = User::create($_POST["name"], $_POST["login"], $_POST["password"]);

                $user = UserDAO::create($user)[0];

                unset($user["password"]);
                unset($user["date"]);

                session_start();
                $_SESSION["user"] = $user;
                
                header('Location: ./index.php');

            } catch (Exception $e) {
                return alert($e->getMessage());
            }
        }
    }
?>