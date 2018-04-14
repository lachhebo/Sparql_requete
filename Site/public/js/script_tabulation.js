window.onload=function(){
    //console.log("test");
    var test = document.getElementById("defaultOpen");

    if (test != null){
        if(document.getElementById("tabvertical8")!= null){
            openTab(null, "Message reçu");
        }else{
            openTab(null, "Mon Profil");
        }
        
    }

    if(document.getElementById("tabvertical8")!= null){
      document.getElementById("tabvertical8").addEventListener("click", function(event) {openTab(event,"Message envoyés");});
      document.getElementById("defaultOpen").addEventListener("click", function(e) {openTab(e, "Message reçu");});
    }

    if(document.getElementById("tabvertical4") != null){
      document.getElementById("defaultOpen").addEventListener("click", function(e) {openTab(e, "Mon Profil");});
      document.getElementById("tabvertical4").addEventListener("click", function(event) {openTab(event,"Modifier mon profil");});

      if(  document.getElementById("tabvertical1") != null){
        document.getElementById("tabvertical1").addEventListener("click", function(event) {openTab(event,"Compétence");});
        document.getElementById("tabvertical2").addEventListener("click", function(event) {openTab(event,"Expérience");});
        document.getElementById("tabvertical3").addEventListener("click", function(event) {openTab(event,"Offres postulé");});
      }
      else{
        document.getElementById("tabvertical5").addEventListener("click", function(event) {openTab(event,"Mes offres");});
        document.getElementById("tabvertical6").addEventListener("click", function(event) {openTab(event,"Inscrire RH");});
        document.getElementById("tabvertical7").addEventListener("click", function(event) {openTab(event,"Securité");});
      }
    }
}

function openTab(evt, cityName) {

    var i, tabcontent, tablinks;


    tabcontent = document.getElementsByClassName("tabcontentvertical");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }


    tablinks = document.getElementsByClassName("tablinksvertical");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";

}
