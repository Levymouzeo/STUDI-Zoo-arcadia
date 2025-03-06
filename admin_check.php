<?php
include 'config.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit;
}

// Vérifie si l'utilisateur est administrateur
if ($_SESSION['user_role'] !== 'admin') {
    echo "❌ Accès refusé. Seuls les administrateurs peuvent voir cette page.";
    exit;
}

// Affichage du message de bienvenue
echo "Bienvenue, " . $_SESSION['user_name'] . "!<br>";
echo "⚡ Vous êtes un administrateur.";
?>
<a href="logout.php">Déconnexion</a>
