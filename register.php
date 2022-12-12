<?php
require 'dbconnect.php';

if(!isset($_SESSION['log'])){
	
} else {
	header('location:home.php');
};


if(isset($_POST['register']))
	{
		$nama = $_POST['nama'];
		$telp = $_POST['telp'];
		$email = $_POST['email'];
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); 
			  
		$tambahuser = mysqli_query($conn,"insert into user (nama, email, password, notelp) 
		values('$nama','$email','$pass','$telp')");
		if ($tambahuser){
		echo " <div class='alert alert-success'>
			Berhasil mendaftar, silakan masuk.
		  </div>
		<meta http-equiv='refresh' content='1; url= login.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal mendaftar, silakan coba lagi.
		  </div>
		 <meta http-equiv='refresh' content='1; url= registered.php'/> ";
		}
		
	};
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
			body{
            padding: 0;
            margin: 0;
            background-color: #E1F0F4;
            background-size: cover;
        }
		.box {
            position: absolute;
            width: 575px;
            background-color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 0px;
            box-shadow: 0 5px 5px 5px rgba(0,0,0,0.1);
        }   
		
		.overlay {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #E1F0F4;
		}

		.header {
			background-image: url(images/Frame2.jpg);
			background-size: cover;
			padding: 70px 50px;
			color: white;
			border-radius: 0px;
		}

		.header p {
			font-size: small;
		}
		.regis-area{
			text-align: center;
			padding: 5px 50px 20px 50px;
		}
		.nama,.email, .password, .telp{
			width: 100%;
            text-align: center;
            padding: 10px 0;
            border-radius: 65px;
            outline: none;
            border: none;
            color: black;
            background-color: #DEF0F1;
            margin-bottom: 18px;
            transition: 0.5s;  
		}
		.nama::placeholder,
		.email::placeholder,
		.password::placeholder, 
		.telp::placeholder{
			black;
		}
		.nama:focus,
		.email:focus,
		.password:focus,
		.telp:focus {
			background-color:  #DEF0F1;
		}
		.regis{
			width: 150px;
			padding: 10px;
			background-color: #41AFBD;
			border-radius: 5px;
			font-weight: bold;
			color: white;
			border:none;
			outline: none;
			margin: 10px;
			transition: 0.2s;
			cursor: pointer;
		}
		.regis:hover {
			background-color: #005A5B;
		}
		a{
			display: block;
			font-size: smaller;
			text-decoration: none;
			color: rgba(55,10,114,0.9);
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div class="overlay"></div>
	<form  method="post" class="box">
		<div class="header">
			
		</div>
		<div class="regis-area">
		<h2> Formulir Registrasi untuk Investor </h2>
            <p>Buat akun Anda dan investasi ke seluruh UMKM se-Indonesia ! </p>
			<input type="text" name="nama" class="nama" placeholder="Nama" required>
			<input type="text" name="email" class="email" placeholder="Email" required>
			<input type="text" name="telp" class ="telp" placeholder="Nomor Telepon" required maxlength="13">
			<input type="password" name="pass" class="password" placeholder="password" required>
			<input type="password" name="pass" class="password" placeholder="Confirm-Password" required>
			<button type="submit" name="register" class="regis" value="register" >Registrasi</button>
			<a href="login.php">Sudah punya akun Investor?</a>
			<a href="register-umkm.php">Registrasi sebagai UMKM</a>
		</div>
	</form>
</body>
</html>