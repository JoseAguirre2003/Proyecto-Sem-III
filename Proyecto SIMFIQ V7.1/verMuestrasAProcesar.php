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
    include "./php/clases/resultados.php";

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
                        <a href="./registrarMuestrasAAProcesar.php?id='.$muestras['IDMuestra_A_Procesar'].'">Editar o eliminar</a><br>
                    ';
            $resultados = new Resultados;
            $resultados = $resultados->buscarResultados($muestras['IDMuestra_A_Procesar']);
            if(!$resultados){
                    echo 'No hay ningun resultado cargado :(<br>
                    <a href="./calculos.php?id=' . $muestras['IDMuestra_A_Procesar'] . '">Calcular resultados</a>';
            }else{
                echo '<table id="resultado">
                        <tbody>
                            <tr>
                                <th colspan="3">Resultados:</th>
                            </tr>
                            <tr>
                                <td>Tipo:</td>
                                <td id="tipo" colspan="2">' . $resultados['IDAnalisis'] . '</td>
                            </tr>
                ';
                if($resultados['pH'] != null)
                    echo ' <tr>
                        <td>pH:</td>
                        <td id="tipo" colspan="2">' . $resultados['pH'] . '</td>
                    </tr>';
                if($resultados['Ce'] != null)
                    echo ' <tr>
                            <td>Conductividad:</td>
                            <td id="tipo" colspan="2">' . $resultados['Ce'] . '</td>
                    </tr>';
                if($resultados['Suelo_CIC'] != null)
                    echo ' <tr>
                            <td>CIC:</td>
                            <td id="tipo" colspan="2">' . $resultados['Suelo_CIC'] . '</td>
                    </tr>';
                if($resultados['Suelo_Textura'] != null)
                    echo ' <tr>
                            <td>Textura:</td>
                            <td id="tipo" colspan="2">' . $resultados['Suelo_Textura'] . '</td>
                    </tr>';
                if($resultados['Suelo_Textura'] != null)
                    echo ' <tr>
                            <td>Textura:</td>
                            <td id="tipo" colspan="2">' . $resultados['Suelo_Textura'] . '</td>
                    </tr>';
                if($resultados['Agua_ParticulasSuspension'] != null)
                    echo ' <tr>
                            <td>Particulas en suspension:</td>
                            <td id="tipo" colspan="2">' . $resultados['Agua_ParticulasSuspension'] . '</td>
                    </tr>';
                echo '
                    <tr>
                        <td>Precio:</td>
                        <td id="tipo" colspan="2">$' . $resultados['Precio'] . '</td>
                    </tr>
                
                
                </table>
                </tbody>';
            }
        }
    } else
        echo "Cuanto vacio..."
            ?>
                </section>
      </main>
    </section>

<?php include "./inc/htmlClose.php"; ?>