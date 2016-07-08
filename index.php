<html>
<title>Login with Jquery</title>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['loggedIn'])): ?> 
	<form enctype="application/x-www-form-urlencoded" method="post" id="login-form" action="">
		<dl>
			<dt id="username-label"><label for="username" class="required">Your user name:</label></dt>
			<dd id="username-element"><input type="text" name="username" id="username" value=""></dd>
			<dt id="password-label"><label for="password" class="required">Your password:</label></dt>
			<dd id="password-element"><input type="password" name="password" id="password" value=""></dd>
			<dt id="submit-label">&#160;</dt>
			<dd id="submit-element"><input type="button" name="submit" id="submit" value="Login"></dd>
		</dl>
	</form>

    <script type="text/javascript">
	$(document).ready(function() {
		$("#submit").click(function(event) {
			if (!$("#username").val() || !$("#password").val()) {
				alert("Username and Password are required fields");
			} else {
				$.post("login.php", { username: $("#username").val(), password: $("#password").val() },
					function(data) {
						data = jQuery.parseJSON(data);
						if (data.success == 'no') {
							alert(data.msg);
						} else {
							window.location.replace("index.php");
						}
				});
			}
		});
	});
	</script>
	
	
	
<?php else: ?>
	<h1>You are logged in</h1>
	<input type="button" name="logout" id="logout" value="Logout">
	<script type="text/javascript">
	$(document).ready(function() {
		$("#logout").click(function(event) {
			$.post("logout.php", function(data) {
				window.location.replace("index.php");
			});
			return false;
		});
	});
	</script>
<?php endif; ?>

</body>
</html>