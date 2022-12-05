<?PHP
require_once 'functions.php' ;

$PDO = db_connect();

$id = isset($_POST['id']) ? $_POST['id'] : '';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '';

if(isset($_POST['id'])){
    $sql_update = "UPDATE `produtos` SET quantidade=:amount WHERE `codigo`=:id";
    $stmt = $PDO->prepare($sql_update);

    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    if($stmt == true) {
        echo 1;
    } else {
        echo 0;
    }

} else {
    echo 0;
}




?>



