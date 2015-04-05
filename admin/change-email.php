<?php
	/* include db.config.php */
	include('../database.php');
	include('../lib/password.php');

	session_start();
	$user=$_SESSION['session_user'];
	if(!isset($user)||$user=="") {
		http_response_code(401);
		$data = array("message" => "Please login");
	}else{
		$post_vars = json_decode(file_get_contents('php://input'), true);
		
		$email = $post_vars['email'];
		$hasError=false;
		//validation goes here
		
		
		
		if(!$hasError){
			$result = $conn->prepare("SELECT * FROM pcm_email WHERE email= :email and active=:active");
			$result->bindParam(':email', $email);
			$active=true;
			$result->bindParam(':active', $active);
			$result->execute();
			$rows = $result->fetch();
			
			if($rows > 0) {
				try {
					$conn->beginTransaction();
					$result = $conn->prepare("UPDATE pcm_email SET email=:email WHERE id=:id");
					$result->bindParam(':email', $email);
					$result->bindParam(':id', $rows['id']);
					$result->execute();
					$conn->commit();
					$data = array("message" => "email change successfully");
				} catch (PDOException $e) {
					$conn->rollBack();
					http_response_code(409);
					$data = array("errorMessage" => $e->getMessage());
				} catch (Exception $e) {
					$conn->rollBack();
					http_response_code(409);
					$data = array("errorMessage" => $e->getMessage());
				}
			} else {
				http_response_code(404);
				$data = array("errorMessage" => "user not found");
			}
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>