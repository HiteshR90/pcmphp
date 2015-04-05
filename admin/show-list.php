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
	<script type="text/template" id="show_template">
	<section class="event-tab tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3 class="left">
              Edit Shows
            </h3>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns table">
             <button class="right send modal add-new-show"> add +</button>
            <div class="large-12 medium-12 small-12 columns show-list"></div>
          </div>
        </div>
      </section>
		<div id="eventModal" class="reveal-modal small" data-reveal>
		<h3>Add an event</h3>
			<div class="row">
				<div class="large-12 medium-12 small-12 columns">
					<ul	class="small-block-grid-2 medium-block-grid-2 large-block-grid-3">
						<li><input type="text" id="venue" placeholder="venue">
							<div class="venueError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
						<li><input type="text" id="city" placeholder="city">
							<div class="cityError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
						<li><input type="text" id="date" placeholder="date" readonly>
							<div class="dateError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
						<li>
						<textarea id="detail" placeholder="detail"></textarea>
							<div class="detailError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
						<li><input type="text" id="cost" placeholder="cost">
							<div class="costError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
						<li><input type="text" id="link" placeholder="ticket link">
							<div class="linkError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
						<li>
						<textarea id="address" placeholder="venue address"></textarea>
							<div class="addressError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
						<li><input type="text" id="contactNo" placeholder="venue contact number">
							<div class="contactError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
						<li><select id="timezone"></select>
							<div class="timezoneError control-group">
								<span class="help-inline"></span>
							</div>
						</li>
					<ul>
						<button class="right send save-update-event">Submit</button>
				</div>
			</div>
			<a class="close-reveal-modal">&#215;</a>
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

	<script type="text/javascript"
		src="../js/underscore-min.js"></script>
	<script type="text/javascript"
		src="../js/backbone-min.js"></script>
	<script type="text/javascript" src="../js/handlebars.js"></script>

	<script type="text/javascript"
		src="../js/model/ShowModel.js"></script>
	<script type="text/javascript"
		src="../js/view/ShowView.js"></script>
	<script type="text/javascript">
		var showModel = Backbone.Model.extend();
		var showView = new ShowView({
			model : new showModel({
				"baseUrl" : "${pageContext.servletContext.contextPath}"
			})
		});
		showView.render();
		$(document).foundation();
	</script>
</html>
