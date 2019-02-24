<?php 
$title = html_entity_decode($post['title']); 
$meta = "Billet simple pour l'Alaska";
$body = "body_post";
ob_start(); 
?>

<div id="post_wrapper">

    <?php 
    if(isset($_GET['add'])) {
        echo "<div class='message'>" . "Merci pour votre commentaire " . $_GET['add'] . " !" . "</div>";
    }
    else if(isset($_GET['report'])) {
        echo "<div class='message'>" . "Merci pour votre signalement, on s'en occupe !" . "</div>";
    }
    else if(isset($_GET['deleteAdminok'])) {
        echo "<div class='message'>" . "Le commentaire a bien été supprimé" . "</div>";
    }
    ?>
    <article id="billet" class=" post container">
        <div class="row">
            <div class=col-lg-12">
            <h1><?= $post['title'] ?></h1>
            <em>Publié le <?= $post['creation_date_fr'] ?></em>
            </div>
        </div>
        <div id="contenu" class="row">
            <div class="col-lg-12">
            <?= html_entity_decode($post['content']) ?>
            </div>
        </div>
    </article>
    <h2>Commentaires</h2>
    <?php
    
    for($i=0 ; $i < count($comments) ; $i++)
    {
    ?>
    <div id="comments" class="post container">
        <p><strong><?= $comments[$i]['author'] ?></strong> 
        <p>Publié le <?= $comments[$i]['comment_date_fr'] ?>
        <p><?= nl2br($comments[$i]['comment']) ?></p>
        <a class="boutons" id="bouton_Signalement" href="index.php?action=report&amp;id=<?= $comments[$i]['id'] ?>&amp;postid=<?= $comments[$i]['post_id'] ?>"><i class="far fa-flag"></i> Signaler</a>
        <?php
        if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
        ?>
            <a class="boutons" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce commentaire ?')){return true;}else{return false;}" href="index.php?action=deleteCommentAdmin&id=<?= $comments[$i]['id'] ?>&postid=<?= $_GET['id'] ?>"><i class="far fa-trash-alt"></i></a>
        <?php
        }
        ?>
    </div>
    <?php
    }
    ?>
    <form method="POST" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>">
        <label for="author">Auteur</label><br>
        <input type="text" name="author" required><br>
        <label for="comment">Contenu</label><br>
        <textarea type="text"  name="comment" required></textarea><br>
        <input type="submit" class="boutons" value="Envoyer">
    </form>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
