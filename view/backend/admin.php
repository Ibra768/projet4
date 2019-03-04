<?php 
$title = 'Espace Administration des billets'; 
$meta = 'Espace Administration des billets';
$body = "body_Admin";
ob_start(); 



if(isset($_GET['add'])) {
  echo "<div class='message'>Le billet a bien été ajouté !</div>";
}
else if(isset($_GET['update'])) {
  echo "<div class='message'>Le billet a bien été modifié !</div>";
}
else if(isset($_GET['delete'])) {
  echo "<div class='message'>Le billet a bien été supprimé !</div>";
}

?>

<div class="instructions_Admin"><p>Bienvenue sur votre espace <?= $_SESSION['pseudo'] ?><br><a class="boutons" href="index.php?action=add">Ajouter un billet</a><br><a class="boutons" href="index.php?action=adminreport">Commentaires signalés</a><br>Voici la liste des billets publiés : <p></div>

<?php

for($i=0 ; $i < count($postsAdminPage) ; $i++)
{
?>
<article id="tableauAdmin">
  <div><p><?= $postsAdminPage[$i]['title'] ?></p></div>
  <div><p><?= $postsAdminPage[$i]['creation_date_fr'] ?></p></div>
  <div id="boutons_Admin">
      <a id="sisi" class="boutons" href="index.php?action=post&amp;id=<?= $postsAdminPage[$i]['id'] ?>"><i class="far fa-eye"></i></a> 
      <a class="boutons" href="index.php?action=updatePost&amp;id=<?= $postsAdminPage[$i]['id'] ?>"><i class="fas fa-paint-brush"></i></a>
      <a id="bouton_delete"class="boutons" href="index.php?action=deletePost&amp;id=<?= $postsAdminPage[$i]['id'] ?>" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce billet ?')){return true;}else{return false;}"><i class="far fa-trash-alt"></i></a>
  </div>
</article>
<?php
}
?>

<aside class="pagination">
  <?php
    for($i=1 ; $i <= $pagesTotales ; $i++){
      if($i == $pageCourante){
            echo "<div class='boutons'>" . $i . "</div>";
      }else {
        echo '<div class="boutons"><a href="index.php?action=admin&page='.$i.'">'.$i.'</a></div>';
        }
    } 
  ?>
</aside>

<?php
$content = ob_get_clean(); 
require('view/template.php'); 
?>

