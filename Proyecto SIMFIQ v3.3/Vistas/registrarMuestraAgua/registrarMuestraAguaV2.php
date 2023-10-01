<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada de datos</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="container">
        <header>Ingreso de datos de Muestra:</header>
        <?php
        include_once "../php/func.php";
        include "../../clases/MuestraAgua.php";
        include "../../clases/MAaProcesar.php";

        if(isset($_POST['idProductor'])){
            $muestra = new MuestraAgua;
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
            if(!$IDMuestra){
                echo "No se ha podido guardar la muestra<br>";
            }else{
                echo "Se ha logrado guardar<br>";
                var_dump($IDMuestra);
                $muestraAP = new MAaProcesar;
                $contMuestras = 0;
                foreach($_POST['muestraAP'] as $map){
                    $muestraAP->setIdMuestra($IDMuestra);
                    $muestraAP->setIdentificador($map['identificar']);
                    $muestraAP->setAnalisisARealizar($map['analisisARealizar']);
                    $muestraAP->setFechaDeToma($map['fechaDeToma']);
                    $muestraAP->setObservaciones($map['observaciones']);
                    if($muestraAP->guardarMuestraAProcesar())
                        $contMuestras++;
                }
                echo "Se han guardado $contMuestras";
            }
        }

        // if (isset($_POST['idProductor'])) {
        //     if (limpiarCadena($_POST['idProductor']) != "" && limpiarCadena($_POST['fehaIngreso']) != "" && limpiarCadena($_POST['fuenteAgua']) != "" && limpiarCadena($_POST['recibidaPor']) != "" && limpiarCadena($_POST['recolectadaPor']) != "" && limpiarCadena($_POST['cultivoARegar']) != "" && limpiarCadena($_POST['problemasSales']) != "" && limpiarCadena($_POST['tratamiento_pH']) != "" && limpiarCadena($_POST['sistemaRiego']) != "" && !is_numeric($_POST['cantidadUsada']) && !is_numeric($_POST['pHMetro']) && !is_numeric($_POST['condcutimetro']) && limpiarCadena($_POST['ubicacion']) != "" && limpiarCadena($_POST['observacionesGenerales']) != "") {
        //         $respuesta = guardarMuestraAgua($_POST['idProductor'], $_POST['fehaIngreso'], $_POST['fuenteAgua'], $_POST['recibidaPor'], $_POST['recolectadaPor'], $_POST['cultivoARegar'], $_POST['problemasSales'], $_POST['tratamiento_pH'], $_POST['sistemaRiego'], $_POST['cantidadUsada'], $_POST['pHMetro'], $_POST['condcutimetro'], $_POST['ubicacion'], $_POST['observacionesGenerales']);
        //         echo "<h3>" . $respuesta . "</h3>";
        //     } else
        //         echo "DATO ERRADO";
        // }
        ?>
        <form action="" method="POST" class="form">
            <div class="imput-box">
                <label for="idProductor">ID Productor:</label>
                <input type="text" placeholder="ID del prodcutor" name="idProductor" id="idProductor">
            </div>

            <div class="imput-box">
                <label for="fehaIngreso">Fecha de Ingreso:</label>
                <input type="date" name="fehaIngreso" id="fehaIngreso">
            </div>

            <div class="imput-box">
                <label for="fuenteAgua">Fuente de Agua:</label>
                <input type="text" placeholder="Fuente de agua" name="fuenteAgua" id="fuenteAgua">
            </div>

            <div class="imput-box">
                <label for="recibidaPor">Recibida por:</label>
                <input type="text" placeholder="Recibida por..." name="recibidaPor" id="recibidaPor">
            </div>

            <div class="imput-box">
                <label for="recolectadaPor">Recolectada por:</label>
                <input type="text" placeholder="Recolectada por..." name="recolectadaPor" id="recolectadaPor">
            </div>

            <div class="imput-box">
                <label for="cultivoARegar">Cultivo a Regar:</label>
                <input type="text" placeholder="Cultivo a Regar" name="cultivoARegar" id="cultivoARegar">
            </div>

            <div class="imput-box">
                <label for="problemasSales">Problemas de Sales:</label>
                <select name="problemasSales" id="problemasSales">
                    <option value="No lo se">No lo se</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="imput-box">
                <label for="tratamiento_pH">Tratamiendo del pH:</label>
                <input type="text" placeholder="Tratamiento pH" name="tratamiento_pH" id="tratamiento_pH">
            </div>

            <div class="imput-box">
                <label for="sistemaRiego">Sistema de riego:</label>
                <input type="text" placeholder="Sistema de riego" name="sistemaRiego" id="sistemaRiego">
            </div>

            <div class="imput-box">
                <label for="cantidadUsada">Cantidad usada:</label>
                <input type="number" name="cantidadUsada" id="cantidadUsada">
            </div>

            <div class="imput-box">
                <label for="pHMetro">ph Metro:</label>
                <input type="number" name="pHMetro" id="pHMetro" step="0.01">
            </div>

            <div class="imput-box">
                <label for="condcutimetro">Conductimetro:</label>
                <input type="number" name="condcutimetro" id="condcutimetro" step="0.0001">
            </div>

            <div class="imput-box">
                <label for="ubicacion">Ubicacion:</label>
                <input type="text" placeholder="Ubicacion" name="ubicacion" id="ubicacion">
            </div>

            <div class="imput-box">
                <label for="observacionesGenerales">Observaciones generales:</label>
                <input type="text" placeholder="Observaciones" name="observacionesGenerales"
                    id="observacionesGenerales">
            </div>

            <div class="imput-box">
                <header>Ingreso de datos de Muestra(s) a porcesar:</header>
            </div>

            <div id="mustrasAProcesar">
                <!-- <div>
                    <h1>Muestra 1</h1>

                    <div class="imput-box">
                        <label for="identificador">Identificador:</label>
                        <input type="text" placeholder="Indentificador" name="identificador[]" id="identificador">
                    </div>

                    <div class="imput-box">
                        <label for="analisisARealizar">Analisis a realizar:</label>
                        <input type="text" placeholder="Analisis a realizar" name="analisisARealizar[]"
                            id="analisisARealizar">
                    </div>

                    <div class="imput-box">
                        <label for="fechaDeToma">Fecha de toma:</label><br>
                        <input type="date" name="fechaDeToma[]" id="fechaDeToma">
                    </div>

                    <div class="imput-box">
                        <label for="observaciones">Observaciones</label><br>
                        <input type="text" placeholder="Observaciones..." name="observaciones[]" id="observaciones">
                    </div>
                </div> -->
                <div>
                    <h1>Muestra 1</h1>

                    <div class="imput-box">
                        <label for="identificador">Identificador:</label>
                        <input type="text" placeholder="Indentificador" name="muestraAP[0][identificar]" id="identificador">
                    </div>

                    <div class="imput-box">
                        <label for="analisisARealizar">Analisis a realizar:</label>
                        <input type="text" placeholder="Analisis a realizar" name="muestraAP[0][analisisARealizar]" id="analisisARealizar">
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

            <input type="submit" value="Guardar" class="button">
        </form>
    </section>
    <script src="../../js/JQuery-3.7.1/JQuery-3.7.1.min.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>