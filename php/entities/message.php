<?php
    class Message {
        private $id;
        private $userId;
        private $text;
        private $date;

        public function __construct() {
            $this->id = null;
            $this->userId = null;
            $this->text = null;
            $this->date = null;
        }

        public static function create($userId, $text) {
            $instance = new self();

            $instance->userId = $userId;
            $instance->text = $text;

            return $instance;
        }

        public static function createWithId($id, $userId, $text, $date) {
            $instance = self::create($userId, $text);
            $instance->id = $id;
            $instance->date = $date;

            return $instance;
        }

        public function getId() {
            return $this->id;
        }

        public function getUserId() {
            return $this->userId;
        }

        public function getText() {
            return $this->text;
        }

        public function getDate() {
            return $this->date;
        }
    }
?>