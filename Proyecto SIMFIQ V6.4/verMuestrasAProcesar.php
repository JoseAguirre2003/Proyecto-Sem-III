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
    include "./php/clases/MAaProcesar.php";

    if (isset($_GET['buscar']) && is_numeric($_GET['buscar'])) {
        $muestras = new MAaProcesar;
        $muestras = $muestras->buscarMuestraAProcesar($_GET['buscar']);
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
                                    <td id="idMuestra" colspan="2">' . $muestras['IDMuestra_A_Procesar'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tipo:</td>
                                    <td id="tipo" colspan="2">' . $muestras['Tipo'] . '</td>
                                </tr>
                                <tr>
                                    <td>Identificador:</td>
                                    <td id="identificador" colspan="2">' . $muestras['Identificador'] . '</td>
                                </tr>
                                <tr>
                                    <td>Analisis a realizar:</td>
                                    <td id="analisisARealizar" colspan="2">' . $muestras['Analisis_A_Realizar'] . '</td>
                                </tr>
                                <tr>
                                    <td>Fecha de toma:</td>
                                    <td id="fechaDeToma" colspan="2">' . $muestras['Fecha_De_Toma'] . '</td>
                                </tr>
                                <tr>
                                    <td>Observaciones:</td>
                                    <td id="observaciones" colspan="2">' . $muestras['Observaciones'] . '</td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="./verProductor.php?buscar=' . $muestras['IDMuestra_A_Procesar'] . '&idElim=' . $muestras['IDMuestra_A_Procesar'] . '" method="POST">
                            <button type="button" class="boton"><a href="./registrarMuestraAgua.php?id=' . $muestras['IDMuestra_A_Procesar'] . '">Editar</a></button>
                            <input type="submit" name="eliminarAgua" value="Eliminar" class="boton">
                        </form>
                    ';
            $resultados = false;
            if(!$resultados){
                if($muestras['Tipo'] == "Agua")
                    echo 'No hay ningun resultado cargado :(<br>
                    <a href="./calculosAguaV2.php?id=' . $muestras['IDMuestra_A_Procesar'] . '">Cargar resultados</a>';
                else
                    echo 'No hay ningun resultado cargado :(<br>
                    <a href="./calculosSueloV2.php?id=' . $muestras['IDMuestra_A_Procesar'] . '">Cargar resultados</a>';
            }else{

            }
        }
    } else
        echo "Cuanto vacio..."
            ?>
                </section>
      </main>
    </section>

<?php include "./inc/htmlClose.php"; ?>