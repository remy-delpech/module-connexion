<?php
// Votre code de connexion à la base de données ici

session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    // Si non, redirigez vers la page de connexion
    header("Location: connexion.php");
    exit();
}

// Récupérez les informations de l'utilisateur
$login = $_SESSION["login"];
$prenom = $_SESSION["prenom"];
$nom = $_SESSION["nom"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nouvelles informations
    $new_login = $_POST["login"];
    $new_prenom = $_POST["prenom"];
    $new_nom = $_POST["nom"];

    // Préparation de la requête
    $stmt = $conn->prepare("UPDATE utilisateurs SET login = ?, prenom = ?, nom = ? WHERE login = ?");
    $stmt->bind_param("ssss", $new_login, $new_prenom, $new_nom, $login);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Si la requête a réussi, mettez à jour les variables de session
        $_SESSION["login"] = $new_login;
        $_SESSION["prenom"] = $new_prenom;
        $_SESSION["nom"] = $new_nom;

        // Redirection vers la même page pour voir les nouvelles informations
        header("Location: profil.php");
        exit();
    } else {
        echo "Une erreur s'est produite. Veuillez réessayer.";
    }

    // Fermeture de la déclaration
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Profil de <?php echo $login; ?></h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" id="login" class="form-control" value="<?php echo $login; ?>">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $prenom; ?>">
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $nom; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
