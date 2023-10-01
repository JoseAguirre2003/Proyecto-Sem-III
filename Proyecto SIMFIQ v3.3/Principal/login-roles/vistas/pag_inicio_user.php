<?php
session_start();


if ($_SESSION["s_usuario"] === null){
    header("Location:../indexlogin.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vistas-css/vistas.css">
    <title>Document</title>
</head>

<body>

    <header class="header">

        <div id="bienvenido">
            <h2 class="log">Bienvenido, <span><?php echo $_SESSION['s_usuario']; ?></span></h2>
            <h2 class="log">Usted es: <span><?php echo $_SESSION['s_rol_descripcion']; ?></span></h2>
            <a href="../bd/logout.php">Logout</a>
        </div>



        <nav class="navbar">
            <a href="../../../Vistas/listaProductores/listaProductores.php">Lista de Productores</a>
            <a href="../../../Vistas/registrarMuestraAgua/registrarMuestraAguaV2.php">Registrar Muestras de Agua</a>
            <a href="../../../Vistas/registrarMuestraAguaAProcesar/registrarMuestrasAAProcesar.php">Registrar Muestras de Agua a Procesar</a>
            <a href="../../../Vistas/registrarProductor/registroProductorV2.php">Registrar Productor</a>

        </nav>

    </header>







    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../popper/popper.min.js"></script>

    <script src="../plugin/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="../codigo.js"></script>

</body>

</html>