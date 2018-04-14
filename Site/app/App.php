<?php
namespace App;

/*
Cette classe contient les informations principales dont on peut avoir besoin à tout moment lors de la navigation
On peut citer les informations relatives à la bdd ou encore le nom du site
*/

class App{


	//Variables statiques représentant la base de données à laquelle on se connecte, ainsi que le nom de notre site
	private static $database;
	private static $title = 'Projet Emploi';

	private static $graphe_potter = 'http://fr.dbpedia.org/page/Harry_Potter';
	private static $graphe_potter_film = 'http://fr.dbpedia.org/page/Harry_Potter_(films)';


	//Si l'utilisateur aboutit à une page non existante, par exemple en jouant avec l'URL, on renvoie une erreur 404
	public static function notFound(){
		header('HTTP/1.0 404 Not Found');
		header('Loacation:index.php?p=404');
	}

	//Getter pour le titre du site
	public static function getTitle(){
		return self::$title;
	}

	//Permet de changer le sous-titre, suivant, la page sur laquelle on se trouve
	public static function setTitle($title){
		self::$title = 'Projet Emploi :'. $title;
	}
}
