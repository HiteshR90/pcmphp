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
	<script type="text/template" id="setting_template">
		<section class="settings-tab tabs">  
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3 class="left">
              Edit My Settings
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3>change my password</h3>
			<div class="changePasswordSuccess control-group"><span class="help-inline"></span></div>
			<div class="changePasswordError control-group"><span class="help-inline"></span></div>
            <div class="settings-form">
            <input type="password" id="current_password" palceholder="current password">
			<div class="currentPasswordError control-group">
						<span class="help-inline"></span></div>
            <input type="password" id="new_password" palceholder="new password">
			<div class="newPasswordError control-group">
						<span class="help-inline"></span></div>
            <input type="password" id="confirm_password" palceholder="confirm password">
			<div class="confirmPasswordError control-group">
						<span class="help-inline"></span></div>
            <button class="right send change-password">Update</button>
            </div>
          </div>
        </div>
          <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3>change email</h3>
			<div class="emailSuccess control-group"><span class="help-inline"></span></div>
			<div class="commonEmailError control-group"><span class="help-inline"></span></div>
            <div class="settings-form">
				<?php
					$active=true;
					$result = $conn->prepare("SELECT email FROM pcm_email WHERE active= :active");
					$result->bindParam(':active', $active);
					$result->execute();
					$rows = $result->fetch();
					if($rows > 0) {
						echo "<input type='text' palceholder='email' id='email' value='".$rows['email']."'>";
					}else{
						echo "<input type='text' palceholder='email' id='email'>";
					}
				?>
				<div class="emailError control-group">
						<span class="help-inline"></span></div>
				<button class="right send update-email">Update</button>
			</div>
          </div>
        </div>
       </section>
	</script>
	<?php
		include ('footer.php');
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
	<script type="text/javascript" src="../js/handlebars.js"></script>

	<script type="text/javascript"
		src="../js/model/EmailModel.js"></script>
	<script type="text/javascript"
		src="../js/model/ChangePasswordModel.js"></script>
	<script type="text/javascript"
		src="../js/view/SettingView.js"></script>
	<script type="text/javascript">
		var settingModel = Backbone.Model.extend();
		var settingView = new SettingView({
			model : new settingModel({
				"baseUrl" : "${pageContext.servletContext.contextPath}"
			})
		});
		settingView.render();
		$(document).foundation();
	</script>
</html>