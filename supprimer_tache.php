<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['tache_id'])) {
    $tache_id = $_POST['tache_id'];

    $sql = "DELETE FROM tache WHERE id = :tache_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':tache_id' => $tache_id]);

    echo "✅ Tâche supprimée avec succès !";
    header("Location: liste_taches.php");
    exit;
} else {
    echo "❌ Erreur : Aucune tâche sélectionnée.";
}
?>
