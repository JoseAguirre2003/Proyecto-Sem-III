<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="plugin/sweet_alert2/sweetalert2.min.css">
    <link rel="stylesheet" href="css/styleLogin.css">
    <title>Document</title>
</head>
<body>
<div class="container-mlogin">
    <div id="login">
        <h1>Autenticacion de usuario</h1>
        <form name="loginform" id="loginform" action="" method="POST">
            <p>
                
                <div class="input-box">
                <input type="text" placeholder="@Usuario" name="username" id="username" class="input" value="" size="20" />
                </div>
            </p>

            <p>
                
                
                <div class="input-box">
                <input type="password" placeholder="@Password" name="password" id="password" class="input" value="" size="20" />
                </div>    
            </p>

            <p>
                <p class="submit">
                    <input type="submit" name="login" class="button" value="Conectar" />
                </p>
            </p>
                <p class="regtext">No estas registrado? <a href="index.php?vista=register" >Registrate aqui</a>!
            </p>

        </form>
    </div>
    
</div>

<script src="./js/jquery/jquery-3.3.1.min.js"></script>
<script src="./js/popper/popper.min.js"></script>
<script src="./js/plugin/sweet_alert2/sweetalert2.all.min.js"></script>
<script src="./js/codigo.js"></script>
</body>
</html>