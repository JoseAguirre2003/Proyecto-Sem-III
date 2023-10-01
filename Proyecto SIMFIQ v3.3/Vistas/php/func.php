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
        if(preg_match("/^".$filtro."$/",$cadena))
            return false;
        else
            return true;
    }

    // function guardarProductor($nombre, $cedulaRIF, $direccion, $localidad, $municipio, $contacto, $traidoPor, $correo, $asesorTecnico){        

    //     $peticion = conexion();
    //     $peticion = $peticion->prepare("INSERT INTO `productor` (`Nombre`, `Cedula_RIF`, `Direccion`, `Localidad`, `Municipio`, `Contacto`, `Traido_Por`, `Correo`, `Asesor_Tecnico`) 
    //                                     VALUES ('".$nombre."', '".$cedulaRIF."', '".$direccion."', '".$localidad."', '".$municipio."', '".$contacto."', '".$traidoPor."', '".$correo."', '".$asesorTecnico."');");
    //     $peticion->execute();
    //     if($peticion->rowCount() == 1){
	// 		$peticion = null;
    //         return "Guardado con exito";
	// 	}else{
	// 		$peticion = null;
    //         return "No se pudo guardar";
	// 	}
    // }

	function guardarMuestraAgua($idProductor, $fechaIngreso, $fuenteAgua, $recibidoPor, $recolectadaPor, $cultivoARegar, $problemasDeSales, $tratamiento_pH, $sistemaRiego, $cantidadUsada, $pHMetro, $conductimetro, $ubicacion, $observacionesGenerales){
		$peticion = conexion();
		$peticion = $peticion->prepare("INSERT INTO `muestra_agua` (`ID_Productor`, `Fecha_Ingreso`, `Fuente_Agua`, `Recibido_Por`, `Recolectada_Por`, `Cultivo_A_Regar`, `Problemas_De_Sales`, `Tratamiento_pH`, `Sistema_Riego`, `Cantidad_Usada`, `pH_Metro`, `Conductimetro`, `Ubicacion`, `Observaciones_Generales`) 
										VALUES ('".$idProductor."', '".$fechaIngreso."', '".$fuenteAgua."', '".$recibidoPor."', '".$recolectadaPor."', '".$cultivoARegar."', '".$problemasDeSales."', '".$tratamiento_pH."', '".$sistemaRiego."', '".$cantidadUsada."', '".$pHMetro."', '".$conductimetro."', '".$ubicacion."', '".$observacionesGenerales."');");
		$peticion->execute();
		if($peticion->rowCount() == 1){
			$peticion = null;
            return "Guardado con exito";
		}else{
			$peticion = null;
			return "No se pudo guardar";
		}
	}

	function guardarMuestraAguaAProcesar($idMuestra, $identificador, $analisisARealizar, $fechaDeToma, $observaciones){
		$peticion = conexion();
		$peticion = $peticion->prepare("INSERT INTO `muestra_agua_a_procesar` (`IDMuestra`, `Identificador`, `Analisis_A_Realizar`, `Fecha_De_Toma`, `Observaciones`)
										VALUES ('".$idMuestra."', '".$identificador."', '".$analisisARealizar."', '".$fechaDeToma."', '".$observaciones."') ");
		$peticion->execute();
		if($peticion->rowCount() == 1){
			$peticion = null;
            return "Guardado con exito";
		}else{
			$peticion = null;
            return "No se pudo guardar";
		}
	}

	function buscarProductor($id){
		$peticion = conexion();
		// $peticion = $peticion->prepare("SELECT * FROM `productor` WHERE `ID_Productor` LIKE '$busqueda' OR `Nombre` LIKE '%$busqueda%' OR `Cedula_RIF` LIKE '%$busqueda%'");
		$peticion = $peticion->prepare("SELECT * FROM `productor` WHERE `ID_Productor` = '$id';");
		$peticion->execute();
		$array = $peticion->fetch();
		$peticion = null;
		return $array;
	}

	function buscarMuestra($id){
		$peticion = conexion();
		$peticion = $peticion->prepare("SELECT * FROM `muestra_agua` WHERE `ID_Muestra` = '$id';");
		$peticion->execute();
		$array = $peticion->fetch();
		$peticion = null;
		return $array;
	}

	//NO HAY PAGINACION
	function listaMuestras($id){
		$peticion = conexion();
		$peticion = $peticion->prepare("SELECT * FROM `muestra_agua` WHERE `ID_Productor` = '$id';");
		$peticion->execute();
		$array = $peticion->fetchAll();
		$peticion = null;
		return $array;
	}

	//NO HAY PAGINACION
	function listaMuestrasAProcesar($id){
		$peticion = conexion();
		$peticion = $peticion->prepare("SELECT * FROM `muestra_agua_a_procesar` WHERE `IDMuestra` = '$id';");
		$peticion->execute();
		$array = $peticion->fetchAll();
		$peticion = null;
		return $array;
	}
?>