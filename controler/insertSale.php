<?php
require_once 'functions.php' ;

$date = date("d/m/Y") ;
$day = date("d") ;
$month = date("m") ;
$year = date("Y") ;

$final_date =

$json = isset($_POST['json']) ? $_POST['json'] : '';
$total = isset($_POST['total']) ? $_POST['total'] : '';
$gateway = isset($_POST['gateway']) ? $_POST['gateway'] : '';
$total_change = isset($_POST['total_change']) ? $_POST['total_change'] : '';

$sql_insert_peso_med = "INSERT INTO `sales` (`json` , `total` , `gateway`, `total_change` , `day`, `month`, `year`, `date` ) VALUES (:json , :total , :gateway, :total_change , $day , $month , $year, :date);" ;

$PDO = db_connect();
$stmt = $PDO->prepare($sql_insert_peso_med);

$stmt->bindParam(':json', $json );
$stmt->bindParam(':total', $total);
$stmt->bindParam(':gateway', $gateway);
$stmt->bindParam(':total_change', $total_change);
$stmt->bindParam(':date', $date);

$stmt->execute();

echo boolval($stmt);
