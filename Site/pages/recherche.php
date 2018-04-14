
<?php
//on cherche la classe
require "../php4store/Endpoint.php";
//on instancie l’objet
$myEndpoint = new Endpoint('http://dbpedia.org/');
//on fabrique la requête SPARQL
$sparql = 'select ?object ?property ?value where {?object ?property ?value } limit 5';
//On utilise la fonction pour faire une requête en lecture
$rows = $myEndpoint->query($sparql, 'rows');
//On vérifie qu’il n'y a pas d'erreur sinon on stoppe le programme et on affiche les erreurs
$err = $myEndpoint->getErrors();
if ($err) { die (print_r($err,true));}
//On scanne le résultat
foreach($rows as $row){
	echo $row['object'] .' '. $row['property'] .' '. $row['value'];
}

?>

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
