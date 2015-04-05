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
		
		$currentPassword = $post_vars['currentPassword'];
		$newPassword = $post_vars['newPassword'];
		$confirmPassword = $post_vars['confirmPassword'];
		
		$hasError=false;
		//validation goes here
		
		
		
		if(!$hasError){
			$result = $conn->prepare("SELECT * FROM pcm_user WHERE email= :email");
			$result->bindParam(':email', $user);
			$result->execute();
			$rows = $result->fetch();
			
			if($rows > 0) {
				if (password_verify($currentPassword, $rows['password'])){
					try {
						$conn->beginTransaction();
						$result = $conn->prepare("UPDATE pcm_user SET password=:password WHERE email=:email");
						$result->bindParam(':email', $user);
						$pa=password_hash($confirmPassword, PASSWORD_BCRYPT);
						$result->bindParam(':password', $pa);
						$result->execute();
						$conn->commit();
						$data = array("message" => "password change successfully");
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
					$data = array("errorMessage" => "current password not match");
				}
			}else{
				http_response_code(404);
				$data = array("errorMessage" => "user not found");
			}
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>