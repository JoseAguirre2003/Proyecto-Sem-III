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
        }else
            header("./logout.php");
    else
        header("./logout.php");
?>
<section class="container">
    <form action="" method="GET">
        <label for="busqueda">Buscar:</label><br>
        <input type="text" name="busqueda" id="busqueda">
        <input type="submit" value="Buscar" class="boton">
    </form>
    <?php
        include "./php/func.php";
        include "./php/clases/user.php";
        $usuarios = new Usuario;
        $busqueda = (isset($_GET['busqueda'])) ? limpiarCadena($_GET['busqueda']) : "";

        $usuarios = $usuarios->listarUsuarios($busqueda);
        if (!$usuarios){
            echo "No se han encontrado productores :(";
        }else{
            echo '      
            <table id="resultado">
                <tbody>
                    <tr>
                        <th colspan="7">Usuarios:</th>
                    </tr>
                    <tr>
                        <th>ID:</th>
                        <th>Nombre:</th>
                        <th>Correo:</th>
                        <th>Username:</th>
                        <th>Rol:</th>
                        <th colspan="2">Opcion:</th>
                    </tr>
                    
            ';
            foreach($usuarios as $usuario){
                echo '
                <tr>
                    <td>'.$usuario['id'].'</a></td>
                    <td>'.$usuario['fullname'].'</td>
                    <td>'.$usuario['email'].'</td>
                    <td>'.$usuario['username'].'</td> 
                ';

                if($usuario['idRol'] == 1){
                    echo '
                        <td>Admin</td>  
                        <td><a href="./adminCtrlUserList.php?idRolUpdate='.$usuario['id'].'">Quitar rol de admin</a></td>
                    ';
                }else{
                    echo '
                    <td>Usuario</td>  
                    <td><a href="./adminCtrlUserList.php?idRolUpdate='.$usuario['id'].'">Asignar rol de admin</a></td>
                    ';
                }
                echo '<td><a href="./adminCtrlUserList.php?idElim='.$usuario['id'].'">Banear</a></td>
                </tr>';
            }
        }
    ?>
</section>
<?php 
    include "./inc/htmlClose.php";
?>