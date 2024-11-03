<?php
// Démarre la session
session_start();

// Connexion à la base de données
require 'connexion/connect.php';

// Appel des fonctions utiles
require 'utils/functions.php';

// Inclure le header
require 'partials/header.php';



/****************************************************************************************/
//FONCTION POUR UPDATE POST 

//function update_Post($mysqlClient)
//{


// Initialiser le tableau des erreurs
$errors = [];

// Initialiser l'ID du post à null
$id_post = null;


// Initialiser les variables pour éviter les erreurs si non définies
$contenu = '';
$date_publication = '';

//MODIFIER UN POST ECRIT PAR SON AUTEUR
//VERIFICATIONS DE BASE : UTILISATEUR CONNECTE ? ID DU POST TRANSMISE DANS URL ?
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['nom'])) {
    //Récupér nom utilisateur dans session
    $nom = $_SESSION['nom'];

    //Vérifier que le id 
    //du post à supprimer est bien dans l'URL
    if (isset($_GET['id_post'])) {
        //Sauvegarder le id du post choisi dans une variable
        $id_post = $_GET['id_post'];

        // var_dump($id_post);

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

            //On a désormais besoin du contenu du post à modifier
            //requête SELECT pour récupérer les champs

            $sqlQuery = "SELECT utilisateur_id, contenu, date_publication, id FROM post WHERE id=:id_post";
            //Préparer la requête
            $statement = $mysqlClient->prepare($sqlQuery);
            //le id_post est transmis dans l'URL 
            //la variable $id_post a été générée plus haut
            //à partir du contenu du $_GET['id_post] 
            //avec bindParam lier le paramètre :id_post à la variable $id_post
            $statement->bindParam(':id_post', $id_post, PDO::PARAM_INT);
            //exécuter la liaison entre paramètre et variable
            $statement->execute();
            //une fois la liaison effectuée
            //on récupère dans la variable $post un tableau
            //cet array contient la valeur de utilisateur_id
            $post = $statement->fetch(PDO::FETCH_ASSOC);

            //à ce stade on peut voir le contenu de l'array $post
            // avec un var_dump, suivi d'un exit 
            //  var_dump($post);
            // exit();

            //Il faut récupérer les données transmises par le formulaire

            // Vérification de l'autorisation de modification
            //$post : veut dire qu'un utilisateur existe
            //$post['utilisateur_id'] == $utilisateur_id) ==> on vérifie que 
            //c'est bien l'utilisateur connecté
            if ($post && $post['utilisateur_id'] == $utilisateur_id) {
                //récupérer les données du formulaire modifié
                //sauvegarder le contenu des champs transmis dans des variables

                // Vérification que la méthode est POST
                //vérifier que  le formulaire a été envoyé (send)
                //Vérifier que l'utilisateur est connecté
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send']) && isset($_SESSION['nom'])) {
                    $id_post = $_POST['id_post'];

                    $contenu = htmlspecialchars(trim($_POST['contenu']));
                    $date_publication = htmlspecialchars(trim($_POST['date_publication']));

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



                        // $contenu = $_POST['contenu'];
                        // $date_publication = $_POST['date_publication'];
                        //Requête pour modifier le post concerné
                        $sqlQuery = "UPDATE post SET contenu = :contenu, date_publication = :date_publication WHERE id = :id_post";
                        //préparer reqûete
                        $statement = $mysqlClient->prepare($sqlQuery);
                        //lier paramètres à variables
                        $statement->bindParam(':contenu', $contenu);
                        $statement->bindParam(':date_publication', $date_publication);
                        $statement->bindParam(':id_post', $id_post, PDO::PARAM_INT);

                        if ($statement->execute()) {
                            //Rediriger utilisateur vers la page des posts
                            header('Location: posts_likes.php');
                            exit();
                        } else {
                            echo "Une erreur s'est produite lors de la modification";
                        }
                    }
                }
            }
        }
    }

    // Pour faciliter la saisie de l'utilisateur
    //Pré-remplir le formulaire avec les données du post si celui-ci existe
    if ($post) {
        $contenu = $post['contenu'];
        $date_publication = $post['date_publication'];
    }
}
//}
?>
<h2>Modifier le post n° <?php echo $id_post ?></h2>



<!-- Affichage des erreurs -->
<?php

//update_Post($mysqlClient);

if (!empty($errors)): ?>
    <div>
        <?php foreach ($errors as $error): ?>
            <?php echo $error; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>





<!-- Formulaire de mise à jour du post -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] .  '?id_post=' . $id_post); ?>" method="post" novalidate>
    <!-- Champ caché pour passer l'ID du post -->
    <input type="hidden" name="id_post" value="<?php echo ($id_post);
                                                ?>">
    <div class="form-field">
        <label for="contenu">Contenu du post</label>
        <textarea class="contenu" name="contenu" rows="4" cols="50" required><?php echo htmlspecialchars($contenu); ?></textarea>
    </div>
    <div class="form-field">
        <label for="date_publication">Date de la publication du post</label>
        <input class="date_publication" type="date" id="date_publication" name="date_publication" required value="<?php echo htmlspecialchars($date_publication); ?>">
    </div>

    <button class="submit" type="submit" name="send">Publier</button>
</form>
</div>

<?php
// Inclure le footer
require 'partials/footer.php';
?>