<?php
session_start(); // start session
include_once("config.inc.php"); // include config file

############# Memasuk produk baru ke keranjang belanja ########################
if(isset($_POST["product_code"]))
{
	foreach($_POST as $key => $value){
		$new_product[$key]=filter_var($value, FILTER_SANITIZE_STRING);
	}
	
	$statement = $mysqli_conn->prepare("SELECT nama_produk, price_produk FROM tbl_produk WHERE code_produk=? LIMIT 1");
		$statement->bind_param('s',$new_product['product_code']);
		$statement->execute();
		$statement->bind_result($product_name,$product_price);
		
	while($statement->fetch()){
		$new_product["product_name"] = $product_name;
		$new_product["product_price"] = $product_price;
		
		if(isset($_SESSION["products"])){
			if(isset($_SESSION["products"][$new_product['product_code']]));
			{
				unset($_SESSION["products"][$new_product['product_code']]);
		}	
	}
		
			$_SESSION["products"][$new_product['product_code']] = $new_product;
		}
		$total_items=count($_SESSION["products"]); //
		die(json_encode(array('items'=>$total_items)));
}
	################## List Produk yang ada di keranjang belanja ##################
	if(isset($_POST["load_cart"]) && $_POST["load_cart"]==1)
	{
		if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
			$cart_box='<ul class="cart-product-loaded">';
			$total=0;
			foreach($_SESSION["products"] as $product){
			
				$product_name = $product["product_name"];
				$product_price = $product["product_price"];
				$product_code = $product["product_code"];
				$product_qyt = $product["product_qyt"];
				$product_color = $product["product_color"];
				$product_size = $product["product_size"];
			
	$cart_box.="<li> $product_name(Qty: $product_qyt | $product_color | $product_size)&mdash;
	".convert_to_rupiah($product_price * $product_qty)."<a href=\"#\"class=\"remove-item\"data-code=\"$product_code\">&times;</a></li>";
			$subtotal=($product_price * $product_qty);
			$total=($total + $subtotal);
			}
			$cart_box.="</ul>";
			$cart_box.='<div class="cart-products-total">Total:'.convert_to_rupiah($total).'<u><a href="view_cart.php" title="Review Cart dan Check-Out"> Check-out</a></u></div>';
				die($cart_box);
			}else{
				die("Keranjang Belanja Anda Kosong");
				}
		}
	################## Mengahapus item dari Keranjang Belanja ##################
	if(isset($_GET["remove_code"]) && isset($_SESSION["products"]))
	{
		$product_code = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING);
		
		if(isset($_SESSION["products"][$product_code]))
		{
			unset($_SESSION["products"][$product_code]);
		}
		$total_items=count($_SESSION["products"]);	
	
		die(json_encode(array('items'=>$total_items)));
	}
	
						
				
				
				
	
	
	
	
	
	
		
		