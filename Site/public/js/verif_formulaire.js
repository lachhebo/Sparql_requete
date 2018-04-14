window.onload=function(){
	var onlyletters = /^[A-Za-z]+$/;
	var colorclass;
	var name = document.getElementById("name");
	var name_desc = document.getElementById("name_problem");

	var firstname = document.getElementById("firstname");
	var firstname_desc = document.getElementById("firstname_problem");

	var mdp = document.getElementById("mdp");
	var mdp_desc = document.getElementById("mdp_problem");

	var date = document.getElementById("date");
	var date_desc = document.getElementById("date_problem");

	var tel = document.getElementById("tel");
	var tel_desc = document.getElementById("tel_problem");

	var email = document.getElementById("email_inscription");
	var email_desc = document.getElementById("email_inscription_problem");

	var adresse = document.getElementById("adres");
	var adresse_desc = document.getElementById("adres_problem");

    name.addEventListener("blur", function(event) {
		$("#name").removeClass("text-danger text-success");
		$("#name_problem").removeClass("text-danger text-success");
		if (name.value == "") {
			colorclass="text-danger";
			$("#name_problem").text("Le champ est vide");
			name_desc.classList ? name_desc.classList.add("text-danger") : name_desc.className += "text-danger";
		}
		else if (!(name.value.match(onlyletters))){
			colorclass = "text-danger";
			$("#name_problem").text("Le champ ne doit contenir que des lettres (majuscules ou minuscules)");
			name_desc.classList ? name_desc.classList.add("text-danger") : name_desc.className += "text-danger";

		}else if (name.value.length < 4){
			colorclass = "text-danger";
			$("#name_problem").text("Nom trop petit");
			name_desc.classList ? name_desc.classList.add("text-danger") : name_desc.className += "text-danger";
		}else{
			$("#name_problem").text("Le champ est valide");
			name_desc.classList ? name_desc.classList.add("text-success") : name_desc.className += "text-success";
			colorclass="text-success";
		}
		name.classList ? name.classList.add(colorclass) : name.className += colorclass;
	}, true);

	firstname.addEventListener("blur", function(event) {
		$("#firstname").removeClass("text-danger text-success");
		$("#firstname_problem").removeClass("text-danger text-success");
		if (firstname.value == "") {
			colorclass="text-danger";
			$("#firstname_problem").text("Le champ est vide");
			firstname_desc.classList ? firstname_desc.classList.add("text-danger") : firstname_desc.className += "text-danger";
		}
		else if (!(firstname.value.match(onlyletters))){
			colorclass = "text-danger";
			$("#firstname_problem").text("Le champ ne doit contenir que des lettres (majuscules ou minuscules)");
			firstname_desc.classList ? firstname_desc.classList.add("text-danger") : firstname_desc.className += "text-danger";

		}else if (firstname.value.length < 3){
			colorclass = "text-danger";
			$("#firstname_problem").text("Prénom trop petit");
			firstname_desc.classList ? firstname_desc.classList.add("text-danger") : firstname_desc.className += "text-danger";
		}else{
			$("#firstname_problem").text("Le champ est valide");
			firstname_desc.classList ? firstname_desc.classList.add("text-success") : firstname_desc.className += "text-success";
			colorclass="text-success";
		}
		firstname.classList ? firstname.classList.add(colorclass) : firstname.className += colorclass;
	}, true);

	mdp.addEventListener("blur", function(event) {
		$("#mdp").removeClass("text-danger text-success");
		$("#mdp_problem").removeClass("text-danger text-success");
		if (mdp.value == "") {
			colorclass="text-danger";
			$("#mdp_problem").text("Le champ est vide");
			mdp_desc.classList ? mdp_desc.classList.add("text-danger") : mdp_desc.className += "text-danger";
		}else if (mdp.value.length < 8){
			colorclass = "text-danger";
			$("#mdp_problem").text("Mot de passe trop petit (au moins 8 caractères)");
			mdp_desc.classList ? mdp_desc.classList.add("text-danger") : mdp_desc.className += "text-danger";
		}else{
			$("#mdp_problem").text("Le champ est valide");
			mdp_desc.classList ? mdp_desc.classList.add("text-success") : mdp_desc.className += "text-success";
			colorclass="text-success";
		}
		mdp.classList ? mdp.classList.add(colorclass) : mdp.className += colorclass;
	}, true);

	date.addEventListener("blur", function(event) {
		$("#date").removeClass("text-danger text-success");
		$("#date_problem").removeClass("text-danger text-success");
		if (date.validity.badInput) {
			colorclass="text-danger";
			$("#date_problem").text(date.validationMessage);
			date_desc.classList ? date_desc.classList.add("text-danger") : date_desc.className += "text-danger";
		}else{
			$("#date_problem").text(date.validationMessage);
			date_desc.classList ? date_desc.classList.add("text-success") : date_desc.className += "text-success";
			colorclass="text-success";
		}
		date.classList ? date.classList.add(colorclass) : date.className += colorclass;
	}, true);

	tel.addEventListener("blur", function(event) {
		$("#tel").removeClass("text-danger text-success");
		$("#tel_problem").removeClass("text-danger text-success");
		if (tel.value == "") {
			colorclass="text-danger";
			$("#tel_problem").text("Le champ est vide");
			tel_desc.classList ? tel_desc.classList.add("text-danger") : tel_desc.className += "text-danger";
		}else if (isNaN(tel.value)){
			colorclass = "text-danger";
			$("#tel_problem").text("Ce champ ne doit contenir que des numéros");
			tel_desc.classList ? tel_desc.classList.add("text-danger") : tel_desc.className += "text-danger";
		}else if(tel.value.length != 10){
			colorclass = "text-danger";
			$("#tel_problem").text("Un numéro de téléphone contient 10 numéros");
			tel_desc.classList ? tel_desc.classList.add("text-danger") : tel_desc.className += "text-danger";
		}else{
			$("#tel_problem").text("Le champ est valide");
			tel_desc.classList ? tel_desc.classList.add("text-success") : tel_desc.className += "text-success";
			colorclass="text-success";
		}
		tel.classList ? tel.classList.add(colorclass) : tel.className += colorclass;
	}, true);

	//Regex efficace trouvé sur Internet
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	email.addEventListener("blur", function(event) {
		$("#email_inscription").removeClass("text-danger text-success");
		$("#email_inscription_problem").removeClass("text-danger text-success");
		if (email.value == "") {
			colorclass="text-danger";
			$("#email_inscription_problem").text("Le champ est vide");
			email_desc.classList ? email_desc.classList.add("text-danger") : email_desc.className += "text-danger";
		}else if(!(reg.test(email.value))){
			colorclass = "text-danger";
			$("#email_inscription_problem").text("Format de mail incorrect");
			email_desc.classList ? email_desc.classList.add("text-danger") : email_desc.className += "text-danger";
		}else{
			$("#email_inscription_problem").text("Le champ est valide");
			email_desc.classList ? email_desc.classList.add("text-success") : email_desc.className += "text-success";
			colorclass="text-success";
		}
		email.classList ? email.classList.add(colorclass) : email.className += colorclass;
	}, true);

	adresse.addEventListener("blur", function(event) {
		$("#adres").removeClass("text-danger text-success");
		$("#adres_problem").removeClass("text-danger text-success");
		if (adresse.value == "") {
			colorclass="text-danger";
			$("#adres_problem").text("Le champ est vide");
			adresse_desc.classList ? adresse_desc.classList.add("text-danger") : adresse_desc.className += "text-danger";
		}else{
			$("#adres_problem").text("Le champ est valide");
			adresse_desc.classList ? adresse_desc.classList.add("text-success") : adresse_desc.className += "text-success";
			colorclass="text-success";
		}
		adresse.classList ? adresse.classList.add(colorclass) : adresse.className += colorclass;
	}, true);


}
