<?php
// Démarre la session
session_start();

// Connexion à la base de données
require 'connexion/connect.php';

// Appel des fonctions utiles
require 'utils/functions.php';

// Inclure le header
require 'partials/header.php';

//SUPPRIMER UN POST ECRIT PAR SON AUTEUR
//VERIFICATIONS DE BASE : UTILISATEUR CONNECTE ? ID DU POST TRANSMISE DANS URL ?
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['nom'])) {
    //Récupér nom utilisateur dans session
    $nom = $_SESSION['nom'];

    //Vérifier que le id du post à supprimer est bien dans l'URL
    if (isset($_GET['id_post'])) {
        //sauvegarder le id du post dans une variable
        $id_post = $_GET['id_post'];

        //A partir du NOM de l'utilisateur contenu dans la session
        //requête pour obtenir son id d'utilisateur dans la BDD
        $sqlQuery = "SELECT id FROM utilisateur WHERE nom = :nom";
        $statement = $mysqlClient->prepare($sqlQuery);
        $statement->bindParam(':nom', $nom);
        $statement->execute();
        $utilisateur = $statement->fetch(PDO::FETCH_ASSOC);

        //Si on a bien trouvé l'utilisateur dans la BDD
        if ($utilisateur) {
            //alors l'information : $utilisateur['id'] 
            //qui vient de la BDD, autrement dit le id de l'utilisateur,
            //est stockée dans la varible $utilisateur_id
            $utilisateur_id = $utilisateur['id'];

            //on a le nom de l'utilisateur (de la session)
            //on a aussi son id (de la requête sql qui cherche le id correspondant au nom)
            //il reste à vérifier si utilisateur est auteur du post

            //requête  - si utilisateur_id de la table post correspond bien à l'id du post
            $sqlQuery = "SELECT utilisateur_id FROM post WHERE id = :id_post";
            //préparer la requête
            $statement = $mysqlClient->prepare($sqlQuery);
            //lier paramètre à id_post qui est dans l'URL
            $statement->bindParam(':id_post', $id_post, PDO::PARAM_INT);
            //exécuter la liaison paramètre et variable
            $statement->execute();
            //chercher le post correspondant au id_post qui est dans l'URL
            $post = $statement->fetch(PDO::FETCH_ASSOC);
            //$post est un array qui contient la valeur de utilisateur_id

            if ($post) {
                //la valeur de utilisateur_id est contenue dans le tableau $post
                //la valeur de l'utilisateur connecté est stockée dans la variable $utilisateur_id
                //$utilisateur_id étant le résulat de la requête sql pour obtenir le id à partir du nom dans la session
                //comparer les deux valeurs : utilisateur_id du post à supprimer et utilisateur_id de la personne connectée
                if ($post['utilisateur_id'] == $utilisateur_id) {
                    //si les valeurs sont identiques alors supprimer le post
                    //Requête pour supprimer dans la base le post dont le id est celui transmis dans l'URL
                    $sqlQuery = "DELETE FROM post WHERE id = :id_post";
                    //préparer la requête
                    $statement = $mysqlClient->prepare($sqlQuery);
                    //lier les valeurs aux paramètres
                    $statement->bindParam(':id_post', $id_post, PDO::PARAM_INT);
                    //Exécuter la requête
                    if ($statement->execute()) {
                        echo "Le post a été supprimé avec succès.";
                        // Rediriger l'utilisateur vers la page des posts
                        header('Location: posts_likes.php');
                        exit();
                    } else {
                        echo "Une erreur s'est produite lors de la suppression du post.";
                    }
                } else {
                    // L'utilisateur n'est pas l'auteur du post
                    echo "Erreur : vous ne pouvez pas supprimer ce post, car vous n'en êtes pas l'auteur.";
                }
            } else {
                echo "Erreur : post non trouvé.";
            }
        } else {
            echo "Utilisateur non trouvé dans la base de données.";
        }
    } else {
        echo "ID de post non spécifié.";
    }
} else {
    echo "Vous devez être connecté pour supprimer un post.";
}


// Inclure le footer
require 'partials/footer.php';
