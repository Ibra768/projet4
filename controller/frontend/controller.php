<?php

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');

function listPostsHome() // FONCTION QUI RECUPERE TOUT LES POSTS
{
    $postManager = new \Model\PostManager();
    $posts = $postManager->getPosts(); // On récupère tous les posts

    require('view/frontend/listPostsView.php');
}
function post($postid) // FONCTION QUI RECUPERE 1 NEWS ET TOUS LES COMMENTAIRES ASSOCIES
{
    try{

        if (isset($postid) && ((int)$postid)) {  // // On vérifie les données envoyées

            $getAllPosts = new \Model\PostManager();
            $posts = $getAllPosts->getPosts(); // On récupère tous les posts

            for($i = 0 ; $i < count($posts) ; $i++){ // On récupère l'ID de tous les posts et on les stocke dans un tableau
                $tableau[] = $posts[$i]['id']; 
            }
            if (!in_array($postid, $tableau)) { // Si l'ID du post demandé est présent dans le tableau, on continue, sinon ..
                throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$postid . "</span>" . " n'existe pas.");
            }
            else{ 

                $postManager = new \Model\PostManager();
                $commentManager = new \Model\CommentManager();

                $post = $postManager->getPost($postid); // On récupère les informations du post concerné
                $comments = $commentManager->getComments($postid); // On récupère les commentaires lié au post concerné

                if(empty($post['content'])) {
                    throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer plus tard.');
                }
                else{
                    require('view/frontend/postView.php');
                }
            }
        }
        else{
            throw new Exception("Aucun post n'a été sélectionné.");
        }
    }
    catch(Exception $e){
        header('Location: index.php?action=error&message='.$e->getMessage());

    }
}
function reportComment($idReport, $postidReport) // FONCTION QUI PERMET DE SIGNALER UN COMMENTAIRE
{
    try{

        if(isset($postidReport) && ((int)$postidReport)) { // On vérifie les données envoyées

            $getAllPosts = new \Model\PostManager();
            $posts = $getAllPosts->getPosts(); // On récupère tous les posts

            for($i = 0 ; $i < count($posts) ; $i++){
                $tableau[] = $posts[$i]['id']; // On crée un tableau, et on y insère les ID de tous les posts
            }
            if (!in_array($postidReport, $tableau)) { // Si l'ID du post concerné par le commentaire est présent dans le tableau, on continue, sinon ..
                throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$postidReport . "</span>" . " n'existe pas.");
            }
            else{
                if(isset($idReport) && ((int)$idReport)) { // On vérifie les données envoyées

                    $getAllComments = new \Model\CommentManager();
                    $getComments = $getAllComments->getAllComments(); // On récupère tous les commentaires

                    for($i = 0 ; $i < count($getComments) ; $i++){
                        $tableau[] = $getComments[$i]['id']; // On crée un tableau, et on y insère les ID de tous les commentaires
                    }
                    if (!in_array($idReport, $tableau)) { // Si l'ID du commentaire concerné est présent dans le tableau, on continue, sinon ..
                        throw new Exception("Désolé, le commentaire n° " . "<span class='cible_Erreur'>" .$idReport . "</span>" . " n'existe pas.");
                    }
                    else{

                        $report = new \Model\CommentManager();

                        $reporting = $report->reportCommentDB($idReport); // On procède à la mise a jour sur la base de données

                        if ($reporting === false) {
                            throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer..');
                        }
                        else{
                            header('Location: index.php?action=post&id=' . $postidReport . '&message=Merci pour votre signalement, on s\'en occupe');
                        }
                    }
                }
                else{
                    throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer.');
                }
            }
        }
        else{
            throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer.');
        }
    }
    catch (Exception $e){
        header('Location: index.php?action=error&message='.$e->getMessage());
    }

}
function addComment($postId, $author, $comment) // Fonction qui permet d'ajouter un commentaire
{
    try{
        if (isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['author']) && !empty($_POST['comment'])) { // On vérifie les données envoyées

            $addComments = new \Model\CommentManager();

            $affectedLines = $addComments->postComment($postId, $author, $comment); // On ajoute le commentaire dans la base de données

            if ($affectedLines === false) {
                throw new Exception('Désolé ' . "<span class='cible_Erreur'>" . $author . "</span>" . ", une erreur a été rencontré. Réessayez plus tard.");
            }
            else {
                header('Location: index.php?action=post&message=Merci pour votre commentaire ' . $author . ' !&id=' . $postId);
            }
        }else{
            throw new Exception('Désolé ' . "<span class='cible_Erreur'>" . $author . "</span>" . ", une erreur a été rencontré. Réessayez plus tard.");
        }
    }
    catch (Exception $e){
        header('Location: index.php?action=post&id=' . $postId . "&message=".$e->getMessage());
    }
}
function getConnexion() { // Fonction qui permet d'accéder à la page de connexion pour l'administrateur
    require('view/frontend/connexion.php');
}
function getAdministrator($pseudo, $mdp) { // Fonction qui permet de savoir si l'utilisateur est administrateur lors de la connexion

    try{

        if(!empty($_POST['pseudo']) && !empty($_POST['pass'])) { // On vérifie les données envoyées

            $checkAdmin = new \Model\AdminManager();
            $resultat = $checkAdmin->getAdmin($pseudo); // On récupère les informations de l'admin
            
            $isPasswordCorrect = password_verify($mdp, $resultat['pass']); // On vérifie si le mot de passe correspond

            
            if (!$resultat) // Si le mot de passe ne correspond pas ..
            {
                throw new Exception('Le pseudo saisi est erroné.');
            }
            else
            {
                if ($isPasswordCorrect) { // Si ça correspond, on lance la session
                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['pass'] = $mdp;    
                    header('Location: index.php?action=admin&message=Bienvenue sur votre espace ' . $_SESSION['pseudo']);  
                }
                else {
                    throw new Exception('Le mot de passe renseigné est erroné.');
                }
            }
        }
        else{
            throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer plus tard.');
        }
    }
    catch(Exception $e){
        header('Location: index.php?action=erreurConnexion&message=' . $e->getMessage());
    }
}
function getForgotPassword() { // Fonction qui permet d'accéder à la page d'oubli de mot de passe
    require('view/frontend/forgotPassword.php');
}
function sendPassword($pseudo) { // Fonction qui permet d'envoyer son mot de passe à l'administrateur par e-mail
    try{

        $getPass = new \Model\AdminManager();
        $resultat = $getPass->getAdmin($pseudo); // On récupère les informations de l'utilisateur

        if($resultat){ // Si l'utilisateur existe, on envoie l'email

            function generer_mot_de_passe($nb_caractere = 12){ // Fonction qui permet de générer un mot de passe aléatoire
                $mot_de_passe = "";
            
                $chaine = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789"; // Chaine de caractère possible pour le mot de passe
                $longeur_chaine = strlen($chaine); 
            
                for($i = 1; $i <= $nb_caractere; $i++)
                {
                    $place_aleatoire = mt_rand(0,($longeur_chaine-1)); // On choisi un chiffre aléatoire entre 0 et $longueur_chaine-1
                    $mot_de_passe .= $chaine[$place_aleatoire]; // On abonde $mot de passe avec $chaine, qui est lui même abondé par un caractère aléatoire x 12
                }

                return $mot_de_passe;   
            }

            $newPass = generer_mot_de_passe(); // On crée un nouveau mot de passe provisoire
            
            $hashPass = password_hash($newPass, PASSWORD_DEFAULT);

            $temporary = new \Model\AdminManager();
            $return = $temporary->temporaryPass($hashPass,$pseudo); // On insère le nouveau mot de passe dans la BDD
            if(!$return){
                throw new Exception("Une erreur a été rencontré. Veuillez réessayer plus tard.");
            }
            else{

                $message =
                "<h1>Votre demande de mot de passe</h1>" .
                "<p>Bonjour" . $pseudo . ",</p><br>" .
                "<p>Comme demandé, veuillez trouver ci joint un mot de passe provisoire afin de vous connecter à votre compte administrateur.</p><br>" .
                "<strong>" . $newPass . "<strong>" .
                "<p>Pour plus de sécurité, nous vous conseillons de modifier votre mot de passe une fois connecté.</p><br>" .
                "<p>Cordialement.</p>";
                mail($resultat['mail'], 'Votre nouveau mot de passe provisoire', $message);
                header('Location: index.php?action=forgotpassword&message=Un mot de passe provisoire vous a été envoyé par email.');
            }
        }
        else{
            throw new Exception("Pas de compte retrouvé pour l'utilisateur" . $pseudo . "</span>");
        }
    }
    catch (Exception $e){
        header('Location: index.php?action=forgotpassword&message='.$e->getMessage());
    }
}

function forbidden(){
    try{
        throw new Exception("L'accès a cette page est interdit.");
    }
    catch (Exception $e){
        header('Location: /projet4/index.php?message='.$e->getMessage());
    }
}
