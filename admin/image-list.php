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
	<script type="text/template" id="image_template">
	<section class="photo-tab tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h2 class="left">
              Edit photo
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <button class="right send modal add-image"> add +</button>
            <div class="image-list"></div>
          </div>
        </div>
      </section>

	<!-- modal shells -->
	<div id="imageModal" class="reveal-modal small" data-reveal>
		<h3>Add A New Image</h3>
		<div class="row">
			<div class="large-12 medium-12 small-12 columns">
				<div>
					<input type="file" id="imageFile" name="imageFile">
					<div class="imageError control-group">
						<span class="help-inline"></span>
					</div>
				</div>
				<button class="right send save-image" type="submit">Submit</button>
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
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
	<script type="text/javascript" src="../js/handlebars.js"></script>

	<script type="text/javascript"
		src="../js/model/ImageModel.js"></script>
	<script type="text/javascript"
		src="../js/view/ImageView.js"></script>

	<script type="text/javascript">
		var imageModel = Backbone.Model.extend();
		var imageModel = new ImageView({
			model : new imageModel({
				"baseUrl" : "${pageContext.servletContext.contextPath}"
			})
		});
		imageModel.render();
		$(document).foundation();
		$(function() {
			// Variable to store your files
			var files;
			// Add events
			$('#imageFile').change(function() {
				var valid = CheckExtension(this);
				if (valid)
					valid = validateFileSize(this);
				if (valid)
					files = this;
			});
			var validFilesTypes = [ "jpg", "png", "jpeg" ];

			function CheckExtension(e) {
				/*global document: false */

				var file = e;
				var path = file.value;

				var ext = path
						.substring(path.lastIndexOf(".") + 1, path.length)
						.toLowerCase();
				var isValidFile = false;
				for (var i = 0; i < validFilesTypes.length; i++) {
					if (ext == validFilesTypes[i]) {
						isValidFile = true;
						break;
					}
				}
				if (!isValidFile) {
					e.value = null;
					alert("Invalid File. Unknown Extension Of Tender Doc"
							+ "Valid extensions are:\n\n"
							+ validFilesTypes.join(", "));
				}
				return isValidFile;
			}

			function validateFileSize(e) {
				/*global document: false */
				var file = e;
				var fileSize = file.files[0].size;
				var isValidFile = false;
				if (fileSize !== 0 && fileSize <= 25214400) {
					isValidFile = true;
				}
				if (!isValidFile) {
					e.value = null;
					alert("File Size Should be Greater than 0 and less than 25 mb");
				}
				return isValidFile;
			}

		});
	</script>
</html>
