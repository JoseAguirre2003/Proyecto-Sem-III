<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/styles.css">
</head>

    <body>
    <section class="container">
        <?php
            include_once "../php/func.php";
            include "../../clases/MuestraAgua.php";
            include "../../clases/MAaProcesar.php";
            if(isset($_GET['buscar']) && is_numeric($_GET['buscar'])) {
                $muestras = new MuestraAgua;
                $muestras = $muestras->buscarMuestra($_GET['buscar']);
                if (!$muestras)
                    echo "No se han encontrado muestras :(";
                else{
                    echo ' 
                        <table id="resultado">
                            <tbody>
                                <tr>
                                    <th colspan="3">Muestra:</th>
                                </tr>
                                <tr>
                                    <td>ID:</td>
                                    <td id="idMuestra" colspan="2">'.$muestras['ID_Muestra'].'</td>
                                </tr>
                                <tr>
                                    <td>Fecha ingreso:</td>
                                    <td id="fechaIngreso" colspan="2">'.$muestras['Fecha_Ingreso'].'</td>
                                </tr>
                                <tr>
                                    <td>Fuente de agua:</td>
                                    <td id="fuenteAgua" colspan="2">'.$muestras['Fuente_Agua'].'</td>
                                </tr>
                                <tr>
                                    <td>Recibido por:</td>
                                    <td id="recibidoPor" colspan="2">'.$muestras['Recibido_Por'].'</td>
                                </tr>
                                <tr>
                                    <td>Recolectada por:</td>
                                    <td id="recolectadaPor" colspan="2">'.$muestras['Recolectada_Por'].'</td>
                                </tr>
                                <tr>
                                    <td>Cultivo a regar:</td>
                                    <td id="cultivoARegar" colspan="2">'.$muestras['Cultivo_A_Regar'].'</td>
                                </tr>
                                <tr>
                                    <td>Problemas de sales:</td>
                                    <td id="problemasDeSales" colspan="2">'.$muestras['Problemas_De_Sales'].'</td>
                                </tr>
                                <tr>
                                    <td>Tratamiento pH:</td>
                                    <td id="tratamiento_pH" colspan="2">'.$muestras['Tratamiento_pH'].'</td>
                                </tr>
                                <tr>
                                    <td>sistema riego:</td>
                                    <td id="sistemaRiego" colspan="2">'.$muestras['Sistema_Riego'].'</td>
                                </tr>
                                <tr>
                                    <td>Cantidad usada:</td>
                                    <td id="cantidadUsada" colspan="2">'.$muestras['Cantidad_Usada'].' L/ha</td>
                                </tr>
                                <tr>
                                    <td>pH Metro:</td>
                                    <td id="pHMetro" colspan="2">'.$muestras['pH_Metro'].'</td>
                                </tr>
                                <tr>
                                    <td>Conductimetro:</td>
                                    <td id="conductimetro" colspan="2">'.$muestras['Conductimetro'].'</td>
                                </tr>
                                <tr>
                                    <td>Ubicacion:</td>
                                    <td id="ubicacion" colspan="2">'.$muestras['Ubicacion'].'</td>
                                </tr>
                                <tr>
                                    <td>Observaciones generales:</td>
                                    <td id="observacionesGenerales" colspan="2">'.$muestras['Observaciones_Generales'].'</td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="../BuscarProdcutor/buscarProdcutorYMuestrasV2.php?buscar='.$muestras['ID_Productor'].'&idElim='.$muestras['ID_Muestra'].'" method="POST">
                            <button type="button" class="boton"><a href="../registrarMuestraAgua/registrarMuestraAguaV2.php?id='.$muestras['ID_Muestra'].'">Editar</a></button>
                            <input type="submit" name="eliminar" value="Eliminar" class="boton">
                        </form>
                    ';
                    $muestrasAProcesar = listaMuestrasAProcesar($_GET['buscar']);
                    if(!$muestrasAProcesar)
                        echo "No se han encontrado muestras a procesar";
                    else{
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
                        
                        foreach($muestrasAProcesar as $rowAP){
                            echo '
                                <tr>
                                    <td id="idMuestraAProcesar">'.$rowAP['IDMuestra_A_Procesar'].'</td>
                                    <td id="Identificador">'.$rowAP['Identificador'].'</td>
                                    <td id="analisisARealizar">'.$rowAP['Analisis_A_Realizar'].'</td>
                                    <td id="fechaDeToma">'.$rowAP['Fecha_De_Toma'].'</td>
                                    <td id="observaciones">'.$rowAP['Observaciones'].'</td>
                                </tr>
                                
                            ';
                        }

                        echo '
                                </tbody>
                            </table>
                        ';
                    }
                }
            }else
                echo "Cuanto vacio..."
        ?>
        </section>
    </body>
</html>