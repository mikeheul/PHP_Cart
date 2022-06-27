<?php
    session_start();

    if(isset($_GET['action'])){

        switch($_GET['action']){
            
            //* ------------------- AJOUTER UN PRODUIT -------------------------
            case "add":
                if(isset($_POST["submit"])) {

                    // filtrer les inputs du formulaire
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                    $desc = filter_input(INPUT_POST, "desc", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    // récupérer les infos de l'image uploadée
                    if(isset($_FILES['file'])){

                        $tmpName = $_FILES['file']['tmp_name'];
                        $nameImg = $_FILES['file']['name'];
                        $size = $_FILES['file']['size'];
                        $error = $_FILES['file']['error'];

                        // récupérer l'extension du fichier uploadé
                        $tabExtension = explode('.', $nameImg);
                        $extension = strtolower(end($tabExtension));
                        //Tableau des extensions acceptées
                        $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                        //Taille max acceptée
                        $maxSize = 400000;
                        
                        // vérifier si l'extension est autorisée et si la taille n'excède pas le quota imposé
                        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                            // générer un identifiant unique pour le nom du fichier
                            //uniqid génère un identifiant : 5f586bf96dcd38.73540086
                            $uniqueName = uniqid('', true);
                            $file = $uniqueName.".".$extension;
                            //$file = 5f586bf96dcd38.73540086.jpg
                            // uploader l'image dans le dossier img du projet
                            move_uploaded_file($tmpName, 'img/'.$file);

                            // si les filtres sont ok, ajouter le produit en session
                            if($name && $price && $qtt && $desc){
                    
                                // construction du produit (nom, prix, quantité, description et image)
                                $product = [
                                    "name" => $name,
                                    "price" => $price,
                                    "qtt" => $qtt,
                                    "desc" => $desc,
                                    "file" => $file
                                ];
                    
                                // ajouter le produit en session
                                $_SESSION["products"][] = $product;

                                // var_dump($_SESSION["products"]);
                                // die();

                                // afficher le message de confirmation d'ajout du produit en session
                                $_SESSION["message"] = "Produit enregistré avec succès !";
                            }
                            else $_SESSION["message"] = "Les données saisies sont incorrectes !";
                        }
                        else $_SESSION["message"] = "Mauvaise extension ou taille de fichier dépassée";
                    }
                    else $_SESSION["message"] = "Fichier non défini !";
                }
                else $_SESSION["message"] = "Vous devez soumettre le formulaire !";

                break;

            //* ------------------- SUPPRIMER UN PRODUIT -------------------------    
            case "delete":
                // vérifier si le paramètre "id" est défini dans l'URL et vérifier si le produit existe en session
                if(isset($_GET["id"]) && isset($_SESSION["products"][$_GET["id"]])){
                    $deletedProd = $_SESSION["products"][$_GET["id"]];
                    // supprimer l'image rattachée au produit
                    unlink("img/". $deletedProd["file"]);
                    // supprimer le produit de la session
                    unset($_SESSION["products"][$_GET["id"]]);
                    // afficher le message de confirmation de suppression
                    $_SESSION["message"] = "Le produit <strong>".$deletedProd["name"]."</strong> a été supprimé !";
                    // redirection
                    header("Location: recap.php");
                    die();
                }
                else $_SESSION["message"] = "Action impossible !";
                break;

            //* ------------------- VIDER LE PANIER -------------------------
            case "clear": 
                foreach($_SESSION["products"] as $index => $product){
                    // supprimer toutes les images uploadées en rapport avec les produits en session
                    unlink("img/". $_SESSION["products"][$index]["file"]);
                }
                // supprimer le tableau de produits en session
                unset($_SESSION["products"]);
                // afficher le message de confirmation du panier vidé
                $_SESSION["message"] = "Le panier a été vidé !";
                // redirection
                header("Location: recap.php");
                die();
                break;

            //* ------------------- AUGMENTER LA QUANTITÉ D'UN PRODUIT -------------------------
            case "up-qtt": 
                // vérifier si le paramètre "id" est défini dans l'URL et vérifier si le produit existe en session
                if(isset($_GET["id"]) && isset($_SESSION["products"][$_GET["id"]])){
                    // incrémenter la quantité courante du produit passé en paramètre
                    $_SESSION["products"][$_GET["id"]]["qtt"]++;
                    // redirection
                    header("Location: recap.php");
                    die();
                }
                else $_SESSION["message"] = "Action impossible !";
                break;

            //* ------------------- DIMINUER LA QUANTITÉ D'UN PRODUIT -------------------------
            case "down-qtt": 
                // vérifier si le paramètre "id" est défini dans l'URL et vérifier si le produit existe en session
                if(isset($_GET["id"]) && isset($_SESSION["products"][$_GET["id"]])){
                    // décrémenter la quantité courante du produit passé en paramètre
                    $_SESSION["products"][$_GET["id"]]["qtt"]--;
                    // si la quantité est de 0, on supprime le produit de la session
                    if($_SESSION["products"][$_GET["id"]]["qtt"] == 0){
                        // supprimer l'image associée au produit
                        unlink("img/". $_SESSION["products"][$_GET["id"]]["file"]);
                        // afficher le message de confirmation du produit supprimé
                        $_SESSION["message"] = "Le produit ". $_SESSION['products'][$_GET['id']]['name'] ." a été supprimé !";
                        // supprimer le produit en session
                        unset($_SESSION["products"][$_GET["id"]]);
                    }
                    // redirection
                    header("Location: recap.php");
                    die();
                }
                else $_SESSION["message"] = "Action impossible !";
                break;
            
            //* ------------------- AFFICHER LE DÉTAIL D'UN PRODUIT -------------------------
            case "detail":
                // vérifier si le paramètre "id" est défini dans l'URL et vérifier si le produit existe en session
                if(isset($_GET["id"]) && isset($_SESSION["products"][$_GET["id"]])){
                    // redirection vers la page dédiée au produit
                    header("Location: detail.php?id=".$_GET["id"]);
                    die();
                }
                else $_SESSION["message"] = "Action impossible !";
                break;
        }
    }

    header("Location: index.php");