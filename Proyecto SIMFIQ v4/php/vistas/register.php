<?php
require_once("bd/connection.php");
$objeto = new Conexion();
$connection = $objeto->Conectar();

session_start();

if (isset($_POST["register"])) {

    if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $full_name = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);



        $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<p class="error"> El email ya se encuentra registrado</p>';
        } //fin de($query->rowCount() > 0)

        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO users(FULLNAME,USERNAME,PASSWORD,EMAIL) VALUES (:fullname,:username,:password,:email)");
            $query->bindParam("fullname", $full_name, PDO::PARAM_STR);
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->bindParam("password", $password, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $result = $query->execute();

            if ($result) {
                $message = "Cuenta Creada Correctamente";
            } //fin de if(result)
            else {
                $message = "Error al ingresar la informacion";
            } //fin del else
        } //$query->rowCount() == 0
        else {
            $message = "El nombre de usuario Ya existe";
        } //fin del else


    } //fin del if(!empty($_POST['fullname']) && !empty($_POST['email'])
    else {
        $message = "Todos los campos no deben estar vacios";
    } //fin del else

} //fin del if(isset($_POST["register"]))

?>

<center>
    <?php if (!empty($message)) {
        echo "<p class=\"error\">" . "Mensaje:" . $message . "</p>";
    } ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Document</title>
    </head>

    <body>

        <div class="container-mregister">
            <div id="login">
                <h1>Registrar</h1>
                <form name="registerform" id="registerform" action="register.php" method="post">
                    <p>
                    <div class="input-box">
                        <input type="text" placeholder="Nombre Completo" name="fullname" id="fullname" class="input"
                            size="20" value="" />
                    </div>
                    </p>

                    <p>
                    <div class="input-box">
                        <input type="email" placeholder="E-mail" name="email" id="email" class="input" value="" />
                    </div>
                    </p>

                    <p>
                    <div class="input-box">
                        <input type="text" placeholder="@Username" name="username" id="username" class="input" value=""
                            size="20" />
                    </div>
                    </p>

                    <p>
                    <div class="input-box">
                        <input type="password" placeholder="@Password" name="password" id="password" class="input"
                            value="" size="20" />
                    </div>
                    </p>

                    <p class="submit">
                        <input type="submit" name="register" id="register" class="button" value="Registrar" />
                    </p>
                    <p class="regtext">Ya tienes cuenta? <a href="indexlogin.php">Entra aqui</a>!</p>
                </form>
            </div>

        </div>


</center>

</body>

</html>