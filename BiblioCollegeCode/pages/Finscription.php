
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
	<div id="inscription">
        <div class="row">
            <!--partie gauche-->
            <div class=col-sm-2></div>
            <!--partie du milieu-->
            <div class="col-sm-8">
                <br><br><br><h2 style="text-align:center">FORMULAIRE INSCRIPTION  </h2>
				<br>
                <p><strong>Inscrivez votre collègien ou collègienne</strong></p>
                <form action="#" method="POST" >
                    <label for="fname">Prenom</label>
                    <input type="text" id="fname" name="nom" placeholder="prenom.."required>

                    <label for="lname">Nom</label>
                    <input type="text" id="lname" name="prenom" placeholder="nom.."required>
                   
					<label for="fname">Sexe</label>
                    <select name="" id="sexeC">
                        <option value="">--choix du sexe--</option>
                        <option value="F" name="sexe">F</option>
                        <option value="M" name="sexe">M</option>
                    </select>
					<br><br>
                    <label for="sname">Statut</label>
                    <select name="pets" id="sexeC">
						<option value="">--choix du statut--</option>
                        <option value="collegien" name="coll">Collègienne</option>
                        <option value="colegienne" name="coll">Collègien</option>
                    
                    </select> 
					<br><br>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="mail" placeholder="Example@gmail.com"required>

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="mdp" placeholder="........"required>

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
</div>



		
</body>
</html>

