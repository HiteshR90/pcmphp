<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("message" => "Please login");
	}else{
		$id = $_GET['showId'];
		$result = $conn->prepare("SELECT * FROM pcm_show WHERE id= :id");
		$result->bindParam(':id', $id);
		$result->execute();
		$rows = $result->fetch();
		
		if($rows>0){
			
			$sql ="DELETE FROM pcm_show WHERE id = ".$id;
			$count = $conn->exec($sql);
			if($count > 0) {
				$data = array("message" => "Success");
			}else{
				http_response_code(404);
				$data = array("message" => "not found");
			}			
		}else{
			http_response_code(404);
			$data = array("errorMessage" => "not found");
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>