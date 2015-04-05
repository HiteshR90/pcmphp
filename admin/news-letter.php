<?php
		session_start();
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta description="" />
    <title>Peter Chung | Log In</title>
    <link rel="icon" type="image/x-icon" href="../img/pcm.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
  </head>
<body>
	<body class="admin">
	<?php
		if(!isset($_SESSION['session_user'])||$_SESSION['session_user']=="") {
			header("location: index.php");
		}
	?>
    <div class="row hide-for-large-up logoRow">
      <div><img src="../img/adminLogo.3.png"></div>
    </div>
	<?php
		include('admin-menu.php');
		include('../database.php');
	?>
	<div class="content">
	<section class="newsletter-tab tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3 class="left">
              Newsletter Subscribers
            </h3>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
		  <?php
				$result = $conn->prepare("SELECT count(*) FROM pcm_news_letter");
				$result->execute();
				$rows = $result->fetchAll(PDO::FETCH_COLUMN,0);
				if($rows > 0) {
					$count=$rows[0];
					if($count>0){
						echo "<div class='right'>".$count." of subscribers</div>";
						
						echo "<table>";
						echo "<thead>";
						echo "<tr>";
						echo "<th>name</th>";
						echo "<th>email</th>";
						echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
						$result = $conn->prepare("SELECT name,email FROM pcm_news_letter");
						$result->execute();
						$rows = $result->fetchAll(PDO::FETCH_ASSOC);
						  foreach($rows as $row){
							echo "<tr>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['email']."</td>";
							echo "</tr>";
						  }
						echo "</tbody>";
						echo "</table>";
					}else{
						echo "No data found";
					}
				}
			?>
          </div>
        </div>
		<div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3>Send a Newsletter</h3>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
		  			
            <div class="edit-box"> 	
			<textarea cols="80" rows="10" id="content" name="content"></textarea>
			</div><br>
            <button type="submit" class="send right" value="SEND">send</button>
          </div>
        </div>
      </section>
	</div>
	<?php
		include ('footer.php');
	?>

	<script src="../js/jquery.js"></script>
	<script src="../js/sticky-footer.js"></script>
	<script src="../js/foundation.js"></script>
	<script src="../js/foundation.topbar.js"></script>
	<script src="../js/foundation.reveal.js"></script>
	<script src="../js/foundation.dropdown.js"></script>
	<script src="../js/ckeditor/ckeditor.js"></script>
	<script src="../js/ckeditor/adapters/jquery.js"></script>
	<script>
		$(document).foundation();
	</script>
	<script>
		CKEDITOR.disableAutoInline = true;

		$(document).ready(function() {
			$('#content').ckeditor(); // Use CKEDITOR.replace() if element is <textarea>.

		});

		function setValue() {
			$('#content').val($('input#val').val());
		}
		/*$("#save").click(function() {
			var val = CKEDITOR.instances['editor1'].getData();
			alert(val);
		});*/
	</script>
</html>