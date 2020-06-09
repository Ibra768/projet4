// Initialisation de tinyMCE
tinymce.init({
    selector: '.tiny',
});

// La fonction message permet d'afficher le bandeau d'informations
function message($message){
    $(".message").html($message);
    $(".message").css("display","block");
    setTimeout(function() {
        $(".message").css("display","none");
    }, 5000);
}

// On y ajoute un appel à la classe URLSearchParams afin de détecter la présence de 'message' dans l'URL
$(document).ready(function(){
    var searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('message')){
        message(searchParams.get('message'));
    }
});

// Cette fonction permet de vérifier les extensions des fichiers uploadés
function checkExtensions($file_extension){
    var extensions = ['jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG'];
    return extensions.includes($file_extension);
}

// La fonction check_update_form permet de vérifier si le nouveau fichier est bien présent lors de la modification du billet ; si ce n'est pas le cas, on informe l'utilisateur.
function check_form(){

    var content = tinyMCE.activeEditor.getContent();

    if(!$('input[name="title"]').val()){
        message('Le champ titre est manquant');
        return false;
    }
    else if(content == ''){
        message('Le champ contenu est manquant');
        return false;
    }
    else{
        var ckbox = $('#old');

        if (ckbox.is(':checked')) { // Si l'utilisateur décide de garder l'ancien fichier, on autorise.
            return true;
        }
        else{

            var input = $('input[name="id"]').val();
            var regex = new RegExp('^[0-9]*$');

            var check = regex.test(input);

            if(!check){

                message('L\'id selectionné est invalide. Veuillez choisir un nombre correct.');
                return false;
            }
            else{

                var file = $('#file-upload')[0].files[0];

                if (!file) { // Si aucun fichier n'est selectionné ..

                    $(".custom-file-upload").css("color","red");
                    $html = $('.custom-file-upload span').html();
                    $('.custom-file-upload span').html("Veuillez ajouter un fichier");
                    setTimeout(function() {
                        $(".custom-file-upload").css("color","white");
                        $('.custom-file-upload span').html($html);
                    }, 2000);
                    return false;

                }
                else{

                    if(file['size'] > 5242880){ // On vérifie la taille du fichier
                        message('Le fichier téléchargé est trop volumineux.');
                        return false;
                    }
                    else{

                        var file_name = $('#file-upload')[0].files[0]['name'];
                        var extension = file_name.substr( (file_name.lastIndexOf('.') +1) ); // On récupère l'extension
                        var checking = checkExtensions(extension); // On vérifie l'extension
                        
                        if(checking){ // Si l'extension est conforme, on l'envoie à PHP.
                            $("<input />").attr("type", "hidden")
                            .attr("name", "extension")
                            .attr("value", extension)
                            .appendTo(".formtiny");
                            return true;
                        }
                        else{   // Sinon ..
                            message('L\'illustration du billet doit être au format jpg, jpeg, gif ou png.');
                            return false;
                        }
                    }
                }
            }
        }
    }
}

// La fonction setFileName permet de remplir le label avec le nom du fichier selectionné pour l'ajout ou la modification de post
function setFileName() {
    filename = $('#file-upload')[0].files[0]['name'];
    $('.custom-file-upload span').html(filename);
}

// Cette fonction permet de faire apparaitre ou non l'onglet photo sur la page de modification 
$(document).ready(function(){
    var label = $(".custom-file-upload span").html();
    var ckbox = $('#old');
    ckbox.on('click',function () {
        if (ckbox.is(':checked')) {
            $("#file-upload").val("");
            $(".custom-file-upload span").html('');
            $(".custom-file-upload").css("display","none");

        } else {
            $(".custom-file-upload").css("display","initial");
            $(".custom-file-upload span").html(label);
        }
    });
});

// Cette fonction permet de faire apparaitre/disparaitre l'onglet mot de passe pour le changement des identifiants
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

// Cette fonction permet d'ajouter un effet au survol du logo du site
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
