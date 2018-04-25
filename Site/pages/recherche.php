
<?php
//on cherche la classe
require "../php4store/Endpoint.php";
//on instancie l’objet
$harryPotterEndpoint = new Endpoint('http://fr.dbpedia.org/');
//on fabrique les requêtes SPARQL
$getAuthorName = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
					 prefix dbpedia-fr: <http://fr.dbpedia.org/resource/>
					 prefix prop-fr: <http://fr.dbpedia.org/property/>
					 select ?object where {
       					 dbpedia-fr:Harry_Potter  dbpedia-owl:author ?author.
       					 ?author prop-fr:nom ?object
								 FILTER (LANGMATCHES(LANG(?object),"FR"))
					 }';
$getAuthorDesc = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
					 prefix dbpedia-fr: <http://fr.dbpedia.org/resource/>
					 select ?object where {
       					 dbpedia-fr:Harry_Potter  dbpedia-owl:author ?author.
       					 ?author dbpedia-owl:abstract ?object
								 FILTER (LANGMATCHES(LANG(?object),"FR"))
					 }';

$getHarryPotterDesc = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
					 prefix dbpedia-fr: <http://fr.dbpedia.org/resource/>
					 select ?desc where {
       					 dbpedia-fr:Harry_Potter dbpedia-owl:abstract ?desc.
								 FILTER (LANGMATCHES(LANG(?desc),"FR"))
					 }';

$getFilms = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
						 prefix dcterms: <http://purl.org/dc/terms/>
  					 select * where {
  					         ?film dcterms:subject <http://fr.dbpedia.org/resource/Catégorie:Film_de_Harry_Potter>.
  					         ?film dbpedia-owl:director ?director
  					 }';
//On utilise la fonction pour faire une requête en lecture
$resultReqAuthorName = $harryPotterEndpoint->query($getAuthorName, 'rows');
//On vérifie qu’il n'y a pas d'erreur sinon on stoppe le programme et on affiche les erreurs
$err = $harryPotterEndpoint->getErrors();
if ($err) {$authorName='Unknown';} else $authorName = $resultReqAuthorName[0]['object'];

$resultReqAuthorDesc = $harryPotterEndpoint->query($getAuthorDesc, 'rows');
$err = $harryPotterEndpoint->getErrors();
if ($err) {$authorDesc='Unknown';} else $authorDesc = $resultReqAuthorDesc[0]['object'];

$resultReqHarryPotterDesc = $harryPotterEndpoint->query($getHarryPotterDesc, 'rows');
$err = $harryPotterEndpoint->getErrors();
if ($err) {$harryPotterDesc='Unknown';} else $harryPotterDesc = $resultReqHarryPotterDesc[0]['desc'];

$resultReqFilms = $harryPotterEndpoint->query($getFilms, 'rows');

?>

<?php if (strtolower($_GET['query']) == "harry potter"): ?>

	<div class="container">
		<div class="entete-title">
			<h1 class="text-center">Votre recherche : <?php echo $_GET['query']; ?></h1>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<p>Qu'est-ce que Harry Potter ?</p>
				<p> <?php echo $harryPotterDesc; ?></p>
			</div>
			<div class="col-xs-6">
				<p><?php echo $authorName; ?>
				<p><?php echo $authorDesc; ?>
			</div>
	</div>

	<h2>Les principaux personnages d'Harry Potter</h2>

	

	<h2>Harry Potter au cinema</h2>
	<div class="panel-group" id="accordion">
		<?php
			$cpt = 1;
			foreach($resultReqFilms as $film) {



				$filmTitle = 'prefix dc: <http://purl.org/dc/elements/1.1/>
											select * where {
  					         			<'. $resultReqFilms[$cpt-1]['film'] .'> dc:title ?title
  					 	 				}';
				$resultReqFilmTitle = $harryPotterEndpoint->query($filmTitle, 'rows');

				$filmDesc = 'prefix dbpedia-owl: <http://dbpedia.org/ontology/>
										 select * where {
  					         			<'. $resultReqFilms[$cpt-1]['film'] .'> dbpedia-owl:abstract ?desc
  					 	 			 }';
				$resultReqFilmDesc = $harryPotterEndpoint->query($filmDesc, 'rows');


				echo '<div class="panel panel-default">';
				echo 		'<div class="panel-heading">';
				echo 				'<h4 class="panel-title">';
				if ($resultReqFilmTitle[0]['title'] == "Harry Potter")
					echo 					'<a data-toggle="collapse" data-parent="#accordion" href="#collapse'. $cpt .'">'. $resultReqFilmTitle[0]['title'] .' '. $resultReqFilmTitle[1]['title'] .'</a>';
				else echo 			'<a data-toggle="collapse" data-parent="#accordion" href="#collapse'. $cpt .'">'. $resultReqFilmTitle[1]['title'] .' '. $resultReqFilmTitle[0]['title'] .'</a>';

				echo 				'</h4>';
				echo 		'</div>';
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
		<!--
		<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Titre 1</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Titre 2</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Titre 3</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>
  </div>
-->
		<!--
		<h3>My Google Maps Demo</h3>
		  <div id="map"></div>
		  <script>
				function initMap() {
					var uluru = {lat: -25.363, lng: 131.044};
					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 4,
						center: uluru
					});
					var marker = new google.maps.Marker({
						position: uluru,
						map: map
					});
				}
			</script>
		  <script async defer
		  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0GQT47hdWLzWuNKBP7-12In5XKNJtVV8&callback=initMap">
		  </script>
		-->
	</div>

<?php else: ?>
	<div class="container">
		<div class="entete-title">
			<h1 class="text-center">Désolé, aucun résultat pour la recherche "<?php echo $_GET['query']; ?>"</h1>
		</div>
	</div>
<?php endif ?>
