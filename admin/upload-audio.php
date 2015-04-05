<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("errorMessage" => "Please login");
	} else {
		if(isset($_FILES["attachment"]["type"])){
			$validextensions = array("mp3");
			$temporary = explode(".", $_FILES["attachment"]["name"]);
			$file_extension = end($temporary);
			if (($_FILES["attachment"]["size"] < 10000000)//Approx. 10000kb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {
				if ($_FILES["attachment"]["error"] > 0) {
					http_response_code(404);
					$data = array("errorMessage" => $_FILES["attachment"]["error"]);
				} else {
					if (file_exists("../resources/audio/" . $_FILES["attachment"]["name"])) {
						http_response_code(409);
						$data = array("errorMessage" => "already exists.");
					} else {
						try {
							$trackName=$_POST['trackName'];
							$conn->beginTransaction();
							$stmt = $conn->prepare("INSERT INTO pcm_audio (file_name,track_name) VALUES (:name,:trackName)");
							$stmt->bindParam(':name', $name);
							$stmt->bindParam(':trackName', $trackName);
							
							// insert one row
							$name = $_FILES["attachment"]["name"];
							$stmt->execute();

							$sourcePath = $_FILES['attachment']['tmp_name']; // Storing source path of the file in a variable
							$uploadDir="../resources/audio/";
							$targetPath = $uploadDir.$_FILES['attachment']['name']; // Target path where file is to be stored
							if (file_exists($uploadDir) && is_writable($uploadDir)) {
								$conn->commit();
								move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
								$data = array("message" => "Successfully Upload");
							} else {
								$conn->rollBack();
								http_response_code(409);
								$data = array("errorMessage" => "Upload directory is not writable, or does not exist.");
							}
						} catch (PDOException $e) {
							$conn->rollBack();
							http_response_code(409);
							$data = array("errorMessage" => "Audio already exist");
						} catch (Exception $e) {
							$conn->rollBack();
							http_response_code(409);
							$data = array("errorMessage" => "The audio could not be added");
						}
					}
				}
			} else {
				http_response_code(404);
				$data = array("errorMessage" => "Invalid filesize or file type");
			}
		}else{
			http_response_code(404);
			$data = array("errorMessage" => $_FILES["attachment"]["type"]);
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>