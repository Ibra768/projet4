
<?php 
    $title = 'Accueil'; 
    $meta = 'Page d\'accueil du site de Jean Forteroche';
    $body = "body_home";
    ob_start(); 
?>

<div id="presentation" class="container">
    <div class="row">
        <div class=col-lg-12">
            <h1> Billet simple pour l'Alaska </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>Bonjour & bienvenue sur mon site</p>
            <p> Je me présente, je suis Jean Forteroche, auteur d'Un Billet Simple Pour l'Alaska.</p>
            <p>J'ai eu l'idée novatrice de présenter mon roman sous forme de site internet, avec différents épisodes.</p>
            <p>Je vous laisse découvrir ce qu'il en est ci-dessous.</p>
            <p>N'hésitez pas à laisser des commentaires !</p>
            <p>Bonne lecture :)<p>
        </div>
    </div>
</div>
<div id="portfolio">
    <?php
    for($i=0 ; $i < count($posts) ; $i++)
    {
    ?>
    <figure>
        <a href="index.php?action=post&amp;id=<?= $posts[$i]['id'] ?>"><img src="public/images/posts/<?= $posts[$i]['images'] ?>" alt="Illustration de l'épisode" /></a>
        <figcaption>
            <span class="title_portfolio"><?= $posts[$i]['title']  ?></span>
            <p>Publié le <?= $posts[$i]['creation_date_fr']  ?></p>
            <?php
            if(isset($_SESSION['pseudo'])) {
                ?>
            <a href="index.php?action=updatePost&amp;id=<?= $posts[$i]['id'] ?>"><span id="boutonSupprimer" class="boutonsAdmin"><i class="fas fa-paint-brush"></i></i></span><a>
            <a href="index.php?action=deletePost&amp;id=<?= $posts[$i]['id'] ?>" onclick="if(window.confirm('Voulez-vous vraiment supprimer ce billet ?')){return true;}else{return false;}"><span id="boutonModifier" class="boutonsAdmin"><i class="far fa-trash-alt"></i></span></a>
            <?php
            }
            ?>
        </figcaption>
        </a>
    </figure>
    <?php
    }
    ?>
</div>

<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>

