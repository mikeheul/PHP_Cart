<?php
    session_start();
    ob_start();
?>

<h1>Ajouter un produit</h1>
<form action="traitement.php?action=add" method="POST" enctype="multipart/form-data">
    <div class="row">
        <label for="name" class="form-label">
            Nom du produit :
            <input id="name" type="text" name="name" class="form-control" required>
        </label>
    </div>
    <div class="row">
        <label for="price" class="form-label">
            Prix du produit :
            <input id="price" type="number" step="any" name="price" class="form-control" required>
        </label>
    </div>
    <div class="row">
        <label for="qtt" class="form-label">
            Quantité désirée :
            <input id="qtt" type="number" name="qtt" value="1" class="form-control" required>
        </label>
    </div>
    <div class="row">
        <label for="desc" class="form-label">
            Description :
            <textarea name="desc" id="desc" cols="30" rows="5" class="form-control" required></textarea>
        </label>
    </div>
    <div class="row">
        <label for="file" class="form-label">
            Image :
            <input type="file" name="file" id="file" class="form-control" required>    
        </label>
    </div>

    <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-success mx-auto mt-3 ">
    
</form>

<?php
    $contenu = ob_get_clean();
    $title = "Ajouter un produit";
    require "template.php";