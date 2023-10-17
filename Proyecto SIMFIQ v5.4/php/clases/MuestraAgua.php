<?php 
    class MuestraAgua{

        private $idProductor;
        private $fechaIngreso;
        private $fuenteAgua;
        private $recibidoPor;
        private $recolectadaPor;
        private $cultivoARegar;
        private $problemasDeSales;
        private $tratamiento_pH;
        private $sistemaRiego;
        private $cantidadUsada;
        private $pHMetro;
        private $conductimetro;
        private $ubicacion;
        private $observacionesGenerales;

        
        public function getIdProductor() {
            return $this->idProductor;
        }
	
        public function setIdProductor($idProductor){
            $this->idProductor = $idProductor;
            return $this;
        }

        public function getFechaIngreso() {
            return $this->fechaIngreso;
        }

        public function setFechaIngreso($fechaIngreso){
            $this->fechaIngreso = $fechaIngreso;
            return $this;
        }

        public function getFuenteAgua() {
            return $this->fuenteAgua;
        }

        public function setFuenteAgua($fuenteAgua){
            $this->fuenteAgua = $fuenteAgua;
            return $this;
        }

        public function getRecibidoPor() {
            return $this->recibidoPor;
        }
        
        public function setRecibidoPor($recibidoPor){
            $this->recibidoPor = $recibidoPor;
            return $this;
        }

        public function getRecolectadaPor() {
            return $this->recolectadaPor;
        }
        
        public function setRecolectadaPor($recolectadaPor){
            $this->recolectadaPor = $recolectadaPor;
            return $this;
        }

        public function getCultivoARegar() {
            return $this->cultivoARegar;
        }
        
        public function setCultivoARegar($cultivoARegar){
            $this->cultivoARegar = $cultivoARegar;
            return $this;
        }

        public function getProblemasDeSales() {
            return $this->problemasDeSales;
        }
        
        public function setProblemasDeSales($problemasDeSales){
            $this->problemasDeSales = $problemasDeSales;
            return $this;
        }

        public function getTratamiento_pH() {
            return $this->tratamiento_pH;
        }

        public function setTratamiento_pH($tratamiento_pH){
            $this->tratamiento_pH = $tratamiento_pH;
            return $this;
        }

        public function getSistemaRiego() {
            return $this->sistemaRiego;
        }
        
        public function setSistemaRiego($sistemaRiego){
            $this->sistemaRiego = $sistemaRiego;
            return $this;
        }

        public function getCantidadUsada() {
            return $this->cantidadUsada;
        }
        
        public function setCantidadUsada($cantidadUsada){
            $this->cantidadUsada = $cantidadUsada;
            return $this;
        }

        public function getPHMetro() {
            return $this->pHMetro;
        }
        
        public function setPHMetro($pHMetro){
            $this->pHMetro = $pHMetro;
            return $this;
        }

        public function getConductimetro() {
            return $this->conductimetro;
        }
        
        public function setConductimetro($conductimetro){
            $this->conductimetro = $conductimetro;
            return $this;
        }

        public function getUbicacion() {
            return $this->ubicacion;
        }

        public function setUbicacion($ubicacion){
            $this->ubicacion = $ubicacion;
            return $this;
        }

        public function getObservacionesGenerales() {
            return $this->observacionesGenerales;
        }

        public function setObservacionesGenerales($observacionesGenerales){
            $this->observacionesGenerales = $observacionesGenerales;
            return $this;
        }

        public function guardarMuestra(){
            $conexion = conexion();
            $peticion = $conexion->prepare("INSERT INTO `muestra_agua` (`ID_Productor`, `Fecha_Ingreso`, `Fuente_Agua`, `Recibido_Por`, `Recolectada_Por`, `Cultivo_A_Regar`, `Problemas_De_Sales`, `Tratamiento_pH`, `Sistema_Riego`, `Cantidad_Usada`, `pH_Metro`, `Conductimetro`, `Ubicacion`, `Observaciones_Generales`) 
                                            VALUES ('".$this->idProductor."', '".$this->fechaIngreso."', '".$this->fuenteAgua."', '".$this->recibidoPor."', '".$this->recolectadaPor."', '".$this->cultivoARegar."', '".$this->problemasDeSales."', '".$this->tratamiento_pH."', '".$this->sistemaRiego."', '".$this->cantidadUsada."', '".$this->pHMetro."', '".$this->conductimetro."', '".$this->ubicacion."', '".$this->observacionesGenerales."');");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = $conexion;
                return $peticion->query("SELECT LAST_INSERT_ID()")->fetch()[0];
            }else{
                $peticion = null;
                return false;
            }
        }

        public function buscarMuestra($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT * FROM `muestra_agua` WHERE `ID_Muestra` = '$id';");
            $peticion->execute();
            $array = $peticion->fetch();
            $peticion = null;
            return $array;
        }

        public function actualizarMuestra($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("UPDATE `muestra_agua` SET `Fecha_Ingreso` = '".$this->fechaIngreso."', `Fuente_Agua` = '".$this->fuenteAgua."', `Recibido_Por` = '".$this->recibidoPor."', `Recolectada_Por` = '".$this->recolectadaPor."', `Cultivo_A_Regar` = '".$this->cultivoARegar."', `Problemas_De_Sales` = '".$this->problemasDeSales."', `Tratamiento_pH` = '".$this->tratamiento_pH."', `Sistema_Riego` = '".$this->sistemaRiego."', `Cantidad_Usada` = '".$this->cantidadUsada."', `pH_Metro` = '".$this->pHMetro."', `Conductimetro` = '".$this->conductimetro."', `Ubicacion` = '".$this->ubicacion."', `Observaciones_Generales` = '".$this->observacionesGenerales."' WHERE `ID_Muestra` = ".$id.";");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = null;
                return true;
            }else {
                $peticion = null;
                return false;
            }
        }

        public function eliminarMuestra($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("DELETE FROM `muestra_agua` WHERE `ID_Muestra` = ".$id.";");
            $peticion->execute();
            if($peticion->rowCount() > 0){
                $peticion = null;
                return true;
            }else {
                $peticion = null;
                return false;
            }
        }

        public function listarMuestras($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT * FROM `muestra_agua` WHERE `ID_Productor` = '$id';");
            $peticion->execute();
            $array = $peticion->fetchAll();
            $peticion = null;
            return $array;
        }
    }

?>