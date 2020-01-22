<?php
include_once ('config.inc.php'); // include config file

############# Memasuk produk baru ke keranjang belanja ########################
header('content-type:application/json');
if (isset($_POST['product_code']))
{
	if (isset($_SESSION['products']))
	{
		if (isset($_SESSION['products'][$_POST['product_code']]))
		{
			$session_quantity = $_SESSION['products'][$_POST['product_code']]['quantity'];
			$quantity = (isset($_POST['quantity']) && is_int($_POST['quantity']))?$_POST['quantity']:$session_quantity+=1;
			$_SESSION['products'][$_POST['product_code']]['quantity'] = $quantity;
			exit(json_encode(array('items' => $_SESSION['products'],'count' => count($_SESSION['products']))));
		}
		else
		{
			foreach ($_POST as $key => $value)
			{
				$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
			}
			
			$statement = $mysqli_conn->prepare("SELECT nama_produk, price_produk FROM tbl_produk WHERE code_produk=? LIMIT 1");
			$statement->bind_param('s', $new_product['product_code']);
			$statement->execute();
			$statement->bind_result($product_name, $product_price);

			while ($statement->fetch())
			{
				$new_product['product_name'] = $product_name;
				$new_product['product_price'] = $product_price;
				$new_product['quantity'] = (isset($_POST['quantity']) && is_int($_POST['quantity']))?$_POST['quantity']:1;
			}

			$_SESSION['products'][$new_product['product_code']] = $new_product;
			exit(json_encode(array('items' => $_SESSION['products'],'count' => count($_SESSION['products']))));
		}
	}
	else
	{
		foreach ($_POST as $key => $value)
		{
			$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
		}
		
		$statement = $mysqli_conn->prepare("SELECT nama_produk, price_produk FROM tbl_produk WHERE code_produk=? LIMIT 1");
		$statement->bind_param('s', $new_product['product_code']);
		$statement->execute();
		$statement->bind_result($product_name, $product_price);

		while ($statement->fetch())
		{
			$new_product['product_name'] = $product_name;
			$new_product['product_price'] = $product_price;
			$new_product['quantity'] = (isset($_POST['quantity']) && is_int($_POST['quantity']))?$_POST['quantity']:1;
		}

		$_SESSION['products'][$new_product['product_code']] = $new_product;
		exit(json_encode(array('items' => $_SESSION['products'],'count' => count($_SESSION['products']))));
	}
}
elseif (isset($_POST['load_cart']) && $_POST['load_cart'] == 1)
{

}
else
{

}
	
	
	
	
	
	
		
		