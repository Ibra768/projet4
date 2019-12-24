// Apparition/disparition des messages de confirmation
$(document).ready(function(){
    var message = $(".message").html();
    if(message.length > 21){
        $(".message").css("display","block");
        setTimeout(function() {
            $(".message").css("opacity","0");
        }, 5000);
    }
});
// Apparition/disparition de l'onglet photo sur la page de modification d'un post
var ckbox = $('#old');

ckbox.on('click',function () {
    if (ckbox.is(':checked')) {
        $("#avatar").css("display","none");
        $("#avatar").val("");
        $("#avatar").prop('required',false);
    } else {
        $("#avatar").css("display","block");
        $("#avatar").prop('required',true);

    }
});

// Apparition/disparition de l'onglet mot de passe sur la page de changement des identifiants

var ckboxPass = $('#changePass');

ckboxPass.on('click',function () {
    if (ckboxPass.is(':checked')) {
        $(".blocPass").css("visibility","visible");
        $(".pass").prop('required',true);

    } else {
        $(".blocPass").css("visibility","hidden");
        $(".pass").val("");
        $(".pass").prop('required',false);


    }
});

// Effet au survol du logo du site

$(document).ready(function(){
    document.getElementById("logo").onmouseover = function() 
{
    this.style.textShadow = "-1px 0 white, 0 1px white, 1px 0 white, 0 -1px white";
}
document.getElementById("logo").onmouseout = function() 
{
    this.style.fontFamily = "Rock Salt";
    this.style.textShadow = "none";
}
});