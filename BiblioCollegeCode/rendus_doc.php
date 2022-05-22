<?php




session_start();
//connexion à ma base de données
include("dataBase.php");
// inscription avec la methode POST
//on se place dans le formulaire

if(isset($_POST['valider'])){ 

            $isbn= $_POST['ISBN'];
            $ID= $_POST['id'];
            
            $reqIsbn=$bdd->prepare("SELECT * FROM emprunt where code_barre =  $isbn ");
            $reqIsbn->execute(array($isbn));  
            $isbnExist =$reqIsbn->rowCount();

            $reqId=$bdd->prepare("SELECT * FROM emprunt where matricule = $ID ");
            $reqId->execute(array($ID));
            $idExist =$reqId->rowCount();

   
            if( $isbnExist == 0 ){

                $error="Le Prêt est introuvable !";

             } 
             if($idExist == 0){ 

                $error="Le prêt est introuvable !";
            
             }
              
        
     else{

                    $exp=$bdd->prepare("SELECT * FROM exemplaire");
                    $exp ->execute();
                   
                    $insertpret=$bdd->prepare("DELETE FROM `bibliobd`.`emprunt` WHERE `emprunt`.`matricule` = $ID and `emprunt`.`code_barre`=$isbn ");
                    $insertpret->execute();
               
                    $modifExp =$bdd -> prepare("UPDATE `bibliobd`.`exemplaire` SET `nbre_exemplaire` = `nbre_exemplaire`+1 WHERE `exemplaire`.`code_barre` = '$isbn'");
                    $modifExp->execute();

                    $messageValidation="Le retour à bien été effectué !";
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
    
    <form action="rendus_doc.php" method ="post">
    <h3>Retour prêt</h3>
    <label>ISBN:</label></br>
    <input type="text" name="ISBN"/></br>
    <label>Identifiant collégien: </label></br>
    <input type="text" name="id"/></br>
    <input type="submit"  name ="valider" value="valider"/>
</form>
<div class="Madiverror">
                    <?php
                        if(isset($error)){
                            echo $error;
                        }
                    ?>
                   
                </div>
                <div class="Madivmessage">

                <?php
                        if(isset($messageValidation)){
                            echo $messageValidation;
                        }
                    ?>
                   
                </div>

   



</body>


</html>