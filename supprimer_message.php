<?php
require_once "config.php";
session_start();

// Vérification de l'authentification admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "Accès refusé.";
    exit();
}

// Vérifier si un ID est bien envoyé
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);

    $stmt = $pdo->prepare("DELETE FROM contact WHERE id = :id");
    $stmt->execute([":id" => $id]);

    header("Location: admin_contact.php"); // Redirige après suppression
    exit();
} else {
    echo "Requête invalide.";
}
?>
