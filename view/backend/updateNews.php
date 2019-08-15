<?php 
$title = 'Modifier un billet'; 
$meta = 'Modifications de billet';
$body = "body_Modif";
ob_start(); 
?>
<h1>Modifier un billet</h1>

    <form method="POST" action="index.php?action=confirmUpdatePost" enctype="multipart/form-data">
                <label for="title">Titre du billet</label><br>
                <input type="text" name="title"  size="25" maxlength="20" value="<?= htmlspecialchars($postUp['title']) ?>" required><br>
                <input type="file" id="avatar" name="avatar" required><br>
                <div id="oldBloc">
                    <label>Conserver l'image?</label><br>
                    <input type="checkbox" name="old" id="old"><br>
                    <img src="public/images/posts/<?= html_entity_decode($postUp['images']) ?>" height="100" width="100">
                </div> 
            <textarea  type="text"  class="tiny" name="content"><?= html_entity_decode($postUp['content']) ?></textarea><br>
            <input type="submit" class="boutons" value="Envoyer">
            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'])?>">
    </form>
<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="public/js/script.js"></script>