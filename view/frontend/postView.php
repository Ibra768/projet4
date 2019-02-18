<?php $title = htmlspecialchars($post['title']); ?>


<?php ob_start(); ?>


<p class="message_Confirmation">cvxcv</p>

<div class="container">
<div class="row">
<div class=col-lg-12">
<h1><?= htmlspecialchars($post['title']) ?></h1>
<em>le <?= $post['creation_date_fr'] ?></em>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<?= nl2br(htmlspecialchars($post['content'])) ?>
</div>
</div>
</div>


<?php
while ($comment = $comments->fetch())
{
?>

<div class="container">
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

<div class="container">
<div class="row">
<div class=col-lg-12">
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" class="btn btn-primary" />
    </div>
</form>
</div>
</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
