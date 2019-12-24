<?php 
    $title = "Ajouter un billet"; 
    $meta = 'Ajout de billet sur le site';
    $body = "body_Modif";
    ob_start(); 
?>

<h1>Ajouter un billet</h1>
<div class="container">
    <form method="POST" action="index.php?action=addPost" enctype="multipart/form-data">
        <div class="row">
            <div class="col-25">
                <label for="title">Titre du billet</label>
            </div>
            <div class="col-75">
                <input type="text" maxlength="20" size="25" name="title" required>
                <input type="file" id="avatar" name="avatar" required><br>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="content">Contenu</label>
            </div>
            <div class="col-75">
                <textarea class="tiny" col="45" row="45"type="text" style="height:200px" name="content"></textarea><br>
                <input type="submit" class="boutons" value="Envoyer">
            </div>
        </div>
    </form>
</div>

<?php 
    $content = ob_get_clean(); 
    require('view/template.php'); 
?>