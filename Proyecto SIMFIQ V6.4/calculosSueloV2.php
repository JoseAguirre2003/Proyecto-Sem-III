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
<section class="sub-body">
  <div class="sub-container">
      <header class="form-tittle">Ingreso de datos para calcular:</header>
            <?php 
            
            ?>
            <form action="" method="POST" class="form">
            
            </form>
    </div>
</section>

<?php 
    include "./inc/htmlClose.php";
?>