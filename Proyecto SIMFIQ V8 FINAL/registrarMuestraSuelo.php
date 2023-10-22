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
<section class="sub-body3">
    <div class="sub-container2">
    <header class="form-tittle">Ingreso de datos de Muestra de Suelo:</header>
    <?php
        include_once "./php/func.php";
        include "./php/clases/MuestraSuelo.php";
        include "./php/clases/MAaProcesar.php";

        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $muestra = new MuestraSuelo;
            $muestra = $muestra->buscarMuestra($_GET['id']);
            if(!$muestra)
                unset($muestra);
            else
                echo "ID de la Muestra a cambiar: ".$muestra['IDMuestraSuelo']."<br>";
        }else
            unset($_GET['id']);

        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_POST['actualizar'])){
            $muestra = new MuestraSuelo;
            if(validarMuestraSuelo($_POST['fehaRecepcion'], $_POST['localidad'], $_POST['municipio'], $_POST['traidoPor'], $_POST['profundidad'], $_POST['usoAnterior'], $_POST['hectaria'])){
                $muestra->setFechaRecepcion($_POST['fehaRecepcion']);
                $muestra->setLocalidad($_POST['localidad']);
                $muestra->setMunicipio($_POST['municipio']);
                $muestra->setTraidoPor($_POST['traidoPor']);
                $muestra->setProfundidad($_POST['profundidad']);
                $muestra->setUsoAnterior($_POST['usoAnterior']);
                $muestra->setHectaria($_POST['hectaria']);
                if($muestra->actualizarMuestra($_GET['id'])){
                    echo "<br>ACTUALIZADO CON EXITO :)";
                    $muestra = $muestra->buscarMuestra($_GET['id']);
                }else{
                    echo "<br>NO SE PUDO ACTUALIZAR :(";
                    unset($muestra);
                }
            }else{
                echo "<br>NO SE PUDO ACTUALIZAR DATOS ERRADOS:(";
                unset($muestra);
            }

        }else if(isset($_POST['idProductor']) && isset($_POST['guardar'])){
            echo "se va guardar ". $_POST['idProductor']."<br>";
            $muestra = new MuestraSuelo;
            if(is_numeric($_POST['idProductor']) && validarMuestraSuelo($_POST['fehaRecepcion'], $_POST['localidad'], $_POST['municipio'], $_POST['traidoPor'], $_POST['profundidad'], $_POST['usoAnterior'], $_POST['hectaria'])){
                $muestra->setIdProductor($_POST['idProductor']);
                $muestra->setFechaRecepcion($_POST['fehaRecepcion']);
                $muestra->setLocalidad($_POST['localidad']);
                $muestra->setMunicipio($_POST['municipio']);
                $muestra->setTraidoPor($_POST['traidoPor']);
                $muestra->setProfundidad($_POST['profundidad']);
                $muestra->setUsoAnterior($_POST['usoAnterior']);
                $muestra->setHectaria($_POST['hectaria']);
                $IDMuestra = $muestra->guardarMuestra();
                if(!$IDMuestra){
                    echo "No se ha podido guardar la muestra<br>";
                    unset($muestra);
                }else{
                    echo "Se ha guardado con exito<br>";
                    $muestraAP = new MAaProcesar;
                    $contMuestras = 0;
                    foreach($_POST['muestraAP'] as $map){
                        if(validarMuestrasAProcesar($map['identificar'], $map['analisisARealizar'], $map['fechaDeToma'], $map['observaciones'])){
                            $muestraAP->setIdentificador($map['identificar']);
                            $muestraAP->setAnalisisARealizar($map['analisisARealizar']);
                            $muestraAP->setFechaDeToma($map['fechaDeToma']);
                            $muestraAP->setObservaciones($map['observaciones']);
                            if($muestraAP->guardarMuestraAProcesar_Suelo($IDMuestra))
                                $contMuestras++;
                        }else
                            echo "Dato errado en la muesra ".$contMuestras+1;
                    }
                    if($contMuestras == 0){
                        echo "No se han podido guardar las muestra<br>";
                        $muestra->eliminarMuestra($IDMuestra);
                    }else
                        echo "Se han guardado $contMuestras meustras a procesar<br>";
                    unset($muestra);
                }
            }else{
                echo "<br>NO SE PUDO GUARDAR, DATOS ERRADOS";
                unset($muestra);
            }
        }
    ?>
    <form action="" method="POST" class="form">
        <div class="main-user-info2">
            <div class="imput-box">
                <label for="idProductor">ID Productor:</label>
                <input type="text" placeholder="ID del prodcutor" name="idProductor" id="idProductor" value=<?php if(isset($muestra))echo '"'.$muestra['IDProductor'].'" disabled'; else if(isset($_GET['idRegist'])) echo '"'.$_GET['idRegist'].'" readonly';?>>
            </div>

            <div class="imput-box">
                <label for="fehaRecepcion">Fecha de Recepcion:</label>
                <input type="date" name="fehaRecepcion" id="fehaRecepcion" value="<?php if(isset($muestra)) echo $muestra['Fecha_Recepcion'];?>">
            </div>

            <div class="imput-box">
                <label for="localidad">Localidad:</label>
                <input type="text" placeholder="Localidad..." name="localidad" id="localidad" value="<?php if(isset($muestra)) echo $muestra['Localidad'];?>">
            </div>

            <div class="imput-box">
                <label for="municipio">Municipio:</label>
                <input type="text" placeholder="Municipio por..." name="municipio" id="municipio" value="<?php if(isset($muestra)) echo $muestra['Municipio'];?>">
            </div>

            <div class="imput-box">
                <label for="traidoPor">Traido por:</label>
                <input type="text" placeholder="Traido por..." name="traidoPor" id="traidoPor" value="<?php if(isset($muestra)) echo $muestra['Traido_Por'];?>">
            </div>

            <div class="imput-box">
                <label for="profundidad">Profundidad:</label>
                <input type="number" name="profundidad" id="profundidad" value="<?php if(isset($muestra)) echo $muestra['Profundidad'];?>">
            </div>

            <div class="imput-box">
                <label for="usoAnterior">Uso Anterior:</label>
                <input type="text" placeholder="Uso Anterior..." name="usoAnterior" id="usoAnterior" value="<?php if(isset($muestra)) echo $muestra['Uso_Anterior'];?>">
            </div>

            <div class="imput-box">
                <label for="hectaria">Hectaria:</label>
                <input type="number" name="hectaria" id="hectaria" value="<?php if(isset($muestra)) echo $muestra['Hectaria'];?>">
            </div>

            <?php 
                if(!isset($muestra)){
                    echo '<article id="articleModal">
                        <div class="mini-container">
                        <header class="form-tittle">Ingreso de datos de Muestra(s) a procesar:</header>
                            <div id="mustrasAProcesar">
                                <div>
                                    <h1>Muestra 1</h1>
                                    <div class="imput-box">
                                        <label for="identificador">Identificador:</label>
                                        <input type="text" placeholder="Indentificador" name="muestraAP[0][identificar]" id="identificador">
                                    </div>
                                    <div class="imput-box">
                                        <label for="analisisARealizar">Analisis a realizar:</label>
                                        <select name="muestraAP[0][analisisARealizar]" id="analisisARealizar">
                                            <option value="pH">pH</option>
                                            <option value="Conductividad">Conductividad</option>
                                            <option value="CIC">CIC</option>
                                            <option value="Todo">Todo</option>
                                        </select>
                                    </div>
                                    <div class="imput-box">
                                        <label for="fechaDeToma">Fecha de toma:</label><br>
                                        <input type="date" name="muestraAP[0][fechaDeToma]" id="fechaDeToma">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="comment-box">
                                        <label for="observaciones">Observaciones</label><br>
                                        
                                        <textarea placeholder="Observaciones..." name="muestraAP[0][observaciones]" id="observaciones" class="obs" cols="30" rows="10"></textarea>
                            </div>
                            
                            
                        </div>
                    </article> ';
                }
            ?>
            <br><input type="button" value="Agregar" class="button" id="btnAgregarMAP_Suelo">
            <input type="submit" name="<?php if(isset($_GET['id'])) echo "actualizar"; else echo "guardar"; ?>" value="Guardar" class="button">
            </div>
    </form>
    </div>
</section>
<script src="./js/jquery/jquery-3.3.1.min.js"></script>
<script src="./js/modalMuestraA.js"></script>
<?php include "./inc/htmlClose.php"; ?>