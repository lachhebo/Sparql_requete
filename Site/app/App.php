<?php
namespace App;

/*
Cette classe contient les informations principales dont on peut avoir besoin à tout moment lors de la navigation
On peut citer les informations relatives à la bdd ou encore le nom du site
*/

class App{

	//Constante : données relatives à la connexion à la base de données
	const DB_NAME = 'espace_membre';
	const DB_USER = 'root';
	const DB_PASS = '1234azer';
	const DB_HOST = 'localhost';

	//Variables statiques représentant la base de données à laquelle on se connecte, ainsi que le nom de notre site
	private static $database;
	private static $title = 'Harry Fansub';

	//Fonction d'initialisation de la connexion à la bdd
	public static function getDb(){
		//Si on est pas déjç connecté à la bdd, on crée une connexion
		if(self::$database == null ){
			self::$database = new Database(self::DB_HOST, self::DB_NAME, self::DB_USER, self::DB_PASS);
		}
		//On retourne la variable décrivant la bdd
		return self::$database;
	}

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
		self::$title = 'Harry Fansub'. $title;
	}
}
