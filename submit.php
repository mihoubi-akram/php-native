<?php
$content = file_get_contents('');
$data = json_decode($content);

if (empty($data['name']) || empty($data['email'])) {
  http_response_code(400);
  echo("Name and email are required");
  exit;
}

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo("Invalid email format");
  exit;
}
$name = $data['name'];
$email = $data['email'];
try{
    //Connect to database
    $pdo = new PDO('', '', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Insert user
    $stmt = $pdo->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
    $stmt->execute(['name' => $name, 'email' => $email]);
} catch (PDOException $e) {
    echo($e->getMessage());
}


?>