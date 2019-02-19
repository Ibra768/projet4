<?php 
$title = htmlspecialchars($post['title']); 
$meta = "Billet simple pour l'Alaska";
$body = "body_post";
ob_start(); 
?>

<div id="post_wrapper">

    <?php 
    if(isset($_GET['add'])) {
        echo "<div class='message'>" . "Merci pour votre commentaire !" . "</div>";
    }
    else if(isset($_GET['report'])) {
        echo "<div class='message'>" . "Merci pour votre signalement, on s'en occupe !" . "</div>";
    }
    ?>
    <article id="billet" class=" post container">
        <div class="row">
            <div class=col-lg-12">
            <h1><?= htmlspecialchars($post['title']) ?></h1>
            <em>Publié le <?= $post['creation_date_fr'] ?></em>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            </div>
        </div>
    </article>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
    <div  class=" post container">
        <div class="row">
            <div class=col-lg-12">
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> 
                <p>Publié le <?= $comment['comment_date_fr'] ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <a class="boutons" id="bouton_Signalement" href="index.php?action=report&amp;id=<?= $comment['id'] ?>&amp;postid=<?= $comment['post_id'] ?>"><i class="far fa-flag"></i> Signaler</a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <div id="formulaire_Add" class="post container">
        <div class="row">
            <div class=col-lg-12">
                <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                    <div>
                        <label for="author">Auteur</label><br />
                        <input type="text" id="author" name="author" />
                    </div>
                    <div>
                        <label for="comment">Commentaire</label><br />
                        <textarea rows="3" cols="100"id="comment" name="comment"></textarea>
                    </div>
                    <div>
                        <input type="submit" class="boutons" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
