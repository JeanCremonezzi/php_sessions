<?php
    require_once(dirname(dirname(__DIR__))."/utils/utils.php");
    require_once(dirname(dirname(__DIR__))."/utils/alert.php");
    require_once(dirname(dirname(__DIR__))."/dao/messageDAO.php");

    function messages($id) {
        if ($id == null OR $id == "") {
            return alert("Usuário inválido!");
            die();
        }

        try {
            if (!UserDAO::userExists($id)) {
                return alert("Usuário não encontrado!");
                die();
            }

            return MessageDAO::getUserMessages($id);
        } catch (Exception $e) {
            return alert($e->getMessage());
        }
    }
?>