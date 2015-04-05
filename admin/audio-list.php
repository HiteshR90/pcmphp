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
	<div class="content"></div>
	<script type="text/template" id="audio_template">
	<section class="audio-tab tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h2 class="left">
              Edit Audio
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
			<button class="right send modal add-audio"> add +</button>
			<div class="audio-list"></div>
          </div>
        </div>
      </section>
	  
	<!-- modal shells -->
	<div id="audiModal" class="reveal-modal small" data-reveal>
		<h3>Add a New Track</h3>
		<div class="row">
			<div class="large-12 medium-12 small-12 columns">
				<div class="commonError control-group">
						<span class="help-inline"></span>
					</div>
					<div><input type="file" id="audioFile" name="audioFile"></div>
					<div class="attachmentError control-group">
						<span class="help-inline"></span>
					</div>
					<div><input type="text" id="trackName" name="trackName"></div>
					<div class="trackNameError control-group">
						<span class="help-inline"></span>
					</div>
				<button class="right send save-audio" type="submit">Submit</button>
			</div>
		</div>
		<a class="close-reveal-modal">X</a>
	</div>
	</script>
	<?php
		include('footer.php');
	?>

	<script src="../js/jquery.js"></script>
	<script src="../js/sticky-footer.js"></script>
	<script src="../js/foundation.js"></script>
	<script src="../js/foundation.topbar.js"></script>
	<script src="../js/foundation.reveal.js"></script>
	<script src="../js/foundation.dropdown.js"></script>

	<script type="text/javascript"
		src="../js/underscore-min.js"></script>
	<script type="text/javascript"
		src="../js/backbone-min.js"></script>
	<script type="text/javascript"
		src="../js/backbone-model-file-upload.js"></script>
	<script type="text/javascript" src="..//js/handlebars.js"></script>

	<script type="text/javascript"
		src="../js/model/AudioModel.js"></script>
	<script type="text/javascript"
		src="../js/view/AudioView.js"></script>

	<script type="text/javascript">
		var audioModel = Backbone.Model.extend();
		var audioView = new AudioView({
			model : new audioModel({
				"baseUrl" : "${pageContext.servletContext.contextPath}"
			})
		});
		audioView.render();
		$(document).foundation();
	</script>
</html>
