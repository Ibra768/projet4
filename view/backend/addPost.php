<?php 
    $title = "Billet Simple pour l\'Alaska - Administration"; 
    $description = 'Cet espace vous permet d\'ajouter un billet.';
    $body = "body_Modif";
    ob_start(); 
?>
<h1>Ajouter un billet</h1>
<div class="flexboxForm">
    <form onsubmit="return checkFile()"class="formtiny" method="POST" action="index.php?action=addPost" enctype="multipart/form-data">
        <label for="title">Titre du billet</label><br>
        <input type="text" maxlength="20" size="25" name="title" required value='<?php if(isset($_GET['title'])){echo $_GET['title'];}?>'><br>
        <label for="file-upload" class="custom-file-upload"><i class="fas fa-upload"></i>&nbsp;<span>Illustration du billet</span></label><br>
        <input onchange="setFileName()" id="file-upload" type="file" name="picture"/>
        <label for="content">Contenu</label>
        <textarea class="tiny" id="texteditor"col="45" row="45"type="text" style="height:200px" name="content">
            <?php
                if(isset($_GET['content'])){
                    echo $_GET['content'];
                }
            ?>
        </textarea>
        <input type="submit" class="boutons" value="Envoyer">
    </form>
</div>
<?php 
    $content = ob_get_clean(); 
    require('view/template.php'); 
?>
