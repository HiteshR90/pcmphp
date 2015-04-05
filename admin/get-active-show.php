<?php
	/* include db.config.php */
	include('../database.php');

	session_start();
	if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
		http_response_code(401);
		$data = array("errorMessage" => "Please login");
	}else{
		$query="select show0_.id, show0_.city, show0_.venue, show0_.detail, DATE_FORMAT(date(CONVERT_TZ(show0_.show_date, '+00:00', timezone1_.zone)),'%c/%d/%y') as date from pcm_show show0_ inner join pcm_time_zone timezone1_ on show0_.time_zone=timezone1_.id where CONVERT_TZ(show0_.show_date, '+00:00', timezone1_.zone)>CONVERT_TZ(utc_timestamp(), '+00:00', timezone1_.zone)";
		$result = $conn->prepare($query);
		$result->execute();
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		if($rows > 0) {
			$data = $rows;
		} else{
			$data = array("errorMessage" => "not found");
		}
	}
	/* JSON Response */
	header('Content-type: application/json');
	echo json_encode($data);
?>