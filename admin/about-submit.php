<?php
	include('../database.php');
	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
			header("location: index.php");
	}else{
		$errflag = false;
		
		$content = $_POST['content'];
		// query
		$active=true;
		$result = $conn->prepare("SELECT * FROM pcm_about WHERE active=:active");
		$result->bindParam(':active', $active);
		$result->execute();
		$rows = $result->fetch();
		
		if($rows > 0) {
			// query
			$id=$rows['id'];
			$sql = "UPDATE pcm_about SET content=? WHERE id=?";
			$q = $conn->prepare($sql);
			$q->execute(array($content,$id));
			$_SESSION['SUCCESS_MSG'] = "Update Successfully";
			header("location: about.php");
		} else {
			$active=true;
			// query
			$sql = "INSERT INTO pcm_about (content,active) VALUES (:content,:active)";
			$q = $conn->prepare($sql);
			$q->execute(array(':content'=>$content,':active'=>$active));
			$_SESSION['SUCCESS_MSG'] = "Update Successfully";
			header("location: about.php");
		}
	}
 ?>