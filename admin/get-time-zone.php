<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("message" => "Please login");
	}else{
		$result = $conn->prepare("SELECT name FROM pcm_time_zone");
		$result->execute();
		$rows = $result->fetchAll(PDO::FETCH_COLUMN, 0);
		if($rows > 0) {
			$data = $rows;
		}else{
			$data = array("message" => "not found");
		}			
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>