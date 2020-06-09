<?php 
    $title = 'Billet Simple pour l\'Alaska - Administration'; 
    $description = 'Cet espace vous permet de modifier le billet que vous avez selectionné.';
    $body = "body_Modif";
    ob_start(); 
?>
<h1>Modifier un billet</h1>
<div class="flexboxForm">
    <form onsubmit="return check_form()" class="formtiny" method="POST" action="index.php?action=add_or_update_post" enctype="multipart/form-data">
        <label for="title">Titre du billet</label><br>
        <input type="text" class='input_text' name="title"  size="25" maxlength="20" value="<?php echo isset($_GET['title']) ? $_GET['title'] : html_entity_decode($postUp['title']); ?>" required><br>
        <label for="file-upload" id='update-file-upload' class="custom-file-upload"><span><i class="fas fa-file-upload"></i> Upload</span></label><br>
        <input type="file" onchange="setFileName()" id="file-upload" name="update_picture"><br>
        <div id="oldBloc">
            <label for="old">Conserver l'image?</label><br>
            <input type="checkbox" name="old" id="old" checked><br>
            <img src="public/images/posts/<?= html_entity_decode($postUp['img']) ?>" height="100" width="100">
        </div> 
        <textarea  type="text"  class="tiny" name="content"><?php echo isset($_GET['content']) ? $_GET['content'] : html_entity_decode($postUp['content']); ?></textarea><br>
        <input type="submit" class="boutons" value="Envoyer">
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'])?>">
    </form>
</div>
<?php 
    $content = ob_get_clean(); 
    require('view/template.php'); 
?>
