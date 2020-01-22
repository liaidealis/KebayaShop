<?php
session_start(); // start session
$db_username ='root';// Mysql username anda
$db_password =''; // Mysql database password anda
$db_name ='shopping'; //Mysql nama database anda
$db_host ='localhost';//Mysql hostname atau IP anda

function convert_to_rupiah($angka)
	{return 'Rp.'.strrev(implode('.',str_split(strrev(strval($angka)),3)));};//Setting untuk Fungsi Rupiah
	
$shipping_cost = 9000;// Setting biaya pengiriman
$taxes		   = array(//setting pajak pengiriman
'Pajak:'=>2,
);
$mysqli_conn = new mysqli($db_host,$db_username,$db_password,$db_name); // koneksi ke mysql
if($mysqli_conn->connect_error) {//Output bila koneksi erorr
die('Error:('.$mysqli_conn->connect_error.')'.$mysqli_conn->connect_error);
}