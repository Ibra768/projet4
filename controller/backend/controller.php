<?php

// Chargement des classes

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');
require_once('model/AddException.php');
require_once('model/AdminException.php');
                           
function dataAdmin($pageCourante) // Fonction qui récupère la liste des billets page par page
{
    try{
        if(isset($_SESSION['pseudo'])){ // On vérifie que c'est bien l'administrateur qui fait la demande

            $postManagerAdmin = new \Model\PostManager();

            $postsAdmin = $postManagerAdmin->allPosts(); // On récupère la liste des billets

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
            throw new AdminException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch(AdminException $e){
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

                    if(!preg_match('#^[a-zA-Z0-9-_]{4,12}$#', $formulaire['pseudo'])){
                        throw new Exception("Le pseudo choisi ne respecte pas les conditions de sécurité.");
                    }
                    else if (strlen($formulaire['pseudo']) < 4) {
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
            throw new AdminException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter");
        }
    }
    catch (Exception $e){
        header('Location: index.php?action=passrequest&message='.$e->getMessage());
    }
    catch (AdminException $e){
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
            throw new AdminException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch(AdminException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    
}     

function getUpdatePage($postid) // Fonction qui récupère le billet à modifier (afin de l'insérer dans un formulaire pour le modifier)
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
                    throw new Exception("Désolé, le poste n°" .$postid . " n'existe pas.");
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

function add_or_update_post($fichier,$formulaire) // Fonction qui permet d'ajouter ou de changer un post
{
    try{
        if(isset($_SESSION['pseudo'])){ // Si l'utilisateur existe .. // On vérifie les données envoyées
            if(empty($formulaire["title"]) || !isset($formulaire["title"])){ 
                throw new AddException("Le champ titre est manquant ou non conforme.");
            }
            else if(empty($formulaire["content"]) || !isset($formulaire["content"])){
                throw new AddException("Le champ contenu est manquant ou non conforme");
            }
            else{

                if(isset($formulaire['add'])){ // Si l'action demandé est l'ajout de fichier

                    if(empty($formulaire['id']) || !preg_match('#^[0-9]*$#', $formulaire['id'])){ // On vérifie que l'ID est bien un nombre
                        throw new AddException('Le champ ID est manquant ou non conforme.'  ); 
                    }
                    else{
        
                        $is_id_exist = new \Model\PostManager(); // On vérifie si l'id existe deja
                        $check_id = $is_id_exist->checkId($formulaire['id']);

                        if($check_id){
                            throw new AddException('Il existe déjà un épisode ' . $formulaire['id'] . '. Veuillez corriger votre saisie.');
                        }
                        else{

                            $max_size = 5242880;

                            if(isset($fichier['add_picture']['error']) && $fichier['add_picture']['error'] >= 3){ // Si aucun fichier n'a été téléchargé

                                throw new AddException("Aucun fichier n'a été téléchargé.");
                            }
                            else if($fichier['add_picture']['size'] > $max_size){
                                throw new AddException("Le fichier selectionné est trop volumineux.");
                            }
                            else{

                                if(isset($formulaire['extension'])){ // Si JS envoie bien l'extension du fichier (si JS n'est pas desactivé par l'utilisateur)

                                    $file_type = $formulaire['extension'];
                                    
                                }
                                else{
                                    
                                    $path_parts = pathinfo($fichier["add_picture"]["name"]); // Sinon on récupère l'extension via PHP
                                    $extension = $path_parts['extension'];
                                    
                                    $validExtensions = array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'); // On définit les extensions acceptées
        
                                    if(!in_array($extension,$validExtensions)){ // Si l'extension n'est pas bonne
                                        throw new AddException('L\'illustration du billet doit être au format jpg, jpeg, gif ou png.');
                                    }
                                    else{
                                        $file_type = $extension;
                                    }
                                }

                                $add = new \Model\PostManager();
                                $addPost = $add->addPost($formulaire['id'],$formulaire['title'],$formulaire['content'],$_SESSION['pseudo']); // On procède à l'ajout dans la base de données
                                $addImage = $add->addImage($formulaire['id'],$fichier['add_picture']['name'],$fichier['add_picture']['size'],$file_type);

                                if($addPost){

                                    if($addImage){

                                        $folder = "public/images/posts/".$fichier['add_picture']['name']; // On définit le futur chemin du fichier uploadé
                                        $result = move_uploaded_file($fichier['add_picture']['tmp_name'],$folder); // On déplace le fichier vers le chemin défini précedemment
                                        if($result){ // Si le transfert du fichier a réussi ..
                                            Header("location:index.php?action=post&id=".$formulaire['id']."&message=L'article a bien été ajouté !");
                                        }
                                        else{
                                            throw new AddException("Nous avons rencontré une erreur lors de l'importation de votre fichier.");
                                        }
                                    }
                                    else{
                                        throw new AddException("Une erreur a été rencontré lors de l'importation de l'image.");
                                    }
                                }
                                else{
                                    throw new AddException("Une erreur a été rencontré lors de l'importation du billet.");
                                }
                            }
                        }
                    }
                }
                else if(isset($formulaire["old"])){ // Si l'utilisateur choisi de garder l'ancienne image ..

                    $post = new \Model\PostManager();
                    $addPost = $post->getPost($formulaire['id']);

                    // On prévoit le cas ou l'utilisateur demande a modifier l'article mais laisse les champs tel quel
                    if ($formulaire['title'] === $addPost['title'] && $formulaire['content'] === $addPost['content'] && $_SESSION['pseudo'] === $addPost['author']){
                        Header('location:index.php?action=admin&message=Rien n\'a été modifié !');
                    }
                    else{
                        // Si l'utilisateur a bien changer les champs, on procède a l'actualisation du post
                        $update = new \Model\PostManager();
                        $updatePost = $update->updatePostDBWithoutImage($formulaire["title"],$formulaire["content"],$_SESSION['pseudo'],$formulaire['id']); // On met a jour le post dans la base de données

                        if($updatePost = 1) {
                            Header('location:index.php?action=admin&message=Le post a bien été modifié !');
                        }
                        else{
                            throw new Exception("Une erreur a été rencontré.");
                        }
                    }
                }
                else if(isset($fichier)){ // Si l'utilisateur décide de changer la photo
                    
                    $max_size = 5242880;

                    if(isset($fichier['update_picture']['error']) && $fichier['update_picture']['error'] >= 3){ // Si aucun fichier n'a été téléchargé

                        throw new Exception("Aucun fichier n'a été téléchargé.");
                    }
                    else if($fichier['update_picture']['size'] > $max_size){
                        throw new Exception("Le fichier selectionné est trop volumineux.");
                    }
                    else{
                        
                        if(isset($formulaire['extension'])){ // Si JS envoie bien l'extension du fichier (si JS n'est pas desactivé par l'utilisateur)

                            $file_type = $formulaire['extension'];
                            
                        }
                        else{
            
                            $path_parts = pathinfo($fichier["update_picture"]["name"]); // Sinon on récupère l'extension via PHP
                            $extension = $path_parts['extension'];
                            
                            $validExtensions = array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'); // On définit les extensions acceptées

                            if(!in_array($extension,$validExtensions)){ // Si l'extension n'est pas bonne
                                throw new Exception('L\'illustration du billet doit être au format jpg, jpeg, gif ou png.');
                            }
                            else{
                                $file_type = $extension;
                            }
                        }
                        /*
                        $check = new \Model\PostManager();
                        $checkImage = $check->checkImageName($fichier["update_picture"]["name"]);

                        if(!$checkImage){ // Si l'image n'existe pas, on garde son nom
                            $img_name = $fichier["update_picture"]["name"];
                        }
                        else{ // Si elle existe deja pour un autre post, on la renomme
                            $img_name = str_replace('.', (random_int(0, 100000) . '.'), $fichier["update_picture"]["name"]);
                        }
                        */
                        
                        $update = new \Model\PostManager();
                        $checkId = $update->checkImageId($formulaire['id']);
                        $img_name = $checkId['img_nom'];

                        $updatePost = $update->updatePostDB($formulaire['title'],$formulaire['content'],$_SESSION['pseudo'],$formulaire['id']); // On procède à la mise a jour de la base de données
                        $updateImage = $update->updateImage($img_name,$fichier["update_picture"]["size"],$file_type,$formulaire['id']);
                        
                        if($updatePost){

                            if($updateImage){
                                $result = move_uploaded_file($fichier['update_picture']['tmp_name'],"public/images/posts/".$img_name); // On déplace le fichier vers le chemin défini précedemment
                                if($result){ // Si le transfert du fichier a réussi ..
                                    Header("location:index.php?action=post&id=".$formulaire['id']."&message=L'article a bien été ajouté !");
                                }
                                else{
                                    throw new AddException("Nous avons rencontré une erreur lors de l'importation de votre fichier.");
                                }
                            }
                            else{
                                throw new AddException("Une erreur a été rencontré lors de l'importation de l'image.");
                            }
                        }
                        else{
                            throw new AddException("Une erreur a été rencontré lors de l'importation du billet.");
                        }  
                    }
                }
                else{
                    throw new Exception('Une erreur a été rencontré.');
                }
            }
        }
        else{
            throw new AdminException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (AdminException $e){
        header('Location: index.php?action=getConnexion&message='.$e->getMessage());
    }
    catch (AddException $e){ // Exception qui gère les erreurs du formulaire d'ajout
        $contenu = urlencode($formulaire['content']); 
        header('Location: index.php?action=add&title='.$formulaire['title'].'&content='.$contenu.'&message='.$e->getMessage());
    }
    catch (Exception $e){ // Exception qui gère les erreurs du formulaire de modification
        $contenu = urlencode($formulaire['content']); // On fait appel a urlencode car si il y a des retours a la ligne dans le contenu, on a une erreur
        header('Location: index.php?action=updatePost&id='.$formulaire['id'].'&title='.$formulaire['title'].'&content='.$contenu.'&message='.$e->getMessage());
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
                    throw new Exception("Désolé, le post n° " .$id . " n'existe pas.");
                }
                else{

                $deletePreviousTitle = new \Model\PostManager();
                $delete = $deletePreviousTitle->getPost($id); // On récupère le post en question

                $deleteImage = $delete['img'];

                $postManagerDeletePosts = new \Model\PostManager();
                $deletePost = $postManagerDeletePosts->deletePost($id); // On le supprime
                
                }
                if ($deletePost === false) {
                    throw new Exception("Une erreur a été rencontré.");
                }
                else {
                    unlink("public/images/posts/".$deleteImage); // On supprime l'image du post
                    header('Location: index.php?action=admin&message=Le post a bien été supprimé!'); 
                }
            }
            else{
                throw new Exception("Une erreur a été rencontré.");
            }
        }
        else{
            throw new AdminException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (AdminException $e){
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
                    throw new Exception("Désolé, le commentaire n° " .$idComment . " n'existe pas.");
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
            throw new AdminException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (AdminException $e){
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
                    throw new Exception("Désolé, le commentaire n° " .$id. " n'existe pas.");
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
            throw new AdminException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (AdminException $e){
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
                    throw new Exception("Désolé, le post n° " . $postid . " n'existe pas.");
                }
                else{ // Si l'id matche ..

                    if(isset($commentid) && ((int)$commentid)) { // On vérifie les données envoyées 

                        $getAllComments = new \Model\CommentManager();
                        $getComments = $getAllComments->getAllComments(); // On récupère tous les commentaires

                        for($i = 0 ; $i < count($getComments) ; $i++){ // On remplit un tableau avec l'id de tous les commentaires
                            $tableau[] = $getComments[$i]['id']; 
                        }
                        if (!in_array($commentid, $tableau)) { // Si l'id du commentaire à supprimer est présent dans le tableau, on continue, sinon ..
                            throw new Exception("Désolé, le commentaire n° " . $commentid . " n'existe pas.");
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
            throw new AdminException("Vous n'avez pas le droit d'accéder à cette page. Veuillez vous connecter.");
        }
    }
    catch (AdminException $e){
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
