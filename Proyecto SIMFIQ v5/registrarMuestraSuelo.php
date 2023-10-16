<?php
session_start();

if ($_SESSION["s_usuario"] === null){
    header("Location: ./index.php?vista=login");
}

    include "./inc/htmlOpen.php";
    
    // if(isset($_SESSION['s_idRol']))
    //     if($_SESSION['s_idRol'] == 1){
    //         $rol = "Admin";
    //         include "./inc/headerAndNavAdmin.php";
    //     }else{
    //         $rol = "Usuario";
    //         include "./inc/headerAndNav.php";
    //     }
    // else
    //     header("./logout.php");
?>
<section>
    <header>Ingreso de datos de Muestra:</header>
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
                echo "ID de la Muestra a cambiar: ".$muestra['IDMuestraSuelo'];
        }else
            unset($_GET['id']);

        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_POST['actualizar'])){
            $muestra = new MuestraSuelo;
            $muestra->setFechaRecepcion($_POST['fehaRecepcion']);
            $muestra->setLocalidad($_POST['localidad']);
            $muestra->setMunicipio($_POST['municipio']);
            $muestra->setTraidoPor($_POST['traidoPor']);
            $muestra->setProfundidad($_POST['profundidad']);
            $muestra->setUsoAnterior($_POST['usoAnterior']);
            $muestra->setAnalisisARealizar($_POST['analisisARealizar']);
            $muestra->setHectaria($_POST['hectaria']);
            if($muestra->actualizarMuestra($_GET['id'])){
                echo "<br>ACTUALIZADO CON EXITO :)";
                $muestra = $muestra->buscarMuestra($_GET['id']);
            }else{
                echo "<br>NO SE PUDO ACTUALIZAR :(";
                unset($muestra);
            }
        }else if(isset($_POST['idProductor'])){
            $muestra = new MuestraSuelo;
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
                echo "Se ha guardado con exito";
                $muestraAP = new MAaProcesar;
                $contMuestras = 0;
                foreach($_POST['muestraAP'] as $map){
                    $muestraAP->setIdentificador($map['identificar']);
                    $muestraAP->setAnalisisARealizar($map['analisisARealizar']);
                    $muestraAP->setFechaDeToma($map['fechaDeToma']);
                    $muestraAP->setObservaciones($map['observaciones']);
                    if($muestraAP->guardarMuestraAProcesar_Suelo($IDMuestra))
                        $contMuestras++;
                }
                if($contMuestras == 0){
                    echo "No se ha podido guardar la muestra<br>";
                    $muestra->eliminarMuestra($IDMuestra);
                }else
                    echo "Se han guardado $contMuestras meustras a procesar";
                unset($muestra);
            }
        }
    ?>
    <form action="" method="POST" class="form">
            <div class="imput-box">
                <label for="idProductor">ID Productor:</label>
                <input type="text" placeholder="ID del prodcutor" name="idProductor" id="idProductor" value=<?php if(isset($muestra)) echo '"'.$muestra['IDProductor'].'" disabled';?>>
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
                    echo '
                        <div class="imput-box">
                            <header>Ingreso de datos de Muestra(s) a porcesar:</header>
                        </div>
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
                                        <option value="particulasFlotantes">Particulas Flotantes</option>
                                        <option value="Todo">Todo</option>
                                    </select>
                                </div>
                                <div class="imput-box">
                                    <label for="fechaDeToma">Fecha de toma:</label><br>
                                    <input type="date" name="muestraAP[0][fechaDeToma]" id="fechaDeToma">
                                </div>
                                <div class="imput-box">
                                    <label for="observaciones">Observaciones</label><br>
                                    <input type="text" placeholder="Observaciones..." name="muestraAP[0][observaciones]" id="observaciones">
                                </div>
                            </div>
                        </div>
                        <br><input type="button" value="Agregar" class="boton" id="btnAgregarMAP">
                    ';      
                }
            ?>

            <input type="submit" name="<?php if(isset($_GET['id'])) echo "actualizar"; else echo "guardar"; ?>" value="Guardar" class="button">

    </form>
</section>
<script src="./js/jquery/jquery-3.3.1.min.js"></script>
<script src="./js/modalMuestraA.js"></script>
<?php include "./inc/htmlClose.php"; ?>