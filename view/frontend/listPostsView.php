
<?php 
$title = 'Accueil'; 
$meta = 'Accueil - Bonjour & bienvenue sur le site de Jean Forteroche';
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
            <a href="index.php?action=post&amp;id=<?= $posts[$i]['id'] ?>">
            <img src="public/images/episodes/episode_<?= $posts[$i]['id'] ?>.png" alt="Illustration de l'épisode" />
            <figcaption>
                <span class="title_portfolio"><?= $posts[$i]['title']  ?></span>
                <p>Publié le <?= $posts[$i]['creation_date_fr']  ?></p>
                <span class="oeil"><i class="fas fa-eye"></i></span>
            </figcaption>
            </a>
        </figure>
        <?php
        }
        ?>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

