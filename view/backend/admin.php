<?php 
  $title = 'Billet Simple pour l\'Alaska - Administration'; 
  $description = 'Cet espace vous permet de gérer l\'ensemble du site.';
  $body = "body_Admin";
  ob_start(); 
?>
<div class="instructions_Admin">
  <div>
    <a class="boutons" href="index.php?action=add">Ajouter un billet</a>
    <a class="boutons" href="index.php?action=passrequest">Modifier mes accès</a>
    <a class="boutons" href="index.php?action=adminreport">Commentaires signalés</a>
  </div>
  <?php
    if(empty($postsAdminPage)){
      echo "<p>" . "Aucun billet publié" . "</p>";
    }
    else{
      echo "<p>" . "Voici la liste des billets publiés" . "</p>";
    }
  ?>
</div>
<?php
  for($i=0 ; $i < count($postsAdminPage) ; $i++) {
?>
<div id="tableauAdmin">
  <div><p><?= $postsAdminPage[$i]['title'] ?></p></div>
  <div><p>Publié le <?= $postsAdminPage[$i]['creation_date_fr'] ?></p></div>
  <div id="boutons_Admin">
      <a id="sisi" class="boutons" href="index.php?action=post&amp;id=<?= $postsAdminPage[$i]['id'] ?>"><i class="far fa-eye"></i></a> 
      <a class="boutons" href="index.php?action=updatePost&amp;id=<?= $postsAdminPage[$i]['id'] ?>"><i class="fas fa-paint-brush"></i></a>
      <a id="bouton_delete"class="boutons" href="index.php?action=deletePost&amp;id=<?= $postsAdminPage[$i]['id'] ?>" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce billet ?')){return true;}else{return false;}"><i class="far fa-trash-alt"></i></a>
  </div>
</div>
<?php
  }
?>
<div class="pagination">
  <?php
    for($i=1 ; $i <= $pagesTotales ; $i++){
      if($i == $pageCourante){
        echo "<div class='boutons'>" . $i . "</div>";
      }
      else {
        echo '<div class="boutons"><a href="index.php?action=admin&page='.$i.'">'.$i.'</a></div>';
      }
    } 
  ?>
</div>
<?php
  $content = ob_get_clean(); 
  require('view/template.php'); 
?>
