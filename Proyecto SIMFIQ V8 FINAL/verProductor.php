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
            include "./php/clases/Productor.php";
            include "./php/clases/MuestraAgua.php";
            include "./php/clases/MuestraSuelo.php";
            $productor = new Productor;

            if(isset($_POST['eliminarAgua']) && (isset($_GET['idElim']) && is_numeric($_GET['idElim']))){
                $muestra = new MuestraAgua;
                if($muestra->eliminarMuestra($_GET['idElim']))
                    echo "Sea Eliminado la muestra de agua de ID: ".$_GET['idElim'];
                else
                    echo "No pudo elimiar la muestra de agua de ID: ".$_GET['idElim'];
            }

            if(isset($_POST['eliminarSuelo']) && (isset($_GET['idElim']) && is_numeric($_GET['idElim']))){
                $muestra = new MuestraSuelo;
                if($muestra->eliminarMuestra($_GET['idElim']))
                    echo "Sea Eliminado la muestra de suelo de ID: ".$_GET['idElim'];
                else
                    echo "No pudo elimiar la muestra de suelo de ID: ".$_GET['idElim'];
            }

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
                        <form action="./listaProductores.php?idElim='.$productor['ID_Productor'].'" method="POST">
                            <button type="button" class="boton"><a href="./registrarMuestraSuelo.php?idRegist='.$productor['ID_Productor'].'">Registrar meustra de suelo</a></button>
                            <button type="button" class="boton"><a href="./registrarMuestraAgua.php?idRegist='.$productor['ID_Productor'].'">Registrar meustra de agua</a></button>
                            <button type="button" class="boton"><a href="./registarProductor.php?id='.$productor['ID_Productor'].'">Editar</a></button>
                            <input type="submit" name="eliminar" value="Eliminar" class="boton">
                        </form>
                    ';
                        //ESOS BOTONES DE ELIMINAR Y EDITAR HAY QUE PONERLOS DE MANERA MA OPTIMA, NO SE ESTA MUY FEO ASI
                    
                    $muestra = new MuestraAgua;
                    $muestras = $muestra->listarMuestras($productor['ID_Productor']);
                    if(!$muestras)
                        echo "No se han encontrado muestras de Agua<br>";
                    else{
                        echo '
                            <table id="resultado">
                                <tbody>
                                    <tr>
                                        <th colspan="6">Muestras de Agua:</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Fuente de Agua</th>
                                        <th>Recolectada por</th>
                                        <td>
                                        <button type="button" class="boton"><a href="./rpt.php?tipoMuestra=Agua&id='.$productor['ID_Productor'].'">Ver Reporte</a></button>
                                         </td>
                                    </tr>
                                
                        ';

                        foreach($muestras as $row){
                            echo '
                                <tr>
                                    <td><a href="./verMuestrasAgua.php?buscar='.$row['ID_Muestra'].'">'.$row['ID_Muestra'].'</a></td>
                                    <td>'.$row['Fecha_Ingreso'].'</td>
                                    <td>'.$row['Fuente_Agua'].'</td>
                                    <td colspan="2">'.$row['Recolectada_Por'].'</td>
                                </tr>
                            ';
                        }
                        
                    }

                    $muestra = new MuestraSuelo;
                    $muestras = $muestra->listarMuestras($productor['ID_Productor']);
                    if(!$muestras)
                        echo "No se han encontrado muestras de suelo<br>";
                    else{
                        echo '
                            <table id="resultado">
                                <tbody>
                                    <tr>
                                        <th colspan="6">Muestras de Suelo:</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha de Recepcion</th>
                                        <th>Uso Anterior</th>
                                        <th>Traido por</th>
                                        <td>
                                        <button type="button" class="boton"><a href="./rpt.php?tipoMuestra=Suelo&id='.$productor['ID_Productor'].'">Ver Reporte</a></button>
                                       </td>
                                    </tr>
                                
                        ';

                        foreach($muestras as $row){
                            echo '
                                <tr>
                                    <td><a href="./verMuestrSuelo.php?buscar='.$row['IDMuestraSuelo'].'">'.$row['IDMuestraSuelo'].'</a></td>
                                    <td>'.$row['Fecha_Recepcion'].'</td>
                                    <td>'.$row['Uso_Anterior'].'</td>
                                    <td colspan="2">'.$row['Traido_Por'].'</td>
                                </tr>
                            ';
                        }
                        
                    }

                    echo '</tbody>
                        </table>
                    ';
                }
            }
        ?>

    
    </main>
</section>
<?php 
    include "./inc/htmlClose.php";
?>