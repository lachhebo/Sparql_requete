<!--
"Code" HTML correspondant au contenu de la page d'accueil
Contient la parallax, ainsi que les liens vers les différentes pages du site

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
	<h1 class="centered">Le site Projet Emploi</h1>
	<p>Dans une société en constante évolution, il peut être difficile de trouver sa place. Les opportunités de rentrer dans le monde du travail peuvent sembler rare. Cette plateforme s'est donné pour mission de permettre aux entreprises et aux demandeurs d'emploi de communiquer plus aisément.
	Ainsi nous nous sommes donnés pour mission de réunir demandeurs d'emploi eint recruteurs, et de leur offrir une plateforme sur laquelle ils puissent interagir.
	</p>
</div>

<div class="album text-muted">
	<div class="container">
		<div class="row">
			<div class="card">
				<a href="#"><img src="./images/find_job.png" class="img_album" alt="Photo de montagne" data-holder-rendered="true" /></a>
				<p class="card-text">Consultez nos offres d'emploi concernant des domaines divers et variés, et trouvez l'emploi qui vous correspond.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/profil_candidat.png" alt="Photo de montagne" /></a>
				<p class="card-text">Inscrivez-vous sur le site en tant que candidat pour pouvoir postuler à nos offres d'emploi.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/contact_rh.png" alt="Photo de montagne" /></a>
				<p class="card-text">Entrez en contact avec nos recruteurs et commencez dès maintenant à élargir votre réseau professionnel.</p>
			</div>
		</div>
	</div>
</div>

<div class="parallax parallax2"></div>
<div class="container-fluid parallax-container">
	<h1 class="centered">Candidats, postulez aux offres de nos recruteurs</h1>
	<p>
	Il vous est possible, sans même être enregistré sur notre site, de consulter les offres d'emploi de notre site et de contacter les recruteurs ayant posté ces offres.
	En revanche il faudra préalablement vous enregistrer sur notre site <a href="./html/Inscription_PRO.html">ici</a> (ou vous connecter si vous êtes déjà inscrit) afin de pouvoir postuler aux offres d'emploi présentées sur notre site.
	</p>
</div>

<div class="album text-muted">
	<div class="container">
		<div class="row">
			<div class="card">
				<a href="#"><img src="./images/postuler_offre.png" class="img_album" alt="Photo de montagne" data-holder-rendered="true" /></a>
				<p class="card-text">Postulez aux offres d'emploi de nos recruteurs.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/modif_profil.png" alt="Photo de montagne" /></a>
				<p class="card-text">Modifier votre profil à mesure que vous accumulez des compétences.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/rep_candidature.jpg" alt="Photo de montagne" /></a>
				<p class="card-text">Consulter les réponses à vos candidatures.</p>
			</div>
		</div>
	</div>
</div>

<div class="parallax parallax3"></div>
<div class="container-fluid parallax-container">
	<h1 class="centered">Recruteurs, publiez vos offres d'emploi</h1>
	<p>
	Parce que nous considérons le travail de recruteur fondamental pour la bonne santé d'une entreprise, nous vous proposons sur ce site divers outils afin de trouver les profils qui correspondent à vos attentes.
	En effet vous pouvez non seulement poster des offres sur le site, mais aussi consulter les profils de candidats enregistrés selon leurs expériences, leur domaine d'activité, etc.
	</p>
</div>

<div class="album text-muted">
	<div class="container">
		<div class="row">
			<div class="card">
				<a href="#"><img src="./images/creer_offre.png" class="img_album" alt="Photo de montagne" data-holder-rendered="true" /></a>
				<p class="card-text">Créer vos offres d'emploi et diffusez-les sur notre plateforme.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/find_candidate.png" alt="Photo de montagne" /></a>
				<p class="card-text">Cherchez parmi les candidats inscrits ceux dont le profil correspond le mieux à vos attentes, et contactez-les.</p>
			</div>
			<div class="card">
				<a href="#"><img class="img_album" src="./images/modifier_candidature.png" alt="Photo de montagne" /></a>
				<p class="card-text">Managez vos offres d'emploi. Acceptez, refusez ou encore blacklistez les candidats.</p>
			</div>
		</div>
	</div>
</div>

</div>
