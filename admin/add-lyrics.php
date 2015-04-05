<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("message" => "Please login");
	}else{
		$post_vars = json_decode(file_get_contents('php://input'), true);
		
		$songname = $post_vars['songname'];
		$songcontent = $post_vars['songcontent'];
		
		//$result = $conn->prepare("select * from pcm_lyrics where title=:songname");
		//$result->bindParam(':songname', $songname);
		//$result->execute();
		//$rows = $result->fetch(PDO::FETCH_ASSOC);
		//if($rows>0) {
			try {
				$conn->beginTransaction();
				$result = $conn->prepare("INSERT into pcm_lyrics (title,lyrics_content) values (:songname,:songcontent)");
				$result->bindParam(':songname', $songname);
				$result->bindParam(':songcontent', $songcontent);
				$result->execute();
				$conn->commit();
				$data = array("message" => "success");
			} catch (PDOException $e) {
				$conn->rollBack();
				http_response_code(409);
				$data = array("errorMessage" => "Song already exist");
			} catch (Exception $e) {
				$conn->rollBack();
				http_response_code(409);
				$data = array("errorMessage" => $e->getMessage());
			}
		//} else {
			//http_response_code(409);
			//$data = array("errorMessage" => "Song already exist");
		//}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>