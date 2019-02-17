<?php 
$title = 'Suppression de billet'; 
?>


<?php ob_start(); 
?>
<?php
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
while ($data = $postsDelete->fetch())
{
?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Numéro de billet</th>
      <th scope="col">Titre du billet</th>
      <th scope="col">Date de création</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?= $data['id'] ?></th>
      <td><?= $data['title'] ?></td>
      <td><?= $data['creation_date_fr'] ?></td>
      <td><a href="index.php?action=delete&id=<?= $data['id'] ?>">Supprimer</a>
    </tr>
  </tbody>
</table>

<?php
}
$postsDelete->closeCursor();
if(isset($_GET['id'])) {
    echo "Le billet n°" . $_GET['id'] . " " . 'a bien été supprimé.';
}
}
else {
    echo "Vous n'avez pas le droit d'accéder a cette page.";
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>