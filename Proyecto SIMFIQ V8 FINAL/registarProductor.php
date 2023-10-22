<?php
session_start();

if ($_SESSION["s_usuario"] === null){
    header("Location: ./index.php?vista=login");
}

    include "./inc/htmlOpen.php";

    if(isset($_SESSION['s_idRol']))
        if($_SESSION['s_idRol'] == 1){
            $rol = "Admin";
            include "./inc/headerAndNavAdmin.php";
        }else{
            $rol = "Usuario";
            include "./inc/headerAndNav.php";
        }
    else
        header("./logout.php");
?>

<section class="sub-body">
    <div class="sub-container">
            <header class="form-tittle">Ingreso de datos de Productor:</header>
            <?php 
                
                include "./php/func.php";
                include "./php/clases/Productor.php";

                if(isset($_GET['id']) && is_numeric($_GET['id'])){
                    $productor = new Productor;
                    $productor = $productor->buscarProductor($_GET['id']);
                    echo "ID del prodcutor Productor a cambiar: ".$productor['ID_Productor'];
                    if(!$productor)
                        unset($productor);
                }else
                    unset($_GET['id']);

                if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_POST['actualizar'])){
                    $productor = new Productor;
                    if(validarProductor($_POST['nombre'], $_POST['cedulaRIF'], $_POST['direccion'], $_POST['localidad'], $_POST['municipio'], $_POST['contacto'], $_POST['traidoPor'], $_POST['correo'], $_POST['asesorTecnico'])){ 
                        $productor->setNombre(limpiarCadena($_POST['nombre']));
                        $productor->setCiRIF(limpiarCadena($_POST['cedulaRIF']));
                        $productor->setDireccion(limpiarCadena($_POST['direccion']));
                        $productor->setLocalidad(limpiarCadena($_POST['localidad']));
                        $productor->setMunicipio(limpiarCadena($_POST['municipio']));
                        $productor->setContacto(limpiarCadena($_POST['contacto']));
                        $productor->setTraidoPor(limpiarCadena($_POST['traidoPor']));
                        $productor->setCorreo(limpiarCadena($_POST['correo']));
                        $productor->setAsesorTecnico(limpiarCadena($_POST['asesorTecnico']));
                        $productor = $productor->actualizarProductor($_GET['id']);
                        if($productor){
                            echo "<br>ACTUALIZADO CON EXITO";
                            $productor = new Productor;
                            $productor = $productor->buscarProductor($_GET['id']);
                        }else{
                            echo "<br>NO SE PUDO ACTUALIZAR";
                            unset($productor);
                        }
                    }else{
                        echo "<br>NO SE PUDO ACTUALIZAR, DATOS ERRADOS";
                        unset($productor);
                    }
                }else if(isset($_POST['guardar']) && isset($_POST['nombre']) && isset($_POST['cedulaRIF']) && isset($_POST['direccion']) && isset($_POST['contacto'])){
                    if(validarProductor($_POST['nombre'], $_POST['cedulaRIF'], $_POST['direccion'], $_POST['localidad'], $_POST['municipio'], $_POST['contacto'], $_POST['traidoPor'], $_POST['correo'], $_POST['asesorTecnico'])){ 
                        $productor = new Productor;
                        $productor->setNombre(limpiarCadena($_POST['nombre']));
                        $productor->setCiRIF(limpiarCadena($_POST['cedulaRIF']));
                        $productor->setDireccion(limpiarCadena($_POST['direccion']));
                        $productor->setLocalidad(limpiarCadena($_POST['localidad']));
                        $productor->setMunicipio(limpiarCadena($_POST['municipio']));
                        $productor->setContacto(limpiarCadena($_POST['contacto']));
                        $productor->setTraidoPor(limpiarCadena($_POST['traidoPor']));
                        $productor->setCorreo(limpiarCadena($_POST['correo']));
                        $productor->setAsesorTecnico(limpiarCadena($_POST['asesorTecnico']));
                        $productor = $productor->guardarProductor();
                        if(!$productor){
                            echo "NO SE PUDO GUARDAR :(";
                            unset($productor);
                        }else{
                            echo 'GUARDADO CON EXITO!! :)<br>
                            <button><a href="./registrarMuestraAgua.php?idRegist='.$productor.'">Click aqui para registrar meustra de agua</a></button><br>
                            <button><a href="./registrarMuestraSuelo.php?idRegist='.$productor.'">Click aqui para registrar meustra de suelo</a></button><br> ';
                            unset($productor);
                        }
                    }else{
                        echo "<br>NO SE PUDO GUARDAR, DATOS ERRADOS";
                        unset($productor);
                    }
                }
  
            ?>
            <form action="" method="POST" class="form">
                <div class="main-user-info">
                <div class="imput-box">
                    <label for="nombre">Nombre:</label>
                    <input type="text" placeholder="Nombre" name="nombre" id="nombre" value="<?php if(isset($productor)) echo $productor['Nombre'];?>">
                </div>

                <div class="imput-box">
                    <label for="cedulaRIF">Cedula o RIF:</label>
                    <input type="text" placeholder="Cedula o RIF" name="cedulaRIF" id="cedulaRIF" value="<?php if(isset($productor)) echo $productor['Cedula_RIF'];?>">
                </div>

                <div class="imput-box">
                    <label for="direccion">Direccion:</label>
                    <input type="text" placeholder="Direccion" name="direccion" id="direccion" value="<?php if(isset($productor)) echo $productor['Direccion'];?>">
                </div>

                <div class="imput-box">
                    <label for="localidad">Localidad:</label>
                    <input type="text" placeholder="Localidad" name="localidad" id="localidad" value="<?php if(isset($productor)) echo $productor['Localidad'];?>">
                </div>

                <div class="imput-box">
                    <label for="municipio">Municipio:</label><br>
                    <input type="text" placeholder="Municipio" name="municipio" id="municipio" value="<?php if(isset($productor)) echo $productor['Municipio'];?>">
                </div>

                <div class="imput-box">
                    <label for="contacto">Contacto:</label><br>
                    <input type="text" placeholder="Contacto" name="contacto" id="contacto" value="<?php if(isset($productor)) echo $productor['Contacto'];?>">
                </div>

                <div class="imput-box">
                    <label for="traidoPor">Traido por:</label><br>
                    <input type="text" placeholder="Traido por..." name="traidoPor" id="traidoPor" value="<?php if(isset($productor)) echo $productor['Traido_Por'];?>">
                </div>

                <div class="imput-box">
                    <label for="correo">Correo:</label><br>
                    <input type="text" placeholder="correo@mail.com" name="correo" id="correo" value="<?php if(isset($productor)) echo $productor['Correo'];?>">
                </div>

                <div class="imput-box">
                    <label for="asesorTecnico">Asesor tecnico:</label><br>
                    <input type="text" placeholder="Asesor Tecnico..." name="asesorTecnico" id="asesorTecnico" value="<?php if(isset($productor)) echo $productor['Asesor_Tecnico'];?>">
                </div>

                <input type="submit" name="<?php if(isset($_GET['id'])) echo "actualizar"; else echo "guardar"; ?>" value="Guardar" class="button">
                </div>
            </form>
            </div>
        </section>

<?php 
    include "./inc/htmlClose.php";
?>