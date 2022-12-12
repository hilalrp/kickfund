<?php
require 'dbconnect.php';

if(!isset($_SESSION['log'])){
	
} else {
	header('location:home.php');
};




	if(isset($_POST['login']))
	{
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$pass = mysqli_real_escape_string($conn,$_POST['pass']);
	$queryuser = mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");
	$cariuser = mysqli_fetch_assoc($queryuser);
		
		if( password_verify($pass, $cariuser['password']) ) {
			$_SESSION['id'] = $cariuser['userid'];
			$_SESSION['notelp'] = $cariuser['notelp'];
			$_SESSION['name'] = $cariuser['nama'];
			$_SESSION['log'] = "Logged";
			header('location:home.php');
		} else {
			echo 'Username atau password salah';
			header("location:login.php");
		}		
	}

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
            width: 500px;
            background-color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 5px;
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
            background-image: url(images/kickfund1.jpg);
            background-size: cover;
            padding: 65px 55px;
            color: white;
            border-radius: 5px;
        }
        .header p {
            font-size: small;
        }
        .login-area{
            text-align: center;
            padding:20px 50px 50px 50px;
        }
        .email, .password{
            width: 100%;
            text-align: center;
            padding: 15px 0;
            border-radius: 65px;
            outline: none;
            border: none;
            color: black;
            background-color: #DEF0F1;
            margin-bottom: 18px;
            transition: 0.5s; 
        }
        .email::placeholder,
        .password::placeholder {
            color: black;
        }
        .email:focus,
        .password:focus {
            background-color: #DEF0F1;
        }
        .login{
            width: 150px;
            padding: 10px;
            background-color: #41AFBD ;
            border-radius: 5px;
            font-weight: bold;
            color: white;
            border:none;
            outline: none;
            margin: 10px;
            transition: 0.2s;
            cursor: pointer;
        }
        .login:hover {
            background-color: #005A5B; 
        }
        a{
            display: block;
            font-size: smaller;
            text-decoration: none;
            color: rgba(49,50,71,1);
            margin-top: 10px;
        }
        
    </style>
</head>
<body>
    <div class="overlay"></div>
    <form  method="post" class="box">
        <div class="header">
        </div>
        <div class="login-area">
            <h2> Welcome to KickFund !</h2>
            <p> Login sebagai Investor </p>
            <input type="text" name="email" class="email" placeholder="Email" required>
            <input type="password" name="pass" class="password" placeholder="Password" required>
            <button type="submit" name="login" class="login" value="login" >Login</button>
            <br/>
            <a href="register.php">Belum punya akun?</a>
            <a href="login-umkm.php">Login Sebagai UMKM</a>
        </div>
    </form>
</body>
</html>