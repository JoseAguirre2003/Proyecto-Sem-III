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
                <label for="municipio">Recibida por:</label>
                <input type="text" placeholder="Municipio por..." name="municipio" id="municipio" value="<?php if(isset($muestra)) echo $muestra['Municipio'];?>">
            </div>

            <div class="imput-box">
                <label for="traidoPor">Recolectada por:</label>
                <input type="text" placeholder="Traido por..." name="traidoPor" id="traidoPor" value="<?php if(isset($muestra)) echo $muestra['Traido_Por'];?>">
            </div>

            <div class="imput-box">
                <label for="profundidad">Cantidad usada:</label>
                <input type="number" name="profundidad" id="profundidad" value="<?php if(isset($muestra)) echo $muestra['Profundidad'];?>">
            </div>

            <div class="imput-box">
                <label for="usoAnterior">Tratamiendo del pH:</label>
                <input type="text" placeholder="Uso Anterior" name="usoAnterior" id="usoAnterior" value="<?php if(isset($muestra)) echo $muestra['Uso_Anterior'];?>">
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
                <label for="cantidadUsada">Hectaria:</label>
                <input type="number" name="cantidadUsada" id="cantidadUsada" value="<?php if(isset($muestra)) echo $muestra['Cantidad_Usada'];?>">
            </div>

</section>
<?php include "./inc/htmlClose.php"; ?>