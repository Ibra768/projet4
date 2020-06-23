<?php 
    $title = "Billet Simple pour l'Alaska - Page d'accueil" ; 
    $description = "Bienvenue sur la page d'accueil du site de Jean Forteroche. Retrouvez les différents billets de son nouveau roman Billet Simple Pour L'Alaska.";
    $body = "body_home";
    ob_start(); 
?>
<section id="presentation">
    <h1> Le premier roman en ligne </h1>
    <p>Bonjour & bienvenue sur mon site</p>
    <p> Je me présente, je suis Jean Forteroche, auteur d'Un Billet Simple Pour l'Alaska.</p>
    <p>J'ai eu l'idée novatrice de présenter mon roman sous forme de site internet, avec différents épisodes.</p>
    <p>Je vous laisse découvrir ce qu'il en est ci-dessous.</p>
    <p>N'hésitez pas à laisser des commentaires !</p>
    <p>Bonne lecture :)<p>
</section>
<?php
    if(empty($posts)){
        echo "<p class='message_data'>" . "Aucun billet publié ..." . "</p>";
    }
?>
<section id="portfolio">
    <?php
        if(empty($posts) && isset($_SESSION['pseudo'])){
    ?>
    <div class="instructions_Admin"><a class="boutons" href="index.php?action=add">Ajouter un billet</a></div>
    <?php
        }
        else{
        }
        for($i=0 ; $i < count($posts) ; $i++)
            {
    ?>
    <figure>
        <?php
            if(isset($_SESSION['pseudo'])) {
        ?>
        <a href="index.php?action=update&amp;id=<?= $posts[$i]['id'] ?>"><span id="boutonModifier" class="boutonsAdmin"><i class="fas fa-paint-brush"></i></i></span><a>
        <a href="index.php?action=deletePost&amp;id=<?= $posts[$i]['id'] ?>" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce billet ?')){return true;}else{return false;}"><span id="boutonSupprimer" class="boutonsAdmin"><i class="far fa-trash-alt"></i></span></a>
        <?php
            }
        ?>
        <a href="index.php?action=post&amp;id=<?= $posts[$i]['id'] ?>">
            <img src="public/images/posts/<?= $posts[$i]['img'] ?>" alt="Illustration de l'épisode" width='100'/>
        </a>
        <figcaption>
            <span class="title_portfolio"><?= $posts[$i]['title']  ?></span>
            <p>Publié le <?= $posts[$i]['creation_date_fr']  ?></p>
        </figcaption>
    </figure>
    <?php
        }
    ?>
</section>
<?php 
    $content = ob_get_clean(); 
    require('view/template.php'); 
?>

