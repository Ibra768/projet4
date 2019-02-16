<?php
if(!session_id()) {
session_start();
}

// Si session ouverte ..
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
?>  
<a href="index.php?action=deconnexion">Deconnexion</a>
<?php
?>
<p>Bonjour <?php echo $_SESSION['pseudo']; ?>, bienvenue sur votre espace d'administration.</p>

<a href="view/addPost.php">Ajouter</a>
<?php
while ($data = $postsAdmin->fetch())
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
      <td><a href="index.php?action=post&id=<?= $data['id'] ?>">Accéder</a> <a href="index.php?action=updatePost&id=<?= $data['id'] ?>">Modifier</a> <a href="index.php?action=deletePost&id=<?= $data['id'] ?>">Supprimer</a></td>
    </tr>
  </tbody>
</table>

<?php
}
$postsAdmin->closeCursor();

while ($comment = $commentsReporting->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}

}

// Si pas de session ouverte
else {
    echo "Vous n'avez pas le droit d'accéder à cette page.";
}
?>

