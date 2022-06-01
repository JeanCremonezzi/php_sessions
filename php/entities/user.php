<?php
    class User {
        private $id;
        private $name;
        private $login;
        private $password;
        private $date;

        public function __construct() {
            $this->id = null;
            $this->name = "";
            $this->login = "";
            $this->password = "";
            $this->date = null;
        }

        public static function create($name, $login, $password) {
            $instance = new self();

            $instance->name = $name;
            $instance->login = $login;
            $instance->password = $password;

            return $instance;
        }

        public static function createWithId($id, $name, $login, $password, $date) {
            $instance = self::create($name, $login, $password);
            $instance->id = $id;
            $instance->date = $date;

            return $instance;
        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getLogin() {
            return $this->login;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getDate() {
            return $this->date;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setLogin($login) {
            $this->login = $login;
        }

        public function setPassword($password) {
            $this->password = $password;
        }
    }
?>