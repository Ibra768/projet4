<?php 
    $title = html_entity_decode($post['title']); 
    $meta = "Billet simple pour l'Alaska";
    $body = "body_post";
    ob_start(); 
?>
<style>
body {
    background-image : url("public/images/posts/<?php echo $post['images'];?>");
    background-size : cover;
}
</style>
<div id="post_wrapper">

    <?php 
        if(isset($_GET['add'])) {
            ?>
            <script>confirmAddComment();</script>
            <?php
        }
        else if(isset($_GET['report'])) {
            ?>
            <script>confirmReportComment();</script>
            <?php
        }
        else if(isset($_GET['deleteAdminok'])) {
            ?>
            <script>confirmDeleteComment();</script>
            <?php
        }
    ?>
    <p class="message"></p>
    <article id="billet">
        <h1><?= $post['title'] ?></h1>
        <em>Publié le <?= $post['creation_date_fr'] ?></em>
        <?= html_entity_decode($post['content']) ?>
    </article>
    <h2>Commentaires</h2>
    <?php
    
    for($i=0 ; $i < count($comments) ; $i++)
    {
    ?>
    <div id="comments">
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

<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="public/js/script.js"></script>
