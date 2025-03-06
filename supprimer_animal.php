<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM animal WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo "✅ Animal supprimé avec succès !";
    header("Location: liste_animaux.php"); // Redirection après suppression
    exit;
}
?>
