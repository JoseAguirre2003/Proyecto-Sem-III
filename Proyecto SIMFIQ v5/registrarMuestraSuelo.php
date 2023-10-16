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
<section>
    <header>Ingreso de datos de Muestra:</header>
    <?php
        include_once "./php/func.php";
        include "./php/clases/MuestraSuelo.php";

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
            $muestra->setAnalisisARealizar($_POST['analisisARealizar']);
            $muestra->setHectaria($_POST['hectaria']);
            $IDMuestra = $muestra->guardarMuestra();
            if(!$IDMuestra){
                echo "No se ha podido guardar la muestra<br>";
                unset($muestra);
            }else{
                echo "Se ha guardado con exito";
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
                <label for="analisisARealizar">Analisis a realizar:</label>
                <select name="analisisARealizar" id="analisisARealizar">
                    <option value="pH" <?php if(isset($muestra) && $muestra['Analisis_A_Realizar'] == "pH") echo "selected";?>>pH</option>
                    <option value="Conductividad" <?php if(isset($muestra) && $muestra['Analisis_A_Realizar'] == "Conductividad") echo "selected";?>>Conductividad</option>
                    <option value="particulasFlotantes" <?php if(isset($muestra) && $muestra['Analisis_A_Realizar'] == "particulasFlotantes") echo "selected";?>>Particulas Flotantes</option>
                    <option value="Todo" <?php if(isset($muestra) && $muestra['Analisis_A_Realizar'] == "particulasFlotantes") echo "selected";?>>Todo</option>
                </select>
            </div>

            <div class="imput-box">
                <label for="hectaria">Hectaria:</label>
                <input type="number" name="hectaria" id="hectaria" value="<?php if(isset($muestra)) echo $muestra['Hectaria'];?>">
            </div>

            <input type="submit" name="<?php if(isset($_GET['id'])) echo "actualizar"; else echo "guardar"; ?>" value="Guardar" class="button">

    </form>
</section>
<?php include "./inc/htmlClose.php"; ?>