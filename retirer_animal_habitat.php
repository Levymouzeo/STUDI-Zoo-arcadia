<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE animal SET habitat_id = NULL WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo "✅ Animal retiré de l'habitat avec succès !";
    header("Location: liste_animaux_habitats.php");
    exit;
}
?>
