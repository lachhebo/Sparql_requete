<?php

//Si l'utilisateur est connecté
if(isset($_POST['identififiant']) and isset($_POST['password'])) {
	//On crée un objet Personnage via l'id et le password existant
	$initie = new App\Table\Personnage(null, null,$_POST["password"],null,null, $_POST['identififiant'],null);
	//On tente de connecter l'utilisateur via l'id et le password fourni
	$test = $initie->connexion();
	//Si la connection échoue, on détruit l'objet Personnage crée précédemment
	if($test==1){
		unset($initie);
	}
	//Si la connexion réussit, on récupère les données de l'utilisateur (nom, prénom ...) et on lui crée une session
	else{
		$initie->recuperer_donnee();
		$initie->session();
	}
}



?>


<html>
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description">
			<meta name="author">

			<link rel="stylesheet" href="./css/projet_emploi.css" type="text/css"/>

			<meta name="viewport" contents="width=device-width, initial-scale=1">

			<script src="./JQuery/jquery-3.2.1.js"></script>
			<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
			<script src="./bootstrap/js/bootstrap.min.js"> </script>

			<title><?= App\App::getTitle(); ?> </title>

			<script src = "js\script_tabulation.js"  type="text/javascript"></script>
			<script src = "js\sign_in.js"  type="text/javascript"></script>


	</head>
	<body>

		<!--Début du menu-->

		<nav class="navbar navbar-inverse  navbar-fixed-top"  role="navigation">
								 <div class="container">
						<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
								</button>

						</div>
						<div id="navbar" class="navbar-collapse collapse">
								<ul class="nav navbar-nav">

									<!--On choisit les liens à afficher suivant les droits de l'utilisateur (candidat, RH ou visiteur)-->
									<?php     ?>
										<li><a href= "index.php"></span> Accueil</a></li>
										<li><a href= "index.php?p=liste_offre">Offres</a></li>
									<?php if(isset($_SESSION['email'])){  ?>
										<li><a href= "index.php?p=profil">Profils</a></li>
									<?php } ?>
									<?php if(isset($_SESSION['email'])){  ?>
										<li><a href=index.php?p=messagerie> Messagerie</a></li>
									<?php } ?>
									<?php if(isset($_SESSION['email']) and $_SESSION['type']==1 ){  ?>
										<li><a href= "index.php?p=liste_candidat">Recherche candidat</a></li>
										<li><a href= "index.php?p=creation_offre">Créer une offre</a></li>

									<?php } ?>



								</ul>

							 <ul class="nav navbar-nav navbar-right">
									<!--On affiche le bouton de login de la navbar si l'utilisateur n'est pas connecté-->
							 		<?php if(!isset($_SESSION['email'])){ ?>
									 	<li><a data-toggle="modal" data-target="#loginModal">login  <span class="glyphicon glyphicon-log-in"></span></a></li>
									 <?php }
									 //Sinon on affiche un bouton de déconnexion pour donner la possibilité à l'utilisateur de mettre fin à se session
									 else{ ?>
									 	<li><a href="index.php?p=deconnexion">Deconnexion  <span class="glyphicon glyphicon-log-out"></span></a></li>

									 <?php } ?>


							</ul>


						</div>
				</div>
	 </nav>

	 <!--On ne charge le code du modal de connexion que si l'utilisateur n'est pas connecté-->
	 <?php if(!isset($_SESSION['email'])){ ?>

		<div id="loginModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"> &times;</button>
				<h4>Login</h4>
			</div>
			<div class="modal-body">
				<form class="form-inline" method="POST" action="">
					<div class="row">

						<div class="col-xs-4">
							<input type="text" name ="identififiant" class="form-control" placeholder="Email" id="email_modal">
						</div>
						<div class="col-xs-4">
							<input type="password" name ="password" class="form-control" placeholder="Password" id="password" name="password">
						</div>
						<div class="col-xs-4">
							<button type="submit" class="btn btn-info modal_sign_in" id="sign_in_btn">Sign in</button>
						</div>

					</div>
				</form>
				<div class="row padding-top-bottom">
					<div class="col-xs-12">
						<p class="invisible text-warning" id="warning_sign_in"><span class="glyphicon glyphicon-remove-circle"></span> Email ou mot de passe incorrect</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a class="btn btn-default" href="index.php?p=inscription" role="button">S'inscrire</a>
			</div>
		</div>
	</div>
</div>

	<?php } ?>

		<!--Le contenu principal de la page-->
		<div class ="starter-template" >
			<?= $content; ?>
		</div>

<!--  Problème d'affichage du footer
		<footer class="footer-distributed">
			<div class="footer-right">
				<a href="#"><img src="../images/icon_fb.png" alt="icone facebook" /></a>
				<a href="#"><img src="../images/icon_twitter.png" alt="icone twitter" /></a>
				<a href="#"><img src="../images/icon_linkedin.png" alt="icone linkedin" /></a>
			</div>
			<div class="footer-left">
				<p class="footer-links">
					<a href="../index.html">Accueil</a>
					.
					<a href="#">Contact</a>
				</p>
				<p>Projet Emploi &copy; 2017</p>
			</div>
		</footer>
-->


	</body>
</html>
