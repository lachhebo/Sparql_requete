<!--
"Code" HTML correspondant au contenu de la page d'accueil
Contient la parallax, ainsi que la barre de recherche

-->

<div class="parallax parallax1">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get" id="search_form">
		<h1 id="site_title">Harry Fansub</h1>
		<input name='query' class="form-control input-lg" id="input_recherche" type="text" placeholder="Rechercher">
		<input type="hidden" name="p" value="recherche">
	</form>
</div>

<div class="upper">

<div class="container-fluid parallax-container">
	<h1 class="centered">Le site HarryFansub</h1>
	<p class='text-center'>
		Dans ce monde vaste aux possibilités infinies, de nombreux secrets attendent d'être découvert.
		En son sein existe une société à part, faite de magie et de créature fantastique : c'est le monde des sorciers.
	</p>
</div>

<div class="album text-muted">
	<div class="container">
		<div class="row">
			<div class="card">
				<a href="#"><img src="./images/dumbledore_portrait.jpg" class="img_album" alt="Photo de montagne" data-holder-rendered="true" /></a>
				<p class="card-text">Découvrez-en plus sur le plus grand directeur d'école du monde des sorciers : Albus Dumbledore.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/hogwart.png" alt="Photo de montagne" /></a>
				<p class="card-text">La meilleure école de sorcellerie du monde : Poudlard.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/magic.png" alt="Photo de montagne" /></a>
				<p class="card-text">La magie est omniprésente dans le monde des sorciers. Mais qu'est-ce que la magie ?</p>
			</div>
		</div>
	</div>
</div>

<div class="parallax parallax2"></div>
<div class="container-fluid parallax-container">
	<h1 class="centered">Découvrez les héros de la saga</h1>
	<p class="text-center">
		Touchant, émouvant, attachant, les personnages imaginés par J.K. Rowling nous entraine dans leurs aventures épiques.
		A leur côté nous partageons leurs expériences, souffrons, rions et combattons avec eux.
	</p>
</div>

<div class="album text-muted">
	<div class="container">
		<div class="row">
			<div class="card">
				<a href="#"><img src="./images/harry_portrait.jpg" class="img_album" alt="Photo de montagne" data-holder-rendered="true" /></a>
				<p class="card-text">Le héros éponyme de la saga de J.K Rowling, téméraire et loyal.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/hermione_portrait.jpg" alt="Photo de montagne" /></a>
				<p class="card-text">La sorcière de génie Hermione Granger.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/ron_portrait.jpg" alt="Photo de montagne" /></a>
				<p class="card-text">Un ami au grand coeur que rien n'arrête : Ronald Weasley.</p>
			</div>
		</div>
	</div>
</div>

<div class="parallax parallax3"></div>
<div class="container-fluid parallax-container">
	<h1 class="centered">Recruteurs, publiez vos offres d'emploi</h1>
	<p class='text-center'>
	Parce que nous considérons le travail de recruteur fondamental pour la bonne santé d'une entreprise, nous vous proposons sur ce site divers outils afin de trouver les profils qui correspondent à vos attentes.
	En effet vous pouvez non seulement poster des offres sur le site, mais aussi consulter les profils de candidats enregistrés selon leurs expériences, leur domaine d'activité, etc.
	</p>
</div>

<div class="album text-muted">
	<div class="container">
		<div class="row">
			<div class="card">
				<a href="#"><img src="./images/bellatrix_portrait.jpg" class="img_album" alt="Photo de montagne" data-holder-rendered="true" /></a>
				<p class="card-text">Créer vos offres d'emploi et diffusez-les sur notre plateforme.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/lucius_malefoy_portrait.jpg" alt="Photo de montagne" /></a>
				<p class="card-text">Cherchez parmi les candidats inscrits ceux dont le profil correspond le mieux à vos attentes, et contactez-les.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/severus_portrait.jpg" alt="Photo de montagne" /></a>
				<p class="card-text">Managez vos offres d'emploi. Acceptez, refusez ou encore blacklistez les candidats.</p>
			</div>
		</div>
	</div>
</div>

</div>
