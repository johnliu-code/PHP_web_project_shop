
<?php 

    $cartcounts = $reqCarts->RowCount();
    $orderID = 1;
    //print_r($_POST["updateCart"]);
    //print_r($_POST["removeFromCart"]);
    //print_r($_POST['cart_quantity']);
    //print_r($_GET["idProduct"], $_GET["idOrder"]);

?>

<!-----------Page title----------->
<?php $title = "Cart Page"; ?>
<!-----------Body----------->
<?php ob_start();?>

        <h1 class="cart_title">Panier details</h1>

        <?php  
            if($cartcounts == 0) {
        ?>

        <div class="cart_detais">
            <div class="empty_cartNote">
                <p class="empty_note">Vous n'avez pas ajouté de produit à votre panier, veuillez retourner à la liste des produits pour ajouter un produit.</p>
            </div>
        </div>     

        <?php 
            }
            else {
        ?>

        <div class="cart_detais">
            <div class="cart_products_list" id="#cart_list">
                <div class="cart_list_table" > 
                                                    
                        <table class="shop_table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Subtotal</th>
                                    <th class="product-remove">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>  

                            <?php
                                $total=0;
                                while ($panier= $reqCarts->fetch())
                                { 
                                    //get stock
                                    // while ($productStock =$reqProducts->fetch()){
                                        
                                    //     if($productStock['product_id'] == $panier['product_id']){
                                    //         $stock = $productStock['stock_number'];
                                       
                    ?>

                                            <form class="cart-form" action="index.php?action=panier&idProduct=<?=$panier['product_id']?>&idOrder=<?= $orderID ?>" method="post"> 
                                                <tr class="cart_item" style="margin: 0.5rem;">
                                                    <td class="product-thumbnail">
                                                        <a href="#"><img height="80" src="<?= $panier['img_url'] ?>" class="thumbnail_img" alt="<?= $panier['product_name'] ?>" loading="lazy" sizes="(max-width: 80px) 100vw, 80px"></a>									
                                                    </td>
                                                    <td class="product-name" data-title="Product">
                                                        <a href="views/product.php"><?=$panier['product_name'] ?></a>									
                                                    </td>       
                                                    <td class="product-price" data-title="Price">
                                                        <span class="amount"><bdi><span class="currency_symbol">CAD$</span><?=$panier['price'] ?></bdi></span>									
                                                    </td>
                                                    <td class="product-quantity" data-title="Quantity">
                                                        <div class="quantity-button minus">
                                                            <span class="qt-minus">-</span>
                                                        </div>
                                                        <input type="text" id="item_quantity" name="cart_quantity" class="input-text item-quantity qty_text" step="1" min="0" max=""  value="<?= $panier['quantity'] ?>" title="Qty" size="4" placeholder="" inputmode="numeric">
                                                        
                                                        <div class="quantity-button plus"> 
                                                            <span class="qt-plus">+</span>
                                                        </div>
                                                    </td>
                                                    <td class="product-subtotal" data-title="Subtotal">
                                                        <span class="amount"><bdi><span class="currency_symbol">$</span><?=$panier['price'] * $panier['quantity'] ?></bdi></span>									
                                                    </td>
                                                    <td class="product-remove">
                                                        <button type="submit" class="remove" name="removeFromCart" style="width:1.5rem; height:1.5rem; border-radius: 50%; color: red; border:none; cursor: pointer;" ><span class="delete_item">x</span></button>	
                                                        <input type='hidden' name='product_id' value='<?= $panier['product_id'] ?>'>  
                                                        <input type="hidden" name="order_id" value="<?= $orderID ?>" >    								
                                                    </td>  
                                                    <td colspan="6" class="actions">
                                                         <button type="submit" class="button" name="updateCart" value="Update" style="color: darkgreen;  cursor: pointer;" aria-disabled="true">Update</button> 
                                                    </td>
                                                        
                                                </tr>
                                           
                                            </form>
                                <?php
                                          //  }
                                        // }
                                       
                                        $total=$total+$panier['price'] * $panier['quantity'];
                                       
                                    }
                                    //$reqCarts->closeCursor();
                                ?>   
                                                
                                <tr>
                                    <td colspan="6" class="actions">
                                        <a href="index.php?action=home" style="text-decoration: none;">           
                                            <button type="submit" class="button" name="backHome" value="Back To Shopping" style="color: rgb(18, 168, 30); font-weight: 700; cursor: pointer;" aria-disabled="true">Back To Shopping</button>         								
                                        </a>
                                    </td>
                                </tr>
                        
                            </tbody>
                        </table>
                    
                    
                </div>
            </div>
            <div class="cart_total_box">
                <h2>Cart totals</h2>
                <div class="total_box">
                    <p class="sub_total">Subtotal:</p>
                    <p> <?=$total?> </p>
                </div>
                <div class="total_box">
                    <p class="tax">GST/QST:</p>
                    <p> * 14.975%</p>
                </div>
                <div class="total_box">
                    <p class="cart_total_amount">Total:</p>
                    <p> <?=$total * (1+ 0.14975)?></p>
                </div>

                <div class="checkout_box">
                    <a href="#" class="checkout-button">Checkout</a>
                </div>
            </div>
        </div>

        <?php 
            }
        ?>        

        <div class="recommand_products">
           <h3>Recommander Produilts</h3> 
           <div class="products_list">
            <a href="views/product.php" style="text-decoration: none;">
                <div class="product_box">
                    <img src="public/images/products/Tahini Paste.jpeg" alt="Tahini Paste">
                    <div class="product_info">
                        <p class="product_name">Tahini Paste</p>
                        <p class="stock_state">Instock</p>
                        <p class="price_list">8.99 CAD$</p>
                        <button class="add_to_cart">Ajouter a Panier</button>
                    </div>
                </div>
            </a>

            <div class="product_box">
                <img src="public/images/products/Lamb - Whole Head .jpeg" alt="Tahini Paste">
                <div class="product_info">
                    <p class="product_name">Tahini Paste</p>
                    <p class="stock_state">Instock</p>
                    <p class="price_list">8.99 CAD$</p>
                    <button class="add_to_cart">Ajouter a Panier</button>
                </div>
            </div>
            <div class="product_box">
                <img src="public/images/products/Crab - Imitation Flakes .jpeg" alt="Tahini Paste">
                <div class="product_info">
                    <p class="product_name">Tahini Paste</p>
                    <p class="stock_state">Instock</p>
                    <p class="price_list">8.99 CAD$</p>
                    <button class="add_to_cart">Ajouter a Panier</button>
                </div>
            </div>
            <div class="product_box">
                <img src="public/images/products/Icecream Cone - Areo Chocolate.jpeg" alt="Tahini Paste">
                <div class="product_info">
                    <p class="product_name">Tahini Paste</p>
                    <p class="stock_state">Instock</p>
                    <p class="price_list">8.99 CAD$</p>
                    <button class="add_to_cart">Ajouter a Panier</button>
                </div>
            </div>
        </div>


<?php $content = ob_get_clean(); ?>

<!-----------template----------->  
<?php require_once('template.php'); ?>