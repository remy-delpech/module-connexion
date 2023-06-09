<?php
// Votre code de connexion à la base de données ici

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez les données entrantes et insérez l'utilisateur dans la base de données
    $login = $_POST["login"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validation de base : vérifiez si les champs sont vides et si les mots de passe correspondent
    if (empty($login) || empty($prenom) || empty($nom) || empty($password) || empty($confirm_password)) {
        echo "Veuillez remplir tous les champs.";
    } elseif ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
        // Hachage du mot de passe
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
        // Préparation de la requête
        $stmt = $conn->prepare("INSERT INTO utilisateurs (login, prenom, nom, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $login, $prenom, $nom, $password_hash);
    
        // Exécution de la requête
        if ($stmt->execute()) {
            // Si la requête a réussi, redirigez vers la page de connexion
            header("Location: connexion.php");
            exit();
        } else {
            echo "Quelque chose a mal tourné. Veuillez réessayer plus tard.";
        }
    
        // Fermeture de la déclaration
        $stmt->close();
    }    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" id="login" class="form-control">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control">
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmation du mot de passe</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Inscription</button>
        </form>
    </div>
</body>
</html>
