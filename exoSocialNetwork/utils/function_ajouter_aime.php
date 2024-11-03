<?php

/********************************************************************************/
//FUNCTION AJOUTER UN AIME
function ajouter_Aime($mysqlClient)
{

    // Initialiser l'ID du post à liker à null
    $id_post = null;

    //MODIFIER UN POST ECRIT PAR SON AUTEUR
    //VERIFICATIONS DE BASE : UTILISATEUR CONNECTE ? ID DU POST TRANSMISE DANS URL ?
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['nom'])) {
        //Récupér nom utilisateur dans session
        $nom = $_SESSION['nom'];

        //Vérifier que le id 
        //du post à liker est bien dans l'URL
        if (isset($_GET['id_post'])) {
            //Sauvegarder le id du post choisi dans une variable
            $id_post = $_GET['id_post'];

            //Etant donné que le NOM de l'utilisateur est stocké dans la session
            //On peut à partir de cette donnée faire une requête à  la BDD 
            //pour obtenir le id de l'utilisateur 
            //Requête à la BDD pour obtenir le id correspondant au nom
            $sqlQuery = "SELECT id FROM utilisateur WHERE nom=:nom";
            //Préparation de la requête
            //La requête attend de savoir quelle valeur attribuer à :nom dans le SELECT
            $statement = $mysqlClient->prepare($sqlQuery);
            //On indique à la requête qu'il faut lier le nom 
            //contenu dans le SELECT et noté :nom
            //à la variable $nom 
            //La variable $nom a été créée plus haut. 
            //Elle contient le nom stocké dans la session
            $statement->bindParam(':nom', $nom);
            //Exécution de la requête
            //Ici la requête lie :nom à $nom
            $statement->execute();
            //Le résultat du execute() est stocké dans 
            //le tableau associatif $utilisateur
            $utilisateur = $statement->fetch(PDO::FETCH_ASSOC);

            //Si on a bien trouvé l'utilisateur dans la BDD
            if ($utilisateur) {
                //Si cet utilisateur existe bien
                //alors son id, contenu dans $utilisateur['id]
                //est stocké dans une variable $utilisateur_id
                $utilisateur_id = $utilisateur['id'];
                //A ce stade on a le nom de l'utilisateur(provenant de la session)
                //Le nom de l'utilisateur est stocké dans la variable $nom
                //Grâce à la requête SELECT WHERE cherchant le id correspondant au nom
                //on dispose aussi du id de l'utilisateur
                //Le id de l'utilisateur est stocké dans la variable $utilisateur_id
                //on dispose aussi du id du post à liker, stocké dans $id_post =$_GET['id_post]
                //on dispose des informations nécessaire spour insérer un aime dans la BDD

                // Requête pour insérer AIME
                $sqlQuery = "INSERT INTO aime (post_id, utilisateur_id, date_like) VALUES (:post_id, :utilisateur_id, NOW())";

                // Préparation de la requête
                $statement = $mysqlClient->prepare($sqlQuery);
                //on peut lier les paramètres :post_id et  :utilisateur_id 
                //aux variables
                $statement->bindParam(':post_id', $id_post);
                $statement->bindParam(':utilisateur_id', $utilisateur_id);
            }

            // Exécuter la requête d'insertion              
            if ($statement->execute()) {
                //Rediriger utilisateur vers la page des posts
                header('Location: posts_likes.php');
                exit();
            } else {
                //si une erreur s'est produite lors de l'insertion
                $errors[] = "<p class='text-danger'>Désolés. Une erreur s'est produite.</p>";
            }
        }
    }
}
