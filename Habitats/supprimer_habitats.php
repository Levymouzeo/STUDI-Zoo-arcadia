<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM habitat WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo "✅ Habitat supprimé avec succès !";
    header("Location: liste_habitats.php");
    exit;
}
?>
