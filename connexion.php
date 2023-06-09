<?php
// Votre code de connexion à la base de données ici

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Vérifiez si les champs ne sont pas vides
    if (empty($login) || empty($password)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        // Préparation de la requête
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $stmt->bind_param("s", $login);

        // Exécution de la requête
        $stmt->execute();

        // Récupération du résultat
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Vérification du mot de passe
            if (password_verify($password, $user["password"])) {
                // Création des variables de session
                $_SESSION["login"] = $user["login"];
                $_SESSION["prenom"] = $user["prenom"];
                $_SESSION["nom"] = $user["nom"];
                $_SESSION["logged_in"] = true;

                // Redirection vers la page de profil
                header("Location: profil.php");
                exit();
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec ce login.";
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
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" id="login" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</body>
</html>
