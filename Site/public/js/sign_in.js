$( document ).ready(function(){
    $('#sign_in_btn').on( "click", function(event) {
		//On récupère les valeurs des champs email et mot de passe
        var email = $("#email_modal").val();
        var mdp = $("#password").val();
        //Si les champs sont vides ou que le format du mail n'est pas respecté
        if(email == '' || mdp == ''){
			event.preventDefault();
          $("#warning_sign_in").removeClass("invisible").addClass("visible");
        }

    });
});
