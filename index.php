<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- inclusion de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- inclusion de votre propre fichier CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">MonSite</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inscription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container">
        <div class="jumbotron">
            <h1 class="display-4">Bienvenue sur MonSite !</h1>
            <p class="lead">Ceci est un site</p>
            <hr class="my-4">
            <p>Vous pouvez vous inscrire ou vous connecter pour accéder à plus de fonctionnalités.</p>
            <a class="btn btn-primary btn-lg" href="inscription.php" role="button">Inscription</a>
            <a class="btn btn-secondary btn-lg" href="connexion.php" role="button">Connexion</a>
        </div>
    </main>

    <footer class="footer bg-light mt-auto py-3">
        <span class="text-muted">© 2023 MonSite. Tous droits réservés.</span>
    </footer>

    <!-- inclusion de jQuery et Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
