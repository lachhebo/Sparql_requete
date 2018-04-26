<?php

//Pour le chargement automatique des classes
require '../app/Autoloader.php';
App\Autoloader::register();

//On démarre une session
session_start();


//p pour path. $_GET['p'] permet de récupérer la route/l'URL actuelle
if(isset($_GET['p'])){
	$page = $_GET['p'];
 } else {
 	$page = 'home';
 }

//q pour query. On récupère la demande pour des ressources secondaires si la demande existe.
if(isset($_GET['query'])){
	$query = $_GET['query'];
}


//Aucune données (sauf les entêtes) n'est envoyée au navigateur. Elles sont temporairement mise en tampon
//Problèmes possibles avec certains serveur Web (par exemple Apache)
ob_start();

//Si l'URL indique  qu'on est sur la page home, on charge la page correspondante
if($page === 'home'){
	require '../pages/home.php';

//Pareil pour la recherche
} elseif ($page === 'recherche' ) {
	$_GET['query'] = $query;
	require '../pages/recherche.php';
} else{  //Sinon on redirige vers la page d'accueil
	require '../pages/home.php';
}



//On vide le tampon de sortie. Son ancien contenu est stocké dans $content
$content = ob_get_clean();
//On charge les composantes communes à toutes nos pages Web (Navbar, modal de connexion, footer) contenu dans le fichier default.php
require '../pages/templates/default.php';
