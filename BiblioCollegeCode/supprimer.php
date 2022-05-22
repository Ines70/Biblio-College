<?php

include_once('GestionLivre.php');
$conn = new PDO("mysql:host=localhost;dbname=PFE", 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$isbn = $_POST["isbn"] ; 
$titre = $_POST["titre"] ; 

$maBDD = new GestionLivre($conn);

echo $maBDD->supprimerLivre($isbn) ;
?>
