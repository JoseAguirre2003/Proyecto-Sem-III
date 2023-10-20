<?php 

    class MAaProcesar{
        private $identificador;
        private $analisisARealizar;
        private $fechaDeToma;
        private $observaciones;
        
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

        public function guardarMuestraAProcesar_Agua($IDMuestra){
            $conexion = conexion();
            $peticion = $conexion->prepare("INSERT INTO `muestra_a_procesar` (`Tipo`, `Identificador`, `Analisis_A_Realizar`, `Fecha_De_Toma`, `Observaciones`)
                                            VALUES ('Agua' ,'".$this->identificador."', '".$this->analisisARealizar."', '".$this->fechaDeToma."', '".$this->observaciones."');");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = $conexion;
                $idMuesAP = $peticion->query("SELECT LAST_INSERT_ID()")->fetch()[0];
                $peticion->query("INSERT INTO `maguaxmap` (`IDMuestraAgua`, `IDMuestraAProcesar`) VALUES ('".$IDMuestra."', '".$idMuesAP."')");
                $peticion = null;
                return true;
            }else{
                $peticion = null;
                return false;
            }
        }

        public function guardarMuestraAProcesar_Suelo($IDMuestra){
            $conexion = conexion();
            $peticion = $conexion->prepare("INSERT INTO `muestra_a_procesar` (`Tipo`, `Identificador`, `Analisis_A_Realizar`, `Fecha_De_Toma`, `Observaciones`)
                                            VALUES ('Suelo' ,'".$this->identificador."', '".$this->analisisARealizar."', '".$this->fechaDeToma."', '".$this->observaciones."');");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = $conexion;
                $idMuesAP = $peticion->query("SELECT LAST_INSERT_ID()")->fetch()[0];
                $peticion->query("INSERT INTO `msueloxmap` (`IDMuestraSuelo`, `IDMuestraAProcesar`) VALUES ('".$IDMuestra."', '".$idMuesAP."')");
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

        public function listarMuestrasAProcrsarAgua($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT muestra_a_procesar.* FROM muestra_a_procesar INNER JOIN maguaxmap ON muestra_a_procesar.IDMuestra_A_Procesar = maguaxmap.IDMuestraAProcesar WHERE maguaxmap.IDMuestraAgua = ".$id." ORDER BY muestra_a_procesar.IDMuestra_A_Procesar ASC;");
            $peticion->execute();
            $array = $peticion->fetchAll();
            $peticion = null;
            return $array;
        }

        public function listarMuestrasAProcrsarSuelo($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT muestra_a_procesar.* FROM muestra_a_procesar INNER JOIN msueloxmap ON muestra_a_procesar.IDMuestra_A_Procesar = msueloxmap.IDMuestraAProcesar WHERE msueloxmap.IDMuestraSuelo = ".$id." ORDER BY muestra_a_procesar.IDMuestra_A_Procesar ASC;");
            $peticion->execute();
            $array = $peticion->fetchAll();
            $peticion = null;
            return $array;
        }

        public function verTipo($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT `Tipo`, `Analisis_A_Realizar` FROM `muestra_a_procesar` WHERE `IDMuestra_A_Procesar` = '$id';");
            $peticion->execute();
            $tipo = $peticion->fetch();
            $peticion = null;
            return $tipo;
        }
        
    }

?>