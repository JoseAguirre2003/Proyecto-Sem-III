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

    public function listarUsuarios($busqueda){
        
        if(isset($busqueda) && $busqueda != "")
            $consultaDatos = "SELECT * FROM users WHERE id LIKE '$busqueda' OR fullname LIKE '%$busqueda%' OR email LIKE '%$busqueda%' OR username LIKE '%$busqueda%';";
        else
            $consultaDatos = "SELECT * FROM users;"; 

        $conexion = conexion();

        $datos = $conexion->query($consultaDatos);
        $datos = $datos->fetchAll();

        $conexion = null;
        return $datos;
    }
}

?>,,