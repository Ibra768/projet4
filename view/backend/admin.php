<?php 
$title = 'Espace Administration'; 
$meta = 'Espace Administration du site';
$body = "body_Admin";
ob_start(); 

if(!session_id()) {
  session_start();
  }

if(isset($_GET['add'])) {
  echo "<div class='message'>Le billet a bien été ajouté !</div>";
}
else if(isset($_GET['update'])) {
  echo "<div class='message'>Le billet a bien été modifié !</div>";
}
else if(isset($_GET['delete'])) {
  echo "<div class='message'>Le billet a bien été supprimé !</div>";
}
else if(isset($_GET['allow'])) {
  echo "<div class='message'>Le commentaire a bien été autorisé !</div>";
}
else if(isset($_GET['deleteComment'])) {
  echo "<div class='message'>Le commentaire a bien été supprimé !</div>";
}

?>

<div class="instructions_Admin"><p>Bienvenue sur votre espace <?= $_SESSION['pseudo'] ?><br><a class="boutons" href="index.php?action=add">Ajouter un billet</a><br>Voici la liste des billets publiés : <p></div>

<?php
for($i=0 ; $i < count($postsAdmin) ; $i++)
{
?>
<div class="table-responsive">
<table>
  <thead>
    <tr>
      <th width="33%" scope="col">Numéro de billet</th>
      <th width="33%" scope="col">Titre du billet</th>
      <th width="33%" scope="col">Date création</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?= $postsAdmin[$i]['id'] ?></th>
      <th scope='row'><?= $postsAdmin[$i]['title'] ?></td>
      <th scope="row"><?= $postsAdmin[$i]['creation_date_fr'] ?></td>
    </tr>
  </tbody>
</table>
</div>
<div id="boutons_Admin"><a class="boutons" href="index.php?action=post&amp;id=<?= $postsAdmin[$i]['id'] ?>">Accéder</a> <a class="boutons" href="index.php?action=updatePost&amp;id=<?= $postsAdmin[$i]['id'] ?>">Modifier</a> <a class="boutons" href="index.php?action=deletePost&amp;id=<?= $postsAdmin[$i]['id'] ?>">Supprimer</a></div>


<?php
}
if(count($commentsReporting) == 0){
?>
<div class="instructions_Admin container-fluid"><p>Aucun commentaire signalé</p></div>
<?php
}
else{
?>
<div class="instructions_Admin container-fluid"><p>Voici la liste des commentaires signalés :</p></div>
<?php
}
for($i=0 ; $i < count($commentsReporting) ; $i++)
{
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12" id="list_Comment">
      <p>Posté par <?= $commentsReporting[$i]['author']?> le <?= $commentsReporting[$i]['comment_date_fr'] ?></p>
      <p><?= $commentsReporting[$i]['comment'] ?></p>
      <p>Que souhaitez-vous faire <?= $_SESSION['pseudo'] ?> ?</p>
      <a class="boutons" href="index.php?action=ignore&amp;id=<?= $commentsReporting[$i]['id'] ?>">Ignorer</a> <a class="boutons" href="index.php?action=deleteComment&amp;id=<?= $commentsReporting[$i]['id'] ?>">Supprimer</a>
    </div>
  </div>
</div>
<?php
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

