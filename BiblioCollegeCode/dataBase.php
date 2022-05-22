<?php


// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=BiblioBD;charset=utf8', 'root', '');
		$bdd->exec('SET NAMES utf8');


?>