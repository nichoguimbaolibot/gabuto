<?php
	require 'db.php';
	session_start();

	if(isset($_POST['login'])){
		$username =$_POST['username'];
		$password =$_POST['password'];

		$result = $mysqli->query("SELECT * FROM login WHERE un ='$username'");
		if ($result->num_rows ==0){
			echo "<script type='text/javascript'>
			alert('User not found!');
			window.location.href ='login2.html';	
			</script>";
		}
		else { 
			$user = $result->fetch_assoc();
			if ($user['pw'] == $password) {
			$_SESSION['logged']=1;
			$_SESSION['username']=$user['un'];
			header("location: instafinderindex.html");
		}
		else{
			echo "<script type='text/javascript'>
			alert('Incorrect password!');
			window.location.href ='login2.html';
			</script>";
		}
	}
}

if(isset($_POST['reg'])){

	$username = $_POST['username'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	$passwords = $_POST['passwords'];

	if($password == $passwords){
		$result = $mysqli->query("SELECT * FROM login WHERE un='$username'") or die($mysqli->error());

	if($result->num_rows > 0){
			echo "<script type='text/javascript'>
			alert('Username already exist!');
			window.location.href ='login2.html';	
			</script>";
			

		}
		else { 
			$sql = "INSERT INTO login (un, name, pw)"
			."VALUES ('$username','$name','$password')";

			if ($mysqli->query($sql)){
				echo "<script type='text/javascript'>
			alert('Welcome to InstaFinder!');	
			</script>";
			header("location: instafinderindex.html");

			}
			
		}
	}
		else{
			echo "<script type='text/javascript'>
			alert('Passwords do not match!');
			window.location.href ='login2.html';
			</script>";

	}
}
