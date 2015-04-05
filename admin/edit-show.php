<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("message" => "Please login");
	}else{
		$id = $_GET['showId'];
		$result = $conn->prepare("select show0_.city as city, show0_.venue as venue, show0_.detail as detail, date_format(CONVERT_TZ(show0_.show_date, '+00:00', timezone1_.zone), '%m/%d/%Y %H:%i') as date, timezone1_.name as timeZone, show0_.cost as cost, show0_.link_to_buy as link , show0_.contact_venue as contact,show0_.address as address from pcm_show show0_ inner join pcm_time_zone timezone1_ on show0_.time_zone=timezone1_.id where show0_.id=:showId");
		$result->bindParam(':showId', $id);
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