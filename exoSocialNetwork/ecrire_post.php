<?php
// On appelle la session
session_start();
// appeler la connexion à la base
require 'connexion/connect.php';
// Appeler le fichier de la fonction 
require 'utils/function_ecrire_post.php';
// inclure le header
require 'partials/header.php';


//appel de la fonction pour insérer un post
//initialiser le tableau des erreurs éventuelles
//pour permettre son affichage
$errors = insert_Post($mysqlClient);


//si un utilisateur est bien connecté
//alors il peut écrire un post
if (isset($_SESSION['nom'])): ?>
    <!-- Formulaire écrire post - UNIQUEMENT pour utilisateur connecté -->
    <div class="form-container">
        <h2>Écrire un nouveau post</h2>

        <!-- Si des erreurs ont été enregistrées lors de la vérification du formulaire, affichage ici -->
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <?php echo $error; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-field">
                <label for="contenu">Contenu du post</label>
                <textarea class="contenu" name="contenu" rows="4" cols="50" required placeholder="Écrivez votre message"><?php echo isset($_POST['contenu']) ? htmlspecialchars($_POST['contenu']) : ''; ?></textarea>
            </div>

            <div class="form-field">
                <label for="date_publication">Date de la publication du post</label>
                <input class="date_publication" type="date" id="date_publication" name="date_publication" required value="<?php echo isset($_POST['date_publication']) ? htmlspecialchars($_POST['date_publication']) : ''; ?>">
            </div>

            <button class="submit" type="submit" name="send">Publier</button>
        </form>
    </div>
<?php endif; ?>

<?php
// Inclure le footer
require 'partials/footer.php';
?>