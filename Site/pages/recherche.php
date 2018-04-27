
<?php
//On cache les messages d'avertissements générés par les programmes tiers (php4store, bordercloud)
error_reporting(0);
//on cherche la classe
require "../php4store/Endpoint.php";
//on instancie l’objet
$harryPotterEndpoint = new Endpoint('http://fr.dbpedia.org/');

//On récupère les lieux de tournage sur wikidata, en utilisant bordercloud
//On n'a pas réussi à les trouver sur dbpedia
require('vendor/autoload.php');
use BorderCloud\SPARQL\SparqlClient;

$endpoint = "https://query.wikidata.org/sparql";
$sc = new SparqlClient();
$sc->setEndpointRead($endpoint);
$q = "SELECT DISTINCT ?locationLabel WHERE {
				wd:Q216930 wdt:P527 ?Harry_Potter.
				?Harry_Potter wdt:P915 ?location.
				SERVICE wikibase:label {
   				bd:serviceParam wikibase:language 'fr' .
 				}
			}";
$rows = $sc->query($q, 'rows');

//on fabrique les requêtes SPARQL
//Recupérer le nom de l'auteure
$getAuthorName = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
					 prefix dbpedia-fr: <http://fr.dbpedia.org/resource/>
					 prefix prop-fr: <http://fr.dbpedia.org/property/>
					 select ?object where {
       					 dbpedia-fr:Harry_Potter  dbpedia-owl:author ?author.
       					 ?author prop-fr:nom ?object
								 FILTER (LANGMATCHES(LANG(?object),"FR"))
					 }';
//Récupérer la description de l'auteure
$getAuthorDesc = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
					 prefix dbpedia-fr: <http://fr.dbpedia.org/resource/>
					 select ?object where {
       					 dbpedia-fr:Harry_Potter  dbpedia-owl:author ?author.
       					 ?author dbpedia-owl:abstract ?object
								 FILTER (LANGMATCHES(LANG(?object),"FR"))
					 }';
//Récupérer la description de l'oeuvre
$getHarryPotterDesc = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
					 prefix dbpedia-fr: <http://fr.dbpedia.org/resource/>
					 select ?desc where {
       					 dbpedia-fr:Harry_Potter dbpedia-owl:abstract ?desc.
								 FILTER (LANGMATCHES(LANG(?desc),"FR"))
					 }';
//Récupérer le nom des films issus de l'oeuvre
$getFilms = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
						 prefix dcterms: <http://purl.org/dc/terms/>
  					 select * where {
  					         ?film dcterms:subject <http://fr.dbpedia.org/resource/Catégorie:Film_de_Harry_Potter>.
  					         ?film dbpedia-owl:director ?director
  					 }';
//Récupérer les personnages mis en scène dans l'oeuvre
$getPersos = 'prefix dbpedia-fr: <http://fr.dbpedia.org/resource/>
							prefix prop-fr: <http://fr.dbpedia.org/property/>
							select * where {
       					?perso  prop-fr:oeuvre dbpedia-fr:Harry_Potter.
		 				  }';
//On utilise la fonction pour faire une requête en lecture
$resultReqAuthorName = $harryPotterEndpoint->query($getAuthorName, 'rows');
//On vérifie qu’il n'y a pas d'erreur sinon on affiche unknown
$err = $harryPotterEndpoint->getErrors();
if ($err) {$authorName='Unknown';} else $authorName = $resultReqAuthorName[0]['object'];

$resultReqAuthorDesc = $harryPotterEndpoint->query($getAuthorDesc, 'rows');
$err = $harryPotterEndpoint->getErrors();
if ($err) {$authorDesc='Unknown';} else $authorDesc = $resultReqAuthorDesc[0]['object'];

$resultReqHarryPotterDesc = $harryPotterEndpoint->query($getHarryPotterDesc, 'rows');
$err = $harryPotterEndpoint->getErrors();
if ($err) {$harryPotterDesc='Unknown';} else $harryPotterDesc = $resultReqHarryPotterDesc[0]['desc'];

$resultReqFilms = $harryPotterEndpoint->query($getFilms, 'rows');
$resultReqPersos = $harryPotterEndpoint->query($getPersos, 'rows');

