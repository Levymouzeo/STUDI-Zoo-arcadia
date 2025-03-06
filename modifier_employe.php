<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de l'animal
    $sql = "SELECT * FROM employe WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $employe = $stmt->fetch();

    if (!$employe) {
        echo "❌ Employé non trouvé.";
        exit;
    }
}

// Mettre à jour l'animal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $poste = $_POST['poste'];
    $departement = $_POST['departement'];
    $date_embauche = $_POST['date_embauche'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $salaire = $_POST['salaire'];
  
   

    $sql = "UPDATE employe SET nom = :nom, date_naissance = :date_naissance, poste = :poste,departement=:departement,date_embauche = :date_embauche, email = :email, telephone = :telephone,adresse=:adresse,salaire =:salaire  WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':date_naissance' => $date_naissance,
            ':poste' => $poste,
            ':departement' => $departement,
            ':date_embauche' => $date_embauche,
            ':email' => $email,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':salaire' => $salaire,
    ]);

    echo "✅Employé modifié avec succès !";
} 


// Formulaire pré-rempli
?>
<style>
    form {
        margin-top: 20px;
    }
    label {
        display: block;
        margin-top: 10px;
    }
    input, select {
        margin-top: 5px;
        padding: 5px;
        width: 200px;
    }
    button {
        margin-top: 10px;
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
</style>
<form method="POST">
    ID : <input type="number" name="id" required><br>
    Nom : <input type="text" name="nom" required><br>
    Prenom : <input type="text" name="prenom" required><br>
    Date de naissance : <input type="date" name="date_naissance" required><br>
    Poste : <input type="text" name="poste" required><br>
    Departement : <input type="text" name="departement" required><br>
    Date d'embauche : <input type="date" name="date_embauche" required><br>
    Email : <input type="email" name="email" required><br>
    Telephone : <input type="number" name="telephone" required><br>
    Adresse : <input type="text" name="adresse" required><br>
    Salaire : <input type="number" name="salaire" required><br>
    <button type="submit">Modifier</button>
</form> 


