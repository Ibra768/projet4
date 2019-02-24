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
<div id="tableauAdmin">
  <div><?= $postsAdmin[$i]['title'] ?></div>
  <div><?= $postsAdmin[$i]['creation_date_fr'] ?></div>
  <div id="boutons_Admin">
      <a id="sisi" class="boutons" href="index.php?action=post&amp;id=<?= $postsAdmin[$i]['id'] ?>"><i class="far fa-eye"></i></a> 
      <a class="boutons" href="index.php?action=updatePost&amp;id=<?= $postsAdmin[$i]['id'] ?>"><i class="fas fa-paint-brush"></i></a>
      <a id="bouton_delete"class="boutons" href="index.php?action=deletePost&amp;id=<?= $postsAdmin[$i]['id'] ?>" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce billet ?')){return true;}else{return false;}"><i class="far fa-trash-alt"></i></a>
  </div>
</div>

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
      <a class="boutons" href="index.php?action=ignore&amp;id=<?= $commentsReporting[$i]['id'] ?>"><i class="fas fa-check"></i></a> <a class="boutons" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce commentaire ?')){return true;}else{return false;}" href="index.php?action=deleteComment&amp;id=<?= $commentsReporting[$i]['id'] ?>"><i class="far fa-trash-alt"></i></a>
    </div>
  </div>
</div>
<?php
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

