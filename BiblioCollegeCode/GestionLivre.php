<?php

class GestionLivre
{

private $db ;

public function __construct($db)
{
	$this->setDb($db);
}

public function setDb(PDO $db)
{
    $this->db = $db;
}

//obtenir livre a partir de son nom ou isbn
public function getLivre($isbn)
{
	$q = $this->db->query('SELECT * FROM livre where isbn = "'. $isbn. '"' );

    return $q->fetch(PDO::FETCH_ASSOC) ;
}

public function getISBN($titre)
{
	$q = $this->db->query('SELECT isbn FROM livre where titre = "'. $titre. '"' );

    $donnees = $q->fetch(PDO::FETCH_ASSOC) ;
    return $donnees['isbn'];
}

public function getTitre($isbn)
{
	$q = $this->db->query('SELECT titre FROM livre where isbn = "'. $isbn. '"' );

    $donnees = $q->fetch(PDO::FETCH_ASSOC) ;
    return $donnees['titre'];
}

public function getIDAuteur($nom,$prenom)
{
	$q = $this->db->query('SELECT id_aut FROM auteur where nom = "'. $nom. '" and prenom = "'. $prenom. '"' );

    $donnees = $q->fetch(PDO::FETCH_ASSOC) ;
    return $donnees['id_aut'];
}

//obtenir liste livre
public function getListeLivre()
{
	$livre = [];
    $q = $this->db->query('SELECT * FROM livre' );

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $livre[] = $donnees;
    }

    return $livre;
}

//obtenir liste exemplaire d'un livre
public function getListeExemplaire($isbn)
{
	$livres = [];

    $q = $this->db->query('select * from exemplaire where isbn =". $isbn' );

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $livres[] = $donnees;
    }

    return $livres;
}

public function ajouterExemplaire($isbn,$nb)
{
	for($i = 0 ; $i < $nb ; $i++)
	{
		$codebarre = $isbn . 'EX' . $i ;
		$a = 'En rayon' ;
		
		$q = $this->db->prepare('INSERT INTO exemplaire (code_barre, etat, ISBN) values(:code, :a ,:isbn)' );
		$q->bindValue(':a', $a);
		$q->bindValue(':code', $codebarre);
		$q->bindValue(':isbn', $isbn);
		$q->execute();
	}
}

//ajouter info livre -> nbExemplaire = 0
public function ajouterLivre($isbn,$titre,$categorie,$parution,$exemplaire,$nom,$prenom)
{
	if($this->verifierLivre($isbn))
		return  $titre . " deja dans le catalogue";
	
	else 
	{
		if(!$this->verifierAuteur($nom,$prenom))
		{	
			$q = $this->db->prepare('INSERT INTO auteur (nom,prenom) values(:nom,:prenom)');

			$q->bindValue(':nom', $nom);
			$q->bindValue(':prenom', $prenom);
			 
			$q->execute();
		}
		
		$q = $this->db->prepare('INSERT INTO livre (ISBN, titre,  parution, nom_cat) values(:a,:b,:c,:d)');

		$q->bindValue(':a', $isbn);
		$q->bindValue(':b', $titre);
		$q->bindValue(':c', $parution);
		$q->bindValue(':d', $categorie);
		
			
		if($q->execute())
		{
			//ajouter ecrire
			$q = $this->db->prepare('INSERT INTO ecrire (id_aut, ISBN ) values(:a,:b)');

			$q->bindValue(':a', $this->getIDAuteur($nom,$prenom));
			$q->bindValue(':b', $isbn);
			$q->execute();
			
			$this->ajouterExemplaire($isbn,$exemplaire) ;
			
			return $titre . " ajouté avec succes";


		}		
		else
			return "Erreur dans l'ajout de livre";
		
	}	 
}

//supp info -> nbExemplaire = 0 et supprimer de la table exemplaire
public function supprimerLivre($isbn)
{
	//verifier livre existe
	if($this->verifierLivre($isbn))
	{		 
		if($this->db->query('DELETE FROM ecrire WHERE isbn = "'.$isbn.'"'))
		{
			if($this->db->query('DELETE FROM exemplaire WHERE isbn = "'.$isbn.'"'))
				if($this->db->query('DELETE FROM livre WHERE isbn = "'.$isbn.'"'))
					echo "Livre supprimé avec succes";
				
				else 
					echo "Erreur suppression du livre";
		}
	}
 
	else
		echo "Ce livre non n'est pas dans le catalogue" ;
}

//verifier si un livre est deja present
public function verifierLivre($isbn)
{
	$q = $this->db->query('select * from livre where isbn = "'. $isbn . '" ');
		
	if(count($q->fetchAll())>0)
		return true ;
	
	else 
		return false ;
}

public function verifierAuteur($nom,$prenom)
{
	$q = $this->db->query('select * from auteur where nom = "'. $nom . '" and prenom = "'. $prenom . '"');
		
	if(count($q->fetchAll())>0)
		return true ;
	
	else 
		return false ;
}

//obtenir le nombre d'exemplaire d'un livre
public function getNbExemplaire($isbn)
{
	$q = $this->db->query('select * from exemplaire where isbn = "'. $isbn . '" ');
		
	return count($q->fetchAll()) ;
}

//modifier quantite exemplaire 
public function modifierNbExemplaire($isbn,$quantite)
{
	//return $q = $this->db->query('UPDATE Utilisateur SET PFP = "'.$pfp.'" WHERE pseudo = "' .$pseudo.'"');
}

}
?>