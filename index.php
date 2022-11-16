<?php

require('controllers/controller.php');

if(isset($_GET["action"])){
    if($_GET["action"] == "products"){
        if(isset($_GET["idProduct"])){
            afficherProduit($_GET["idProduct"]);
        }    
    }
    else if ($_GET["action"]=="home"){
        afficherProduits(1);
    }
    else if ($_GET["action"]=="additem"){
        if(isset($_GET["idOrder"]) && isset($_GET["idProduct"])){
            $idOrder = ajourterPanier($_GET["idProduct"], $_GET["idOrder"]);
            afficherProduits(1);
        }     
    }
    else if($_GET["action"] == "panier"){
        
        if(isset($_POST["updateCart"])) {
              modifierPanier($_GET["idProduct"], $_GET["idOrder"], $_POST['cart_quantity']);
              afficherPaniers();
        }
        else if (isset($_POST["removeFromCart"])){
            supprimerPanier($_GET["idProduct"], $_GET["idOrder"]);
            afficherPaniers();
        } else{
            afficherPaniers();
        }
        //supprimerPanier(5, 1);
        // modifierPanier($_GET["idProduct"], $_GET["idOrder"], $_POST['cart_quantity']);
    }   

}