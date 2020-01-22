<?php include_once ("config.inc.php");?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="|E=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description"content="">
<meta name="author" content="">

<title> Membuat Shopping Cart Dengan PHP,Ajax,JQuery & Bootstrap</title>
<!--Bootsrap Core CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
<!--Custom CSS -->
<link href="css/shop-homepage.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-menu">
				<span class="sr-only"> Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Kebaya Shop</a>
		</div>
		<div class="collapse navbar-collapse"id="navbar-collapse-menu">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Service</a></li><li><a href="#">Colection</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="cart-box"><i class="fa fa-shopping-cart"></i>&nbsp;<span class="badge">42</span></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Sign In</a></li>
						<li><a href="#">Sign Up</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Forgot Password?</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="shopping-cart-box">
		<a href="#" class="close-shopping-cart-box">Close</a>
		<h3> Keranjang Belanja Anda</h3>
		<div id="shopping-cart-results"></div>
	</div>
</nav>

<style type="text/css">
.info_produk {
	margin-top: 2%;
	margin-bottom: 2%;
	max-height: 400px;
	height: 32px;
}

.img-product {
	max-height: 400px;
	margin: 0 auto;
}
</style>

<?php
$quantity = 10;
$warna = array('Merah', 'Biru', 'Kuning', 'Hijau');
$ukuran = array('S', 'M', 'L');
?>

<div class="container" style="margin-top: 4%;">
	<?php
	$results=$mysqli_conn->query("SELECT nama_produk, bahan_produk, code_produk, image_produk, price_produk FROM tbl_produk");
	while ($row = $results->fetch_assoc()){
	?>
	<form class="form_cart">
		<div class="col-lg-4" style="padding: 20px;">
			<img src="images/<?php echo $row["image_produk"] ?>" class="img-responsive thumbnail img-product">
			<div class="col-lg-12" style="margin-top: 4%;">
				<div class="col-lg-3 col-xs-3 info_produk"><b>Harga</b></div><div class="col-lg-9 col-xs-9 info_produk">Rp <?php echo $row['price_produk']; ?></div>

				<div class="col-lg-3 col-xs-3 info_produk"><b>Bahan</b></div><div class="col-lg-9 col-xs-9 info_produk"><?php echo $row['bahan_produk']; ?></div>

				<div class="col-lg-3 col-xs-3 info_produk"><b>Warna</b></div>
				<div class="col-lg-9 col-xs-9 info_produk">
					<select name="warna" class="form-control input-sm">
						<?php foreach ($warna as $value) { ?>
						<option value="<?php echo $value ?>"><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-lg-3 col-xs-3 info_produk"><b>Quantity</b></div>
				<div class="col-lg-9 col-xs-9 info_produk">
					<select name="jumlah" class="form-control input-sm">
						<?php for($i = 1; $i<=10; $i++){ ?>
						<option value="<?php echo $i ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-lg-3 col-xs-3 info_produk"><b>Ukuran</b></div>
				<div class="col-lg-9 col-xs-9 info_produk">
					<select name="ukuran" class="form-control input-sm">
						<?php foreach ($ukuran as $value) { ?>
						<option value="<?php echo $value ?>"><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>

				<input type="hidden" name="product_code" value="<?php echo $row['code_produk'] ?>">
				<button class="btn btn-success btn-block button_beli" type="submit">Beli</button>
			</div>
		</div>
	</form>
	<?php
	}
	?>
</div>

<hr>

<div class="col-lg-12">
	<p align="center"> Copyright &copy; KebayaShop.com | 2016</p>
</div>

</body>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
	$('.form_cart').on('submit',(function(event){
		event.preventDefault();
		var data = new FormData(this);
		$.ajax({
			url: 'cart_process.php',
			type: 'POST',
			dataType: 'JSON',
			processData: false,
			data: data,
			success: function(data){
			},
			error: function(error){
			}
		});
	}));
});
</script>
</html>