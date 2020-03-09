<?php

// Chargement des classes

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');
require_once('model/MyException.php');
                           
function dataAdmin($pageCourante) // Fonction qui récupère la liste des billets page par page
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande

            $postManagerAdmin = new \Model\PostManager();

            $postsAdmin = $postManagerAdmin->getPostAdmin(); // On récupère la liste des billets

            $postsParPage = 5; // On définit le nombre de posts par page

            $postsTotaleReq = $postsAdmin;

            $postsTotales = $postsTotaleReq->rowCount(); // On compte le nombre de posts

            $pagesTotales = ceil($postsTotales/$postsParPage); // On divise le nombre de posts par le nombre de posts par page (5) afin de connaitre le nombre de pages (ceil permet d'arrondir au nombre supérieur)

            if($pageCourante > $pagesTotales) { // Permet de retourner à la première page si l'utilisateur essaie de se rendre sur une page qui n'existe pas
                $pageCourante = 1; 
            }
        
            $depart = ($pageCourante-1)*$postsParPage; // Calcul du premier post à afficher 
            
            $postManagerAdmin2 = new \Model\PostManager();

            $postsAdminPage = $postManagerAdmin2->getPostsPage($depart,$postsParPage); // On affiche les posts allant du posts $depart + 5

            require('view/backend/admin.php');
        }
        else{
            throw new Exception("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch(Exception $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
}

function adminCommentReport($pageCouranteComments) // Fonction qui permet à l'administrateur d'accéder à la page des commentaires signalés
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande

            $commentReport = new \Model\CommentManager();

            $commentsReporting = $commentReport->getCommentsReport(); // On récupère le nombre de commentaires signalés

            $commentsParPage = 3; // On choisi le nombre de commentaires à afficher par page

            $commentsTotaleReq = $commentsReporting;

            $commentsTotales = $commentsTotaleReq->rowCount();  // On compte le nombre de commentaires signalés
  
            $pagesTotalesComments = ceil($commentsTotales/$commentsParPage); // On divise le nombre de commentaires totals par le nombre de commentaires que l'on veut par page, pour avoir le nombre de pages totales

            $departComments = ($pageCouranteComments-1)*$commentsParPage; // On détermine le premier commentaire à afficher

            $commentsByPage = new \Model\CommentManager();

            $getCommentsByPage = $commentsByPage->getCommentsReportByPage($departComments,$commentsParPage); // On récupère la liste des commentaires, du premier commentaire +5

            require('view/backend/commentAdmin.php');
        }
        else{
            throw new Exception("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch(Exception $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
}

function passRequest() // Fonction qui permet d'accéder à la page de modification des accès
{
    try{
        if (isset($_SESSION['pseudo'])) { // On vérifie que c'est bien l'administrateur qui fait la demande
            $get = new \Model\AdminManager();
            $getAccess = $get->getAdmin($_SESSION['pseudo']); // On vérifie que l'utilisateur existe 

            if($getAccess) {
                require('view/backend/changeAccess.php'); // Si il existe, on le redirige vers la page en question
            }
            else{
                throw new Exception("Une erreur s'est produite. Veuillez réessayer.");
            }
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch(MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    catch(Exception $e){
        header('Location: index.php?action=admin&message='.$e->getMessage());
    }
}

function changeAccess($formulaire) // Fonction qui procède au changement des identifiants d'accès
{
    try{
    
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande
            
            if(isset($formulaire['changePass'])){ // Si l'utilisateur a coché le changement de mot de passe
            
                if (isset($formulaire['pseudo'],$formulaire['pass'],$formulaire['newPass']) && !empty($formulaire['pseudo']) && !empty($formulaire['pass']) && !empty($formulaire['newPass'])) { // On vérifie les données envoyées

                    if (!preg_match('#^[a-zA-Z0-9*+]{8,30}$#', $formulaire['newPass'])){
                        throw new Exception("Le mot de passe choisi ne respecte pas les conditions de sécurité.");
                    }
                    if (strlen($formulaire['newPass']) < 8) {
                        throw new Exception("Le mot de passe est trop court.");
                    }
                    else if (strlen($formulaire['newPass']) > 30) {
                        throw new Exception("Le mot de passe est trop long.");
                    }
                    else{

                        $checkAdmin = new \Model\AdminManager();
                        $resultat = $checkAdmin->getAdmin($_SESSION['pseudo']); // On vérifie que l'utilisateur existe bien
                    
                        $pass_hache = password_hash($formulaire['newPass'], PASSWORD_DEFAULT); // On crypte le nouveau mot de passe
                        $isPasswordCorrect = password_verify($formulaire['pass'], $resultat['pass']); // On vérifie que le mot de passe correspondent bien

                        if (!$resultat)
                        {
                            throw new Exception("Une erreur s'est produite. Veuillez réessayer");
                        }
                        else
                        {
                            if ($isPasswordCorrect) {

                                if($formulaire['pass'] == $formulaire['newPass']) { // Si le mot de passe saisi est identique au précédent
                                    throw new Exception('Le nouveau mot de passe saisi est identique au précédent');
                                }
                                else{

                                    $changeAccess = new \Model\AdminManager();
                                    $resultat = $changeAccess->changeAccess($formulaire['pseudo'],$pass_hache,$_SESSION['pseudo']); // On change le pseudo et/ou le mot de passe
            
                                    if($_SESSION['pseudo'] == $formulaire['pseudo']){
                                        header('Location: index.php?action=admin&message=Le mot de passe a bien été modifié !');
                                    }
                                    else{
                                        $_SESSION['pseudo'] = $formulaire['pseudo'];
                                        header('Location: index.php?action=admin&message=Le pseudo et le mot de passe ont bien été modifiés !');
                                    }
                                }
                            }
                            else{
                                throw new Exception('Le mot de passe renseigné ne correspond pas');
                            }   
                        }
                    }
                }
                else{
                    throw new Exception("Une erreur s'est produite. Veuillez réessayer");
                }
            }
            else{ // Sinon, si l'utilisateur n'a pas coché le changement de mot de passe

                if (isset($formulaire['pseudo']) && !empty($formulaire['pseudo'])) { // On vérifie les données envoyées

                    if(!preg_match('#^[a-zA-Z0-9-_]{6,12}$#', $formulaire['pseudo'])){
                        throw new Exception("Le pseudo choisi ne respecte pas les conditions de sécurité.");
                    }
                    else if (strlen($formulaire['pseudo']) < 6) {
                            throw new Exception("Le pseudo choisi est trop court");
                    }
                    else if (strlen($formulaire['pseudo']) > 12) {
                        throw new Exception("Le pseudo choisi est trop long");
                    }
                    else{

                        $changeAccess = new \Model\AdminManager();
                        $resultat = $changeAccess->changeOnlyPseudo($formulaire['pseudo'],$_SESSION['pseudo']); // On change le pseudo

                        $_SESSION['pseudo'] = $formulaire['pseudo']; // On met a jour $_SESSION

                        header('Location: index.php?action=admin&message=Le pseudo a bien été modifié !');

                    }
                }
                else{
                    throw new Exception("Une erreur s'est produite. Veuillez réessayer");
                }
            }
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter");
        }
    }
    catch (Exception $e){
        header('Location: index.php?action=passrequest&message='.$e->getMessage());
    }
    catch (MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
}
function getAddPage() // Fonction qui permet d'accéder à la page d'ajout de post
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande
            require('view/backend/addPost.php');
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch(MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    
}     

function addPost($fichier,$title,$content,$author) // Fonction qui permet d'ajouter un post
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande, puis on vérifie les données envoyées
            if(empty($title) || !isset($title)) {
                throw new Exception("Le champ " . "<span class='cible_Erreur'>" . "titre" . "</span>" . " est manquant.");
            }
            else if(empty($content) || !isset($content)){
                throw new Exception("Le champ " . "<span class='cible_Erreur'>" . "contenu" . "</span>" . " est manquant.");
            }
            else if(empty($author) || !isset($author)){
                throw new Exception("Le champ " . "<span class='cible_Erreur'>" . "auteur" . "</span>" . " est manquant.");
            }
            else if(empty($fichier) || !isset($fichier)){
                throw new Exception("Le" . "<span class='cible_Erreur'>" . "fichier du post" . "</span>" . " est manquant.");
            }
            else{
                $maxSize = 5000000; // On définit la taille maximale du fichier
                $validExtensions = array('jpg','jpeg','png','gif'); // On définit les extensions acceptées
                
                if ($fichier['picture']['size'] <= $maxSize){ // Si le fichier correspond à la bonne taille ..
                    $uploadExtensions = strtolower(substr(strrchr($fichier['picture']['name'], '.'),1)); // On prend le nom du fichier, on le met en minuscule, on selectionne ce qui se situe après le "." grâce à strrchr (.jpg), puis on récupère uniquement (jpg) grâce à substr.
                    if(in_array($uploadExtensions, $validExtensions)){ // Si l'extension du fichier uploadé correspond à une extension valide ..
                        $folder = "public/images/posts/".$title.".".$uploadExtensions; // On définit le futur chemin du fichier uploadé
                        $result = move_uploaded_file($fichier['picture']['tmp_name'],$folder); // On déplace le fichier vers le chemin défini précedemment
                        if($result){ // Si le transfert du fichier a réussi ..
                            $fichierImage = $title.".".$uploadExtensions; // On définit le nom du fichier pour la colonne "images" de la table "posts"
                            $add = new \Model\PostManager();
                            $addPost = $add->addPost($title,$content,$author,$fichierImage); // On procède à l'ajout dans la base de données
                            Header("location:index.php?action=admin&message=L'article a bien été ajouté !");
                        }
                        else{
                            throw new Exception("Nous avons rencontré une erreur lors de l'importation de votre fichier.");
                        }
                    }
                    else{
                        throw new Exception("L'illustration de l'article doit être au format jpg, jpeg, png ou gif.");
                    }
                }   
                else{
                    throw new Exception("L'illustration de l'article ne doit pas dépasser 2mo.");
                }
            }
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    catch (Exception $e){
        header('Location: index.php?action=add&title='.$title.'&content='.html_entity_decode($content).'&message='.$e->getMessage());
    }
}
function updatePost($postid) // Fonction qui récupère le billet à modifier (afin de l'insérer dans un formulaire pour le modifier)
{
    try{

        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande

            if (isset($postid) && ((int)$postid)) { // On vérifie les données envoyées

                $getAllPosts = new \Model\PostManager();
                $posts = $getAllPosts->getPosts(); // On récupère tous les billets

                for($i = 0 ; $i < count($posts) ; $i++){ // On récupère les ID de tous les billets et on les mets dans un tableau
                    $tableau[] = $posts[$i]['id']; 
                }
                if (!in_array($postid, $tableau)) { // On vérifie que l'ID du billet demandé existe bien, en le comparant aux ID du tableau
                    throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$postid . "</span>" . " n'existe pas.");
                }
                else{

                    $postUpdate = new \Model\PostManager();
                    $postUp = $postUpdate->getPost($postid); // On récupère le billet en question et on accède à la page de modification

                    require('view/backend/updateNews.php');
                }
            }
            else{
                throw new Exception("Une erreur s'est produite. Veuillez réessayer.");
            }
        }
        else{
            throw new Exception("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch(Exception $e){
        header('Location: index.php?action=admin&message='.$e->getMessage());
    }
    catch(Exception $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
}
function confirmUpdatePost($fichier,$formulaire) // Fonction qui permet de changer un post
{
    try{
        if(isset($_SESSION['pseudo'])){ // Si l'utilisateur existe .. // On vérifie les données envoyées
            if(empty($formulaire["title"]) || !isset($formulaire["title"])){ 
                throw new Exception("Le champ " . "<span class='cible_Erreur'>" . "titre" . "</span>" . " est manquant.");
            }
            else if(empty($formulaire["content"]) || !isset($formulaire["content"])){
                throw new Exception("Le champ " . "<span class='cible_Erreur'>" . "contenu" . "</span>" . " est manquant.");
            }
            else{

                if(isset($formulaire["old"])){ // Si l'utilisateur choisi de garder l'ancienne image ..

                    $getExtension = new \Model\PostManager();
                    $get = $getExtension->getPost($formulaire['id']); // On récupère le post

                    $extension = strrchr($get['images'], "."); // On isole l'extension grâce à strrchr

                    $update = new \Model\PostManager();
                    $updatePost = $update->updatePostDB($formulaire["title"],$formulaire["content"],$_SESSION['pseudo'],$formulaire['title'].$extension,$formulaire["id"]); // On met a jour le post dans la base de données
                    rename("public/images/posts/".$get['images'],"public/images/posts/".$formulaire['title'].$extension); // On renomme le fichier avec le nouveau titre
                    if(!$updatePost) {
                        throw new Exception("Une erreur a été rencontré.");
                    }
                    else{
                        Header('location:index.php?action=admin&message=Le post a bien été modifié !');
                    }
                }
                else if(isset($fichier) && !empty($formulaire["title"]) && !empty($formulaire["content"])){ // Si l'utilisateur décide de changer la photo
                    $maxSize = 5000000; // On défini la taille maximale du fichier 
                    $validExtensions = array('jpg','jpeg','gif','png'); // On définit les extensions acceptées
                    
                    if ($fichier['picture']['size'] <= $maxSize){ // Si la taille du fichier est conforme ..
                        $uploadExtensions = strtolower(substr(strrchr($fichier['picture']['name'], '.'),1)); // On recupère l'extension grâce à strrchr (.jpg), puis on isole (jpg) grâce à substr
                        $deletePreviousTitle = new \Model\PostManager();
                        $delete = $deletePreviousTitle->getPost($formulaire['id']); // On récupère les informations du post en question
                        
                        if(in_array($uploadExtensions, $validExtensions)){ // Si l'extension du fichier est conforme ..
                            $folder = "public/images/posts/".$formulaire['title'].".".$uploadExtensions; // On définit le chemin de destination du fichier
                            $result = move_uploaded_file($fichier['picture']['tmp_name'],$folder); // On procède au déplacement du fichier
                            if($result){ // Si le déplacement est réussi ..
                                $fichierImage = $formulaire['title'].".".$uploadExtensions; // On définit le nom donné à la colonne images pour ce post
                                $update = new \Model\PostManager();
                                $updatePost = $update->updatePostDB($formulaire['title'],$formulaire['content'],$_SESSION['pseudo'],$fichierImage,$formulaire['id']); // On procède à la mise a jour de la base de données
                                if(!$updatePost) {
                                    throw new Exception("Une erreur a été rencontré.");
                                }
                                else{
                                Header('location:index.php?action=admin&message=Le post a bien été modifié !');
                                unlink("public/images/posts/".$delete['images']); // On supprime l'ancienne image
                                }
                            }
                            else{
                                throw new Exception("Nous avons rencontrer une erreur lors de l'importation de votre fichier.");
                            }
                        }
                        else{
                            throw new Exception("Votre photo de profil doit être au format jpg, gif ou png.");
                        }
                    }   
                    else{
                        throw new Exception('Votre photo de profil ne doit pas dépasser 2mo.');
                    }
                }
                else{
                    throw new Exception('Une erreur a été rencontré.');
                }
            }
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    catch (Exception $e){
        header('Location: index.php?action=updatePost&id='.$formulaire['id'].'&title='.$formulaire['title'].'&content='.html_entity_decode($formulaire['content']).'&message='.$e->getMessage());
    }
}

function deletePost($id) // Fonction qui permet de supprimer un billet
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande

            if (isset($id) && ((int)$id)) { // On vérifie les données envoyées

                $getAllPosts = new \Model\PostManager();
                $posts = $getAllPosts->getPosts(); // On récupère tous les posts

                for($i = 0 ; $i < count($posts) ; $i++){
                    $tableau[] = $posts[$i]['id']; // On remplit un tableau avec l'id de tous les posts
                }
                if (!in_array($id, $tableau)) { // On vérifie que le post a supprimé est bien contenu dans le tableau (qu'il existe)
                    throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$id . "</span>" . " n'existe pas.");
                }
                else{

                $deletePreviousTitle = new \Model\PostManager();
                $delete = $deletePreviousTitle->getPost($id); // On récupère le post en question
                $titleDelete = $delete['images'];

                $postManagerDeletePosts = new \Model\PostManager();
                $deletePost = $postManagerDeletePosts->deletePost($id); // On le supprime
                
                }
                if ($deletePost === false) {
                    throw new Exception("Une erreur a été rencontré.");
                }
                else {
                    unlink("public/images/posts/".$titleDelete); // On supprime l'image du post
                    header('Location: index.php?action=admin&message=Le post a bien été supprimé!'); 
                }
            }
            else{
                throw new Exception("Une erreur a été rencontré.");
            }
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    catch (Exception $e){
        header('Location: index.php?action=admin&message='.$e->getMessage());
    }
}

function allowComment($idComment) // Fonction qui autorise un commentaire signalé
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande
            if (isset($idComment) && ((int)$idComment)) { // On vérifie les données envoyées

                $getAllComments = new \Model\CommentManager();
                $getComments = $getAllComments->getAllComments(); // On récupère l'ensemble des commentaires

                for($i = 0 ; $i < count($getComments) ; $i++){
                    $tableau[] = $getComments[$i]['id']; // On remplit un tableau avec tous les id de tous les commentaires
                }
                if (!in_array($idComment, $tableau)) { // On vérifie que l'id du commentaire autorisé est présent dans le tableau, sinon ..
                    throw new Exception("Désolé, le commentaire n° " . "<span class='cible_Erreur'>" .$idComment . "</span>" . " n'existe pas.");
                }
                else{ // Si il est présent ..

                    $allow = new \Model\CommentManager();

                    $allowingComment = $allow->allowCommentDB($idComment); // On procède à l'autorisation

                    if ($allowingComment === false) {
                        throw new Exception("Une erreur a été rencontré.");
                    }
                    else {
                        header('Location: index.php?action=adminreport&message=Le commentaire a bien été autorisé !');
                    }
                }
            }
            else{
                throw new Exception("Une erreur a été rencontré.");
            }
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    catch(Exception $e){
        header('Location: index.php?action=adminreport&message='.$e->getMessage());
    }
}

function deleteComment($id) // Fonction qui permet de supprimer un commentaire signalé
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande
            if(isset($id) && ((int)$id)) { // // On vérifie les données envoyées

                $getAllComments = new \Model\CommentManager();
                $getComments = $getAllComments->getAllComments(); // On récupère tous les commentaires

                for($i = 0 ; $i < count($getComments) ; $i++){ // On remplit un tableau avec tous les ID des commentaires
                    $tableau[] = $getComments[$i]['id']; 
                }
                if (!in_array($id, $tableau)) { // Si l'ID du commentaire à supprimé est présent dans le tableau, on peut continuer, sinon ..
                    throw new Exception("Désolé, le commentaire n° " . "<span class='cible_Erreur'>" .$id . "</span>" . " n'existe pas.");
                }
                else{

                    $deleteComment = new \Model\CommentManager();

                    $confirmDeleteComment = $deleteComment->deleteComment($id); // On supprime le commentaire

                    if ($confirmDeleteComment === false) {
                        throw new Exception("Une erreur a été rencontré.");
                    }
                    else {
                        header('Location: index.php?action=adminreport&message=Le commentaire a bien été supprimé !'); 
                    }
                }
            }
            else{
                throw new Exception("Une erreur a été rencontré. Veuillez réessayer.");
            }
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    catch(Exception $e){
        header('Location: index.php?action=adminreport&message='.$e->getMessage());
    }
}

function deleteCommentAdmin($commentid,$postid) // Fonction qui permet à l'administrateur de supprimer un commentaire signalé directement sur la page du post
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande
            if(isset($postid) && ((int)$postid)) { // On vérifie les données envoyées 

                $getAllPosts = new \Model\PostManager();
                $posts = $getAllPosts->getPosts(); // On récupère tous les posts

                for($i = 0 ; $i < count($posts) ; $i++){ // On remplit un tableau avec l'id de tous les posts sélectionnés
                    $tableau[] = $posts[$i]['id']; // Si l'id du post selectionné dans lequel se trouve le commentaire est présent dans le tableau, on peut continuer, sinon ..
                }
                if (!in_array($postid, $tableau)) {
                    throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$postid . "</span>" . " n'existe pas.");
                }
                else{ // Si l'id matche ..

                    if(isset($commentid) && ((int)$commentid)) { // On vérifie les données envoyées 

                        $getAllComments = new \Model\CommentManager();
                        $getComments = $getAllComments->getAllComments(); // On récupère tous les commentaires

                        for($i = 0 ; $i < count($getComments) ; $i++){ // On remplit un tableau avec l'id de tous les commentaires
                            $tableau[] = $getComments[$i]['id']; 
                        }
                        if (!in_array($commentid, $tableau)) { // Si l'id du commentaire à supprimer est présent dans le tableau, on continue, sinon ..
                            throw new Exception("Désolé, le commentaire n° " . "<span class='cible_Erreur'>" .$commentid . "</span>" . " n'existe pas.");
                        }
                        else{
                            $deleteComment = new \Model\CommentManager();

                            $confirmDeleteComment = $deleteComment->deleteComment($commentid); // On supprime le commentaire

                            if ($confirmDeleteComment === false) {
                                throw new Exception("Une erreur a été rencontré. Veuillez réessayer.");
                            }
                            else {
                                header('Location: index.php?action=post&id=' . $postid . '&message=Le commentaire a bien été supprimé !');
                            }
                        }
                    }
                    else{
                        throw new Exception("Une erreur a été rencontré. Veuillez réessayer");
                    }
                }
            }
            else{
                throw new Exception("Une erreur a été rencontré. Veuillez réessayer.");
            }
        }
        else{
            throw new MyException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (MyException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    catch(Exception $e){
        header('Location: index.php?action=post&id=' . $postid . '&message='.$e->getMessage());
    }
}

function disconnect () // Fonction qui permet la deconnexion de l'admin
{
    session_unset();
    session_destroy();
    listPostsHome();
}
