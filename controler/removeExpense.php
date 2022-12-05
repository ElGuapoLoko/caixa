<?PHP
require_once 'functions.php' ;

$PDO = db_connect();

$id = isset($_POST['id']) ? $_POST['id'] : '';

if(isset($_POST['id'])){
    $sql_remove = "DELETE FROM `despesas` WHERE `id` = :id";
    $stmt = $PDO->prepare($sql_remove);

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



