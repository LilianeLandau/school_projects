<?php

/***************************************************************************************************************************************/

//FONCTION POUR INSERER UN POST - PAGE ecrire_post.php

function insert_Post($mysqlClient)
{
    //Ouvrir un tableau pour erreurs éventuelles
    $errors = [];

    // INSERTION DU NOUVEAU POST
    // Vérifie si le formulaire a été envoyé et si l'utilisateur est connecté
    if (isset($_POST['send']) && isset($_SESSION['nom'])) {
        // Sauvegarder données du POST dans variables
        //utiliser fonctions pour htmlspecialchars et trim pour sécuriser
        $contenu = htmlspecialchars(trim($_POST['contenu']));
        $date_publication = trim($_POST['date_publication']);
        $nom = $_SESSION['nom'];

        // Vérifier si contenu post pas vide
        if (empty($contenu)) {
            //Imposer un contenu au post
            $errors[] = "<p class='text-danger'>Merci de saisir un contenu</p>";
        }

        // Vérifier que date_publication pas vide et au format correst
        if (empty($date_publication)) {
            //Imposer la saisie d'une date
            $errors[] = "<p class='text-danger'>Merci de saisir une date de publication</p>";
        } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_publication)) {
            //Imposer un format de date
            $errors[] = "<p class='text-danger'>Merci de saisir une date de publication au format JJ/MM/AAAA</p>";
        }

        // Si tableau $errors est vide
        if (empty($errors)) {
            //Requête à la BDD pour obtenir le id de l'utilisateur connecté 
            //correspondant au nom contenu dans la session
            //le paramètre :nom sera associé plus tard à la variable $nom
            //en provenance du POST, grâce à bindParam
            $sqlQuery = "SELECT id FROM utilisateur WHERE nom = :nom";
            //préparation de la requête
            //la requête est mise en mémoire mais pas exécutée
            //la requête attend les bindParam pour lier de façon sécurisée
            //les paramètres aux variables issues du POST
            $statement = $mysqlClient->prepare($sqlQuery);
            //bindParam lie une variable ici $nom 
            //à un paramètre de la requête ici :nom  
            //ceci est appelé une LIAISON PAR REFERENCE        
            $statement->bindParam(':nom', $nom);
            //la variable $nom a été liée au paramètre :nom
            //lors de l'execute() la valeur de $nom est insérée dans la BDD
            $statement->execute();
            //fetch() permet de récupérer une ligne de résultat à la fois dans la BDD
            //FETCH_ASSOC indique que la ligne doit être renvoyée sous forme de tableau associatif
            //les résultats obtenus sont stockés dans $utilisateur, tableau associatif
            //les clés de ce tableau associatif sont les noms des colonnes de la table
            $utilisateur = $statement->fetch(PDO::FETCH_ASSOC);

            //on a obtenu le id, on le nom ==> l'utilisateur existe
            //utilisateur existant et connecté ==> utilisateur autorisé à insérer un post
            if ($utilisateur) {
                $utilisateur_id = $utilisateur['id'];

                // Requête pour insérer post
                $sqlQuery = "INSERT INTO post (utilisateur_id, contenu, date_publication) VALUES (:utilisateur_id, :contenu, :date_publication)";
                $statement = $mysqlClient->prepare($sqlQuery);
                $statement->bindParam(':utilisateur_id', $utilisateur_id);
                $statement->bindParam(':contenu', $contenu);
                $statement->bindParam(':date_publication', $date_publication);

                // Exécuter la requête d'insertion              
                if ($statement->execute()) {
                    //Rediriger utilisateur vers la page des posts
                    //son post s'affiche en haut du tableau
                    header('Location: posts_likes.php');
                    exit();
                } else {
                    //si une erreur s'est produite lors de l'insertion
                    $errors[] = "<p class='text-danger'>Désolés. Une erreur s'est produite lors de la publication du post. Merci de bien vouloir réessayer.</p>";
                }
            } else {
                //aucun utilisateur n'a été trouvé
                //pas de correspondance entre le nom de l'utilisateur contenu dans la session et un id en BDD
                $errors[] = "<p class='text-danger'>Désolés. Vous ne figurez pas dans notre base de données. Etes-vous bien inscrit ?</p>";
            }
        }
    }

    // Retourner tableau d'erreurs éventuelles
    return $errors;
}

/***************************************************************************************************************************************/
