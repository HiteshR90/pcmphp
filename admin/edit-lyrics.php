<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("message" => "Please login");
	}else{
		$id = $_GET['lyricsId'];
		$result = $conn->prepare("select lyrics.title as songname, lyrics.lyrics_content as content from pcm_lyrics as lyrics where lyrics.id=:lyricsId");
		$result->bindParam(':lyricsId', $id);
		$result->execute();
		$rows = $result->fetch(PDO::FETCH_ASSOC);
		
		if($rows>0){
			$data = $rows;
		}else{
			http_response_code(404);
			$data = array("errorMessage" => "not found");
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>