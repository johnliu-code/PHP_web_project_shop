
<!-----------Session----------->
<?php
    session_start();   
?>
<!-----------Session method----------->
<?php 

   $orderID = 1;

?>


<!-----------Page title----------->
<?php $title = "Produits Liste"; ?>

<!-----------Body----------->
<?php ob_start();?>

<h1>Bienvenue au Magasin Bon Voisin</h1>
        
<!-----------theme button----------->
        <div class="theme">
            <button class="theme_toggle" onclick="themeSwitcher()">Clicke to change theme color</button>
        </div>

        <p>Toutes les Produits</p>

        <div class="products_list">

            <?php
            while ($data = $req->fetch())
            {
            ?>

            <form action="index.php?action=additem&idProduct=<?=$data['product_id']?>&idOrder=<?= $orderID ?>" method="post">
            <div class="product_box">
                <a href="index.php?action=products&idProduct=<?=$data['product_id']?>" style="text-decoration: none;">
                    <img src="<?= $data['img_url'] ?>" alt="Tahini Paste">
                </a>
                
                <div class="product_info">
                    <a href="index.php?action=products&idProduct=<?=$data['product_id']?>" style="text-decoration: none;">
                        <p class="product_name"><?= $data['product_name'] ?></p>
                    </a>                   
                    <p class="stock_state">Instock: <?= $data['stock_number'] ?></p>
                    <p class="price_list"><?= $data['price'] ?> CAD$</p>
                    <button type="submit" name="addTocart" id="switchBTN" class="add_to_cart initOrderId" >Ajouter a Panier</button>
                    <input type="hidden" name="product_id" value="<?=$data['product_id']?>" >   
                    <input type="hidden" name="order_id" value="<?= $orderID ?>" >             
                </div>
            </div>
            </form>
            <?php
            }
            $req->closeCursor();
            ?>

        </div>
      
<?php $content = ob_get_clean(); ?>

<!-----------template----------->  
<?php require('template.php'); ?>
