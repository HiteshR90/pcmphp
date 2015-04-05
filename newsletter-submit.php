<?php
	include('database.php');
	date_default_timezone_set('Etc/UTC');
	require 'lib/PHPMailerAutoload.php';
	
	$errflag = false;
	$validation_failed = false;
	$validation_msg = "";
	$sender_email = "";
	$sender_pwd = "";
	
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['message'];
	$request_type = $_POST['request_type'];
	
	$data = $request_type;
	if (strlen($name) <= 0) {
		$data = array("validation_column" => 'NAME');
		$validation_msg = "Name is required";	
		$validation_failed = true;
	}else if (strlen($email) <= 0) {
		$data = array("validation_column" => 'EMAIL');
		$validation_msg = "Email is required";	
		$validation_failed = true;
	} else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
		$data = array("validation_column" => 'EMAIL');
		$validation_msg = "Email is invalid";	
		$validation_failed = true;
	}
	if($validation_failed)
	{	http_response_code(409);
		$data["validation_msg"] = $validation_msg;
	}else
	{
		if($request_type == "newsletter")
		{
			$result = $conn->prepare("select email from pcm_news_letter where email=:email");
			$result->bindParam(':email', $email);
			$result->execute();
			$rows = $result->fetch(PDO::FETCH_ASSOC);
			
			if($rows>0) {
				http_response_code(409);
				$data = array("validation_column" => 'EMAIL');
				$data["validation_msg"] = 'Email already exists';
			}
			else
			{
				try 
				{
					$conn->beginTransaction();
					$sql = "INSERT INTO pcm_news_letter (name,email) VALUES (:name,:email)";
					$q = $conn->prepare($sql);
					$q->execute(array(':name'=>$name,':email'=>$email));	
					$conn->commit();
					$data = array("message" => "success");
				} catch (PDOException $e) {
					$conn->rollBack();
					http_response_code(409);
					$data = array("errorMessage" => $e->getMessage());
				} catch (Exception $e) {
					$conn->rollBack();
					http_response_code(409);
					$data = array("errorMessage" => $e->getMessage());
				}
			}
		}
		else if ($request_type == "bookme" || $request_type == "questions")
		{
			$mail = new PHPMailer();  
			$mail->SMTPDebug = 0;
			$mail->IsSMTP();  // Telling the class to use SMTP
			$mail->SMTPAuth   = true;                   // enable SMTP authentication
			$mail->SMTPSecure = 'tls';                  // sets the prefix to the servier
			$mail->Host       = 'smtp.gmail.com';       // sets GMAIL as the SMTP server
			$mail->Port       = '25';                
			$mail->Username   = $sender_email;     // GMAIL username
			$mail->Password   = $sender_pwd;        // GMAIL password
			$mail->SetFrom(	$sender_email, $name);
			$mail->Subject    = $request_type;
			$mail->MsgHTML($msg);
			$mail->AddAddress($email);
						
			 
			if(!$mail->Send()) {
				$data = array("validation_msg" => 'Message was not sent.');
				$data = array("errorMessage" => $mail->ErrorInfo);
			} else {
				http_response_code(200);
				$data = array("message" => 'Message has been sent.');
			}
		}
	}
		/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
 ?>