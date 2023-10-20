<?php 
    class Resultados{
        private $idMAP;
        private $Suelo_PH;
        private $Suelo_Ce;
        private $Suelo_CIC;
        private $Suelo_Textura;
        private $Agua_pH;
        private $Agua_Ce;
        private $Agua_ParticulasSuspension;

        public function getIdMAP() {
            return $this->idMAP;
        }
        
        public function setIdMAP($idMAP){
            $this->idMAP = $idMAP;
            return $this;
        }
        
        public function getSuelo_PH() {
            return $this->Suelo_PH;
        }
        
        public function setSuelo_PH($Suelo_PH){
            $this->Suelo_PH = $Suelo_PH;
            return $this;
        }

        public function getSuelo_Ce() {
            return $this->Suelo_Ce;
        }

        public function setSuelo_Ce($Suelo_Ce){
            $this->Suelo_Ce = $Suelo_Ce;
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

        public function getAgua_pH() {
            return $this->Agua_pH;
        }

        public function setAgua_pH($Agua_pH){
            $this->Agua_pH = $Agua_pH;
            return $this;
        }

        public function getAgua_Ce() {
            return $this->Agua_Ce;
        }

        public function setAgua_Ce($Agua_Ce){
            $this->Agua_Ce = $Agua_Ce;
            return $this;
        }

        public function getAgua_ParticulasSuspension() {
            return $this->Agua_ParticulasSuspension;
        }

        public function setAgua_ParticulasSuspension($Agua_ParticulasSuspension){
            $this->Agua_ParticulasSuspension = $Agua_ParticulasSuspension;
            return $this;
        }

        public function guardarResultado(){
            $conexion = conexion();
            $peticion = $conexion->prepare("INSERT INTO `analisis` (`IDMAP`, `Suelo_PH`, `Suelo_Ce`, `Suelo_CIC`, `Suelo_Textura`, `Agua_pH`, `Agua_Ce`, `Agua_ParticulasSuspension`) 
                                            VALUES ('".$this->idMAP."', '".$this->Suelo_PH."', '".$this->Suelo_Ce."', '".$this->Suelo_CIC."', '".$this->Suelo_Textura."', '".$this->Agua_pH."', '".$this->Agua_Ce."', '".$this->Agua_ParticulasSuspension."')");
            
            return; 
        }
    }
?>