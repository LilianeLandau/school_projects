<?php
// On appelle la session
session_start();
// appeler la connexion à la base
require 'connexion/connect.php';


// Appeler le fichier de la fonction pour cette page

require 'utils/function_afficher_utilisateurs.php';

// inclure le header
require 'partials/header.php';
?>


<h1>Utilisateurs</h1>

<h2>Liste des Utilisateurs</h2>


<?php
// Appel fonction pour afficher  utilisateurs
afficher_Utilisateurs($mysqlClient);
?>



<?php
// inclure le footer';
require 'partials/footer.php';
?>