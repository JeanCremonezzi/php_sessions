<?php
    require_once(dirname(dirname(__DIR__))."/utils/utils.php");
    require_once(dirname(dirname(__DIR__))."/utils/alert.php");
    require_once(dirname(dirname(__DIR__))."/dao/messageDAO.php");
    require_once(dirname(dirname(__DIR__))."/dao/userDAO.php");

    function postar() {
        if(isMetodo("POST")) {
            $lista = ["userId", "message"];

            if (!parametrosValidos($_POST, $lista)) {
                return alert("Mensagem não pode estar vazia!");
                die();
            }

            try {
                if (!UserDAO::userExists($_POST["userId"])) {
                    return alert("Usuário não encontrado!");
                    die();
                }

                $msg = Message::create($_POST["userId"], $_POST["message"]);
                $msg = MessageDAO::create($msg)[0];

                header('Location: ./index.php');

            } catch (Exception $e) {
                return alert($e->getMessage());
            }
        }
    }
?>