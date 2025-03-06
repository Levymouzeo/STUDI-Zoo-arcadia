<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM visite_medicale WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo "✅ Visite médicale supprimée avec succès !";
    header("Location: liste_visites.php");
    exit();
}
?>
