<?php 
    $title = "Billet Simple pour l'Alaska - Administration"; 
    $description = "Cet espace vous permet d'ajouter un billet.";
    $body = "body_Modif";
    ob_start(); 
?>
<h1>Ajouter un billet</h1>
<div class="flexboxForm">
    <form onsubmit=" return check_form()" class="formtiny" method="POST" action="index.php?action=add_or_update_post" enctype="multipart/form-data">
        <label for="title">Titre du billet</label><br>
        <input type="text" class="input_text" maxlength="20" size="25" name="title" required value='<?php if(isset($_GET['title'])){echo $_GET['title'];}?>'><br>
        <label for="id">N° de l'épisode</label>
        <input type="text" class="input_text" name="id" maxlength = '5' required value='<?php if(isset($_GET['id'])){echo $_GET['id'];}?>'><br>
        <label for="file-upload" class="custom-file-upload"><span><i class="fas fa-upload"></i> Upload</span></label><br>
        <input onchange="setFileName()" id="file-upload" type="file" name="add_picture"/>
        <label for="content">Contenu</label>
        <textarea class="tiny" id="texteditor"col="45" row="45"type="text" style="height:200px" name="content">
            <?php
                if(isset($_GET['content'])){
                    echo $_GET['content'];
                }
            ?>
        </textarea>
        <input type="submit" class="boutons" value="Envoyer">
        <input type="hidden" name="add">
    </form>
</div>
<?php 
    $content = ob_get_clean(); 
    require('view/template.php'); 
?>
