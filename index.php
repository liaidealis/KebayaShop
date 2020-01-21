<?php
session_start();
include("config.inc.php");
?>
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
<!--Custom CSS -->
<link href="css/shop-homepage.css" rel="stylesheet">
</head>
<body>

<!--Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-nabar-collapse-1">
<span class="sr-only"> Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#">Kebaya Shop</a>
</div>
<!--Collect the nav links,forms, and other content for toggling-->
<div class="collapse navbar-collapse"id="bs-example-navbar-collapse-1">
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
<li>
	<a href="#"></a>
</li>
<li>
	
	<a href="#" class="cart-box" id="card-info" title="view Cart">
		<?php
		if(isset($_SESSION["products"])){
		echo count($_SESSION["products"]);
		} else {
		echo 0;
		}
		?>
	</a>
	</li>
	</ul>
	</div>
	<!--/.navbar-collapse-->
	</div>
<!--/.container-->
	<div class="shopping-cart-box">
		<a href="#" class="close-shopping-cart-box">Close</a>
		<h3> Keranjang Belanja Anda</h3>
		<div id="shopping-cart-results">
		</div>
	</div>
</nav>

<style type="text/css">
.info_produk {
	width: 30%;
}

.img-product {
	max-height: 600px;
}
</style>

<?php
$quantity = 10;
$warna = array('Merah', 'Biru', 'Kuning', 'Hijau');
$ukuran = array('S', 'M', 'L');
?>
<div class="row">
		<div class="container">
			<?php
			$results=$mysqli_conn->query("SELECT nama_produk, bahan_produk, code_produk, image_produk, price_produk FROM tbl_produk");
			while ($row = $results->fetch_assoc()){
			?>
			<form class="form_cart">
				<div class="col-lg-4">
					<img src="images/<?php echo $row["image_produk"] ?>" class="img-responsive thumbnail img-product">
					<div class="col-lg-12">
						<label class="info_produk">Harga</label>Rp <?php echo $row['price_produk']; ?><br>
						<label class="info_produk">Bahan</label><?php echo $row['bahan_produk']; ?><br>
						<label class="info_produk">Warna</label>
							<select name="warna">
								<?php foreach ($warna as $value) { ?>
								<option value="<?php echo $value ?>"><?php echo $value; ?></option>
								<?php } ?>
							</select>
						<br>
						<label class="info_produk">Quantity</label>
							<select name="jumlah">
								<?php for($i = 1; $i<=10; $i++){ ?>
								<option value="<?php echo $i ?>"><?php echo $i; ?></option>
								<?php } ?>
							</select>
						<br>
						<label class="info_produk">Ukuran</label>
							<select name="ukuran">
								<?php foreach ($ukuran as $value) { ?>
								<option value="<?php echo $value ?>"><?php echo $value; ?></option>
								<?php } ?>
							</select>
						<br>
						<input type="hidden" name="product_code" value="<?php echo $row['code_produk'] ?>">
						<button class="btn btn-success btn-block button_beli" type="submit">Beli</button>
					</div>
				</div>
			</form>
			<?php
			}
			?>
		</div>
</div>

<hr>

<!--Footer -->
<footer>
	<div class="row">
	<div class="col-lg-12">
	<p> Copyright &copy; KebayaShop.com | 2016</p>
	</div>
	
	</div>
	</footer>
</div>

<!--/.container-->
<!-- jQuery-->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<!-- <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script> -->
<script>
$(document).ready(function(){

// $('.button_beli').on('click',function(){
// 	$.ajax({
// 		url: 'cart_process.php',
// 		type: 'POST',
// 		dataType: 'JSON',
// 		data: {
// 			product_code: '',
// 			product_name: '',

// 		},
// 		success: function(data){

// 		}
// 	});
// });


$('.form_cart').on('submit',(function(event){
	event.preventDefault();
	var data = new FormData(this);
	$.ajax({
		url: 'cart_process.php',
		type: 'POST',
		dataType: 'JSON',
		process: false,
		data: data,
		success: function(data){
			console.log(data)
		},
		error: function(error){
			console.log(error)
		}
	});
}));
		// $(".form-item").submit(function(e){
		// 	var form_data = $(this).serialize();
		// 	var button_content = $(this).find('button[type=submit]');
		// 	button_content.html('Adding...'); // Loading button text
			
		// 	$ajax({// request ajax ke cart_process.php
		// 		url:"cart_process.php",
		// 		type: "POST",
		// 		dataType:"json",
		// 		data:form_data
		// 	}).done(function(data){ // Jika Ajax berhasil
		// 		$("#cart-info").html(data.items); // total item di cart-info element
		// 		button_content.html('BELI'); //
		// 		alert("Item telah dimasukan ke kerajang belanja anda");
		// 		if($(".shopping-cart-box").css("display") == "block"){
		// 			$(".cart-box").trigger("click");
		// 		}
		// 	})
		// 		e.preventDefault();
		// });
	
// menampilkan item ke keranjang belanja
$(".cart-box").click(function(e) {
	e.preventDefault();
	$(".shopping-cart-box").fadeln();
	$("#shopping-cart-results").html("<img src='images/ajax-loader.gif'>"); // menampilkan loading gambar
	$("#shopping-cart-results").load("cart_process.php",{"load_cart":"1"}); // membuat permintaan ajax menggunakan dengan jQuery Load() & Update
	});
	
	//keluar keranjang belanja 
	$(".close-shopping-cart-box").click(function(e) { // fungsi klik pengguna pada keranjang belanja
		e.preventDefault();
		$(".shopping-cart-box").fadeOut(); //Keluar keranjang belanka
	});
	
	// Menghapus item dari keranjang 
	$("#shopping-cart-results").on('click','a.remove-item',function(e) {
		e.preventDefault();
		var pcode=$(this).attr("data-code"); // mendapatkan get produk
		$(this).parent().fadeOut(); // menghapus elemen item dari kotak
		$getJSON("cart_process.php",{"remove_code":pcode}, function(data) { // mendapatkan harga barang dari server
			$("#cart-info").html(data.items); // update menjullahkan item pada cart-info
			$(".cart-box").trigger("click"); // trigger click on cart-box to untuk memperbarui daftar item
		});
	});
});
</script>

<!--Bootsrap Core JavaScript-->
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>