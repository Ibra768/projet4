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
      <td><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Accéder</a> <a href="index.php?action=updatePost&amp;id=<?= $data['id'] ?>">Modifier</a> <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">Supprimer</a></td>
    </tr>
  </tbody>
</table>

<?php
}
$postsAdmin->closeCursor();

while ($comment = $commentsReporting->fetch())
{
?>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Auteur</th>
      <th scope="col">Contenu</th>
      <th scope="col">Date de publication</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= htmlspecialchars($comment['author']) ?></td>
      <td><?= $comment['comment'] ?></td>
      <td><?= $comment['comment_date_fr'] ?></td>
      <td><a href="index.php?action=ignore&amp;id=<?= $comment['id'] ?>">Ignorer</a> <a href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>">Supprimer</a>
    </tr>
  </tbody>
</table>
<?php
}

}

// Si pas de session ouverte
else {
    echo "Vous n'avez pas le droit d'accéder à cette page.";
}
?>

