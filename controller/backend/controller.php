<?php

// Chargement des classes

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');

                               
function dataAdmin($pageCourante) // Fonction qui récupère la liste des billets page par page

{
    if(isset($_SESSION['pseudo'])){

        $postManagerAdmin = new \Model\PostManager();

        $postsAdmin = $postManagerAdmin->getPostAdmin();

        $postsParPage = 5;

        $postsTotaleReq = $postsAdmin;

        $postsTotales = $postsTotaleReq->rowCount(); // On compte le nombre de posts

        $pagesTotales = ceil($postsTotales/$postsParPage); // On divise le nombre de post par le nombre de post par page, pour avoir le nombre de page totale
    
        $depart = ($pageCourante-1)*$postsParPage; // On fixe un point de départ, qui correspond à la page actuel x le nombre de page.
        
        $postManagerAdmin2 = new \Model\PostManager();

        $postsAdminPage = $postManagerAdmin2->getPostsPage($depart,$postsParPage); // On récupère les posts page par page

        require('view/backend/admin.php');
    }
    else{
        require('view/frontend/forbidden.php');
    }
}

function adminCommentReport($pageCouranteComments) {

    if(isset($_SESSION['pseudo'])){

        $commentReport = new \Model\CommentManager();

        $commentsReporting = $commentReport->getCommentsReport();


        $commentsParPage = 3;

        $commentsTotaleReq = $commentsReporting;

        $commentsTotales = $commentsTotaleReq->rowCount();  // On compte le nombre de posts


        $pagesTotalesComments = ceil($commentsTotales/$commentsParPage); // On divise le nombre de commentaires par le nombre de commentaires par page, pour avoir le nombre de page totale

    

        $departComments = ($pageCouranteComments-1)*$commentsParPage; // On fixe un point de départ, qui correspond à la page actuel x le nombre de commentaires.

        $commentsByPage = new \Model\CommentManager();

        $getCommentsByPage = $commentsByPage->getCommentsReportByPage($departComments,$commentsParPage); // On récupère les commentaires page par page


        require('view/backend/commentAdmin.php');
    }
    else{
        require('view/frontend/forbidden.php');
    }


}

function updatePost($id) // Fonction qui récupère le billet à modifier (afin de l'insérer dans un formulaire pour le modifier)
{
    if (isset($id) && $id > 0) {
        $postUpdate = new \Model\PostManager();

        $postUp = $postUpdate->getPost($id);

        require('view/backend/updateNews.php');
    }
    else{
        require('view/frontend/error.php');
    }
}

function confirmUpdatePost($idUpdate, $titleUpdate, $contentUpdate) // Fonction qui modifie le billet
{
    try{

        if(!isset($idUpdate) && $idUpdate < 0) {
            require('view/frontend/error.php');
        }
        else if(empty($titleUpdate)){
            throw new Exception('Impossible d\'envoyer votre post, le titre n\'a pas été renseigné');
        }
        else if(empty($contentUpdate)) {
            throw new Exception('Impossible d\'envoyer votre post, le contenu n\'a pas été renseigné');
        }
        else{

            $confirmPostUpdate = new \Model\PostManager();

            $confirmUp = $confirmPostUpdate->updatePostDB($idUpdate, $titleUpdate, $contentUpdate);


            if ($confirmUp === false) {
                require('view/frontend/error.php');
            }
            else {
                
                header('Location: index.php?action=admin&update'); 

            }
        }
    }
    catch (Exception $e){
        require('view/frontend/error.php');
        ?>
        <script>document.getElementById("paragraphe_Error").innerHTML = "<?= $e->getMessage(); ?>";</script>
        <?php

    }
}

function addPost($title, $content) // Fonction qui permet d'ajouter un billet
{
    try{

        if (empty($title)){
            throw new Exception('Impossible d\'envoyer votre post, le titre n\'a pas été renseigné');
        }
        else if(empty($content)) { 
            throw new Exception('Impossible d\'envoyer votre post, le contenu n\'a pas été renseigné');
        }
        else{

            $newPost = new \Model\PostManager();

            $addedPost = $newPost->addPost($title, $content);

            if ($addedPost === false) {
                require('view/frontend/error.php');
            }
            else {
                header('Location: index.php?action=admin&add'); 
            }
        }
    }
    catch (Exception $e){
        require('view/frontend/error.php');
        ?>
        <script>document.getElementById("paragraphe_Error").innerHTML = "<?= $e->getMessage(); ?>";</script>
        <?php

    }
}   

function deletePost($id) // Fonction qui permet de supprimer un billet
{
    if(isset($id) && $id > 0) { 

        $postManagerDeletePosts = new \Model\PostManager();

        $deletePost = $postManagerDeletePosts->deletePost($id);

        if ($deletePost === false) {
            require('view/frontend/error.php');
        }
        else {
            header('Location: index.php?action=admin&delete'); 
        }
    }
    else{
        require('view/frontend/error.php');
    }

}

function allowComment($idComment) // Fonction qui autorise un commentaire signalé
{
    if (isset($idComment) && $idComment > 0) {

        $allow = new \Model\CommentManager();

        $allowingComment = $allow->allowCommentDB($idComment);

        if ($allowingComment === false) {
            require('view/frontend/error.php');
        }
        else {
            header('Location: index.php?action=adminreport&allow');
        }
    }
    else{
        require('view/frontend/error.php');
    }
}

function deleteComment($id) // Fonction qui permet de supprimer un commentaire signalé
{
    if(isset($id) && $id > 0) {

        $deleteComment = new \Model\CommentManager();

        $confirmDeleteComment = $deleteComment->deleteComment($id);

        if ($confirmDeleteComment === false) {
            require('view/frontend/error.php');
        }
        else {
            header('Location: index.php?action=adminreport&deleteComment'); 
        }
    }
    else{
        require('view/frontend/error.php');
    }
}

function deleteCommentAdmin($id,$postid) // Fonction qui permet de supprimer un commentaire signalé
{
    if(isset($id) && $id > 0  && isset($postid) && $postid > 0) {

        $deleteComment = new \Model\CommentManager();

        $confirmDeleteComment = $deleteComment->deleteComment($id);

        if ($confirmDeleteComment === false) {
            require('view/frontend/error.php');
        }
        else {
            header('Location: index.php?action=post&deleteAdminok&id=' . $postid);
        }
    }
    else{
        require('view/frontend/error.php');
    }
}

function disconnect () { // Fonction qui permet la deconnexion de l'admin
    
    session_unset();
    session_destroy();
    listPostsHome();
}
function getAddPage() {
    require('view/backend/addPost.php');
}
function forbidden() {
    require('view/frontend/forbidden.php');
}
