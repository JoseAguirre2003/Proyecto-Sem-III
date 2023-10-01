<?php 
    class conexion{

        private $conex;

        public function __construct(){
            $conex = new PDO("mysql: host=localhost; dbname=simfiq","root","");
            $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function getConex(){
            return $this->conex;
        }

        public function closeConex(){
            $this->conex = null;
        }
    }

?>