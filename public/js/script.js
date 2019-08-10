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


