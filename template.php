<?php
    require_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Store - Product | <?= $title ?></title>
    </head>
    <body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a class="nav-link" href="list.php"> 
                            Liste des produits
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="recap.php"> 
                            <?php $class = (getWholeQuantity() > 0) ? "success" : "danger"; ?>
                            Récap <span class="badge badge-pill bg-<?= $class ?>"><?= getWholeQuantity() ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Message flash -->
        <?= getMessages() ?>
        </header>

        <div id="wrapper">
            <main class="container">
                <!-- Injection du contenu -->
                <?= $contenu ?>
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>