<?php
require('models/modele.php');

function afficherProduits($idOrder){	
	
	if ($idOrder== null){
		$idOrder = initialOrderId();
	}else{
		$idOrder = $idOrder;	
	}

	$reqCarts = getCarts(1);
	$req = getProducts();

	require('views/products_list.php');
}

function afficherProduit($idProduct){
	$product=getProduct($idProduct);
	$reqCarts = getCarts(1);
	require('views/product.php');
}

function initialOrderId(){
	return $initOrderId =  getMaxOderId() + 1;
}

function ajourterPanier($idProduct, $idOrder){

	if($idOrder == null){
		$idOrder = initialOrderId();
		return ajourterPanier($idProduct, $idOrder);
	}else{

		$idOrder = $idOrder;
		$product = getProduct($idProduct);
		if($product['stock_number'] >=1) {			
			if(getCartItemQuantity($idOrder, $idProduct) == 0) {
				$idOrder = addToCart($idOrder, $idProduct, $product['product_name'], $product['price'], 1, $product['img_url']);

				//Update products
				updateProduct($idProduct, -1);         //passe minus number when decrease
				echo "<script>alert('Add to cart success!')</script>";
           		echo "<script>window.location = 'index.php?action=home'</script>";
			}
			else{
				echo "<script>alert('Product is already in the cart..!')</script>";
				echo "<script>window.location = 'index.php?action=home'</script>";
			}
		}
		return $idOrder;
	}
}

function afficherPaniers(){
	$reqCarts = getCarts(1);
	$reqProducts = getProducts();
	require('views/cart.php');
}

function afficherPanier($idPanier){           
    
  
	require('views/cart.php');
}

function modifierPanier($idProduct, $idOrder, $quantityNew){
	$productStock = getProduct($idProduct)['stock_number'];
	$cartQuantity = getCartItemQuantity($idOrder, $idProduct);

	if($quantityNew > $productStock){
		echo "<script>alert('There is not enough stock..!')</script>";
		echo "<script>window.location = 'index.php?action=panier'</script>";	
	}
	else{
		//Update products
		updateProduct($idProduct, -($quantityNew - $cartQuantity) );         //passe minus number when decrease

		//Update carts
		updateCart($idOrder, $idProduct, getProduct($idProduct)['price'], $quantityNew);
	}
}

function  supprimerPanier($idProduct, $idOrder){

	$cartQuantity = getCartItemQuantity($idOrder, $idProduct);
	deleteCart($idOrder, $idProduct);
	//Update products
	updateProduct($idProduct, $cartQuantity);

}

