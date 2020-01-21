<?php
session_start(); // start session
include("config.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title> Membuat Shopping Cart Dengan PHP,Ajax,JQuery & Bootstrap</title>
	
	<!--Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="style/style.css" rel="stylesheet" type="text/css">
		
	<!--Custom CSS -->
	<link href="css/shop-homepage.css" rel="stylesheet">
	</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
	<!-- Brand and Toggle get grouped for better mobile display -->
	<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#">KebayaShop</a>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li>
	<a href="index.php">Home</a>
</li>
<li>
	<a href="#">About</a>
</li>
<li>
	<a href="#">Service</a>
</li>
<li>
	<a href="#">Colection</a>
</li>
<li>
	<a href="#">Contact</a>
</li>
<li>
	<a href="#"></a>
</li>
</ul>
</div>
<!--/.navbar-collapse-->
</div>

<!--/.container -->
	<div class="shopping-cart-box">
		<a href="#" class="close-shopping-cart-box"> Close</a>
		<h3> Keranjang belanja Anda</h3>
		<div id="shopping-cart-results">
		</div>
	</div>
</nav>

<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	</div>
	<div class="col-md-9">
	<div class="row carousel-holder">
	</div>
	<div class="row">
	<div align="center">
</div>
<h3 style="text-align-center">Review Keranjang Belanja Anda</h3>
<?php
if(isset($_SESSION["products"])&& count($_SESSION["products"])>0){
		$total		= 0;
		$list_tax	= ";
		$cart_box	='<"ul class="view-cart">';
		
		foreach($_SESSION["products"] as $product){ // Cetak setiap item, kuantitas dan harga.
		$product_name 	 = $product["product_name"];
		$product_qty	 = $product["product_qyt"];
		$product_price	 = $product["product_price"];
		$product_code 	 = $product["product_code"];
		$product_color	 = $product["product_color"];
		$product_size	 = $product["product_size"];
		
		$item_price = convert_to_rupiah($product_price * $product_qyt); // Harga x qyt = Total harga barang 
	$cart_box.= "<li> $product_code &ndash; $product_name(Qty: $product_qyt | $product_color | $product_size) <span> $item_price</span></li>";
		
		$subtotal	= ($product_price * $product_qyt); // Multiply kuantitas * harga
		$total 		= ($total + $subtotal); // Add up to total harga
		}
		$grand_total = $total +$shipping_cost: //Menjumlahkan total
		
		foreach($taxes as $key => $value) { // menghitung semua pajak dalam array
							$tax_amount		=round($total *($value / 100));
							$tax_item[$key] =$tax_amount;
							$grand_total	=$grand_total + $tax_amount;
		}
		foreach($tax_item as $key => $value){ // List Pajak
				$list_tax.=$key.''. convert_to_rupiah($value).'<br/>';
		}
			$shipping_cost = ($shipping_cost)?'Biaya Pengiriman:'.convert_to_rupiah($shipping_cost).'<br/>':";
			
	
	// Menampilkan pajak, biaya pengiriman & Total Belanja
	$cart_box.="<li class=\"view-cart-total\">$shipping_cost $list_tax <hr>Total Belanja Anda :
	".convert_to_rupiah($grand_total)."</li>";
	$cart_box.="</ul>";
	
	echo $cart_box;
	} else {
		echo " Keranjang beranda Anda kosong";
		}
		?>
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	</body>
	</html>
	
					
							
		
		
		
		









