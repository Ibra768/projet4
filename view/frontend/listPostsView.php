
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
                <p>Je vous laisse découvrir ce qu'il en est ci-dessous</p>
                <p>N'hésitez pas à laisser des commentaires !</p>
                <p>Bonne lecture :)<p>
            </div>
        </div>
    </div>


    <div id="portfolio">
        <?php
        while ($data = $posts->fetch())
        {
        ?>
        <figure>
            <img src="public/images/background_home.jpg" alt="Image Roman" />
            <figcaption>
                <span class="title_portfolio"><?= htmlspecialchars($data['title']) ?></span>
                <p>Publié le <?= $data['creation_date_fr'] ?></p>
                <span class="oeil"><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><i class="fas fa-eye"></i></a></span>
            </figcaption>
        </figure>
        <?php
        }
        $posts->closeCursor();
        ?>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

