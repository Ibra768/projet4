function confirmAddComment () {
    $(document).ready(function(){
        $(".message").html("Votre commentaire a bien été ajouté!");
        $(".message").addClass("messageActive");
    });
    setTimeout(function() {
        $(".message").html("");
        $(".message").removeClass("messageActive");
    }, 3000);
}
function confirmReportComment () {
    $(document).ready(function(){
        $(".message").html("Merci pour votre signalement, on s'en occupe !");
        $(".message").addClass("messageActive");
    });
    setTimeout(function() {
        $(".message").html("");
        $(".message").removeClass("messageActive");
    }, 3000);
}

function confirmDeleteComment () {
    $(document).ready(function(){
        $(".message").html("Le commentaire a bien été supprimé");
        $(".message").addClass("messageActive");
    });
    setTimeout(function() {
        $(".message").html("");
        $(".message").removeClass("messageActive");
    }, 3000);
}

function confirmAddPost () {
    $(document).ready(function(){
        $(".message").html("Le billet a bien été ajouté !");
        $(".message").addClass("messageActive");
    });
    setTimeout(function() {
        $(".message").html("");
        $(".message").removeClass("messageActive");
    }, 3000);
}
function confirmUpdatePost () {
    $(document).ready(function(){
        $(".message").html("Le billet a bien été modifié !");
        $(".message").addClass("messageActive");
    });
    setTimeout(function() {
        $(".message").html("");
        $(".message").removeClass("messageActive");
    }, 3000);
}

function confirmDeletePost () {
    $(document).ready(function(){
        $(".message").html("Le billet a bien été supprimé");
        $(".message").addClass("messageActive");
    });
    setTimeout(function() {
        $(".message").html("");
        $(".message").removeClass("messageActive");
    }, 3000);
}


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