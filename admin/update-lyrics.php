<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("message" => "Please login");
	}else{
		$id = $_GET['lyricsId'];
		//$post = file_get_contents('php://input');
		//$data=$post;
		//if($_POST)
		//{
		//$post_vars="post data";
		//}else{
		$post_vars = json_decode(file_get_contents('php://input'), true);
		//parse_str(file_get_contents("php://input"),$post_vars);
		//echo $post_vars['fruit']." is the fruit\n";
		//}
		$songname = $post_vars['songname'];
		$songcontent = $post_vars['songcontent'];
		
		
		
		$result = $conn->prepare("select * from pcm_lyrics where id=:lyricsId");
		$result->bindParam(':lyricsId', $id);
		$result->execute();
		$rows = $result->fetch(PDO::FETCH_ASSOC);
		if($rows>0) {
			try {
				$conn->beginTransaction();
				$result = $conn->prepare("UPDATE pcm_lyrics SET title=:songname,lyrics_content=:songcontent where id=:lyricsId");
				$result->bindParam(':songname', $songname);
				$result->bindParam(':songcontent', $songcontent);
				$result->bindParam(':lyricsId', $id);
				$result->execute();
				$conn->commit();
				$data = array("message" => "success".$songcontent);
			} catch (PDOException $e) {
				$conn->rollBack();
				http_response_code(409);
				$data = array("errorMessage" => "Song already exist");
			} catch (Exception $e) {
				$conn->rollBack();
				http_response_code(409);
				$data = array("errorMessage" => $e->getMessage());
			}
		} else {
			http_response_code(404);
			$data = array("errorMessage" => "Song not exist");
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>