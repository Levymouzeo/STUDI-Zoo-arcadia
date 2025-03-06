<?php
$mot_de_passe_en_clair = "Vousdevezmechanger##00"; // Remplace par ton vrai mot de passe
$hash = password_hash($mot_de_passe_en_clair, PASSWORD_DEFAULT);
echo "Mot de passe haché : " . $hash;
?>
