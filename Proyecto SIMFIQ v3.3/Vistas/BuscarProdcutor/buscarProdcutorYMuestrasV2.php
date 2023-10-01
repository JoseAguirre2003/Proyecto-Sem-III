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
        <!-- <form action="" method="POST">
            <label for="buscar">Buscar:</label><br>
            <input type="text" name="buscar" id="buscar">
            <input type="submit" value="Buscar" class="boton">
        </form> -->
        <?php
            include_once "../php/func.php";
            include "../../clases/Productor.php";
            $productor = new Prodcutor;
            if(isset($_GET['buscar']) && is_numeric($_GET['buscar'])) {
                $productor = $productor->buscarProductor($_GET['buscar']);
                if (!$productor)
                    echo "No se ha encontrado al Productor :(";
                else{
                    echo ' 
                        <table id="resultado">
                            <tbody>
                                <tr>
                                    <th colspan="3">Productor:</th>
                                </tr>
                                <tr>
                                    <td>ID:</td>
                                    <td id="idProductor" colspan="2">'.$productor['ID_Productor'].'</td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td id="nombre" colspan="2">'.$productor['Nombre'].'</td>
                                </tr>
                                <tr>
                                    <td>Cedula o RIF:</td>
                                    <td id="cedulaRIF" colspan="2">'.$productor['Cedula_RIF'].'</td>
                                </tr>
                                <tr>
                                    <td>Direccion:</td>
                                    <td id="direcion" colspan="2">'.$productor['Direccion'].'</td>
                                </tr>
                                <tr>
                                    <td>Localidad:</td>
                                    <td id="localidad" colspan="2">'.$productor['Municipio'].'</td>
                                </tr>
                                <tr>
                                    <td>Contacto:</td>
                                    <td id="contacto" colspan="2">'.$productor['Contacto'].'</td>
                                </tr>
                                <tr>
                                    <td>Traido por:</td>
                                    <td id="traidoPor" colspan="2">'.$productor['Traido_Por'].'</td>
                                </tr>
                                <tr>
                                    <td>Correo:</td>
                                    <td id="correo" colspan="2">'.$productor['Correo'].'</td>
                                </tr>
                                <tr>
                                    <td>Asesor tecnico:</td>
                                    <td id="asesorTecnico" colspan="2">'.$productor['Asesor_Tecnico'].'</td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="../listaProductores/listaProductores.php?idElim='.$productor['ID_Productor'].'" method="POST">
                            <button type="button" class="boton"><a href="../registrarProductor/registroProductorV2.php?id='.$productor['ID_Productor'].'">Editar</a></button>
                            <input type="submit" name="eliminar" value="Eliminar" class="boton">
                        </form>
                    ';
                        //ESOS BOTONES DE ELIMINAR Y EDITAR HAY QUE PONERLOS DE MANERA MA OPTIMA, NO SE ESTA MUY FEO ASI
                    $muestras = listaMuestras($productor['ID_Productor']);
                    if(!$muestras)
                        echo "No se han encontrado muestras";
                    else{
                        echo '
                            <table id="resultado">
                                <tbody>
                                    <tr>
                                        <th colspan="6">Muestras:</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Fuente de Agua</th>
                                        <th>Recolectada por</th>
                                        <th colspan="2">Opciones</th>
                                    </tr>
                                
                        ';

                        foreach($muestras as $row){
                            echo '
                                <tr>
                                    <td><a href="../VerMuestras/verMuestras.php?buscar='.$row['ID_Muestra'].'">'.$row['ID_Muestra'].'</a></td>
                                    <td>'.$row['Fecha_Ingreso'].'</td>
                                    <td>'.$row['Fuente_Agua'].'</td>
                                    <td>'.$row['Recolectada_Por'].'</td>
                                    <td>*Editar*</td>
                                    <td>*Eliminar*</td>
                                </tr>
                            ';
                        }
                    }
                }
            }
        ?>
        </section>

    </body>
</html>