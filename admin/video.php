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
	<section class="video-tab  tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h2 class="left">
              Edit Video
            </h2>
          </div>
        </div>
		<?php
				if( isset($_SESSION['SUCCESS_MSG'])) {
					echo $_SESSION['SUCCESS_MSG'];
					unset($_SESSION['SUCCESS_MSG']);
				}
			?>
        <div class="row">
          <div class="large-7 medium-12 small-12 columns">
          <form action="video-submit.php" method="post">
					<div>
						<?php
								$active=true;
								$result = $conn->prepare("SELECT * FROM pcm_video WHERE active= :active");
								$result->bindParam(':active', $active);
								$result->execute();
								$rows = $result->fetch();
								if($rows > 0) {
									echo "<input type='text' id='link' name='link' value='".$rows['link']."'/>";
								}else{
									echo "<input type='text' id='link' name='link'/>";
								}
						?>
					</div>
					<button type="submit" class="send right" value="SUBMIT">Submit</button>
			</form>
          </div>
          <div class="large-5 medium-12 small-12 columns" style="text-align:center;">
            <h2></h2>
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
	<script>
		$(document).foundation();
	</script>
</html>