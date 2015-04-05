<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("message" => "Please login");
	}else{
		//$id = $_GET['showId'];
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
		$city = $post_vars['city'];
		$venue = $post_vars['venue'];
		$detail = $post_vars['detail'];
		//$date = $post_vars['date'];
		$date = new DateTime($post_vars['date']);
		$timeZone = $post_vars['timeZone'];
		$cost = $post_vars['cost'];
		$link = $post_vars['link'];
		$address = $post_vars['address'];
		$contact = $post_vars['contact'];
		
		$result = $conn->prepare("select id,zone from pcm_time_zone where name=:name");
		$result->bindParam(':name', $timeZone);
		$result->execute();
		$rows = $result->fetch(PDO::FETCH_ASSOC);
		if($rows>0) {
			try {
				$conn->beginTransaction();
				$result = $conn->prepare("INSERT into pcm_show (city,detail,show_date,venue,time_zone,cost,link_to_buy,address,contact_venue) values (:city,:detail,CONVERT_TZ(:date, :timeZone, '+00:00'),:venue,:timeZoneId,:cost,:link,:address,:contact)");
				$result->bindParam(':city', $city);
				$result->bindParam(':detail', $detail);
				$formatedDate=date_format($date, 'Y-m-d H:i:s');
				$result->bindParam(':date', $formatedDate);
				$result->bindParam(':venue', $venue);
				$result->bindParam(':timeZoneId', $rows['id']);
				$result->bindParam(':timeZone', $rows['zone']);
				
				$result->bindParam(':cost', $cost);
				$result->bindParam(':link', $link);
				$result->bindParam(':address', $address);
				$result->bindParam(':contact', $contact);
				$result->execute();
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
		} else {
			http_response_code(404);
			$data = array("errorMessage" => "Not valid time zone");
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>