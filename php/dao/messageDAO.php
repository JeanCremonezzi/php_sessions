<?php
    require_once(dirname(__DIR__)."/database/configuration/connection.php");
    require_once(dirname(__DIR__)."/entities/message.php");

    class MessageDAO {
        private static $conn;

        public function __construct() {
            self::$conn = Conexao::getConexao();
        }

        public static function create(Message $msg) {
            try {
                if (!isset(self::$conn)) {
                    new MessageDAO();
                }

                $sql = "INSERT INTO msg (userId, text, date) VALUES (:userId, :text, :date)";
                $stmt = self::$conn->prepare($sql);

                $stmt->execute([
                    ":userId" => $msg->getUserId(),
                    ":text" => $msg->getText(),
                    ":date" => date('Y-m-d H:i:s')
                ]);

                return self::getLastInserted();
            } catch (Exception $e) {
                throw new Exception("Erro ao cadastrar mensagem!");
            }
        }

        public static function getUserMessages($id) {
            try {
                if (!isset(self::$conn)) {
                    new MessageDAO();
                }

                $sql = "SELECT * FROM msg WHERE userId = :userId ORDER BY date DESC";
                $stmt = self::$conn->prepare($sql);

                $stmt->execute([
                    ":userId" => $id
                ]);

                return $stmt->fetchAll();
            } catch (Exception $e) {
                throw new Exception("Erro ao procurar mensagens!");
            }
        }

        private static function getLastInserted() {
            try {
                if (!isset(self::$conn)) {
                    new UserDAO();
                }

                $stmt = self::$conn->prepare("SELECT * FROM msg WHERE :id = id");
                $stmt->execute([":id" => self::$conn->lastInsertId()]);

                return $stmt->fetchAll();

            } catch (Exception $e) {
                return "Erro ao buscar mensagem!";
            }
        }
    }
?>