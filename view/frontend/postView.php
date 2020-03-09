<?php 
    $title = "Billet simple pour l'Alaska - Billet n° " . $post['id'] . " : " . html_entity_decode($post['title']); 
    $description = 'Suivez les aventures de Jean Forteroche, au travers de son roman "Billet Simple pour l\'Alaska". Voici le billet n° ' . $post['id'] . ' de ce roman.';
    $body = "body_post";
    ob_start(); 
?>
<style>
    body {
        background-image : url("public/images/posts/<?php echo $post['images'];?>");
        background-size : cover;
        background-attachment : fixed; 
    }
    #addComments {
        <?php 
            if(count($comments) === 0) {
                echo "margin: auto";
            }  
        ?>
    }
    #blocComments {
        <?php 
            if(count($comments) === 0) {
                echo "display : block;";
            }  
        ?>
    }
</style>
<div id="post_wrapper">
    <article id="billet">
        <h1><?= $post['title'] ?></h1>
        <em>Publié le <?= $post['creation_date_fr'] ?></em>
        <?= html_entity_decode($post['content']) ?>
    </article>
    <article id="blocComments">
        <div id="addComments">
            <h2 class="titleComments">Ajouter un commentaire</h3>
            <form method="POST" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>">
                <label for="author">Auteur</label><br>
                <input type="text" name="author" required><br>
                <label for="comment">Contenu</label><br>
                <textarea type="text"  name="comment" required></textarea><br>
                <input type="submit" class="boutons" value="Envoyer">
            </form>
        </div>
        <div id="readComments">
            <?php 
                if(count($comments) > 0){
            ?>
            <h3 class="titleComments"><?php echo count($comments); ?> Commentaire(s)</h3>
            <?php
                }
                for($i=0 ; $i < count($comments) ; $i++)
                {
            ?>
            <div id="comments">
                <p><strong><?= $comments[$i]['author'] ?></strong></p>
                <p>Publié le <?= $comments[$i]['comment_date_fr'] ?></p>
                <p><?= nl2br($comments[$i]['comment']) ?></p>
                <a class="boutons" id="bouton_Signalement" href="index.php?action=report&amp;id=<?= $comments[$i]['id'] ?>&amp;postid=<?= $comments[$i]['post_id'] ?>"><i class="far fa-flag"></i> Signaler</a>
                <?php
                    if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
                ?>
                <a class="boutons" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce commentaire ?')){return true;}else{return false;}" href="index.php?action=deleteCommentAdmin&commentid=<?= $comments[$i]['id'] ?>&postid=<?= $_GET['id'] ?>"><i class="far fa-trash-alt"></i></a>
                <?php
                }
                ?>
            </div>
            <?php
                }
            ?>
        </div>
    </article>
</div>
<?php 
    $content = ob_get_clean(); 
    require('view/template.php'); 
?>

