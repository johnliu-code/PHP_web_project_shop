<?php
    //Connnect DB
	function db_connect()
	{
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=projet_final;charset=utf8', 'root', '');
			return $db;
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}

    //Get products data
    function getProducts()
	{

		$bdd=db_connect();
		$req = $bdd->query('SELECT * FROM products ORDER BY product_name ASC LIMIT 0, 20');

		return $req;

	}

	function getRecomandProducts()
	{

		$bdd=db_connect();
		$req = $bdd->query('SELECT * FROM products ORDER BY create_at ASC LIMIT 0, 10');

		return $req->fetchAll();
	}

	function getProduct($idProduct)
	{
		$bdd = db_connect();

		$req = $bdd->prepare('SELECT * FROM products WHERE product_id = :IDproduct');
		$req->execute(array(
			"IDproduct" => $idProduct
		));
		$product = $req->fetch();

		return $product;
	}

    function updateProduct($idProduct, $quantity) {
		$bdd = db_connect();

        $newStock = getProduct($idProduct)['stock_number'] + $quantity; 

		$req = $bdd->prepare('UPDATE products SET stock_number = :newNumber WHERE product_id = :IDproduct');
		$req->execute(array(
			"IDproduct" =>$idProduct,
            "newNumber" => $newStock
		));
		$product = $req->fetch();
        if($req->rowCount() > 0 ) {
            echo("Product Update seccess!!");
        }else{
            echo("Product Update failed!!");
        }

		return $product;
    }

    //Get cart data by orderId
    function getCarts($orderID){
		$bdd=db_connect();

        $req = $bdd->prepare('SELECT * FROM shopping_carts  WHERE order_id = :ID_order');
		$req->execute(array(
			"ID_order" => $orderID
		));

		return $req;
	}

    function getCartItemQuantity($orderID, $idProduct){
		$bdd= db_connect();

		$req = $bdd->prepare('SELECT * FROM shopping_carts  WHERE order_id = :ID_order AND  product_id = :ID_product');
		$req->execute(array(
			"ID_order" => $orderID, 
			"ID_product" => $idProduct
		));

       if ($req-> rowCount() > 0){
            return $req->fetch()['quantity'];
       }else return 0;
		
	}

    //Chcek if product is in the order or not
    function getOderId($idProduct){
		$bdd= db_connect();

		$req = $bdd->prepare('SELECT * FROM shopping_carts  WHERE product_id = :ID_product');
		$req->execute(array(
			"ID_product" => $idProduct 
		));

        if ($req->fetch() != null){
            return $req->fetch()['order_id'];
        }else{
            return null;
        }
	}

    function getMaxOderId(){
		$bdd= db_connect();

		$req = $bdd->query('SELECT order_id FROM shopping_carts ORDER BY order_id DESC LIMIT 1');
        $orderId = $req->fetch()[0];

		return  $orderId;
	}

    function addToCart($orderID, $idProduct, $nomProduct, $price, $quantity, $imagelink){

        $bdd=db_connect();
        
        $req = $bdd->prepare('INSERT INTO shopping_carts (product_id, product_name, quantity, price, total_amount, order_id, img_url) VALUES (:ID_product, :Name_product, :QuantityPr, :PricePr, :AmountTl, :orderID, :URLimg)');
        $req->execute(array(
            "ID_product" => $idProduct, 
            "Name_product" => $nomProduct,
            "QuantityPr" => 1, 
            "PricePr" => $price, 
            "AmountTl" => $price * $quantity,
            "orderID" => $orderID,
            ":URLimg" => $imagelink
        ));
	}

    function updateCart($orderID, $idProduct, $price, $NewQuantity){

        $bdd=db_connect();

        try
		{
        //update cart
            $amount = $price * $NewQuantity;
            $req = $bdd->prepare('UPDATE shopping_carts SET quantity = :cartQuantity, total_amount = :amountPr WHERE order_id = :ID_order AND  product_id = :ID_product ');
            $req->execute(array(
                "ID_order" => $orderID, 
                "ID_product" => $idProduct,
                "cartQuantity" => $NewQuantity,
                "amountPr" => $amount
            ));
        
            if($req->Rowcount() > 0){
                return true;
                echo "Cart Update success!!";
            }
            else{
                echo "Cart Update failed!!";
                return false;
            }
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}

    }

    function deleteCart($orderID, $idProduct){

        $bdd=db_connect();

        try
		{
            $req = $bdd->prepare('DELETE FROM shopping_carts WHERE order_id = :ID_order AND  product_id = :ID_product');
            $req->execute(array(
                "ID_order" => $orderID, 
                "ID_product" => $idProduct
            ));

            if($req->Rowcount() > 0){
 
                echo "Delete success!!";
                return true;
            }
            else{
                echo "Delete failed!!...Item is not found!!";
                return false;
            }

		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
    }
