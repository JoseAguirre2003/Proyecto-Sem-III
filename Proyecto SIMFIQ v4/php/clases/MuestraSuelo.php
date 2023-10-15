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
}



?>