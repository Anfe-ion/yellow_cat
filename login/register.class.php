<?php 
//Clase para insertar los usuarios en el JSON
class RegisterUser{
	//Propiedades
	private $username; //Usuario
    private $raw_password; //Contraseña
    private $encrypted_password; //Contraseña encriptada -hash
    public $error; //Error
    public $success; //Éxito
    private $storage = "data.json"; //Guardara/Sontendra/Holdeara el paquete JSON
    private $stored_users; //Holdeara los usuarios en el archivo
    private $new_user; //Array, holdeara la data de los usuarios

	//Para iniciar las propiedades
	public function __construct($username, $password){
		//Para quitar cualquier espacio en blanco al principio o final
		$this->username = trim($this->username);
		//Para "sanitizar" el valor
		$this->username = filter_var($username, FILTER_SANITIZE_STRING);
		//Lo mismo para el password
		$this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
		//Encriptacion
		$this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

		//Ahora se guardaran todos los usuarios del JSON en stored_users
        //json_decode para transformar a array
        //Como se necesita un array se pone true, de no ponerlo devolvera un objeto
		$this->stored_users = json_decode(file_get_contents($this->storage), true);
		//Asignar un array con el username y la password cifrada a la propiedad new_user
		$this->new_user = [
			"username" => $this->username,
			"password" => $this->encrypted_password,
		];
		//Si los campos no están vacios, inserte los usuauris..
		if($this->checkFieldValues()){
			$this->insertUser();
		}
	}

	//Para verificar si los input son validos
	private function checkFieldValues(){
		if(empty($this->username) || empty($this->raw_password)){
			$this->error = "Todos los campos son requeridos.";
			return false;
		}else{
			return true;
		}
	}

	//Funcion para comprobar si el usuario existe
	private function usernameExists(){
		//Se mira a través del archivo con el loop
		foreach($this->stored_users as $user){
			if($this->username == $user['username']){
				$this->error = "El nombre de usuario ya ha sido usado. Por favor, escoja otro.";
				return true;
			}
		}
		return false;
	}

	//Inserción del usuario en el archivo
	private function insertUser(){
		//Si el usuario no existe...
		if($this->usernameExists() == FALSE){
			//Se empuja el nuevo usuario al array
			array_push($this->stored_users, $this->new_user);
			//file_put_contents para escribir la data en el JSON, de nuevo se usa el encode
           	//JSON_PRETTY para obtener un archivo más legible
           	//Si todo funciona bien...
			if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
				return $this->success = "Registro exitoso.";
			}else{
				return $this->error = "Algo salió mal. Intenta de nuevo.";
			}
		}
	}



} //Fin