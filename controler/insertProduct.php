<?php
require_once 'functions.php' ;

$PDO = db_connect();

$data = date("d/m/Y") ;
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
$medida = isset($_POST['medida']) ? $_POST['medida'] : '';
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';

$sql_insert_peso_med = "INSERT INTO produtos (codigo , nome , valor , medida , data_cadastro , quantidade ) VALUES (:codigo , :nome , :valor ,:medida , :data , :quantidade);" ;

$stmt = $PDO->prepare($sql_insert_peso_med);

$stmt->bindParam(':data', $data );
$stmt->bindParam(':nome', $nome );
$stmt->bindParam(':codigo', $codigo );
$stmt->bindParam(':valor', $valor );
$stmt->bindParam(':medida', $medida );
$stmt->bindParam(':quantidade', $quantidade );

$stmt->execute();

if($stmt == true){
    echo 1;
} else {
    echo 0;
}




?>