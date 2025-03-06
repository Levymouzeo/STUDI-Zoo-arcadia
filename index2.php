<?php
// Connexion à PostgreSQL
$host = "localhost";
$dbname = "zoo_arcadia";
$user = "postgres";
$password = "Stadta1jvtc";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les données
    $sql = "SELECT * FROM utilisateur"; // Remplace "utilisateur" par le nom de ta table
    $stmt = $pdo->query($sql);
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; text-align: left; }
        th { background-color: #f4f4f4; }
        label {padding: 2rem; width: 100%; }
    </style>
</head>
<body>
<h2>Ajouter un utilisateur</h2>
<form action="ajouter.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required>
    
    <label for="email">Email :</label>
    <input type="email" name="email" required> 

     <label for="mot_de_passe">Mot de passe :</label>
    <input type="password" name="mot_de_passe" required>

    <button type="submit">Ajouter</button>
</form>

    <h1>Liste des Utilisateurs</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
        </tr>
        <?php foreach ($utilisateurs as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['nom']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
