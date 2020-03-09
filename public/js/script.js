// APPARATION/DISPARITION DU MESSAGE DE CONFIRMATION
$(document).ready(function(){
    var message = $(".message").html();
    if(message.length > 21){
        $(".message").css("display","block");
        setTimeout(function() {
            $(".message").css("opacity","0");
        }, 5000);
    }
});
// VERIFICATION SI FICHIER PRESENT POUR AJOUT DE BILLET
function checkFile() {
    if (!$('#file-upload').val()) {
        $(".custom-file-upload").css("color","red");
        setTimeout(function() {
            $(".custom-file-upload").css("color","white");
        }, 2000);
        return false;
      }
      else{
          return true;
      }
}
// APPARITION/DISPARATION DE L'ONGLET PHOTO SUR LA PAGE DE MODIFICATION D'UN POST 
$(document).ready(function(){
    var ckbox = $('#old');
    ckbox.on('click',function () {
        if (ckbox.is(':checked')) {
            $("#file-upload").val("");
            $(".custom-file-upload span").html("Nouvelle illustration");
            $(".custom-file-upload").css("display","none");

        } else {
            $(".custom-file-upload").css("display","initial");
        }
    });
});
// VERIFICATION SI FICHIER PRESENT POUR MODIFICATION DE BILLET OU CONVERVATION DU FICHIER DEJA MIS EN PLACE
function checkFile2(){
    var ckbox = $('#old');
    if (ckbox.is(':checked')) {
        return true;
    }
    else{
        if (!$('#file-upload').val()) {
            $(".custom-file-upload").css("color","red");
            setTimeout(function() {
                $(".custom-file-upload").css("color","white");
            }, 2000);
            return false;
        }
        else{
            return true;
        }
    }
}
// APPARITION/DISPARITION DE L'ONGLET MOT DE PASSE SUR LA PAGE DE CHANGEMENT DES IDENTIFIANTS
$(document).ready(function(){
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
});
// EFFET AU SURVOL DU LOGO DU SITE
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
// INITIALISATION DE TINY MCE
tinymce.init({
    selector: '.tiny',
});

// INSERTION DU NOM DU FICHIER SELECTIONNE DANS LE LABEL
function setFileName() {
    filename = $('#file-upload')[0].files[0]['name'];
    $('.custom-file-upload span').html(filename);
}


