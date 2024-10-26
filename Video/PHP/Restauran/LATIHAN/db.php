<?php 

    class DB{

        //PROPERTI
        public $host = "127.0.0.1";
        private $user = "root";
        private $password = "";
        private $database = "dbrestauran";

        public function __construct() {
            echo "functionconstruct";
        }

        //METHOD
        public function selectData() {
            echo 'select data';
        }

        public function getDatabase() {
            echo  $this->database;
        }

        public function tampil() {
            $this->selectData();
        }

        public static function insertData() {
            echo "static function";
        }
    }

    DB::insertData();

    // $db = new DB;

    // $db-> selectData();

    // echo '<br>';

    // echo $db->host;

    // echo '<br>';

    // $db->getDatabase();

    // echo '<br>';

    // $db->selectData();

?>