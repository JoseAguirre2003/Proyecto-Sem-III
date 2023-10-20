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
    <header class="form-tittle">Ingreso de datos para calcular muestra:</header>
        <form action="" method="POST" class="form">
            <h3>Calculo de</h3>
            <div class="main-user-info2">
            <?php   
                    include_once "./php/func.php";
                    include "./php/clases/MAaProcesar.php";
                    include "./php/clases/resultados.php";

                    if(isset($_GET['id']) && is_numeric($_GET['id'])){
                        $muestrasAProcesar = new MAaProcesar;
                        $muestrasAProcesar = $muestrasAProcesar->verTipo($_GET['id']);
                        if(!$muestrasAProcesar)
                            echo "Muestra no encontrada";
                        else{
                            switch ($muestrasAProcesar['Analisis_A_Realizar']){
                                case 'pH':
                                    include "./inc/calculo_pH.php";
                                    break;
                                case 'Conductividad':
                                    include "./inc/calculo_Ce.php";
                                    break;
                                case 'ParticulasFlotantes':
                                    include "./inc/calculo_particulasSuspension.php";
                                    break;
                                case 'CIC':
                                    include "./inc/calculo_CIC.php";
                                    break;
                                case 'Textura':
                                    echo "No hay";
                                    break;
                                case 'Todo':
                                    if($muestrasAProcesar['Tipo'] == "Agua"){
                                        include "./inc/calculo_pH.php";
                                        include "./inc/calculo_Ce.php";
                                        include "./inc/calculo_particulasSuspension.php";
                                        echo '<div class="imput-box">  
                                            <input type="button" value="Calcular Todo" id="btnCalcular_TodoAgua">
                                        </div>';
                                    }
                                    else if($muestrasAProcesar['Tipo'] == "Suelo"){
                                        include "./inc/calculo_pH.php";
                                        include "./inc/calculo_Ce.php";
                                        include "./inc/calculo_CIC.php";
                                        // "Falta textura";
                                        echo '<div class="imput-box">  
                                            <input type="button" value="Calcular Todo" id="btnCalcular_TodoSuelo">
                                        </div>';
                                    }
                                    break;
                                default:
                                    echo "Nada";
                                    break;
                            }
                            echo '<div class="imput-box">  
                                <input type="submit" value="Enviar" id="btnCalcular_Enviar">
                            </div>';
                        }
                            
                    }else
                        echo "Cuanto vacio";
            ?>
            </div>
        </form>
    </div>
</section>
<script src="./js/jquery/jquery-3.3.1.min.js"></script>
<script src="./js/popper/popper.min.js"></script>
<script src="./js/plugin/sweet_alert2/sweetalert2.all.min.js"></script>
<script src="./js/calculos.js"></script>

<?php 
    include "./inc/htmlClose.php";
?>