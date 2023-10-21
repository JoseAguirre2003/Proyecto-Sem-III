<?php 
    class Resultados{
        private $idMAP;
        private $pH;
        private $Ce;
        private $Suelo_CIC;
        private $Suelo_Textura;
        private $Agua_ParticulasSuspension;

        public function getIdMAP() {
            return $this->idMAP;
        }
        
        public function setIdMAP($idMAP){
            $this->idMAP = $idMAP;
            return $this;
        }
        
        public function get_pH() {
            return $this->pH;
        }
        
        public function set_pH($pH){
            $this->pH = $pH;
            return $this;
        }

        public function getCe() {
            return $this->Ce;
        }

        public function setCe($Ce){
            $this->Ce = $Ce;
            return $this;
        }

        public function getSuelo_CIC() {
            return $this->Suelo_CIC;
        }
        
        public function setSuelo_CIC($Suelo_CIC){
            $this->Suelo_CIC = $Suelo_CIC;
            return $this;
        }

        public function getSuelo_Textura() {
            return $this->Suelo_Textura;
        }
        
        public function setSuelo_Textura($Suelo_Textura){
            $this->Suelo_Textura = $Suelo_Textura;
            return $this;
        }

        public function getAgua_ParticulasSuspension() {
            return $this->Agua_ParticulasSuspension;
        }

        public function setAgua_ParticulasSuspension($Agua_ParticulasSuspension){
            $this->Agua_ParticulasSuspension = $Agua_ParticulasSuspension;
            return $this;
        }

        public function __construct(){
            $this->pH = null;
            $this->Ce = null;
            $this->Suelo_CIC = null;
            $this->Suelo_Textura = null;
            $this->Agua_ParticulasSuspension = null;
        }
        public function guardarResultado(){
            $conexion = conexion();
            $peticion = $conexion->prepare("INSERT INTO `analisis` (`IDMAP`, `pH`, `Ce`, `Suelo_CIC`, `Suelo_Textura`, `Agua_ParticulasSuspension`) 
                                            VALUES ('".$this->idMAP."', '".$this->pH."', '".$this->Ce."', '".$this->Suelo_CIC."',  '".$this->Suelo_Textura."', '".$this->Agua_ParticulasSuspension."')");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = $conexion;
                $precio = 0;
                $precio += ($this->pH != null) ? 5 : 0;
                $precio += ($this->Ce != null) ? 5 : 0;
                $precio += ($this->Suelo_CIC != null) ? 10 : 0;
                $precio += ($this->Suelo_Textura != null) ? 10 : 0;
                $precio += ($this->Agua_ParticulasSuspension != null) ? 5 : 0;
                $idAnalisis = $peticion->query("SELECT LAST_INSERT_ID()")->fetch()[0];
                $peticion->query("INSERT INTO `facturacion` (`IDAnalisis`, `Precio`) VALUES ('".$idAnalisis."', '".$precio."') ");
                $conexion = null;
                $peticion = null;
                return true;
            }else{
                $conexion = null;
                $peticion = null;
                return false;
            }
        }

        public function buscarResultados($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT analisis.*, Precio FROM analisis INNER JOIN facturacion ON analisis.IDAnalisis = facturacion.IDAnalisis WHERE analisis.IDMAP = $id;");
            $peticion->execute();
            $array = $peticion->fetch();
            $peticion = null;
            return $array;
        }
    }
?>