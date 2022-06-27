<?php 
    session_start();
    ob_start();

    if(isset($_GET["id"]) && isset($_SESSION["products"][$_GET["id"]])) : 
        $product = $_SESSION["products"][$_GET["id"]]; ?>
        <img class="img" src="img/<?= $product["file"] ?>" alt="img_produit">
        <h1><?= $product["name"] ?></h1>
        <h3><?= $product["price"] ?>&nbsp;&euro;</h3>
        <p><?= $product["desc"] ?></p>
    <?php endif ?>

<?php
    $contenu = ob_get_clean();
    require "template.php";