<?php
// Votre code de connexion à la base de données ici

session_start();

// Vérifiez si l'utilisateur est connecté et si c'est l'admin
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["login"] !== "admin") {
    // Si non, redirigez vers la page de connexion
    header("Location: connexion.php");
    exit();
}

// Récupérez tous les utilisateurs de la base de données
$stmt = $conn->prepare("SELECT * FROM utilisateurs");
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

// Fermeture de la déclaration
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Administration</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user["id"]; ?></td>
                    <td><?php echo $user["login"]; ?></td>
                    <td><?php echo $user["prenom"]; ?></td>
                    <td><?php echo $user["nom"]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
