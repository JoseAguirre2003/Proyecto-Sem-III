<?php 

class Usuario{

    private $fullname;
    private $email;
    private $username;
    private $password;
    private $idRol;

	public function getFullname() {
		return $this->fullname;
	}
	
	public function setFullname($fullname){
		$this->fullname = $fullname;
		return $this;
	}

	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email = $email;
		return $this;
	}

	public function getUsername() {
		return $this->username;
	}
	
	public function setUsername($username){
		$this->username = $username;
		return $this;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setPassword($password){
		$this->password = $password;
		return $this;
	}

	public function getIdRol() {
		return $this->idRol;
	}
	
	public function setIdRol($idRol){
		$this->idRol = $idRol;
		return $this;
	}

	public function camiarRol($id){
		$conexion = conexion();
		$peticion = $conexion->prepare("SELECT idRol FROM `users` WHERE `id` = ".$id.";");
		$peticion->execute();
		$rol = $peticion->fetch()[0];
		if($rol == 1){
			if($conexion->query("UPDATE `users` SET `idRol` = '0' WHERE `users`.`id` = $id ")){
				$peticion = null;
				$conexion = null;
				return true;
			}
			return false;
		}else{
			if($conexion->query("UPDATE `users` SET `idRol` = '1' WHERE `users`.`id` = $id ")){
				$peticion = null;
				$conexion = null;
				return true;
			}
			return false;
		}
	}

	public function eliminarUser($id){
		$peticion = conexion();
		$peticion = $peticion->prepare("DELETE FROM `users` WHERE `id` = ".$id.";");
		$peticion->execute();
		if($peticion->rowCount() > 0){
			$peticion = null;
			return true;
		}else {
			$peticion = null;
			return false;
		}
	}

    public function listarUsuarios($busqueda){
        
        if(isset($busqueda) && $busqueda != "")
            $consultaDatos = "SELECT * FROM users WHERE id != ".$_SESSION["s_id"]." AND (fullname LIKE '%$busqueda%' OR email LIKE '%$busqueda%' OR username LIKE '%$busqueda%');";
        else
            $consultaDatos = "SELECT * FROM users WHERE id != ".$_SESSION["s_id"].";"; 

        $conexion = conexion();

        $datos = $conexion->query($consultaDatos);
        $datos = $datos->fetchAll();

        $conexion = null;
        return $datos;
    }
}

?>,,