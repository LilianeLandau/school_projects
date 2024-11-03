
<?php
/***************************************************************************************************************************************/
// FONCTION POUR AFFICHER LES UTILISATEURS DANS TABLE HTML

//$mysqlClient en paramètre afin que la fonction accède à la connexion
//$mysqlClient en paramètre permet à la fonction de communiquer avec la BDD
//Dans PHP on a besoin d'une connexion active à la BDD
//cette connexion est représentée par l'objet $mysqlClient
//Cet objet $mysqlClient a été créé dans un autre fichier connect.php
//En passant $mysqlClient en paramètre de la fonction 
//la fonction peut accéder à la BDD sans avoir besoin
//de créer une nouvelle connexion

function afficher_Utilisateurs($mysqlClient)
{
    //connexion BDD et affichage
    //demander tout le contenu de la table utilisateur
    //ordonner par nom
    $sqlQuery = 'SELECT * FROM utilisateur ORDER by nom';
    //prepare la demande de données
    $statement = $mysqlClient->prepare($sqlQuery);
    //exécute la demande de données
    $statement->execute();
    //affiche les données demandées sous forme d'objet
    $utilisateurs = $statement->fetchAll(PDO::FETCH_OBJ);
    // Afficher début tableau HTML
    echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                </tr>
            </thead>
            <tbody>';

    // Boucle foreach pour générer et remplir chaque ligne du tableau
    foreach ($utilisateurs as $utilisateur) {
        echo "<tr><td>" . htmlspecialchars($utilisateur->id) . "</td><td>" .
            htmlspecialchars($utilisateur->nom) . "</td></tr>";
    }
    //afficher fin tableau HTML
    echo '</tbody></table>';
}

/***************************************************************************************************************************************/
