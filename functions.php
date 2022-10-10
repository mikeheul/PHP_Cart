<?php

    function getWholeQuantity(){
        $wholeQtt = 0;
        if(isset($_SESSION["products"])){
            foreach($_SESSION["products"] as $product) {
                $wholeQtt += $product["qtt"];
            }
        }
        return $wholeQtt;
    }

    function getMessages(){
        if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){
            $html = "<div id='message' class='container alert alert-primary'><p>".$_SESSION["message"]."</p></div>";
            unset($_SESSION["message"]);
            
            return $html;
        }
        return false;
    }

?>