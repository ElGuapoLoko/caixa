<?php
function db_connect(){
	
$username = 'root';
$password_banco = ''; 

try {
    $conn = new PDO('mysql:host=localhost:3306;dbname=caixa', $username, $password_banco);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $conn ; 
} catch(PDOException $e) {
    echo 'Deu erro na Conecxão Aki : ' . $e->getMessage();
}


}
 
function lastID($connection, $table){
        try {
            $state = $connection->prepare("SELECT last_insert_id() as last FROM {$table}");
            $state->execute();
            $state = $state->fetchObject();
        } catch (PDOException $ex){
            die ($ex->getMessate());
        }
        return $state->last;
    }

/**
 * Cria o hash da senha, usando MD5 e SHA-1
 */
function make_hash($str) {
    return sha1(md5($str));
}

?>

