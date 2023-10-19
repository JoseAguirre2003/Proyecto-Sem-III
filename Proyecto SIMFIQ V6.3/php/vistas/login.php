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
        
        <form name="loginform" id="loginform" action="" method="POST">
        <h1>Autenticacion de usuario</h1>
            <p>
                
                <div class="input-box">
                <input type="text" placeholder="@Usuario" name="username" id="username" class="input" value="" size="20" />
                <span>Username</span>
                <i></i>
                </div>
            </p>

            <p>
                
                
                <div class="input-box">
                <input type="password" placeholder="@Password" name="password" id="password" class="input" value="" size="20" />
                <span>Enter Password</span>
                <i></i>
                </div>    
            </p>

            <p>
                <p class="submit">
                    <input type="submit" name="login" class="button" value="Conectar" />
                </p>
                <center>
            <div class="regtext">
                 <a href="index.php?vista=register">Registrate aqui</a>
                 </div>
                 </center>
            

        </form>
    </div>
    
</div>

<script src="./js/jquery/jquery-3.3.1.min.js"></script>
<script src="./js/popper/popper.min.js"></script>
<script src="./js/plugin/sweet_alert2/sweetalert2.all.min.js"></script>
<script src="./js/codigo.js"></script>
</body>
</html>