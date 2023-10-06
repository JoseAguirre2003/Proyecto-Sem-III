<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Entrada de datos</title>
        <link rel="stylesheet" href="./styles/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <section class="container">
            <header>Ingreso de datos de Muestra a Procesar:</header>
            <?php 
                include_once "../php/func.php";
                include "../../clases/MAaProcesar.php";

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
                

                // if(isset($_POST['idMuestra'])){
                //     if(limpiarCadena($_POST['idMuestra']) && limpiarCadena($_POST['identificador']) && limpiarCadena($_POST['analisisARealizar']) && limpiarCadena($_POST['fechaDeToma']) && limpiarCadena($_POST['observaciones'])){
                //         // $respuesta = guardarMuestraAguaAProcesar($_POST['idMuestra'], $_POST['identificador'], $_POST['analisisARealizar'], $_POST['fechaDeToma'], $_POST['observaciones']);
                //         // echo "<h3>".$respuesta."</h3>";
                //         $muestrasAProcesar = new MAaProcesar;

                //     }else
                //         echo "DATO ERRADO";
                // }
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
    </body>
</html>