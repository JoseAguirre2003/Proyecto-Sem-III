<?php 

    class MAaProcesar{

        private $idMuestra;
        private $identificador;
        private $analisisARealizar;
        private $fechaDeToma;
        private $observaciones;

        public function getIdMuestra(){
            return $this->idMuestra;
        }
        
        public function setIdMuestra($idMuestra){
            $this->idMuestra = $idMuestra;
            return $this;
        }
        
        public function getIdentificador(){
            return $this->identificador;
        }
        
        public function setIdentificador($identificador){
            $this->identificador = $identificador;
            return $this;
        }

        public function getAnalisisARealizar(){
            return $this->analisisARealizar;
        }
        
        public function setAnalisisARealizar($analisisARealizar){
            $this->analisisARealizar = $analisisARealizar;
            return $this;
        }
        
        public function getFechaDeToma() {
            return $this->fechaDeToma;
        }

        public function setFechaDeToma($fechaDeToma){
            $this->fechaDeToma = $fechaDeToma;
            return $this;
        }

        public function getObservaciones() {
            return $this->observaciones;
        }
        
        public function setObservaciones($observaciones){
            $this->observaciones = $observaciones;
            return $this;
        }

        public function guardarMuestraAProcesar(){
            $peticion = conexion();
            $peticion = $peticion->prepare("INSERT INTO `muestra_a_procesar` (`IDMuestra`, `Identificador`, `Analisis_A_Realizar`, `Fecha_De_Toma`, `Observaciones`)
                                            VALUES ('".$this->idMuestra."', '".$this->identificador."', '".$this->analisisARealizar."', '".$this->fechaDeToma."', '".$this->observaciones."');");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = null;
                return true;
            }else{
                $peticion = null;
                return false;
            }
        }

        public function buscarMuestraAProcesar($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT * FROM `muestra_a_procesar` WHERE `IDMuestra_A_Procesar` = '$id';");
            $peticion->execute();
            $array = $peticion->fetch();
            $peticion = null;
            return $array;
        }
        
        public function actualizarMuestraAProcesar($id){
            $peticion = conexion();
            $peticion= $peticion->prepare("UPDATE `muestra_a_procesar` SET `Identificador` = '".$this->identificador."', `Analisis_A_Realizar` = '".$this->analisisARealizar."', `Fecha_De_Toma` = '".$this->fechaDeToma."', `Observaciones` = '".$this->observaciones."' WHERE `IDMuestra_A_Procesar` = ".$id.";");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = null;
                return true;
            }else {
                $peticion = null;
                return false;
            }
        }

        public function eliminarMuestraAProcesar($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("DELETE FROM `muestra_a_procesar` WHERE `IDMuestra_A_Procesar` = ".$id.";");
            $peticion->execute();
            if($peticion->rowCount() > 0){
                $peticion = null;
                return true;
            }else {
                $peticion = null;
                return false;
            }
        }

        public function listarMuestrasAProcrsar($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT * FROM `muestra_a_procesar` WHERE `IDMuestra` = '$id';");
            $peticion->execute();
            $array = $peticion->fetchAll();
            $peticion = null;
            return $array;
        }
        
    }

?>