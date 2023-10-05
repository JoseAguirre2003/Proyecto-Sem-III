<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/styles.css">
</head>

<body>
    <section class="container">
        <form action="" method="GET">
            <label for="busqueda">Buscar:</label><br>
            <input type="text" name="busqueda" id="busqueda">
            <input type="submit" value="Buscar" class="boton">
        </form>
        <?php
        include_once "../php/func.php";
        include "../../clases/Productor.php";
        $productores = new Prodcutor;

        if(isset($_POST['eliminar']) && (isset($_GET['idElim']) && is_numeric($_GET['idElim']))){
            if($productores->eliminarProductor($_GET['idElim']))
                echo "Sea Eliminado el Productor de ID: ".$_GET['idElim'];
            else
                echo "No pudo elimiar el Productor de ID: ".$_GET['idElim'];
        }

        $pagInicial = (isset($_GET['paginaInicial']) && is_numeric($_GET['paginaInicial']) && $_GET['paginaInicial'] > 1) ? $_GET['paginaInicial'] : 1;
        $busqueda = (isset($_GET['busqueda'])) ? limpiarCadena($_GET['busqueda']) : "";
        $productores = $productores->listarProductores($pagInicial, 10, $busqueda);
        if (!$productores){
            echo "No se han encontrado productores :(";
            echo '<div id="botones" style="justify-content: space-around;">
                    <button type="button" class="boton"><a href="?paginaInicial='.((int)$pagInicial - 1).'">Atras</a></button>
                    <button type="button" class="boton"><a href="?paginaInicial='.((int)$pagInicial + 1).'">Siguiente</a></button>
                </div>
            ';
            //ESOS BOTONES ESTAN RAROS, NO SE SI ESTE BIEN PONE UN <a> DENTRO DE UN <button>
        }else {
            echo '      
                        <p>Click en el ID para ver mas detalles ;)</p>
                        <table id="resultado">
                            <tbody>
                                <tr>
                                    <th colspan="7">Productores:</th>
                                </tr>
                                <tr>
                                    <th>ID:</th>
                                    <th>Nombre:</th>
                                    <th>Cedula o RIF:</th>
                                    <th>Direccion:</th>
                                    <th>Municipio:</th>
                                    <th>Contacto:</th>
                                    <th>Correo:</th>
                                </tr>
                    ';

            foreach($productores as $productor){
                echo '
                <tr>
                    <td><a href="../BuscarProdcutor/buscarProdcutorYMuestrasV2.php?buscar='.$productor['ID_Productor'].'">'.$productor['ID_Productor'].'</a></td>
                    <td>'.$productor['Nombre'].'</td>
                    <td>'.$productor['Cedula_RIF'].'</td>
                    <td>'.$productor['Direccion'].'</td>
                    <td>'.$productor['Municipio'].'</td>
                    <td>'.$productor['Contacto'].'</td>
                    <td>'.$productor['Correo'].'</td>
                </tr>
                ';
            }

            echo '</tbody>
                </table>
                <div id="botones" style="justify-content: space-around;">
                    <button type="button" class="boton"><a href="?paginaInicial='.((int)$pagInicial - 1).'">Atras</a></button>
                    <button type="button" class="boton"><a href="?paginaInicial='.((int)$pagInicial + 1).'">Siguiente</a></button>
                </div>
            ';
            //ESOS BOTONES ESTAN RAROS, NO SE SI ESTE BIEN PONE UN <a> DENTRO DE UN <button>
        }
        ?>

        <a href=""></a>
    </section>
</body>
</html>