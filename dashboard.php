<?php
session_start();
include 'config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit();
}

$user_role = $_SESSION['user_role'];
$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #aaa;
        }
        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Bienvenue, <?= htmlspecialchars($user_name) ?> !</h2>

    <?php if ($user_role == 'admin') : ?>
        <p>⚡ Vous êtes un <strong>Administrateur</strong>.</p>
        <a href="liste_employes.php">🛠️ Gérer les employés</a>
        <a href="liste_paiements.php">💰 Gérer les paiements</a>

    <?php elseif ($user_role == 'employe') : ?>
        <p>🛠️ Vous êtes un <strong>Employé</strong>.</p>
        <a href="liste_animaux.php">🐾 Gérer les animaux</a>
        <a href="liste_reservations.php">📅 Gérer les réservations</a>

    <?php else :($user_role == 'visiteur') ?>
        <p>🎟️ Vous êtes un <strong>Visiteur</strong>.</p>
        <a href="ajouter_billets.php">🛒 Réserver un billet</a>
        <a href="ajouter_avis.php">📝 Laisser un avis</a>

    <?php endif; ?>

    <a href="logout.php" style="color: red;">🚪 Déconnexion</a>
</div>

</body>
</html>
