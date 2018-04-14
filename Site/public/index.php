<?php

//Pour le chargement automatique des classes
require '../app/Autoloader.php';
App\Autoloader::register();

//On démarre une session
session_start();


//p pour path. $_GET['p'] permet de récupérer la route/l'URL actuelle
if(isset($_GET['p'])){
	$p = $_GET['p'];
 } else {
 	$p = 'home';
 }

//q pour query. On récupère la demande pour des ressources secondaires si la demande existe.
if(isset($_GET['q'])){
	$q = $_GET['q'];
}

if(isset($_GET['offre'])){
	$offre = $_GET['offre'];
}


//Aucune données (sauf les entêtes) n'est envoyée au navigateur. Elles sont temporairement mise en tampon
//Problèmes possibles avec certains serveur Web (par exemple Apache)
ob_start();

//Si l'URL indique  qu'on est sur la page home, on charge la page correspondante
if($p === 'home'){
	require '../pages/home.php';
//Pareil pour la page de consultation des offres
} elseif ($p ==='offre'){
	require '../pages/offre.php' ;
	//Pareil pour la page de recherche des candidats
} elseif ($p === 'candidat') {
	//On ne donne accès à cette page que pour les RH ( $_SESSION['type'] == 1). Sinon on "redirige vers" (charge) la page d'accueil
	if($_SESSION['type']==1){
		require '../pages/candidat.php';
	} else{
		require '../pages/home.php';
	}
//Pareil pour la recherche des offres
} elseif ($p === 'recherche' ) {
	$_GET['q'] = $q;
	require '../pages/recherche.php';
//Pareil pour la liste des offres
} elseif ($p === 'liste_offre') {
	require '../pages/liste_offre.php';
//Pareil pour la page de profil de l'utilisateur
} elseif ($p === 'profil'){
	//Page accessible seulement si l'utilisateur est connecté
	if(isset($_SESSION['id'])){
		require '../pages/profil.php';
	}
	//Sinon on redirige vers la page d'accueil
	else{
		require '../pages/home.php';
	}
//Pareil pour la page d'inscription
} elseif ($p === 'inscription') {
	//Accessible seulement si l'utilisateur n'est pas connecté
	if(!isset($_SESSION['id'])){
		require '../pages/inscription.php';
	//Sinon on redirige vers la page d'accueil
	} else{
		require '../pages/home.php';
	}
//Pareil pour la déconnexion
} elseif ($p === 'deconnexion') {
	//Déconnection possible seulement si l'utilisateur est connecté
	if(isset($_SESSION['id'])){
		require '../pages/deconnexion.php';
	//Sinon on le redirige vers la page d'accueil
	}else{
		require '../pages/home.php';
	}
//Pareil pour la liste des candidats
} elseif ($p === 'liste_candidat') {
	//Seulement si l'utilisateur est connecté en tant que RH
	if($_SESSION['type']==1){
		require '../pages/liste_candidat.php';
	}
	//Sinon on le redirige vers la page d'accueil
	else{
		require '../pages/home.php';
	}
//Pareil pour la création d'offre d'emploi
} elseif ($p === 'creation_offre') {
	//Seulement si l'utilisateur est connecté en tant que RH
	if($_SESSION['type']==1){
		require '../pages/creation_offre.php';
	}
	//Sinon on le redirige vers la page d'accueil
	else{
		require '../pages/home.php';
	}
//Pareil pour la recherche de candidat
} elseif ($p === 'recherche_candidat') {
	//Seulement si l'utilisateur est connecté en tant que RH
	if($_SESSION['type']==1){
		$_GET['q'] = $q;
		require '../pages/recherche_candidat.php';
	//Sinon on le redirige vers la page d'accueil
	}else{
		require '../pages/home.php';
	}
//Pareil pour la messagerie
} elseif ($p === 'messagerie') {
	//On charge la messagerie seulement si l'utilisateur est connecté
	if(isset($_SESSION['id'])){
		require '../pages/messagerie.php';
	//Sinon on le redirige vers la page d'accueil
	} else{
		require '../pages/home.php';
	}
} elseif ($p === 'engager') {
	//Seulement si l'utilisateur est connecté en tant que RH

	if($_SESSION['type']==1){
		$_GET['q'] = $q;
		$_GET['offre']= $offre;
		require '../pages/engager.php';
	//Sinon on le redirige vers la page d'accueil
	}else{
		require '../pages/home.php';
	}
} elseif ($p === 'refuser') {
	//Seulement si l'utilisateur est connecté en tant que RH

	if($_SESSION['type']==1){
		$_GET['q'] = $q;
		$_GET['offre']= $offre;
		require '../pages/refuser.php';
	//Sinon on le redirige vers la page d'accueil
	}else{
		require '../pages/home.php';
	}
}


//On vide le tampon de sortie. Son ancien contenu est stocké dans $content
$content = ob_get_clean();
//On charge les composantes communes à toutes nos pages Web (Navbar, modal de connexion, footer) contenu dans le fichier default.php
require '../pages/templates/default.php';
