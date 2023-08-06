<?php

class LoginUser{
    //Propiedades
    private $username;
    private $password;
    public $error;
    public $success;
    private $storage = "data.json";
    private $stored_users; //array

    //Métodos
    //Constructor para inicializar las propiedades y ejecutar los metodos
    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->login();
     }
   
     //Función para verificar la contraseña y dar el login
     private function login(){
        //Loop y se almacenan todos los usuarios en $user
        foreach ($this->stored_users as $user) {
            //Si el usuario ingresado y los existentes hacen match
           if($user['username'] == $this->username){
            //Si la contraseña ingresada hace match con las existentes...
              if(password_verify($this->password, $user['password'])){
                 //Se redireccionaría a su usaurio.
                 session_start();
					$_SESSION['user'] = $this->username;
					header("location: account.php"); exit();
              }
           }
        }
        return $this->error = "Usuario o contraseña errados";
     }
} //Final