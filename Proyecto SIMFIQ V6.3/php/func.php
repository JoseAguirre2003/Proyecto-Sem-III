<?php 
	// echo "aaaaa";
	
    function conexion(){
        $pdo = new PDO('mysql:host=localhost;dbname=simfiq','root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    function limpiarCadena($cadena){
        $cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
    }

    function verficarDatos($filtro,$cadena){
        if(preg_match($filtro,$cadena))
            return false;
        else
            return true;
    }

	function validarProductor($nombre, $ciRIF, $direccion, $localidad, $municipio, $contacto, $traidorPor, $correo, $asesorTecnico){
		if(limpiarCadena($nombre) == "")
			return false;
		if(limpiarCadena($ciRIF) == "")
			return false;
		if(limpiarCadena($direccion) == "")
			return false;
		if(limpiarCadena($localidad) == "")
			return false;
		if(limpiarCadena($municipio) == "")
			return false;
		if(verficarDatos('/^[0-9\-]+$/', $contacto))
			return false;
		if(limpiarCadena($traidorPor) == "")
			return false;
		if(!filter_var($correo, FILTER_VALIDATE_EMAIL))
			return false;
		if(limpiarCadena($asesorTecnico) == "")
			return false;
		return true;
	}

	function validarMuestraAgua($fechaIngreso, $fuenteAgua, $recibidoPor, $recolectadaPor, $cultivoARegar, $problemasDeSales, $tratamiento_pH, $sistemaRiego, $cantidadUsada, $pHMetro, $conductimetro, $ubicacion, $observacionesGenerales){
		if(!DateTime::createFromFormat("Y-m-d", $fechaIngreso))
			return false;
		if(limpiarCadena($fuenteAgua) == "")
			return false;
		if(limpiarCadena($recibidoPor) == "")
			return false;
		if(limpiarCadena($recolectadaPor) == "")
			return false;
		if(limpiarCadena($cultivoARegar) == "")
			return false;
		if(limpiarCadena($problemasDeSales) != "Si" && limpiarCadena($problemasDeSales) != "No" && limpiarCadena($problemasDeSales) != "No lo se")
			return false;
		if(limpiarCadena($tratamiento_pH) == "")
			return false;
		if(limpiarCadena($sistemaRiego) == "")
			return false;
		if(!is_numeric($cantidadUsada))
			return false;
		if(!is_numeric($pHMetro) || $pHMetro > 14 || $pHMetro < 0)
			return false;
		if(!is_numeric($conductimetro))
			return false;
		if(limpiarCadena($ubicacion) == "")
			return false;
		if(limpiarCadena($observacionesGenerales) == "")
			return false;
		return true;
	}

	function validarMuestraSuelo($fechaRecepcion ,$localidad, $municipio, $traidoPor, $profundidad, $usoAnterior, $hectaria){
		if(!DateTime::createFromFormat("Y-m-d", $fechaRecepcion))
			return false;
		if(limpiarCadena($localidad) == "")
			return false;
		if(limpiarCadena($municipio) == "")
			return false;
		if(limpiarCadena($traidoPor) == "")
			return false;
		if(!is_numeric($profundidad))
			return false;
		if(limpiarCadena($usoAnterior) == "")
			return false;
		if(!is_numeric($hectaria))
			return false;
		return true;
	}

	function validarMuestrasAProcesar($identificador, $analisisARealizar, $fechaDeToma, $observaciones){
		if(limpiarCadena($identificador) == "")
			return false;
		if(limpiarCadena($analisisARealizar) != "pH" && limpiarCadena($analisisARealizar) != "Conductividad" && limpiarCadena($analisisARealizar) != "Especial" && limpiarCadena($analisisARealizar) != "Todo")
			return false;
		if(!DateTime::createFromFormat("Y-m-d", $fechaDeToma))
			return false;
		if(limpiarCadena($observaciones) == "")
			return false;
		return true;
	}

?>