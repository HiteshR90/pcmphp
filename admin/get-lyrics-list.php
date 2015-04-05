<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("errorMessage" => "Please login");
	}else{
		$query="select lyrics.id, lyrics.title from pcm_lyrics lyrics";
		$result = $conn->prepare($query);
		$result->execute();
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		if($rows > 0) {
			$data = $rows;
		} else{
			$data = array("errorMessage" => "not found");
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>