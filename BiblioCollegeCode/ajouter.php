<?php

include_once('GestionLivre.php');
$conn = new PDO("mysql:host=localhost;dbname=bibliobd", 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$isbn = $_POST["isbn"] ; 
$titre = $_POST["titre"] ; 
$categorie = $_POST["categorie"] ; 
$parution = $_POST["parution"] ;
$exemplaire = $_POST["exemplaire"] ;  
$nom = $_POST["nom"] ;  
$prenom = $_POST["prenom"] ;  

$maBDD = new GestionLivre($conn);

echo $maBDD->ajouterLivre($isbn,$titre,$categorie,$parution,$exemplaire,$nom,$prenom) ;
?>
