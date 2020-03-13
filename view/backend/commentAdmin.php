<?php 
  $title = 'Billet Simple pour l\'Alaska - Administration'; 
  $description = 'Cet espace vous permet d\'accéder aux commentaires signalés.';
  $body = "body_AdminComments";
  ob_start(); 
  if(count($getCommentsByPage) == 0){
?>
<div class="instructions_Admin"><p class='message_data'>Aucun commentaire signalé</p><a class="boutons" href="index.php?action=admin">Administration</a></div>
<?php
  }
  else{
?>
<div class="instructions_Admin"><p>Il y a <?=$commentsTotales ?> commentaires signalé(s)</p></div>
<?php
  }
  for($i=0 ; $i < count($getCommentsByPage) ; $i++) {
?>
<div id="commentReport">
  <div class="row">
    <div class="col-lg-12" id="list_Comment">
      <p>Posté par <?= $getCommentsByPage[$i]['author']?> le <?= $getCommentsByPage[$i]['comment_date_fr'] ?> sur le post n°<?= $getCommentsByPage[$i]['post_id']?></p>
      <hr>
      <p><?= $getCommentsByPage[$i]['comment'] ?></p>
      <hr>
      <p>Ce commentaire a été signalé à <?= $getCommentsByPage[$i]['nb_signalements'] ?> reprise(s).</p>
      <p>Que souhaitez-vous faire <?= $_SESSION['pseudo'] ?> ?</p>
      <a class="boutons" href="index.php?action=ignore&amp;id=<?= $getCommentsByPage[$i]['id'] ?>"><i class="fas fa-check"></i></a> <a class="boutons" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce commentaire ?')){return true;}else{return false;}" href="index.php?action=deleteComment&amp;id=<?= $getCommentsByPage[$i]['id'] ?>"><i class="far fa-trash-alt"></i></a>
    </div>
  </div>
</div>
<?php
  }
?>
<div class="pagination">
  <?php
    for($i=1 ; $i <= $pagesTotalesComments ; $i++){
      if($i == $pageCouranteComments){
        echo "<div class='boutons'>" . $i . "</div>";
      }
      else {
        echo '<div class="boutons"><a href="index.php?action=adminreport&pageComment='.$i.'">'.$i.'</a></div>';
      }
    } 
  ?>
</div>
<?php
  $content = ob_get_clean(); 
  require('view/template.php'); 
?>
