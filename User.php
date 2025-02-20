<?php

class User {
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->setPassword($password);
    }

    public function getName() {
        return $this->name;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }


    public static function getAllUsers() {
        try {
            $pdo = new PDO('', '', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query('SELECT name, email, password FROM users');
            $users = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = new User($row['name'], $row['email'], $row['password']);
            }

            return $users;

        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }
   
}

?>