<?php


    session_start();
    //connexion à ma base de données
    include("dataBase.php");
   

	if(isset($_POST['valider'])){ 
				$isbn= $_POST['ISBN'];
				$ID=$_POST['id']; 
				$dateP=$_POST['dateP'];
                $dateR= $_POST['dateR'];
				
				
				$reqIsbn=$bdd->prepare("SELECT * FROM exemplaire where code_barre  = ?");
				$reqIsbn->execute(array($isbn));

                $isbnExist =$reqIsbn->rowCount();

                $reqId=$bdd->prepare("SELECT * FROM personne where matricule = ?");
				$reqId->execute(array($ID));
                $idExist =$reqId->rowCount();

                
				
                
				if($isbnExist == 0 || $idExist == 0) 
				{   
						
                    $errorinscription="erreur ";
				}
               

				else{

                
                    $dispo =$bdd-> prepare("SELECT  `nbre_exemplaire`  FROM  `bibliobd`.`exemplaire` WHERE `exemplaire`.`code_barre` = '$isbn'");
                    $dispo ->execute();

                       

                        $insertpret=$bdd->prepare("INSERT INTO `bibliobd`.`emprunt`(`id_emprunt`, `Date_emprunt`, `Date_retour`, `matricule`, `code_barre`) VALUES ('NULL', '$dateP', '$dateR','$ID',$isbn) ");
						$insertpret->execute(array(NULL, $dateP, $dateR,$ID,$isbn));




                   



                        $modifExp =$bdd -> prepare("UPDATE `bibliobd`.`exemplaire` SET `nbre_exemplaire` = `nbre_exemplaire`-1 WHERE `exemplaire`.`code_barre` = '$isbn'");
                        $modifExp->execute();

                      

						$messageInscription="Le prêt à bien été effectué !";
                        

                    }
                       
					

                                
                       
				
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link href="form.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
    <title>Biblio-College</title>
    <h1>Biblio-college</h1>
    <form action="pret_conn.php" method ="post" style=" margin-left: 30px; ">
    <h3>+ Nouveau prêt</h3>
    <label>ISBN</label></br>
    <input type="text" name="ISBN"/></br>
    <label>Identifiant de l'emprunteur </label></br>
    <input type="text" name="id"/></br>
    <label>Date de prêt : </label></br>
    <input type="date" name="dateP"/></br>
    <label>Date de retour: </label></br>
    <input type="date" name="dateR"/></br>
    <input type="submit" name="valider"value="valider"/></br>
</form>
    <div class="Madiverror">
                    <?php
                        if(isset($errorinscription))
                        {
                            echo $errorinscription;
                        }
                    ?>
                </div>
                <div class="Madivmessage">
                    <?php
                        if(isset($messageInscription))
                        {
                            echo $messageInscription;
                        }
                    ?>
                </div>

   


    </form>


</body>


</html>