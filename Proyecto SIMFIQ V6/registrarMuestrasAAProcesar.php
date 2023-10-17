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
    <section class="container">
            <header>Ingreso de datos de Muestra a Procesar:</header>
            <?php 
                include_once "./php/func.php";
                include "./php/clases/MAaProcesar.php";

                if(isset($_GET['id']) && is_numeric($_GET['id'])){
                    $muestrasAProcesar = new MAaProcesar;
                    $muestrasAProcesar = $muestrasAProcesar->buscarMuestraAProcesar($_GET['id']);
                    if(!$muestrasAProcesar)
                        unset($muestrasAProcesar);
                    else
                        echo "ID de la Muestra a cambiar: ".$muestrasAProcesar['IDMuestra_A_Procesar'];
                }else
                    unset($_GET['id']);

                if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_POST['actualizar'])){
                    $muestrasAProcesar = new MAaProcesar;
                    $muestrasAProcesar->setIdentificador($_POST['identificador']);
                    $muestrasAProcesar->setAnalisisARealizar($_POST['analisisARealizar']);
                    $muestrasAProcesar->setFechaDeToma($_POST['fechaDeToma']);
                    $muestrasAProcesar->setObservaciones($_POST['observaciones']);
                    if($muestrasAProcesar->actualizarMuestraAProcesar($_GET['id'])){
                        echo "<br>ACTUALIZADO CON EXITO :)";
                        $muestrasAProcesar = $muestrasAProcesar->buscarMuestraAProcesar($_GET['id']);
                    }else{
                        echo "<br>NO SE PUDO ACTUALIZAR :(";
                        unset($muestrasAProcesar);
                    }
                }else if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_POST['eliminar'])){
                    $muestrasAProcesar = new MAaProcesar;
                    if($muestrasAProcesar->eliminarMuestraAProcesar($_GET['id'])){
                        echo "SE ha Eliminado";
                        unset($muestrasAProcesar);
                    }else{
                        echo "<br>NO SE HA PODIDO ELIMINAR :)";
                        unset($muestrasAProcesar);
                    }
                }
                
            ?>
            <form action="" method="POST" class="form">
                <div class="imput-box">
                    <label for="idMuestra">ID de Muestra:</label>
                    <input type="text" placeholder="Id" name="idMuestra" id="idMuestra" value=<?php if(isset($muestrasAProcesar)) echo '"'.$muestrasAProcesar['IDMuestra'].'" disabled';?>>
                </div>

                <div class="imput-box">
                    <label for="identificador">Identificador:</label>
                    <input type="text" placeholder="Indentificador" name="identificador" id="identificador" value=<?php if(isset($muestrasAProcesar)) echo $muestrasAProcesar['Identificador'];?>>
                </div>

                <div class="imput-box">
                    <label for="analisisARealizar">Analisis a realizar:</label>
                    <input type="text" placeholder="Analisis a realizar" name="analisisARealizar" id="analisisARealizar" value=<?php if(isset($muestrasAProcesar)) echo $muestrasAProcesar['Analisis_A_Realizar'];?>>
                </div>

                <div class="imput-box">
                    <label for="fechaDeToma">Fecha de toma:</label><br>
                    <input type="date" name="fechaDeToma" id="fechaDeToma" value=<?php if(isset($muestrasAProcesar)) echo $muestrasAProcesar['Fecha_De_Toma'];?>>
                </div>

                <div class="imput-box">
                    <label for="observaciones">Observaciones</label><br>
                    <input type="text" placeholder="Observaciones..." name="observaciones" id="observaciones" value=<?php if(isset($muestrasAProcesar)) echo $muestrasAProcesar['Observaciones'];?>>
                </div>

                <input type="submit" name="actualizar" value="Actualizar" class="button">
                <input type="submit" name="eliminar" value="Eliminar" class="button">
            </form>
        </section>

<?php include "./inc/htmlClose.php"; ?>