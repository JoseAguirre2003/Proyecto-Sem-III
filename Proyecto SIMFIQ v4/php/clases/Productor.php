<?php 
    class Prodcutor{

        private $nombre;
        private $ciRIF;
        private $direccion;
        private $localidad;
        private $municipio;
        private $contacto;
        private $traidoPor;
        private $correo;
        private $asesorTecnico;

        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getCiRIF(){
            return $this->ciRIF;
        }

        public function setCiRIF($ciRIF){
            $this->ciRIF = $ciRIF;
        }

        public function getDireccion(){
            return $this->direccion;
        }

        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }

        public function getLocalidad(){
            return $this->localidad;
        }

        public function setLocalidad($localidad){
            $this->localidad = $localidad;
        }

        public function getMunicipio(){
            return $this->municipio;
        }

        public function setMunicipio($municipio){
            $this->municipio = $municipio;
        }

        public function getContacto(){
            return $this->contacto;
        }

        public function setContacto($contacto){
            $this->contacto = $contacto;
        }

        public function getTraidoPor(){
            return $this->traidoPor;
        }

        public function setTraidoPor($traidoPor){
            $this->traidoPor = $traidoPor;
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function setCorreo($correo){
            $this->correo = $correo;
        }

        public function getAsesorTecnico(){
            return $this->asesorTecnico;
        }

        public function setAsesorTecnico($asesorTecnico){
            $this->asesorTecnico = $asesorTecnico;
        }

        public function guardarProductor(){
            $peticion = conexion();
            $peticion = $peticion->prepare("INSERT INTO `productor` (`Nombre`, `Cedula_RIF`, `Direccion`, `Localidad`, `Municipio`, `Contacto`, `Traido_Por`, `Correo`, `Asesor_Tecnico`) 
                                            VALUES ('".$this->nombre."', '".$this->ciRIF."', '".$this->direccion."', '".$this->localidad."', '".$this->municipio."', '".$this->contacto."', '".$this->traidoPor."', '".$this->correo."', '".$this->asesorTecnico."');");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = null;
                return true;
            }else{
                $peticion = null;
                return false;
            }
        }

        public function buscarProductor($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("SELECT * FROM `productor` WHERE `ID_Productor` = '$id';");
            $peticion->execute();
            $array = $peticion->fetch();
            $peticion = null;
            return $array;
        }

        public function actualizarProdcutor($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("UPDATE `productor` SET `Nombre` = '".$this->nombre."', `Cedula_RIF` = '".$this->ciRIF."', `Direccion` = '".$this->direccion."', `Localidad` = '".$this->localidad."', `Municipio` = '".$this->municipio."', `Contacto` = '".$this->contacto."', `Traido_Por` = '".$this->traidoPor."', `Correo` = '".$this->correo."', `Asesor_Tecnico` = '".$this->asesorTecnico."' WHERE `ID_Productor` = ".$id.";");
            $peticion->execute();
            if($peticion->rowCount() == 1){
                $peticion = null;
                return true;
            }else {
                $peticion = null;
                return false;
            }
        }
        
        public function eliminarProductor($id){
            $peticion = conexion();
            $peticion = $peticion->prepare("DELETE FROM `productor` WHERE `ID_Productor` = ".$id.";");
            $peticion->execute();
            if($peticion->rowCount() > 0){
                $peticion = null;
                return true;
            }else {
                $peticion = null;
                return false;
            }
        }

        public function listarProductores($pagina, $registros, $busqueda){
            $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

            if(isset($busqueda) && $busqueda != ""){
                // $consultaDatos = "SELECT * FROM productor WHERE ID_Productor LIKE '$busqueda' OR Nombre LIKE '%$busqueda%' OR Cedula_RIF LIKE '%$busqueda%' LIMIT $inicio, $registros;";    
                $consultaDatos = "SELECT * FROM productor WHERE ID_Productor LIKE '$busqueda' OR Nombre LIKE '%$busqueda%' OR Cedula_RIF LIKE '%$busqueda%';";
                // $consultaTotal = "SELECT COUNT(ID_Productor) FROM productor WHERE ID_Productor LIKE '$busqueda' OR Nombre LIKE '%$busqueda%' OR Cedula_RIF LIKE '%$busqueda%';";
            }else{
                $consultaDatos = "SELECT * FROM productor LIMIT $inicio, $registros;";    
                // $consultaTotal = "SELECT COUNT(ID_Productor) FROM productor;";
            }

            $conexion = conexion();

            $datos = $conexion->query($consultaDatos);
            $datos = $datos->fetchAll();

            $conexion = null;
            return $datos;
        }
    }

?>