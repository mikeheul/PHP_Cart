<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li>
                    <a class="nav-link" href="recap.php"> 
                        Récap
                        <span class="badge badge-pill bg-dark"><?= getWholeQuantity() ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <?= getMessages() ?>

</header>