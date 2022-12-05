<?php
 
// inclui o arquivo de inicialização
require_once 'functions.php';
 
// resgata variáveis do formulário
$email = isset($_POST['user']) ? $_POST['user'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
 
$PDO = db_connect();
 
$sql = "SELECT * FROM users WHERE email = :user AND senha = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':user', $email);
$stmt->bindParam(':password', $password);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
if (count($users) >= 1) {
    setcookie('address', "localhost", time()+3600, '/');
    echo 1;
} else{
    echo 0;
}

?>


