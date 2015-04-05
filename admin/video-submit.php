<?php
	include('../database.php');
	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
			header("location: index.php");
	}else{
		$errflag = false;
		
		$link = $_POST['link'];
		// query
		$active=true;
		$result = $conn->prepare("SELECT * FROM pcm_video WHERE active= :active");
		$result->bindParam(':active', $active);
		$result->execute();
		$rows = $result->fetch();
		
		if($rows > 0) {
			// query
			$id=$rows['id'];
			$sql = "UPDATE pcm_video SET link=? WHERE id=?";
			$q = $conn->prepare($sql);
			$q->execute(array($link,$id));
			$_SESSION['SUCCESS_MSG'] = "Update Successfully";
			header("location: video.php");
		} else {
			$active=true;
			// query
			$sql = "INSERT INTO pcm_video (link,active) VALUES (:link,:active)";
			$q = $conn->prepare($sql);
			$q->execute(array(':link'=>$link,':active'=>$active));
			$_SESSION['SUCCESS_MSG'] = "Update Successfully";
			header("location: video.php");
		}
	}
 ?>