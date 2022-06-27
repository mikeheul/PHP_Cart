<?php
    session_start();
    ob_start();
    require "functions.php";

    if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        echo "<p>Aucun produit en session...</p>";
    }
    else{
        echo "<table class='table'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                        "<th>Actions</th>",
                    "</tr>",
                "</thead>",
                "<tbody>";
        $totalGeneral = 0;
        $totalProduits = 0;
        foreach($_SESSION["products"] as $index => $product){
            $total = $product["price"]*$product["qtt"];
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td><a href='traitement.php?action=detail&id=$index'>".$product["name"]."</a></td>",
                    "<td>".number_format($product["price"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td>",
                        "<a href='traitement.php?action=down-qtt&id=$index' class='btn btn-primary btn-sm'><i class='bi-dash'></i></a>",
                        "<span class='p-2'>".$product["qtt"]."</span>",
                        "<a href='traitement.php?action=up-qtt&id=$index' class='btn btn-primary btn-sm'><i class='bi-plus'></i></a>",
                    "</td>",
                    "<td>".number_format($total, 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?action=delete&id=$index' class='btn btn-danger btn-sm'><i class='bi-trash'></i></a></td>",
                "</tr>";
            $totalGeneral += $total;
            $totalProduits += $product["qtt"];
        }
            echo "<tr>",
                // "<td>Nombre de produits : ".getWholeQuantity()."</td>",
                    "<td>Nombre de produits : ".$totalProduits."</td>",
                    "<td colspan=3>Total général : </td>",
                    "<td colspan=2><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "</tr>",
            "</tbody>",
        "</table>";

        echo "<p><a href='traitement.php?action=clear' class='btn btn-danger'>Vider le panier</a></p>";
    }

    $contenu = ob_get_clean();
    $title = "Panier";
    require "template.php";
?>
            