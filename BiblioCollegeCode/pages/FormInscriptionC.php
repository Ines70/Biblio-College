
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css" type="text/css">	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
  <title>Inscription</title>
  <style>
  a {color: white;} </style>
</head>
<body>
    <!--formulaire d'inscription d'un collegien-->
    <div id="inscription">
        <div class="row">
            <!--partie gauche-->
            <div class=col-sm-2></div>
            <!--partie du milieu-->
            <div class="col-sm-8">
                <br><br><br><h2 style="text-align:center">INSCRIPTION </h2>
                <p>Inscrivez vous si vous ne n'avez pas encore de compte, sinon connectez vous</p>
                <form action="#" method="POST" >

                    <label for="fname">Matricule</label>
                    <input type="text" id="fname" name="matricule" required>                

                    <label for="lname">Nom</label>
                    <input type="text" id="lname" name="prenom" placeholder="nom.."required>

                    <label for="fname">Prenom</label>
                    <input type="text" id="fname" name="nom" placeholder="prenom.."required>

                    <label for="fname">Sexe</label>
                    <select name="" id="sexeC">
                        <option value="">--choix du sexe--</option>
                        <option value="F" name="sexe">F</option>
                        <option value="M" name="sexe">M</option>
                    </select>

                    <label for="sname">Statut</label>
                    <select name="pets" id="sexeC">
                    
                        <option value="collegien" name="coll">Collègienne</option>
                        <option value="colegienne" name="coll">Collègien</option>
                    
                    </select> 
                    <button type="submit" value="inscription" name="forminscription"> S'inscrire </button>
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
                <div class=col-sm-2></div>
            </div>
    </div>

		
</body>
</html>

