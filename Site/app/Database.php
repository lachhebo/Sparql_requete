<?php

/*
Fichier contenant les fonctions relatives à l'interaction entre le site Web et la base de données
On y trouve notamment la connexion à la base, des méthodes pour simplifier les requêtes simples sur la base ou encore les mises à jour de la bdd.
*/

namespace App;

//On utilise la classe PDO (PHP Data Object)
use \PDO;
class Database{

	//Nom de la base de données
	private $db_name;
	//Utilisateur de la base de données (admin, utilisateur standard ...)
	private $db_user;
	//Mdp de la base de données
	private $db_pass;
	//Hote la base de données
	private $db_host;
	private $pdo;

	//Constructeur de la classe Database. Charge les informations de la bdd dans les attributs de notre classe
	public function __construct($db_name, $db_user = 'root', $db_pass= '1234azer', $db_host = 'localhost' ){
		$this->db_name = $db_name;
		$this->db_pass = $db_pass;
		$this->db_user = $db_user;
		$this->db_host = $db_host;
	}

	//On renvoie une connexion à la base de données
	public function getPDO(){
		//Si notre objet n'a pas de connexion à la bdd, on essaie  d'en créer une
		if ($this->pdo === null) {
			$pdo = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}
		//Et on la retourne
		return $this->pdo;
	}

	/*
	Fonction permettant de simplifier l'écriture d'une requête à la base de données
	On prend en parametre la requete et le nom de la classe dans laquelle on veut utiliser les données
	*/
	public function query($statement, $class_name){
		//On effectue la requête
		$req = $this->getPDO()->query($statement);
		// On controle le contenu du tableau retourné en le fetchant suivant la classe désiré (contenue dans $class_name)
		$datas = $req->fetchAll(PDO::FETCH_CLASS, $class_name);
		//On renvoie le tableau de résultats
		return $datas;
	}

	/*
	Fonction permettant de mettre à jour de manière sécurisé la base de données
	*/
	public function update($statement, $attributes){
		//On prépare la requête contenue dans $statement à être exécutée
		$req = $this->getPDO()->prepare($statement);
		//Puis on l'exécute
		$req->execute($attributes);

	}

	/*
	Fonction utilisée lors de la mise à jour des informations de l'utilisateur par ce dernier via la page de modification du profil utilisateur
	*/
	public function modification_personnage(){
		//Pour chaque attribut de l'utilisateur, on vérifie qu'il doit être modifié, puis on le modifie si nécessaire
		if(isset($_POST['modification_name']) and $_POST['modification_name']!= null){
		  $this->update('UPDATE membres SET nom = :name WHERE id = :id ', ['name'=>$_POST['modification_name'], 'id'=> $_SESSION['id']]);
		  $_SESSION['nom'] = $_POST['modification_name'];
		}

		if(isset($_POST['modification_firstname']) and $_POST['modification_firstname']!= null){
		  $this->update('UPDATE membres SET prenom = :firstname WHERE id = :id ', ['firstname'=>$_POST['modification_firstname'], 'id'=> $_SESSION['id']]);
		  $_SESSION['prenom'] = $_POST['modification_firstname'];
		}

		if(isset($_POST['modification_mdp']) and $_POST['modification_mdp']!= null){
		  $this->update('UPDATE membres SET motdepasse = :mdp WHERE id = :id ', ['mdp'=>sha1($_POST['modification_mdp']), 'id'=> $_SESSION['id']]);
		}

		if(isset($_POST['modification_date']) and $_POST['modification_date']!= null){
		  $this->update('UPDATE membres SET date_naissance = :date_ WHERE id = :id ', ['date_'=>$_POST['modification_date'], 'id'=> $_SESSION['id']]);
		  $_SESSION['date_naissance'] = $_POST['modification_date'];
		}

		if(isset($_POST['modification_tel']) and $_POST['modification_tel']!= null){
		  $this->update('UPDATE membres SET telephone = :tel WHERE id = :id ', ['tel'=>$_POST['modification_tel'], 'id'=> $_SESSION['id']]);
		  $_SESSION['telephone'] = $_POST['modification_tel'];
		}

		if(isset($_POST['modification_email']) and $_POST['modification_email']!= null){
		  $this->update('UPDATE membres SET mail = :mail WHERE id = :id ', ['mail'=>$_POST['modification_email'], 'id'=> $_SESSION['id']]);
		  $_SESSION['email'] = $_POST['modification_email'];
		}

		if(isset($_POST['modification_adres']) and $_POST['modification_adres']!= null){
		  $this->update('UPDATE membres SET adresse = :adresse WHERE id = :id ', ['adresse'=>$_POST['modification_adres'], 'id'=> $_SESSION['id']]);
		  $_SESSION['adresse'] = $_POST['modification_adres'];
		}

		if(isset($_POST['modification_ent']) and $_POST['modification_ent']!= null){
		  $this->update('UPDATE membres SET entreprise= :entreprise WHERE id = :id ', ['adresse'=>$_POST['modification_ent'], 'id'=> $_SESSION['id']]);
		  $_SESSION['entreprise'] = $_POST['modification_ent'];
		}
		if(isset($_POST['modification_sa']) and $_POST['modification_sa']!= null){
		  $this->update('UPDATE membres SET secteur_activite = :secteur_activite WHERE id = :id ', ['secteur_activite'=>$_POST['modification_sa'], 'id'=> $_SESSION['id']]);
		  $_SESSION['secteur'] = $_POST['modification_sa'];
		}
		if(isset($_POST['modification_bio']) and $_POST['modification_bio']!= null){
		  $this->update('UPDATE membres SET bio = :bio WHERE id = :id ', ['bio'=>$_POST['modification_bio'], 'id'=> $_SESSION['id']]);
		  $_SESSION['bio'] = $_POST['modification_bio'];
		}

	}

