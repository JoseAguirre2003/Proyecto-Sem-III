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
    <section class="sub-body2">
        <div class="sub-container2">
        <header class="form-tittle">Ingreso de datos de Muestra de Agua:</header>
        <?php
        include_once "./php/func.php";
        include "./php/clases/MuestraAgua.php";
        include "./php/clases/MAaProcesar.php";

        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $muestra = new MuestraAgua;
            $muestra = $muestra->buscarMuestra($_GET['id']);
            if(!$muestra)
                unset($muestra);
            else
                echo "ID de la Muestra a cambiar: ".$muestra['ID_Muestra'].'<br>';
        }else
            unset($_GET['id']);

        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_POST['actualizar'])){
            $muestra = new MuestraAgua;
            if(validarMuestraAgua($_POST['fehaIngreso'], $_POST['fuenteAgua'], $_POST['recibidaPor'], $_POST['recolectadaPor'], $_POST['cultivoARegar'], $_POST['problemasSales'], $_POST['tratamiento_pH'], $_POST['sistemaRiego'], $_POST['cantidadUsada'], $_POST['pHMetro'], $_POST['condcutimetro'], $_POST['ubicacion'], $_POST['observacionesGenerales'])){
                $muestra->setFechaIngreso($_POST['fehaIngreso']);
                $muestra->setFuenteAgua($_POST['fuenteAgua']);
                $muestra->setRecibidoPor($_POST['recibidaPor']);
                $muestra->setRecolectadaPor($_POST['recolectadaPor']);
                $muestra->setCultivoARegar($_POST['cultivoARegar']);
                $muestra->setProblemasDeSales($_POST['problemasSales']);
                $muestra->setTratamiento_pH($_POST['tratamiento_pH']);
                $muestra->setSistemaRiego($_POST['sistemaRiego']);
                $muestra->setCantidadUsada($_POST['cantidadUsada']);
                $muestra->setPHMetro($_POST['pHMetro']);
                $muestra->setConductimetro($_POST['condcutimetro']);
                $muestra->setUbicacion($_POST['ubicacion']);
                $muestra->setObservacionesGenerales($_POST['observacionesGenerales']);
                if($muestra->actualizarMuestra($_GET['id'])){
                    echo "<br>ACTUALIZADO CON EXITO :)";
                    $muestra = $muestra->buscarMuestra($_GET['id']);
                }else{
                    echo "<br>NO SE PUDO ACTUALIZAR :(";
                    unset($muestra);
                }
            }else{
                echo "<br>NO SE PUDO ACTUALIZAR, DATOS ERRADOS";
                unset($muestra);
            }
        }else if(isset($_POST['idProductor']) && isset($_POST['guardar'])){
            $muestra = new MuestraAgua;
            if(is_numeric($_POST['idProductor']) && validarMuestraAgua($_POST['fehaIngreso'], $_POST['fuenteAgua'], $_POST['recibidaPor'], $_POST['recolectadaPor'], $_POST['cultivoARegar'], $_POST['problemasSales'], $_POST['tratamiento_pH'], $_POST['sistemaRiego'], $_POST['cantidadUsada'], $_POST['pHMetro'], $_POST['condcutimetro'], $_POST['ubicacion'], $_POST['observacionesGenerales'])){
                $muestra->setIdProductor($_POST['idProductor']);
                $muestra->setFechaIngreso($_POST['fehaIngreso']);
                $muestra->setFuenteAgua($_POST['fuenteAgua']);
                $muestra->setRecibidoPor($_POST['recibidaPor']);
                $muestra->setRecolectadaPor($_POST['recolectadaPor']);
                $muestra->setCultivoARegar($_POST['cultivoARegar']);
                $muestra->setProblemasDeSales($_POST['problemasSales']);
                $muestra->setTratamiento_pH($_POST['tratamiento_pH']);
                $muestra->setSistemaRiego($_POST['sistemaRiego']);
                $muestra->setCantidadUsada($_POST['cantidadUsada']);
                $muestra->setPHMetro($_POST['pHMetro']);
                $muestra->setConductimetro($_POST['condcutimetro']);
                $muestra->setUbicacion($_POST['ubicacion']);
                $muestra->setObservacionesGenerales($_POST['observacionesGenerales']);
                $IDMuestra = $muestra->guardarMuestra();
                echo "Se guaradara en ".$IDMuestra;
                if(!$IDMuestra){
                    echo "No se ha podido guardar la muestra<br>";
                    unset($muestra);
                }else{
                    echo "Se ha logrado guardar<br>";
                    $muestraAP = new MAaProcesar;
                    $contMuestras = 0;
                    foreach($_POST['muestraAP'] as $map){
                        if(validarMuestrasAProcesar($map['identificar'], $map['analisisARealizar'], $map['fechaDeToma'], $map['observaciones'])){
                            $muestraAP->setIdentificador($map['identificar']);
                            $muestraAP->setAnalisisARealizar($map['analisisARealizar']);
                            $muestraAP->setFechaDeToma($map['fechaDeToma']);
                            $muestraAP->setObservaciones($map['observaciones']);
                            if($muestraAP->guardarMuestraAProcesar_Agua($IDMuestra))
                                $contMuestras++;
                        }else
                            echo "Dato errado en la muesra ".$contMuestras+1;
                    }
                    if($contMuestras == 0){
                        echo "No se han podido guardar las muestra a procesar<br>";
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
                <input type="text" placeholder="ID del prodcutor" name="idProductor" id="idProductor" value=<?php if(isset($muestra)) echo '"'.$muestra['ID_Productor'].'" disabled'; else if(isset($_GET['idRegist'])) echo '"'.$_GET['idRegist'].'" readonly';?>>
            </div>

            <div class="imput-box">
                <label for="fehaIngreso">Fecha de Ingreso:</label>
                <input type="date" name="fehaIngreso" id="fehaIngreso" value="<?php if(isset($muestra)) echo $muestra['Fecha_Ingreso'];?>">
            </div>

            <div class="imput-box">
                <label for="fuenteAgua">Fuente de Agua:</label>
                <input type="text" placeholder="Fuente de agua" name="fuenteAgua" id="fuenteAgua" value="<?php if(isset($muestra)) echo $muestra['Fuente_Agua'];?>">
            </div>

            <div class="imput-box">
                <label for="recibidaPor">Recibida por:</label>
                <input type="text" placeholder="Recibida por..." name="recibidaPor" id="recibidaPor" value="<?php if(isset($muestra)) echo $muestra['Recibido_Por'];?>">
            </div>

            <div class="imput-box">
                <label for="recolectadaPor">Recolectada por:</label>
                <input type="text" placeholder="Recolectada por..." name="recolectadaPor" id="recolectadaPor" value="<?php if(isset($muestra)) echo $muestra['Recolectada_Por'];?>">
            </div>

            <div class="imput-box">
                <label for="cultivoARegar">Cultivo a Regar:</label>
                <input type="text" placeholder="Cultivo a Regar" name="cultivoARegar" id="cultivoARegar" value="<?php if(isset($muestra)) echo $muestra['Cultivo_A_Regar'];?>">
            </div>

            <div class="imput-box">
                <label for="problemasSales">Problemas de Sales:</label>
                <select name="problemasSales" id="problemasSales">
                    <option value="No lo se" <?php if(isset($muestra) && $muestra['Problemas_De_Sales'] == "No lo se") echo "selected";?>>No lo se</option>
                    <option value="Si" <?php if(isset($muestra) && $muestra['Problemas_De_Sales'] == "Si") echo "selected";?>>Si</option>
                    <option value="No" <?php if(isset($muestra) && $muestra['Problemas_De_Sales'] == "No") echo "selected";?>>No</option>
                </select>
            </div>

            <div class="imput-box">
                <label for="tratamiento_pH">Tratamiendo del pH:</label>
                <input type="text" placeholder="Tratamiento pH" name="tratamiento_pH" id="tratamiento_pH" value="<?php if(isset($muestra)) echo $muestra['Tratamiento_pH'];?>">
            </div>

            <div class="imput-box">
                <label for="sistemaRiego">Sistema de riego:</label>
                <input type="text" placeholder="Sistema de riego" name="sistemaRiego" id="sistemaRiego" value="<?php if(isset($muestra)) echo $muestra['Sistema_Riego'];?>">
            </div>

            <div class="imput-box">
                <label for="cantidadUsada">Cantidad usada:</label>
                <input type="number" name="cantidadUsada" id="cantidadUsada" value="<?php if(isset($muestra)) echo $muestra['Cantidad_Usada'];?>">
            </div>

            <div class="imput-box">
                <label for="pHMetro">ph Metro:</label>
                <input type="number" name="pHMetro" id="pHMetro" step="0.01" value="<?php if(isset($muestra)) echo $muestra['pH_Metro'];?>">
            </div>

            <div class="imput-box">
                <label for="condcutimetro">Conductimetro:</label>
                <input type="number" name="condcutimetro" id="condcutimetro" step="0.0001" value="<?php if(isset($muestra)) echo $muestra['Conductimetro'];?>">
            </div>

            <div class="imput-box">
                <label for="ubicacion">Ubicacion:</label>
                <input type="text" placeholder="Ubicacion" name="ubicacion" id="ubicacion" value="<?php if(isset($muestra)) echo $muestra['Ubicacion'];?>">
            </div>

            <div class="imput-box">
                <label for="observacionesGenerales">Observaciones generales:</label>
                <input type="text" placeholder="Observaciones" name="observacionesGenerales" id="observacionesGenerales" value="<?php if(isset($muestra)) echo $muestra['Observaciones_Generales'];?>">
            </div>

            <?php 
                if(!isset($muestra)){
                    echo '
                    <article id="articleModal">
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
                                            <option value="Especial">Particulas Flotantes</option>
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
                    </article>
                    ';      
                }
            ?>

            <br><input type="button" value="Agregar" class="button" id="btnAgregarMAP"><br>
            <input type="submit" name="<?php if(isset($_GET['id'])) echo "actualizar"; else echo "guardar"; ?>" value="Guardar" class="button">
            </div>
        </form>
        </div>
    </section>
    <script src="./js/jquery/jquery-3.3.1.min.js"></script>
    <script src="./js/modalMuestraA.js"></script>

<?php include "./inc/htmlClose.php"; ?>

