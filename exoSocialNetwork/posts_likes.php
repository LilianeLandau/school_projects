<?php
// On appelle la session
session_start();
// appeler la connexion à la base
require 'connexion/connect.php';

// Appeler les fichiers des fonctions nécessaires
require 'utils/function_ecrire_post.php';
require 'utils/function_afficher_posts_et_utilisateurs_et_likes.php';
require 'utils/function_ajouter_aime.php';

// inclure le header
require 'partials/header.php';

?>


<h1>Posts & Likes</h1>


<?php if (isset($_SESSION['nom'])): ?>
   <p>Bonjour <b><?php echo ($_SESSION['nom'])   ?></b>, cliquez pour écrire un nouveau post :
      <a href="ecrire_post.php" class="submit inline">Écrire un post</a>
   </p>
<?php endif; ?>





<?php

//Appel de la fonction pour ajouter un aime
ajouter_Aime($mysqlClient);
//Appel fonction pour afficher les posts et les utilisateurs
afficher_Posts_et_Utilisateurs_et_Likes($mysqlClient);


?>







<?php
// inclure le footer';
require 'partials/footer.php';
?>