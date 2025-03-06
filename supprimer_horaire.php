<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM horaire WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo "✅ Horaire supprimé avec succès !";
    header("Location: liste_horaires.php");
    exit();
}
?>
