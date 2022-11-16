<!-----------Session----------->
<?php
    session_start();   
?>

<base href="http://phptest/TP3_YL_LYJ/" />
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/style.css">
    <title><?= $title ?></title>
</head>
<body>
    <header id="SwitchBG" class="">
        <a href="index.php?action=home" style="text-decoration: none;">
            <div class="logo">
                <img src="public/images/shopping-cart.png" alt="logo">
                <p class="logo_text">Bon Voisin Magasin</p>
            </div>
        </a>
         <div class="nav">
                <li><a href="index.php?action=home">Produits</a></li>
                 <li>
                     <a href="index.php?action=panier">Panier
                        <span class="cart_number"><i class="fa fa-cart-plus" style="font-size:1.2rem; color:aliceblue; margin-right: 0.2rem;"></i>( <?= $cartcounts ?> )</span>
                     </a>
                </li>
         </div>
    </header>

    <main>

        <?= $content ?>

    </main>

    <footer id="switchBGfooter" class="">
        <p class="copyright">© 2022 All rights reserved. By Yang Li et Yongjiang Liu.</p>
        <div class="date_box">
            <p>Date et heure du jour: <?php $date = new DateTime("now", new DateTimeZone('America/Montreal') );
                echo $date->format('Y-m-d H:i:s');?></p>
            <p>Date modified: <?= $dateModify="2022-11-08"; ?> </p>
        </div>
    </footer>

    <script src="public/main.js"></script>


</body>
</html>