	/*
	Fonction permettant de simplifier l'écriture d'une requête à la base de données
	Cette fonction est différente de query de par son second argument. Ici on ne fetche pas le tableau de résultat en fonction d'une classe.

	*/
	public function query2($statement, $one= false){
		$req = $this->getPDO()->query($statement);
		$datas = $req->fetchAll();
		//var_dump($datas);
		if($one){

		}
		//Si le second argument a pour valeur false, on crée un utilisateur par ligne dans le résultat de la requête, puis on retourne ces résultats
		//workaround pour pallier au fait que fetch_class ne fonctionnait pas comme attendu
		else{
			$resultat = array();
			foreach ($datas as $post):

			$mon_perso = new \App\Table\Personnage($post['nom'],$post['prenom'], null, $post['date_naissance'],$post['telephone'],$post['mail'], $post['adresse'], $post['entreprise'], $post['secteur_activite'],$post['id'],$post['bio']);

			$resultat[$post['id']] = $mon_perso;
			endforeach;
		// On retourne le résultat
		return $resultat;

		}

	}


	/*
	Fonction permettant de mettre à jour de manière sécurisé la base de données
	Cette fonction permet également de récupérer le résultat de la requête et de le renvoeyr
	*/
	public function prepare($statement, $attributes, $class_name, $one= false){
		$req = $this->getPDO()->prepare($statement);
		$req->execute($attributes);
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		//Si on attend qu'une seule ligne résultat
		if($one){
			$datas = $req->fetch();
		}
		//Si on attend plusieurs résultats (comportement par défaut)
		else{
			$datas = $req->fetchAll();
		}
		return $datas;

	}

	/*
	Pareil que la fonction ci-dessus, mais pour la classe Personnage spécifiquement
	*/
	public function prepare2($statement, $attributes, $one = true){
		$req = $this->getPDO()->prepare($statement);
		$req->execute($attributes);
		//Si on attend qu'une seule ligne résultat (comportement par défaut)
		if($one){
			$datas = $req->fetch();
			//var_dump($datas);
			$mon_perso = new \App\Table\Personnage($datas['nom'],$datas['prenom'], null, $datas['date_naissance'],$datas['telephone'],$datas['mail'], $datas['adresse'], $datas['entreprise'], $datas['secteur_activite'],$datas['id'],$datas['bio']);
			//On retourne un seul résultat
			return $mon_perso;
			//var_dump($mon_perso);
		}
		//Si on attend plusieurs résultats
		else{
			$datas = $req->fetchAll();
			$resultat = array();
			//var_dump($datas);
			foreach ($datas as $key ):
				$mon_perso = new \App\Table\Personnage($key['nom'],$key['prenom'], null, $key['date_naissance'],$key['telephone'],$key['mail'], $key['adresse'], $key['entreprise'], $key['secteur_activite'],$key['id'],$key['bio']);
				$resultat[$key['id']] = $mon_perso;
				//var_dump($mon_perso);
			endforeach;
			//On retourne un tableau de résultat
			return $resultat;
		}
	}

}
