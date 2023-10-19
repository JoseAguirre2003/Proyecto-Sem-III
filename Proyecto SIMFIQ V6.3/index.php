<?php
    if (!isset($_GET['vista']) || $_GET['vista'] == "")
        $_GET['vista'] = "home";

    if (is_file("./php/vistas/" . $_GET['vista'] . ".php") && $_GET['vista'] != "login" && $_GET['vista'] != "404" && $_GET['vista'] != "home")
        include "./php/vistas/".$_GET['vista'].".php";
    else {
        if ($_GET['vista'] == "home")
            include "./php/vistas/home.php";
        else if ($_GET['vista'] == "login")
            include "./php/vistas/login.php";
        else if ($_GET['vista'] == "register")
            include "./php/vistas/register.php";
    }
?>