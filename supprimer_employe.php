<?php
include 'config.php';

// Vérifier si un ID est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer l'employé de la base de données
    $sql = "DELETE FROM employe WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo "✅ Employé supprimé avec succès !";
} else {
    echo "❌ Aucun employé sélectionné.";
}
?>

<a href="liste_employes.php">Retour à la liste des employés</a>
