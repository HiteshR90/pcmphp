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
	<link rel="stylesheet" type="text/css"
	href="../css/jquery.datetimepicker.css">
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
	<script type="text/template" id="lyrics_template">

	 <section class="lyric-tab tabs">
		<div class="row">
			<div class="large-12 medium-12 small-12 columns">
				<h3 class="left">
				Edit lyrics
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="large-12 medium-12 small-12 columns table">
				<button class="right send modal add-new-lyrics"> add +</button>
				<div class="large-12 medium-12 small-12 columns lyrics-list"></div>
			</div>
		</div>
	</section> 
	<div id="lyricsModal" class="reveal-modal medium" data-reveal data-options="close_on_background_click:false;close_on_esc:false;">
		<h3> add a Lyric</h3>
		<div class="row">
			<div class="large-12 medium-12 small-12 columns">
				<div><input type="text" name="song-name" id="song_names" placeholder="track name"></div>
				<div class="songNameError control-group"><span class="help-inline"></span></div>
			</div>
		</div>
		<div class="row">
			<div class="large-12 medium-12 small-12 columns">
				<p style="margin-bottom:2px;">wite the track name once more (bold/strong font) in the box below, above the your new lyrics</p>
				<div class="edit-box"><textarea cols="80" rows="10" id="lyricsContent" name="lyricsContent"></textarea></div><br>
				<div class="lyricsContentError control-group"><span class="help-inline"></span></div>
				<button type="submit" class="send right save-update-lyrics" value="SUBMIT">Submit</button>
			</div>
		</div>
		<a class="close-reveal-modal">X</a>
	</div>
	</script>
	<?php
		include('footer.php');
	?>

	<script src="../js/jquery.js"></script>
	<script src="../js/jquery.datetimepicker.js"></script>
	<script src="../js/sticky-footer.js"></script>
	<script src="../js/foundation.js"></script>
	<script src="../js/foundation.topbar.js"></script>
	<script src="../js/foundation.reveal.js"></script>
	<script src="../js/foundation.dropdown.js"></script>
	<script src="../js/ckeditor/ckeditor.js"></script>
	<script src="../js/ckeditor/adapters/jquery.js"></script>
	
	<script type="text/javascript"
		src="../js/underscore-min.js"></script>
	<script type="text/javascript"
		src="../js/backbone-min.js"></script>
	<script type="text/javascript" src="../js/handlebars.js"></script>

	<script type="text/javascript"
		src="../js/model/LyricsModel.js"></script>
	<script type="text/javascript"
		src="../js/view/LyricsView.js"></script>
	
	<script type="text/javascript">
		var lyricsModel = Backbone.Model.extend();
		var lyricsView = new LyricsView({
			model : new lyricsModel()
		});
		lyricsView.render();
		$(document).foundation();
	</script>
	<script>
		CKEDITOR.disableAutoInline = true;
		$(".close-reveal-modal").click(function(){
			//alert('hello');
			CKEDITOR.instances['lyricsContent'].destroy();
		});
		$(document).ready(function() {
			//$('#lyricsContent').ckeditor(); // Use CKEDITOR.replace() if element is <textarea>.

		});

		//function setValue() {
			//$('#lyricsContent').val($('input#val').val());
		//}
		/*$("#save").click(function() {
			var val = CKEDITOR.instances['editor1'].getData();
			alert(val);
		});*/
	</script>
</html>
