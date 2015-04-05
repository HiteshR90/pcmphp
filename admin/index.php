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
        <style>
        h1 span{
            color:#483247;
        }
        a p{
            text-align: right !important;
              color:#483247 !important;
              font-family: 'Josefin Slab', serif;
              font-size: .8em;
              text-transform: uppercase;
            } 
        </style>
    </head>
    <body class="admin">
    <div >
	<?php
		if(isset($_SESSION['session_user'])) {
			header("location: admin-home.php");
		}
	?>
        <div class="row admin-login">
            <div class="large-7 medium-7 small-12 columns login-img">
               <img src="../img/LogoLg.png"/>
            </div>
            <div class="large-5 medium-5 small-12 columns login-container">
            <h1>Admin <span>|</span> login</h1>
            <form class="adm-inputA" action="login.php" method="POST">
			<?php
					if( isset($_SESSION['ERRMSG_COMMON'])) {
						echo $_SESSION['ERRMSG_COMMON'];
						unset($_SESSION['ERRMSG_COMMON']);
					}
			?>
              <input type="text" name="uname" placeholder="email">
				<?php
					if( isset($_SESSION['ERRMSG_EMAIL'])) {
						echo "<div class='error radius '>".$_SESSION['ERRMSG_EMAIL']."</div>";
						unset($_SESSION['ERRMSG_EMAIL']);
					}
				?>
			  <!-- <div class="error radius ">Invalid email</div>-->
              
              <input type="password" name="pword" placeholder="password">
			  <?php
					if( isset($_SESSION['ERRMSG_PASSWORD'])) {
						echo "<div class='error radius '>".$_SESSION['ERRMSG_PASSWORD']."</div>";
						unset($_SESSION['ERRMSG_PASSWORD']);
					}
				?>
                <!--<div class="error radius hide">Invalid Password</div>-->
              <a><p class="modal forgot">Forgot My Password</p></a>
              <button type="submit" class="send right" value="LOGIN">Let Me In</button>
            </form>
          </div>
        </div>
    </div>
    <!-- modal -->
    <div id="pwModal" class="reveal-modal small" data-reveal>
     <div> 
      <div class="row outer-title">
        <div class="large-12 medium-12 small-12 columns">
        <h3>forgot your password?</h3> 
        <p>enter your email</p>
        <form>
            <input type="text" name="email" placeholder="email">
            <button type="submit" class="send right" value="SEND">Send</button>
        </form>     
      </div>
    </div>  
      <a class="close-reveal-modal">X</a>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/foundation.js"></script>
    <script src="../js/foundation.reveal.js"></script>
    <script>
    $(document).foundation();
    $( '.modal' ).click(function(){
      $('#pwModal').foundation('reveal', 'open'); 
    });
    </script>
    </body>
</html>    