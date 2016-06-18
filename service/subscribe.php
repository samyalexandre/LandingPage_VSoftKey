<?php
require_once("../config/configuration.php");

$connexion = new PDO(PDO_DSN, USER, PASSWD);
$connexion->exec("set names utf8");

$query = "" ;
$array = array();

if(isset($_POST['email']) && !empty($_POST['email'])) {  
    $statement = $connexion->prepare("INSERT INTO newsletter VALUES(NULL, :field1, 1, NULL)");
    $statement->execute(array(':field1' => $_POST['email']);  
} else {
    exit(1);
}


?>