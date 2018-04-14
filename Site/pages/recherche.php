
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
	echo $row['object'] .' '. $row['property'] .' '. $row['value'] ;
}

?>
