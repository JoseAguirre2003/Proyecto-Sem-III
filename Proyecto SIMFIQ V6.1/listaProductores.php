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
    <form action="" method="GET">
        <label for="busqueda">Buscar:</label><br>
        <input type="text" name="busqueda" id="busqueda">
        <input type="submit" value="Buscar" class="boton">
    </form>
    <?php
        include "./php/func.php";
        include "./php/clases/Productor.php";
        $productores = new Productor;

        if(isset($_POST['eliminar']) && (isset($_GET['idElim']) && is_numeric($_GET['idElim']))){
            if($productores->eliminarProductor($_GET['idElim']))
                echo "Sea Eliminado el Productor de ID: ".$_GET['idElim']."<br>";
            else
                echo "No pudo elimiar el Productor de ID: ".$_GET['idElim']."<br>";
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
                    <td><a href="./verProductor.php?buscar='.$productor['ID_Productor'].'">'.$productor['ID_Productor'].'</a></td>
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
                <div class="btns-prod" id="botones" style="justify-content: space-around;">
                    <button type="button" class="boton"><a href="?paginaInicial='.((int)$pagInicial - 1).'">Atras</a></button>
                    <button type="button" class="boton"><a href="?paginaInicial='.((int)$pagInicial + 1).'">Siguiente</a></button>
                </div>
            ';
            //ESOS BOTONES ESTAN RAROS, NO SE SI ESTE BIEN PONE UN <a> DENTRO DE UN <button>
        }
    ?>

    </section>
      </main>
</section>

<?php 
    include "./inc/htmlClose.php";
?>