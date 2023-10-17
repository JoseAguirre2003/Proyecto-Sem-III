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
    <main class="table">
        <section class="table_body">
    <?php
    include_once "./php/func.php";
    include "./php/clases/MuestraSuelo.php";
    include "./php/clases/MAaProcesar.php";
    if (isset($_GET['buscar']) && is_numeric($_GET['buscar'])) {
        $muestras = new MuestraSuelo;
        $muestrasAProcesar = new MAaProcesar;
        $muestras = $muestras->buscarMuestra($_GET['buscar']);
        if (!$muestras)
            echo "No se han encontrado muestras :(";
        else {
            echo ' 
                        <table id="resultado">
                            <tbody>
                                <tr>
                                    <th colspan="3">Muestra:</th>
                                </tr>
                                <tr>
                                    <td>ID:</td>
                                    <td id="idMuestra" colspan="2">' . $muestras['IDMuestraSuelo'] . '</td>
                                </tr>
                                <tr>
                                    <td>Fecha Recepcion:</td>
                                    <td id="fechaRecepcion" colspan="2">' . $muestras['Fecha_Recepcion'] . '</td>
                                </tr>
                                <tr>
                                    <td>Localidad:</td>
                                    <td id="localidad" colspan="2">' . $muestras['Localidad'] . '</td>
                                </tr>
                                <tr>
                                    <td>Municipio:</td>
                                    <td id="municipio" colspan="2">' . $muestras['Municipio'] . '</td>
                                </tr>
                                <tr>
                                    <td>Traido por:</td>
                                    <td id="TraidoPor" colspan="2">' . $muestras['Traido_Por'] . '</td>
                                </tr>
                                <tr>
                                    <td>Profundidad :</td>
                                    <td id="profundidad" colspan="2">' . $muestras['Profundidad'] . '</td>
                                </tr>
                                <tr>
                                    <td>Uso anterior:</td>
                                    <td id="usoAnterior" colspan="2">' . $muestras['Uso_Anterior'] . '</td>
                                </tr>
                                <tr>
                                    <td>Hectaria:</td>
                                    <td id="hectaria" colspan="2">' . $muestras['Hectaria'] . '</td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="./verProductor.php?buscar=' . $muestras['IDProductor'] . '&idElim=' . $muestras['IDMuestraSuelo'] . '" method="POST">
                            <button type="button" class="boton"><a href="./registrarMuestraSuelo.php?id=' . $muestras['IDMuestraSuelo'] . '">Editar</a></button>
                            <input type="submit" name="eliminarSuelo" value="Eliminar" class="boton">
                        </form>
                    ';
            $muestrasAProcesar = $muestrasAProcesar->listarMuestrasAProcrsarSuelo($_GET['buscar']);
            if (!$muestrasAProcesar)
                echo "No se han encontrado muestras a procesar";
            else {
                echo ' 
                            <table id="resultado">
                                <tbody>
                                    <tr>
                                        <th colspan="6">Muestras a procesar:</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Identificador</th>
                                        <th>Analisis a realizar</th>
                                        <th>Fecha de toma</th>
                                        <th>Observaciones </th>
                                    </tr>
                        ';

                foreach ($muestrasAProcesar as $rowAP) {
                    echo '
                                <tr>
                                    <td id="idMuestraAProcesar">' . $rowAP['IDMuestra_A_Procesar'] . '</td>
                                    <td id="Identificador">' . $rowAP['Identificador'] . '</td>
                                    <td id="analisisARealizar">' . $rowAP['Analisis_A_Realizar'] . '</td>
                                    <td id="fechaDeToma">' . $rowAP['Fecha_De_Toma'] . '</td>
                                    <td id="observaciones">' . $rowAP['Observaciones'] . '</td>
                                </tr>
                                
                            ';
                }

                echo '
                                </tbody>
                            </table>
                        ';
            }
        }
    } else
        echo "Cuanto vacio..."
            ?>
                </section>
      </main>
</section>
<?php include "./inc/htmlClose.php"; ?>