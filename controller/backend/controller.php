<?php
// Chargement des classes
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');
require_once('model/MyException.php');
                           
function dataAdmin($pageCourante) // Fonction qui récupère la liste des billets page par page
{
    try{
        if(isset($_SESSION['pseudo'])){

            $postManagerAdmin = new \Model\PostManager();

            $postsAdmin = $postManagerAdmin->getPostAdmin();

            $postsParPage = 5;

            $postsTotaleReq = $postsAdmin;

            $postsTotales = $postsTotaleReq->rowCount(); 

            $pagesTotales = ceil($postsTotales/$postsParPage);

            if($pageCourante > $pagesTotales) {
                $pageCourante = 1;
            }
        
            $depart = ($pageCourante-1)*$postsParPage; 
            
            $postManagerAdmin2 = new \Model\PostManager();

            $postsAdminPage = $postManagerAdmin2->getPostsPage($depart,$postsParPage); 

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
        if(isset($_SESSION['pseudo'])){

            $commentReport = new \Model\CommentManager();

            $commentsReporting = $commentReport->getCommentsReport();

            $commentsParPage = 3;

            $commentsTotaleReq = $commentsReporting;

            $commentsTotales = $commentsTotaleReq->rowCount();  
  
            $pagesTotalesComments = ceil($commentsTotales/$commentsParPage);

            $departComments = ($pageCouranteComments-1)*$commentsParPage; 

            $commentsByPage = new \Model\CommentManager();

            $getCommentsByPage = $commentsByPage->getCommentsReportByPage($departComments,$commentsParPage); 

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
        if (isset($_SESSION['pseudo'])) {
            $get = new \Model\AdminManager();
            $getAccess = $get->getAdmin($_SESSION['pseudo']);

            if($getAccess) {
                require('view/backend/changeAccess.php');
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
    
        if(isset($_SESSION['pseudo'])){
            
            if(isset($formulaire['changePass'])){
            
                if (isset($formulaire['pseudo'],$formulaire['pass'],$formulaire['newPass']) && !empty($formulaire['pseudo']) && !empty($formulaire['pass']) && !empty($formulaire['newPass'])) {

                    /*if (!preg_match('#^[a-zA-Z0-9*]{8,30}$#', $formulaire['newPass'])){
                        throw new Exception("Le mot de passe choisi ne respecte pas les conditions de sécurité.");
                    }*/
                    if (strlen($formulaire['newPass']) < 8) {
                        throw new Exception("Le mot de passe est trop court.");
                    }
                    else if (strlen($formulaire['newPass']) > 30) {
                        throw new Exception("Le mot de passe est trop long.");
                    }
                    else{

                        $checkAdmin = new \Model\AdminManager();
                        $resultat = $checkAdmin->getAdmin($_SESSION['pseudo']);
                    
                        $pass_hache = password_hash($formulaire['newPass'], PASSWORD_DEFAULT);
                        $isPasswordCorrect = password_verify($formulaire['pass'], $resultat['pass']);

                        if (!$resultat)
                        {
                            throw new Exception("Une erreur s'est produite. Veuillez réessayer");
                        }
                        else
                        {
                            if ($isPasswordCorrect) {

                                if($formulaire['pass'] == $formulaire['newPass']) {
                                    throw new Exception('Le nouveau mot de passe saisi est identique au précédent');
                                }
                                else{

                                    $changeAccess = new \Model\AdminManager();
                                    $resultat = $changeAccess->changeAccess($formulaire['pseudo'],$pass_hache,$_SESSION['pseudo']);
            
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
            else{

                if (isset($formulaire['pseudo']) && !empty($formulaire['pseudo'])) {

                    if(!preg_match('#^[a-zA-Z0-9-_]{6,12}#', $formulaire['pseudo'])){
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
                        $resultat = $changeAccess->changeOnlyPseudo($formulaire['pseudo'],$_SESSION['pseudo']);

                        $_SESSION['pseudo'] = $formulaire['pseudo'];

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
function updatePost($postid) // Fonction qui récupère le billet à modifier (afin de l'insérer dans un formulaire pour le modifier)
{
    try{

        if(isset($_SESSION['pseudo'])){

            if (isset($postid) && ((int)$postid)) {

                $getAllPosts = new \Model\PostManager();
                $posts = $getAllPosts->getPosts();

                for($i = 0 ; $i < count($posts) ; $i++){
                    $tableau[] = $posts[$i]['id']; 
                }
                if (!in_array($postid, $tableau)) {
                    throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$postid . "</span>" . " n'existe pas.");
                }
                else{

                    $postUpdate = new \Model\PostManager();
                    $postUp = $postUpdate->getPost($postid);

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

function getAddPage() 
{
    try{
        if(isset($_SESSION['pseudo'])){
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

function addPost($fichier,$title,$content,$author)
{
    try{
        if(isset($_SESSION['pseudo'])){
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
                $maxSize = 5000000;
                $validExtensions = array('jpg','jpeg','png','gif');
                
                if ($fichier['avatar']['size'] <= $maxSize){
                    $uploadExtensions = strtolower(substr(strrchr($fichier['avatar']['name'], '.'),1));
                    if(in_array($uploadExtensions, $validExtensions)){
                        $folder = "public/images/posts/".$title.".".$uploadExtensions;
                        $result = move_uploaded_file($fichier['avatar']['tmp_name'],$folder);
                        if($result){
                            $fichierImage = $title.".".$uploadExtensions;
                            $add = new \Model\AdminManager();
                            $addPost = $add->addPost($title,$content,$author,$fichierImage);
                            Header("location:index.php?action=admin&message=L'article a bien été ajouté !");
                        }
                        else{
                            throw new Exception("Nous avons rencontré une erreur lors de l'importation de votre fichier.");
                        }
                    }
                    else{
                        throw new Exception("L'illustration de l'article doit être au format jpg, jpeg, png.");
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
        header('Location: index.php?action=add&message='.$e->getMessage());
    }
}

function confirmUpdatePost($fichier,$formulaire)
{
    try{
        if(isset($_SESSION['pseudo'])){
            if(empty($formulaire["title"]) || !isset($formulaire["title"])){
                throw new Exception("Le champ " . "<span class='cible_Erreur'>" . "titre" . "</span>" . " est manquant.");
            }
            else if(empty($formulaire["content"]) || !isset($formulaire["content"])){
                throw new Exception("Le champ " . "<span class='cible_Erreur'>" . "contenu" . "</span>" . " est manquant.");
            }
            else{

                if(isset($formulaire["old"])){

                    $getExtension = new \Model\PostManager();
                    $get = $getExtension->getPost($formulaire['id']);

                    $extension = substr($get['images'], -4, 4);

                    $update = new \Model\PostManager();
                    $updatePost = $update->updatePostDB($formulaire["title"],$formulaire["content"],$_SESSION['pseudo'],$formulaire['title'].$extension,$formulaire["id"]);
                    rename("public/images/posts/".$get['images'],"public/images/posts/".$formulaire['title'].$extension);
                    if(!$updatePost) {
                        throw new Exception("Une erreur a été rencontré.");
                    }
                    else{
                        Header('location:index.php?action=admin&message=Le post a bien été modifié !');
                    }
                }
                else if(isset($fichier) && !empty($formulaire["title"]) && !empty($formulaire["content"])){
                    $maxSize = 5000000;
                    $validExtensions = array('jpg','gif','png');
                    
                    if ($fichier['avatar']['size'] <= $maxSize){
                        $uploadExtensions = strtolower(substr(strrchr($fichier['avatar']['name'], '.'),1));
                        $deletePreviousTitle = new \Model\PostManager();
                        $delete = $deletePreviousTitle->getPost($formulaire['id']);
                        
                        if(in_array($uploadExtensions, $validExtensions)){
                            $folder = "public/images/posts/".$formulaire['title'].".".$uploadExtensions;
                            $result = move_uploaded_file($fichier['avatar']['tmp_name'],$folder);
                            if($result){
                                $fichierImage = $formulaire['title'].".".$uploadExtensions;
                                $update = new \Model\PostManager();
                                $updatePost = $update->updatePostDB($formulaire['title'],$formulaire['content'],$_SESSION['pseudo'],$fichierImage,$formulaire['id']);
                                if(!$updatePost) {
                                    throw new Exception("Une erreur a été rencontré.");
                                }
                                else{
                                Header('location:index.php?action=admin&message=Le post a bien été modifié !');
                                unlink("public/images/posts/".$delete['images']);
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
        header('Location: index.php?action=updatePost&id=' . $formulaire['id'] . '&message='.$e->getMessage());
    }
}

function deletePost($id) // Fonction qui permet de supprimer un billet
{
    try{
        if(isset($_SESSION['pseudo'])){

            if (isset($id) && ((int)$id)) {

                $getAllPosts = new \Model\PostManager();
                $posts = $getAllPosts->getPosts();

                for($i = 0 ; $i < count($posts) ; $i++){
                    $tableau[] = $posts[$i]['id']; 
                }
                if (!in_array($id, $tableau)) {
                    throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$id . "</span>" . " n'existe pas.");
                }
                else{

                $deletePreviousTitle = new \Model\PostManager();
                $delete = $deletePreviousTitle->getPost($id);
                $titleDelete = $delete['images'];

                $postManagerDeletePosts = new \Model\PostManager();
                $deletePost = $postManagerDeletePosts->deletePost($id);
                
                }
                if ($deletePost === false) {
                    throw new Exception("Une erreur a été rencontré.");
                }
                else {
                    unlink("public/images/posts/".$titleDelete);
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
        if(isset($_SESSION['pseudo'])){
            if (isset($idComment) && ((int)$idComment)) {

                $getAllComments = new \Model\CommentManager();
                $getComments = $getAllComments->getAllComments();

                for($i = 0 ; $i < count($getComments) ; $i++){
                    $tableau[] = $getComments[$i]['id']; 
                }
                if (!in_array($idComment, $tableau)) {
                    throw new Exception("Désolé, le commentaire n° " . "<span class='cible_Erreur'>" .$idComment . "</span>" . " n'existe pas.");
                }
                else{

                    $allow = new \Model\CommentManager();

                    $allowingComment = $allow->allowCommentDB($idComment);

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
        if(isset($_SESSION['pseudo'])){
            if(isset($id) && ((int)$id)) {

                $getAllComments = new \Model\CommentManager();
                $getComments = $getAllComments->getAllComments();

                for($i = 0 ; $i < count($getComments) ; $i++){
                    $tableau[] = $getComments[$i]['id']; 
                }
                if (!in_array($id, $tableau)) {
                    throw new Exception("Désolé, le commentaire n° " . "<span class='cible_Erreur'>" .$id . "</span>" . " n'existe pas.");
                }
                else{

                    $deleteComment = new \Model\CommentManager();

                    $confirmDeleteComment = $deleteComment->deleteComment($id);

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

function deleteCommentAdmin($commentid,$postid) // Fonction qui permet de supprimer un commentaire signalé
{
    try{
        if(isset($_SESSION['pseudo'])){
            if(isset($postid) && ((int)$postid)) {

                $getAllPosts = new \Model\PostManager();
                $posts = $getAllPosts->getPosts();

                for($i = 0 ; $i < count($posts) ; $i++){
                    $tableau[] = $posts[$i]['id']; 
                }
                if (!in_array($postid, $tableau)) {
                    throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$postid . "</span>" . " n'existe pas.");
                }
                else{

                    if(isset($commentid) && ((int)$commentid)) {

                        $getAllComments = new \Model\CommentManager();
                        $getComments = $getAllComments->getAllComments();

                        for($i = 0 ; $i < count($getComments) ; $i++){
                            $tableau[] = $getComments[$i]['id']; 
                        }
                        if (!in_array($commentid, $tableau)) {
                            throw new Exception("Désolé, le commentaire n° " . "<span class='cible_Erreur'>" .$commentid . "</span>" . " n'existe pas.");
                        }
                        else{
                            $deleteComment = new \Model\CommentManager();

                            $confirmDeleteComment = $deleteComment->deleteComment($commentid);

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
