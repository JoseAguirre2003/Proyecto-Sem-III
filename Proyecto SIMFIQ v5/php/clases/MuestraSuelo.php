<?php 

class MuestraSuelo{

    private $idProductor;
    private $fechaRecepcion;
    private $localidad;
    private $municipio;
    private $traidoPor;
    private $profundidad;
    private $usoAnterior;
    private $AnalisisARealizar;
    private $hectaria;

	public function getIdProductor() {
		return $this->idProductor;
	}

	public function setIdProductor($idProductor){
		$this->idProductor = $idProductor;
		return $this;
	}

	public function getFechaRecepcion() {
		return $this->fechaRecepcion;
	}
	
	public function setFechaRecepcion($fechaRecepcion){
		$this->fechaRecepcion = $fechaRecepcion;
		return $this;
	}

	public function getLocalidad() {
		return $this->localidad;
	}

	public function setLocalidad($localidad){
		$this->localidad = $localidad;
		return $this;
	}
	
	public function getMunicipio() {
		return $this->municipio;
	}

	public function setMunicipio($municipio){
		$this->municipio = $municipio;
		return $this;
	}

	public function getTraidoPor() {
		return $this->traidoPor;
	}

	public function setTraidoPor($traidoPor){
		$this->traidoPor = $traidoPor;
		return $this;
	}

	public function getProfundidad() {
		return $this->profundidad;
	}
	
	public function setProfundidad($profundidad){
		$this->profundidad = $profundidad;
		return $this;
	}

	public function getUsoAnterior() {
		return $this->usoAnterior;
	}

	public function setUsoAnterior($usoAnterior){
		$this->usoAnterior = $usoAnterior;
		return $this;
	}

	public function getAnalisisARealizar() {
		return $this->AnalisisARealizar;
	}

	public function setAnalisisARealizar($AnalisisARealizar){
		$this->AnalisisARealizar = $AnalisisARealizar;
		return $this;
	}

	public function getHectaria() {
		return $this->hectaria;
	}

	public function setHectaria($hectaria){
		$this->hectaria = $hectaria;
		return $this;
	}

	public function guardarMuestra(){
		$conexion = conexion();
		$peticion = $conexion->prepare("INSERT INTO `muestra_suelo` (`IDProductor`, `Fecha_Recepcion`, `Localidad`, `Municipio`, `Traido_Por`, `Profundidad`, `Uso_Anterior`, `Analisis_A_Realizar`, `Hectaria`) 
										VALUES ('".$this->idProductor."', '".$this->fechaRecepcion."', '".$this->localidad."', '".$this->municipio."', '".$this->traidoPor."', '".$this->profundidad."', '".$this->usoAnterior."', '".$this->AnalisisARealizar."', '".$this->hectaria."');");
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
		$peticion = $peticion->prepare("SELECT * FROM `muestra_suelo` WHERE `IDMuestraSuelo` = '$id';");
		$peticion->execute();
		$array = $peticion->fetch();
		$peticion = null;
		return $array;
	}

	public function actualizarMuestra($id){
		$peticion = conexion();
		$peticion = $peticion->prepare("UPDATE `muestra_suelo` SET `Fecha_Recepcion` = '".$this->fechaRecepcion."', `Localidad` = '".$this->localidad."', `Municipio` = '".$this->municipio."', `Traido_Por` = '".$this->traidoPor."', `Profundidad` = '".$this->profundidad."', `Uso_Anterior` = '".$this->usoAnterior."', `Analisis_A_Realizar` = '".$this->AnalisisARealizar."', `Hectaria` = '".$this->hectaria."' WHERE `IDMuestraSuelo` = ".$id.";");
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
		$peticion = $peticion->prepare("DELETE FROM `muestra_suelo` WHERE `IDMuestraSuelo` = ".$id.";");
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
		$peticion = $peticion->prepare("SELECT * FROM `muestra_suelo` WHERE `IDMuestraSuelo` = '$id';");
		$peticion->execute();
		$array = $peticion->fetchAll();
		$peticion = null;
		return $array;
	}
}

?>