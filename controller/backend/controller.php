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

function updatePost() // Fonction qui récupère le billet à modifier (afin de l'insérer dans un formulaire pour le modifier)
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $postUpdate = new \Model\PostManager();

        $postUp = $postUpdate->getPost($_GET['id']);

        require('view/backend/updateNews.php');
    }
    else{
        require('view/frontend/error.php');
    }
}

function getAddPage() {
    require('view/backend/addPost.php');
}     

function addPost($fichier,$title,$content,$author){
    try{
        if(empty($title) && empty($content) && empty($author)) {
            throw new Exception("Une erreur a été rencontré.");
        }
        else{
            $maxSize = 2097152;
            $validExtensions = array('jpg','jpeg','png','gif');
            
            if ($fichier['avatar']['size'] <= $maxSize){
                $uploadExtensions = strtolower(substr(strrchr($fichier['avatar']['name'], '.'),1));
                if(in_array($uploadExtensions, $validExtensions)){
                    $folder = "public/images/posts/".$title.".".$uploadExtensions;
                    $result = move_uploaded_file($fichier['avatar']['tmp_name'],$folder);
                    var_dump($result);
                    if($result){
                        $fichierImage = $title.".".$uploadExtensions;
                        $add = new \Model\AdminManager();
                        $addPost = $add->addPost($title,$content,$author,$fichierImage);
                        var_dump($addPost);
                        Header('location:index.php?action=admin&add=ok');
                    }
                    else{
                        throw new Exception("Nous avons rencontrer une erreur lors de l'importation de votre fichier.");
                    }
                }
                else{
                    throw new Exception("L\'illustration de l\'article doit être au format jpg.");
                }
            }   
            else{
                throw new Exception('L\illustration de l\'article ne doit pas dépasser 2mo.');
            }
        }
    }
    catch (Exception $e){
        require('view/frontend/error.php');
        ?>
        <script>document.getElementById("message_Error").innerHTML = "<?= $e->getMessage(); ?>";</script>
        <?php
    }
}

function confirmUpdatePost($fichier,$id,$title,$content,$author){

    try{
        if(empty($title) && empty($content) && empty($author)) {
            throw new Exception("Une erreur a été rencontré.");
        }
        else{
            $maxSize = 2097152;
            $validExtensions = array('jpg','jpeg','gif','png');
            
            if ($fichier['avatar']['size'] <= $maxSize){
                $uploadExtensions = strtolower(substr(strrchr($fichier['avatar']['name'], '.'),1));
                $deletePreviousTitle = new \Model\PostManager();
                $delete = $deletePreviousTitle->getPost($id);
                
                if(in_array($uploadExtensions, $validExtensions)){
                    if (!empty($delete['images'])){
                        unlink("public/images/posts/". $delete['images']);
                    }
                    $folder = "public/images/posts/".$title.".".$uploadExtensions;
                    $result = move_uploaded_file($fichier['avatar']['tmp_name'],$folder);
                    var_dump($fichier);
                    if($result){
                        $fichierImage = $title.".".$uploadExtensions;
                        $update = new \Model\PostManager();
                        $updatePost = $update->updatePostDB($title,$content,$author,$fichierImage,$id);
                        if(!$updatePost) {
                            throw new Exception("Une erreur a été rencontré.");
                        }
                        else{
                        Header('location:index.php?action=admin&update=ok');
                        }
                    }
                    else{
                        throw new Exception("Nous avons rencontrer une erreur lors de l'importation de votre fichier.");
                    }
                }
                else{
                    throw new Exception("Votre photo de profil doit être au format jpg, jpeg, gif ou png.");
                }
            }   
            else{
                throw new Exception('Votre photo de profil ne doit pas dépasser 2mo.');
            }
        }
    }
    catch (Exception $e){
        require('view/frontend/error.php');
        ?>
        <script>document.getElementById("message_Error").innerHTML = "<?= $e->getMessage(); ?>";</script>
        <?php
    }
}

function deletePost() // Fonction qui permet de supprimer un billet
{
    if(isset($_GET['id']) && $_GET['id'] > 0) { 

        $postManagerDeletePosts = new \Model\PostManager();

        $deletePost = $postManagerDeletePosts->deletePost($_GET['id']);

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
    if (isset($_GET['id']) && $_GET['id'] > 0) {

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
    if(isset($_GET['id']) && $_GET['id'] > 0) {

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
    if(isset($_GET['id']) && $_GET['id'] > 0  && isset($_GET['postid']) && $_GET['postid'] > 0) {

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
