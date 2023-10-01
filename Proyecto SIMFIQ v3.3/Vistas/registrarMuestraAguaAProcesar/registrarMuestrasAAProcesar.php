<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Entrada de datos</title>
        <link rel="stylesheet" href="./styles/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <section class="container">
            <header>Ingreso de datos de Muestra a Procesar:</header>
            <?php 
                include_once "../php/func.php";
                if(isset($_POST['idMuestra'])){
                        if(limpiarCadena($_POST['idMuestra']) && limpiarCadena($_POST['identificador']) && limpiarCadena($_POST['analisisARealizar']) && limpiarCadena($_POST['fechaDeToma']) && limpiarCadena($_POST['observaciones'])){
                        $respuesta = guardarMuestraAguaAProcesar($_POST['idMuestra'], $_POST['identificador'], $_POST['analisisARealizar'], $_POST['fechaDeToma'], $_POST['observaciones']);
                        echo "<h3>".$respuesta."</h3>";
                    }else
                        echo "DATO ERRADO";
                }
            ?>
            <form action="" method="POST" class="form">
                <div class="imput-box">
                    <label for="idMuestra">ID de Muestra:</label>
                    <input type="text" placeholder="Id" name="idMuestra" id="idMuestra">
                </div>

                <div class="imput-box">
                    <label for="identificador">Identificador:</label>
                    <input type="text" placeholder="Indentificador" name="identificador" id="identificador">
                </div>

                <div class="imput-box">
                    <label for="analisisARealizar">Analisis a realizar:</label>
                    <input type="text" placeholder="Analisis a realizar" name="analisisARealizar" id="analisisARealizar">
                </div>

                <div class="imput-box">
                    <label for="fechaDeToma">Fecha de toma:</label><br>
                    <input type="date" name="fechaDeToma" id="fechaDeToma">
                </div>

                <div class="imput-box">
                    <label for="observaciones">Observaciones</label><br>
                    <input type="text" placeholder="Observaciones..." name="observaciones" id="observaciones">
                </div>

                <input type="submit" value="Guardar" class="button">
            </form>
        </section>
    </body>
</html>