<?php
session_start();

if ($_SESSION["s_usuario"] === null) {
    header("Location: ./index.php?vista=login");
}

include "./inc/htmlOpen.php";

if (isset($_SESSION['s_idRol'])) {
    if ($_SESSION['s_idRol'] == 1) {
        $rol = "Admin";
        include "./inc/headerAndNavAdmin.php";
    } else {
        $rol = "Usuario";
        include "./inc/headerAndNav.php";
    }
} else {
    header("./logout.php");
}
?>

<section class="container">
    <main class="table">
        <section class="table_body">
            <form action="" method="GET">
                <label for="busqueda">Buscar:</label><br>
                <input type="text" name="busqueda" id="busqueda">
                <input type="submit" value="Buscar" class="boton">
                <button type="button" class="boton" onclick="mostrarFormatoReporte('pdf')">PDF</button>
                <button type="button" class="boton" onclick="mostrarFormatoReporte('excel')">Excel</button>
            </form>
            <?php
            include "./php/func.php";
            include "./php/clases/Productor.php";
            $productores = new Productor;

            if (isset($_POST['eliminar']) && (isset($_GET['idElim']) && is_numeric($_GET['idElim']))) {
                if ($productores->eliminarProductor($_GET['idElim']))
                    echo "Se ha eliminado el Productor de ID: " . $_GET['idElim'] . "<br>";
                else
                    echo "No se pudo eliminar el Productor de ID: " . $_GET['idElim'] . "<br>";
            }

            $pagInicial = (isset($_GET['paginaInicial']) && is_numeric($_GET['paginaInicial']) && $_GET['paginaInicial'] > 1) ? $_GET['paginaInicial'] : 1;
            $busqueda = (isset($_GET['busqueda'])) ? limpiarCadena($_GET['busqueda']) : "";
            $productores = $productores->listarProductores($pagInicial, 10, $busqueda);
            if (!$productores) {
                echo "No se han encontrado productores :(";
                echo '<div id="botones" style="justify-content: space-around;">
                            <button type="button" class="boton"><a href="?paginaInicial=' . ((int)$pagInicial - 1) . '">Atrás</a></button>
                            <button type="button" class="boton"><a href="?paginaInicial=' . ((int)$pagInicial + 1) . '">Siguiente</a></button>
                        </div>
                    ';
                // ESOS BOTONES ESTÁN RAROS, NO SÉ SI ESTÁ BIEN PONER UN <a> DENTRO DE UN <button>
            } else {
                echo '
                            <p>Click en el ID para ver más detalles ;)</p>
                            <table id="resultado">
                                <tbody>
                                    <tr>
                                        <th colspan="7">Productores:</th>
                                    </tr>
                                    <tr>
                                        <th>ID:</th>
                                        <th>Nombre:</th>
                                        <th>Cedula o RIF:</th>
                                        <th>Dirección:</th>
                                        <th>Municipio:</th>
                                        <th>Contacto:</th>
                                        <th>Correo:</th>
                                    </tr>
                        ';

                foreach ($productores as $productor) {
                    echo '
                        <tr>
                            <td><a href="./verProductor.php?buscar=' . $productor['ID_Productor'] . '">' . $productor['ID_Productor'] . '</a></td>
                            <td>' . $productor['Nombre'] . '</td>
                            <td>' . $productor['Cedula_RIF'] . '</td>
                            <td>' . $productor['Direccion'] . '</td>
                            <td>' . $productor['Municipio'] . '</td>
                            <td>' . $productor['Contacto'] . '</td>
                            <td>' . $productor['Correo'] . '</td>
                        </tr>
                        ';
                }

                echo '</tbody>
                        </table>
                        <div class="btns-prod" id="botones" style="justify-content: space-around;">
                            <button type="button" class="boton"><a href="?paginaInicial=' . ((int)$pagInicial - 1) . '">Atrás</a></button>
                            <button type="button" class="boton"><a href="?paginaInicial=' . ((int)$pagInicial + 1) . '">Siguiente</a></button>
                        </div>
                    ';
                // ESOS BOTONES ESTÁN RAROS, NO SÉ SI ESTÁ BIEN PONER UN <a> DENTRO DE UN <button>
            }
            ?>
        </section>
    </main>
</section>

<script>
    function mostrarFormatoReporte(formato) {
        // Añadir la lógica para generar el informe en PDF o Excel según la opción seleccionada
        if (formato === 'pdf') {
            // Utiliza window.open para abrir el informe en una nueva ventana o pestaña
            window.open("reporte.php", "_blank");
        } else if (formato === 'excel') {
            // Redirige a la página que genera el informe en Excel
            window.location.href = "generarInforme.php?formato=excel";
        }
    }
</script>

<?php
include "./inc/htmlClose.php";
?>
