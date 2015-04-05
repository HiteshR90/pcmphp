<?php
	include('../database.php');
	include('../lib/password.php');
    session_start();
    $errmsg_arr = array();
    $errflag = false;
    
     
    // new data
     
    $user = $_POST['uname'];
    $password = $_POST['pword'];
     
    if($user == '') {
		$_SESSION['ERRMSG_EMAIL'] = "You must enter your Username";
		$errflag = true;
    }
    if($password == '') {
		$_SESSION['ERRMSG_PASSWORD'] = "You must enter your Password";
		$errflag = true;
    }
     if(!$errflag){
		//$hashed_password = crypt($password);
		 // query
		$result = $conn->prepare("SELECT * FROM pcm_user WHERE email= :email");
		$result->bindParam(':email', $user);
		$result->execute();
		$rows = $result->fetch();
		
		if($rows > 0) {
			if (password_verify($password, $rows['password'])) {
				$_SESSION['session_user'] = $rows['email'];
				header("location: about.php");
			}else{
				$_SESSION['ERRMSG_COMMON'] = "Password not match";
				$errflag = true;
			}			
		} else {
			$_SESSION['ERRMSG_COMMON'] = "Username and Password are not found";
			$errflag = true;
		}
	 }
    
    if($errflag) {
		session_write_close();
		header("location: index.php");
		exit();
    }
     
    ?>