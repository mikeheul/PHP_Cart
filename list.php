<?php
    session_start();
    ob_start();

    if(!isset($_SESSION['products']) || empty($_SESSION['products'])) :
        echo "<p>Aucun produit en session...</p>";
    else : ?>
        <div class="cards">
        <?php foreach($_SESSION["products"] as $index => $product) : ?>  
            <div class="card" style="width: 30rem;">
                <img class="card-img-top" src="img/<?= $product['file'] ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><a href="traitement.php?action=detail&id=<?= $index ?>"><?= $product['name'] ?></a></h5>
                    <h6><?= $product["price"] ?>&nbsp;&euro;</h6>
                </div>
            </div>
        
        <?php endforeach; ?>
        </div>
    
    <?php endif;

    $contenu = ob_get_clean();
    $title = "Liste des produits";
    require "template.php";