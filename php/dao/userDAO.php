<?php
    require_once(dirname(__DIR__)."/database/configuration/connection.php");
    require_once(dirname(__DIR__)."/entities/user.php");

    class UserDAO {
        private static $conn;

        public function __construct() {
            self::$conn = Conexao::getConexao();
        }

        public static function create(User $user) {
            try {
                if (!isset(self::$conn)) {
                    new UserDAO();
                }

                $sql = "INSERT INTO user (name, login, password, date) VALUES (:name, :login, :password, :date)";
                $stmt = self::$conn->prepare($sql);

                $stmt->execute([
                    ":name" => $user->getName(),
                    ":login" => $user->getLogin(),
                    ":password" => password_hash($user->getPassword(), PASSWORD_BCRYPT, ['cost' => 15]),
                    ":date" => date('Y-m-d H:i:s')
                ]);

                return self::getLastInserted();
            } catch (Exception $e) {
                throw new Exception("Erro ao cadastrar usuário!");
            }
        }

        public static function readByLogin($login) {
            try {
                if (!isset(self::$conn)) {
                    new UserDAO();
                }

                $sql = "SELECT * FROM user WHERE login = :login";
                $stmt = self::$conn->prepare($sql);

                $stmt->execute([
                    ":login" => $login
                ]);

                return $stmt->fetchAll();

            } catch (Exception $e) {
                return "Erro ao buscar usuário!";
            }
        }

        public static function loginExists($login) {
            try {
                if (!isset(self::$conn)) {
                    new UserDAO();
                }

                $stmt = self::$conn->prepare("SELECT * FROM user WHERE login = :login");
                $stmt->execute([":login" => $login]);

                return $stmt->rowCount() > 0;

            } catch (Exception $e) {
                return "Erro ao verificar login!";
            }
        }

        public static function userExists($id) {
            try {
                if (!isset(self::$conn)) {
                    new UserDAO();
                }

                $stmt = self::$conn->prepare("SELECT * FROM user WHERE id = :id");
                $stmt->execute([":id" => $id]);

                return $stmt->rowCount() > 0;

            } catch (Exception $e) {
                return "Erro ao procurar usuário!";
            }
        }

        private static function getLastInserted() {
            try {
                if (!isset(self::$conn)) {
                    new UserDAO();
                }

                $stmt = self::$conn->prepare("SELECT * FROM user WHERE :id = id");
                $stmt->execute([":id" => self::$conn->lastInsertId()]);

                return $stmt->fetchAll();

            } catch (Exception $e) {
                return "Erro ao buscar usuário!";
            }
        }
    }
?>