
<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "❌ Accès refusé. Seuls les administrateurs peuvent voir cette page.";
    exit;
}
?>

<?php 
// Inclure le fichier de connexion  
require_once 'config.php'; 

// Requête pour récupérer les animaux 
$sql = "SELECT * FROM utilisateur"; // Remplace "utilisateur" par le nom de ta table
$pdo->query($sql); // Afficher les résultats 
$stmt = $pdo->query($sql); // Afficher les résultats 
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    echo "ID: " . $row['id'] . " - Nom: " . $row['nom'] . " - Role: " . $row['role'] . "<br>"; 
    } 
?>