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
		<section class="about-tab tabs">
			<div class="row">
				<div class="large-12 medium-12 small-12 columns">
					<h2 class="left">Edit About</h2>
				</div>
			</div>
			<?php
				if( isset($_SESSION['SUCCESS_MSG'])) {
					echo $_SESSION['SUCCESS_MSG'];
					unset($_SESSION['SUCCESS_MSG']);
				}
			?>
			<div class="row">
				<div class="large-12 medium-12 small-12 columns">
					<form method="post" action="about-submit.php">
						<div class="edit-box">
						<textarea cols="80" rows="10" id="content" name="content">
						<?php
								$active=true;
								$result = $conn->prepare("SELECT * FROM pcm_about WHERE active= :active");
								$result->bindParam(':active', $active);
								$result->execute();
								$rows = $result->fetch();
								if($rows > 0) {
									echo $rows['content'];
								}
							?>	
						</textarea>
						</div>
						<br>
						<button class="right send" type="submit">Submit</button>
					</form>
				</div>
			</div>
		</section>
	</div>
	<?php
		include('footer.php');
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
