<?PHP
require_once 'functions.php' ;

$PDO = db_connect();

$data = date("d/m/Y") ;
$data1 = date("d") ;
$data2 = date("m") ;
$data3 = date("Y") ;
(float)$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

$sql_insert_peso_med = "INSERT INTO despesas (descricao , valor , data_despesa , data1 , data2, data3 ) VALUES (:descricao , :valor , :data , $data1 , $data2 , $data3);" ;

$stmt = $PDO->prepare($sql_insert_peso_med);

$stmt->bindParam(':data', $data );
$stmt->bindParam(':valor', $valor  );
$stmt->bindParam(':descricao', $descricao );

$stmt->execute();


if($stmt == true) {
    $id = lastID($PDO, 'despesas');
    $json = "{\"id\": \"". $id . "\", \"date\": \"" . $data . "\"}";
    echo $json;
} else {
    echo 0;
}




?>



