<?php

/************************************************************************************************/
//FONCTION POUR AFFICHER LES POSTS ET LES UTILISATEURS ET LES LIKES DANS TABLE HTML

function afficher_Posts_et_Utilisateurs_et_Likes($mysqlClient)
{
    // Requête pour récupérer les posts, les utilisateurs et le nombre de likes par post
    //compter le nombre de aime pour affichage
    $sqlQuery = "SELECT post.id, post.contenu, post.date_publication, utilisateur.id
AS utilisateur_id, utilisateur.nom,
COUNT(aime.id) AS nombre_aime
FROM utilisateur
JOIN post ON utilisateur.id = post.utilisateur_id
LEFT JOIN aime ON post.id = aime.post_id
GROUP BY post.id
ORDER BY post.id DESC";

    //préparer la requête
    $statement = $mysqlClient->prepare($sqlQuery);
    //exécuter la requête
    $statement->execute();
    //afficher les donnéess ous forme d'objet
    $posts = $statement->fetchAll(PDO::FETCH_OBJ);


    // Afficher début tableau HTML
    echo '<table class="table">
    <thead>
        <tr>
            <th scope="col">Id Post</th>
            <th scope="col">Contenu</th>
            <th scope="col">Date de publication</th>
            <th scope="col">Id Utilisateur</th>
            <th scope="col">Nom Utilisateur</th>
            <th scope="col">Supprimer Post</th>
            <th scope="col">Modifier Post</th>
            <th scope="col">Cliquer pour ajouter un Like</th>
            <th scope="col">Nombre de Like pour ce post</th>
        </tr>
    </thead>
    <tbody>';

    //boucle foreach pour afficher les données dans une table
    foreach ($posts as $post) {
        //La date de publication et l'heure sont en format USA
        //je veux afficher en format européen
        // date_publication est en format USA - type : "2024-10-24 14:30:00"
        $dateUsa = $post->date_publication;

        //dans la variable $date je stocke un nouvel objet DateTime
        //cet objet DateTime contient la date au format USA
        $date = new DateTime($dateUsa);

        //j'indique que $post->date_francaise contient désormais
        //la date USA mais formatée à la française
        //format() est une méthode de l'objet DateTime
        //format() est utilisée pour convertir un ojet DateTime
        //en une chaîne de caractères formatée selon un modèle spécifié
        $post->date_francaise = $date->format('d/m/Y');
        echo "<tr>
            <td>"
            . htmlspecialchars($post->id) . "</td>
            <td>"
            . htmlspecialchars($post->contenu) . "</td>
            <td>"
            . htmlspecialchars($post->date_francaise) . "</td>
            <td>"
            . htmlspecialchars($post->utilisateur_id) . "</td>
            <td>"
            . htmlspecialchars($post->nom)
            . "
            <td><a class='btnPost' href='delete_post.php?id_post=" . htmlspecialchars($post->id) . "'>Supprimer</a></td>"
            . "<td><a class='btnPost' href='update_post.php?id_post=" . htmlspecialchars($post->id) . "'>Modifier</a></td>"
            . "<td><a class='btnPost btnLike' href='posts_likes.php?id_post=" . htmlspecialchars($post->id) . "'>
                    <span class='red-heart-icon'>
                        <svg width='16' height='16' viewBox='0 0 24 24' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z' />
                        </svg>
                    </span>Liker
                </a></td>"
            . "<td>" . htmlspecialchars($post->nombre_aime) . "</td>"
            . "
        </tr>";
    }

    //afficher fin tableau HTML
    echo '</tbody>
</table>';
}



/************************************************************************************************/
