
<?php 
$title = 'Mon blog'; 
?>


<?php ob_start(); 
?>

<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>
<div class="row">
<?php
while ($data = $posts->fetch())
{
?>
    <div class="col-md-6 col-xs-12">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= substr(nl2br(htmlspecialchars($data['content'])),0,300); ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Accéder à l'épisode</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>


</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

