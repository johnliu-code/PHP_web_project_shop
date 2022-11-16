
<?php
//Get cart items number and passe to pages
    $cartcounts = $reqCarts->RowCount();
    
    $orderID = 1;
?>


<!-----------Page title----------->
<?php $title = "Produit Page"; ?>
<!-----------Body----------->
<?php ob_start();?>
        <h1 class="product_name">Tahini Paste</h1>

        <div class="product_detais">
            <div class="product_big_image">
                <img src="<?= $product['img_url'] ?>" alt="<?= $product['product_name'] ?>">
            </div>
            <div class="product_info_box">
                <p class="price"><?= $product['price'] ?> CAD$</p>
                <p class="stock_number">In Stock <?= $product['stock_number'] ?></p>
                <p class="short_desc"><?= $product['short_description'] ?></p>
                <form action="index.php?action=ajouterPanier&idProduit=<?=$product['product_id'] ?>" method="post">
                    <div class="product-quantity" style="padding-bottom: 1.6rem;">
                        <div class="quantity-button minus">
                            <span class="qt-minus">-</span>
                        </div>
                        <input type="text" id="item_quantity" class="input-text qty_text" step="1" min="0" max="" name="cart_quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric">
                        <div class="quantity-button plus">
                            <span class="qt-plus">+</span>
                        </div>
                    </div>  
                    <button class="add_to_cart_btn">Ajouter au Panier</button>           
                </form>              
            </div>
        </div>
        <div class="description">
           <h3>Description</h3> 
        
            <p class="desc_long">
                <?= $product['description'] ?>
            </p>
        </div>

<?php $content = ob_get_clean(); ?>

<!-----------template----------->  
<?php require('template.php'); ?>