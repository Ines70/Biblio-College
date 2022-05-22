<?php

include_once('GestionLivre.php');
$conn = new PDO("mysql:host=localhost;dbname=PFE", 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$maBDD = new GestionLivre($conn);
$res = '';

if(isset($_POST["isbn"]))
	$res = $maBDD->getTitre($_POST["isbn"]) ;

elseif(isset($_POST["titre"]))
	$res = $maBDD->getISBN($_POST["titre"]) ;

echo $res ;
 
?>
