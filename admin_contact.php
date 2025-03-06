<?php
require_once "config.php"; // Connexion à la base de données
session_start();

// Vérification de l'authentification 
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== true) {
    header("Location: login.php"); // Redirige vers la page de connexion si non connecté
    exit();
}

// Récupération des messages de contact
$stmt = $pdo->query("SELECT * FROM contact ORDER BY sujet DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Messages Contact</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>
    <header>
        <h1>📩 Messages reçus</h1>
        <a href="dashboard.php">⬅ Retour au tableau de bord</a>
    </header>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?= htmlspecialchars($msg['id']) ?></td>
                    <td><?= htmlspecialchars($msg['email']) ?></td>
                    <td><?= htmlspecialchars($msg['sujet']) ?></td>
                    <td><?= htmlspecialchars($msg['message']) ?></td>
                    <td>
                        <form method="POST" action="delete_message.php" onsubmit="return confirm('Supprimer ce message ?');">
                            <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                            <button type="submit">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
