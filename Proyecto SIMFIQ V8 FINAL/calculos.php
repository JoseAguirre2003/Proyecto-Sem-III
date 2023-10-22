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
        <form action="calculos.php?id=<?php if(isset($_GET['id']))echo $_GET['id'];?>" method="POST" class="form">
            <h3>Calculo de</h3>
            <div class="main-user-info2">
            <?php   
                    include_once "./php/func.php";
                    include "./php/clases/MAaProcesar.php";
                    include "./php/clases/resultados.php";

                    if(isset($_POST['calculos'])){
                        $resultado = new Resultados;
                        $validos = false;
                        if(isset($_GET['id']) && is_numeric($_GET['id'])){
                            $resultado->setIdMAP($_GET['id']);
                            $validos = true;
                        }
                        if(isset($_POST['resultado_pH']) && is_numeric($_POST['resultado_pH'])){ 
                            $resultado->set_pH($_POST['resultado_pH']);
                            $validos = true;
                        }
                        if(isset($_POST['resultado_Ce']) && is_numeric($_POST['resultado_Ce'])){
                            $resultado->setCe( $_POST['resultado_Ce']);
                            $validos = true;
                        }
                        if(isset($_POST['resultado_CIC']) && is_numeric($_POST['resultado_CIC'])){
                            $resultado->setSuelo_CIC( $_POST['resultado_CIC']);
                            $validos = true;
                        }
                        if(isset($_POST['resultado_Textura']) && is_numeric($_POST['resultado_Textura'])){
                            $resultado->setSuelo_Textura($_POST['resultado_Textura']);
                            $validos = true;
                        }
                        if(isset($_POST['resultado_particulas']) && is_numeric($_POST['resultado_particulas'])){
                            $resultado->setAgua_ParticulasSuspension($_POST['resultado_particulas']);
                            $validos = true;
                        }
                       /*  if(isset($_GET['id']) && is_numeric($_GET['id'])){
                            $resultado->setIdMAP($_GET['id']);
                            $validos = true;
                        }
                        if(isset($_POST['resultado_pH']) && is_numeric($_POST['resultado_pH'])){ 
                            $resultado->set_pH(isset($_POST['resultado_pH']) ? $_POST['resultado_pH'] : null);
                            $validos = true;
                        }
                        if(isset($_POST['resultado_Ce']) && is_numeric($_POST['resultado_Ce'])){
                            $resultado->setCe((isset($_POST['resultado_Ce']) ? $_POST['resultado_Ce'] : null));
                            $validos = true;
                        }
                        if(isset($_POST['resultado_CIC']) && is_numeric($_POST['resultado_CIC'])){
                            $resultado->setSuelo_CIC((isset($_POST['resultado_CIC']) ? $_POST['resultado_CIC'] : null));
                            $validos = true;
                        }
                        if(isset($_POST['resultado_Textura']) && is_numeric($_POST['resultado_Textura'])){
                            $resultado->setSuelo_Textura((isset($_POST['resultado_Textura']) ? $_POST['resultado_Textura'] : null));
                            $validos = true;
                        }
                        if(isset($_POST['resultado_particulas']) && is_numeric($_POST['resultado_particulas'])){
                            $resultado->setAgua_ParticulasSuspension((isset($_POST['resultado_particulas']) ? $_POST['resultado_particulas'] : null));
                            $validos = true;
                        } */
                            
                        if($validos)
                            if($resultado->guardarResultado()){
                                // header("./verMuestrasAAProcesar.php?id=".$resultado->getIdMAP());
                                echo "<script>window.location = './verMuestrasAProcesar.php?buscar=".$resultado->getIdMAP()."'</script>";
                            }else{
                                echo "No se pudo guardar el resultado<br>";
                            }
                        else
                            echo "Datos errados!!<br>";
                    }

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
                                <input type="submit" name="calculos" value="Enviar" id="btnCalcular_Enviar">
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