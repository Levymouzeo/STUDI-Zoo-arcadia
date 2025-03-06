<?php 
// Démarrer la session uniquement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion à PostgreSQL
try { 
    $pdo = new PDO("pgsql:host=localhost;dbname=zoo_arcadia", "postgres", "Stadta1jvtc"); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    echo "✅ Connexion réussie à PostgreSQL !"; 
} catch (PDOException $e) { 
    die("❌ Erreur de connexion : " . $e->getMessage()); 
} 
?>