?>
<!-- On affiche la page seulement si l'utilisateur du site a tappé "harry potter" (non sensible à la casse grâce à strtolower)  -->
<?php if (strtolower($_GET['query']) == "harry potter"): ?>

	<div class="container">
		<div class="entete-title">
			<h1 class="text-center">Votre recherche : <?php echo $_GET['query']; ?></h1>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<p>Qu'est-ce que Harry Potter ?</p>
				<!-- Affichage de la description de l'oeuvre -->
				<p> <?php echo $harryPotterDesc; ?></p>
			</div>
			<div class="col-xs-6">
				<!-- Affichage du nom de l'auteure -->
				<p>L'auteure : <?php echo $authorName; ?>
				<!-- Affichage de la description de l'auteure -->
				<p><?php echo $authorDesc; ?>
			</div>
	</div>

	<h2>Les principaux personnages d'Harry Potter</h2>

	<?php
		$cpt = 1;
		//Pour chaque personnage trouvé sur dbpedia
		foreach($resultReqPersos as $perso) {
			//Requête pour trouver le nom d'un personnage
			$persoName = 'select * where {
												<'. $perso['perso'] .'> rdfs:label ?name
												FILTER (LANGMATCHES(LANG(?name),"FR"))
										}';
			$resultReqPersoName = $harryPotterEndpoint->query($persoName, 'rows');

			//Requête pour trouver la description d'un personnage
			$persoDesc = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
										select * where {
												<'. $perso['perso'] .'> dbpedia-owl:abstract ?desc
										}';
			$resultReqPersoDesc = $harryPotterEndpoint->query($persoDesc, 'rows');

			//Requête pour récupérer les URI des acteurs d'un personnage
			$persoActorUri = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
												 select * where {
													 	<'. $perso['perso'] .'> dbpedia-owl:performer ?actor
												 }';
			$resultReqpersoActorUri = $harryPotterEndpoint->query($persoActorUri, 'rows');

			//Requête pour récupérer les activités/occupations d'un personnage
			$PersoActivity = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
												 prefix prop-fr: <http://fr.dbpedia.org/property/>
												 select * where {
													 	<'. $perso['perso'] .'> prop-fr:activité ?activite
												 }';
			$resultReqPersoActivity = $harryPotterEndpoint->query($PersoActivity, 'rows');

			//Puis pour chaque personnage, on affiche les informations qu'on est allé chercher à son sujet
			echo '<div class="container-fluid perso-infos">';
			echo 	'<h3>'. $resultReqPersoName[0]['name'] .'</h3>';
			echo 	'<p class="text">'. $resultReqPersoDesc[0]['desc'] .'</p>';
			echo '<div class="row">';
			echo '<div class="col-xs-6">';
			echo 		'<p>Acteur(s) / Actrice(s) : </p>';
			echo  	'<ul>';
			//Pour chaque acteur ayant interprété le personnage, on récupère le nom de l'acteur et on l'affiche
			foreach ($resultReqpersoActorUri as $actor) {
				$actorName = 'select * where {
												<'. $actor['actor'] .'> rdfs:label ?name
												FILTER (LANGMATCHES(LANG(?name),"FR"))
										 }';
				$resultReqpersoActorName = $harryPotterEndpoint->query($actorName, 'rows');
				echo 			'<li>'. $resultReqpersoActorName[0]['name'] .'</li>';
			};
			echo 		'</ul>';
			echo 		'</div>';
			echo 		'<div class="col-xs-6">';
			if (!empty($resultReqPersoActivity)){
				echo 		'<p>Occupation(s) :</p>';
				echo  	'<ul>';
				//On affiche chaque activité/occupation du personnage, sous la forme d'une liste
				foreach ($resultReqPersoActivity as $activite) {
					echo 			'<li>'. $activite['activite'] .'</li>';
				};
				echo 		'</ul>';
			}else echo 		'<p>Occupation(s) : Aucune connue</p>';
			echo 		'</div>';
			echo 	'</div>';
			echo '</div>';

			$cpt=$cpt+1;
		}

	?>

	<h2>Harry Potter au cinema</h2>
	<div class="panel-group" id="accordion">
		<?php
			$cpt = 1;
			//Pour chaque film récupéré sur dbpedia
			foreach($resultReqFilms as $film) {
				//On récupère le titre du film
				$filmTitle = 'select * where {
													<'. $film['film'] .'> rdfs:label ?title
													FILTER (LANGMATCHES(LANG(?title),"FR"))
											}';
				$resultReqFilmTitle = $harryPotterEndpoint->query($filmTitle, 'rows');
				//On récupère aussi la description du film
				$filmDesc = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
										 select * where {
  					         			<'. $film['film'] .'> dbpedia-owl:abstract ?desc
  					 	 			 }';
				$resultReqFilmDesc = $harryPotterEndpoint->query($filmDesc, 'rows');

				echo '<div class="panel panel-default">';
				echo 		'<div class="panel-heading">';
				echo 				'<h4 class="panel-title">';
				echo 					'<a data-toggle="collapse" data-parent="#accordion" href="#collapse'. $cpt .'">'. $resultReqFilmTitle[0]['title'] .'</a>';
				echo 				'</h4>';
				echo 		'</div>';
				//La description du film apparait à l'écran si l'utilisateur clique sur le titre. On évite de surcharger la page de cette manière
				echo 		'<div id="collapse'. $cpt .'" class="panel-collapse collapse">';
				echo 			'<div class="panel-body">';
				echo					'<div class="row">';
				echo 						'<div class="col-xs-8">';
				echo 							'<h3> Description </h3>';
				echo 							'<p> '. $resultReqFilmDesc[0]['desc'] .' </p>';
				echo 						'</div>';
				echo 					'</div>';
				echo 			'</div>';
				echo 		'</div>';
				echo 	'</div>';

				$cpt = $cpt+1;
			}
		?>

		<h2>Les lieux de tournage</h2>

		<div class="row">
			<div class="col-xs-6">
				<!-- On créer un tableau qui va contenir nos lieux de tournages trouvés sur wikidata. Parce qu'on ne peut pas (ou très difficilement) utiliser de variables
				php en javascript, il est utile de créer ce tableau qui va stocker ces lieux de tournage pour que nous puissions générer la map Google en javascript-->
				<table class="table table-striped" id="lieu_tournage">
					<thead>
						<tr><th>Lieux de tournages :</th></tr>
					</thead>
					<tbody>
						<?php
						//Pour chaque lieu de tournage, on créé une ligne dans le tableau pour l'ajouter
						foreach ($rows["result"]["rows"] as $row) {
								foreach ($rows["result"]["variables"] as $variable) {
									echo '<tr><td class="table_lieu">'. $row[$variable] . '</td></tr>';
								}
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-xs-6">
				<!-- div qui va contenir la Map Google -->
				<div id="map"></div>
				<!-- script javascript pour générer la map et y introduire des marqueurs correspondant aux lieux de tournage -->
				<script>
					var cartelieutournage;
			  	function initMap() {
			  		var cartelieutournage = new google.maps.Map(document.getElementById('map'), {
			  			zoom: 6,
			  			center: {lat: 53, lng: -1}
			  		});
						//L'objet geocoder de google.maps.geocoder permet de trouver l'adresse (latitude et longitude) d'un lieu étant donné son nom
						//On n'avait pas accès aux coordonnées géographiques, que ce soit sur wikidata ou dbpedia, cette outil est bien pratique
						geocoder = new google.maps.Geocoder();
						//On récupère les éléments du tableau précédemment affiché (les lieux de tournage)
						var elements = document.getElementsByClassName('table_lieu');
						//Pour chaque lieu de tournage
						Array.prototype.forEach.call(elements, function(element) {
							//On récupère son nom (écrit dans le tableau)
							var nom_lieu_tournage = element.innerHTML;
							//On utilise geocoder pour trouver l'adresse du lieu
							geocoder.geocode({'address' : nom_lieu_tournage}, function(results, status) {
								//Si on a un résultat
								if (status == google.maps.GeocoderStatus.OK){
									//On peut créer un marqueur sur notre map, aux coordonnées trouve par le geocoder
									var marker = new google.maps.Marker({
						  			position: {lat:results[0].geometry.location.lat(), lng:results[0].geometry.location.lng()},
						  			map: cartelieutournage
						  		});
								}
							})
						})
			  	}
			  </script>
				<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0GQT47hdWLzWuNKBP7-12In5XKNJtVV8&callback=initMap">
				</script>
			</div>
		</div>
	</div>

<?php else: ?>
	<div class="container">
		<div class="entete-title">
			<h1 class="text-center">Désolé, aucun résultat pour la recherche "<?php echo $_GET['query']; ?>"</h1>
		</div>
	</div>
<?php endif ?>
