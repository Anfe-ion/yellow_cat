<?php 
class RegisterUser {
    // Propiedades
    private $username;
    private $raw_password;
    private $encrypted_password;
    private $birthDate;
    private $cedula;
    private $email;
    public $error;
    public $success;
    private $storage = "data.json";
    private $stored_users;
    private $new_user;

    // Constructor
    public function __construct($username, $password, $birthDate, $cedula, $email) {
        $this->username = trim($username);
        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);
        $this->birthDate = $birthDate;
        $this->cedula = $cedula;
        $this->email = $email;

        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->new_user = [
            "username" => $this->username,
            "password" => $this->encrypted_password,
            "birthDate" => $this->birthDate,
            "cedula" => $this->cedula,
            "email" => $this->email,
        ];

        if ($this->checkFieldValues() && $this->checkUniqueFields()) {
            $this->insertUser();
        }
    }

    private function checkFieldValues() {
        if (empty($this->username) || empty($this->raw_password) || empty($this->cedula) || empty($this->email) || empty($this->birthDate)) {
            $this->error = "Todos los campos son requeridos.";
            return false;
        } else {
            return true;
        }
    }

    private function checkUniqueFields() {
        foreach ($this->stored_users as $user) {
            if ($user['username'] == $this->username) {
                $this->error = "El nombre de usuario ya ha sido usado. Por favor, escoja otro.";
                return false;
            }
            if ($user['cedula'] == $this->cedula) {
                $this->error = "La cédula ya ha sido registrada. Por favor, use una diferente.";
                return false;
            }
            if ($user['email'] == $this->email) {
                $this->error = "El correo electrónico ya ha sido registrado. Por favor, use uno diferente.";
                return false;
            }
        }
        return true;
    }

    private function insertUser() {
        array_push($this->stored_users, $this->new_user);
        if (file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))) {
            $this->success = "Registro exitoso.";
        } else {
            $this->error = "Algo salió mal. Intenta de nuevo.";
        }
    }
}
