

<div class="liste_offre">
	<div class= "row">
		<div class="col-xs-8" id="zone_affichage">
			<h1 > Recherche resultat : </h1>
			<?php
				//S'il y a une requête de faite dans l'URL
				if(isset($_GET['q']) AND !empty($_GET['q'])) {
					//On récupère les mots-clés
					$mot_cle = $_GET["q"] ;
				}
			?>
			<?php
				//S'il y a une requête de faite dans l'URL
				if(isset($_GET['q']) AND !empty($_GET['q'])) {
					//On récupère les mots-clés
					$mot_cle = $_GET["q"];

					//Pour chaque résultat de la recherche
					foreach (App\Table\Personnage::recherche($mot_cle) as $resultcandidat):
			?>
						<!--On affiche une brève description du candidat-->
						<h2><a href="<?= $resultcandidat->getURL() ?>"><?= $resultcandidat->get_nom(); ?></a> </h2>
						<p><em><?=  $resultcandidat->get_prenom() ?> </em></p>
						<p><?=  $resultcandidat->getExtrait(); ?></p>
				<?php endforeach; };  ?>
		</div>



		<!--Formulaire permettant d'effectuer des recherches sur les candidats-->
		<div class="col-xs-4" class="list_offre_2">
			<ul>
				<div class="div-header">
					<p><span class="glyphicon glyphicon-search"></span> Effectuez une recherche de candidats :</p>
				</div>
				<form class="form" method="POST" action="" >
					<div class="form-group">
						<p>Chercher dans :</p>
						<select class="form-control" id="emploi_choix_search">
							<option>Le nom / prénom du candidat</option>
							<option>Les compétences techniques du candidat</option>
							<option>L'adresse du candidat</option>
						</select>
						<p>les mots :</p>
						<input type="search" class="form-control" id="input_search_emploi" placeholder="Ex : Gérard, Bayonne, C++ ..." name = "zone_recherche">

						<div class="divider"></div>

						<p>Niveau d'étude :</p>
						<div class="checkbox">
							<label><input type="checkbox" value="">Bac</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" value="">Bac +2 / +3</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" value="">Bac +5 et supérieur</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" value="">Autre</label>
						</div>

						<div class="divider"></div>

						<p>Domaines d'activité :</p>
						<select class="big-select" name="secteur_activite[]" size="5" multiple="multiple">
							<option>Agroalimentaire</option>
							<option>Banque / Assurance</option>
							<option>Bois / Papier / Carton / Imprimerie</option>
							<option>BTP / Matériaux de construction</option>
							<option>Chimie / Parachimie</option>
							<option>Commerce / Négoce / Distribution</option>
							<option>Edition / Communication / Multimédia</option>
							<option>Electronique / Electricité</option>
							<option>Etudes et conseils</option>
							<option>Industrie pharmaceutique</option>
							<option>Informatique / Télécoms</option>
							<option>Machines et équipements / Automobile</option>
							<option>Métallurgie / Travail du métal</option>
							<option>Plastique / Caoutchouc</option>
							<option>Services aux entreprises</option>
							<option>Textile / Habillement / Chaussure</option>
							<option>Transports / Logistique</option>
						</select>
						<button type="button" class="btn btn-default btn-emploi-search"> <span class="glyphicon glyphicon-search"></span> Rechercher</button>
					</div>
				</form>
			</ul>
		</div>
	</div>
</div>
