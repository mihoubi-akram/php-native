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

    public function getName(): string {
        return $this->name;
    }

    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }


    public static function getAllUsers(): array {
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

    public function login(string $email, string $password): ?User {
        try {
            $pdo = new PDO('', '', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return new User($user['name'], $user['email'], $user['password']);
            } else {
                return null;
            }

        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }
   
}

?>