<?php 
session_start();
include_once 'connection.php';
$objeto = new Conexion();
$conexion= $objeto->Conectar();

//recopilacion de datos enviados

$usuario= (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password= (isset($_POST['password'])) ? $_POST['password'] : '';

$pass= md5($password); //ecripto de la clave enviada por el ususario 

$consulta = "SELECT users.idRol as idRol, roles.descripcion AS rol FROM users JOIN roles ON users.idRol = roles.id WHERE username='$usuario' AND password='$pass' ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount()>= 1){
    $data= $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuario"]=$usuario;
    $_SESSION["s_idRol"] = $data[0]["idRol"];
    $_SESSION["s_rol_descripcion"]= $data[0]["rol"];

}else{
    $_SESSION["s_usuario"]= null;
    $data=null;
}

print json_encode($data);
$conexion=null;



