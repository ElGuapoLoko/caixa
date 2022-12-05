<?php

if(!isset($_COOKIE['address']) || empty($_COOKIE['address'])){
    include "pagestyle/login.php";
} else {
    include "pagestyle/index.php";
}
?>