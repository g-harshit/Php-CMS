<?php 
	include "session.php";
	include "style/adminDashboard_style.php";
	require_once "database.php";
?>
<?php
	if(isset($_POST["submit"]))
	{
		$username=mysql_real_escape_string($_POST["username"]);
		$password=mysql_real_escape_string($_POST["password"]);
		$query="select * from admin where username='$username' and password='$password'";
		$execute=mysql_query($query);
		if($admin=mysql_fetch_assoc($execute))
		{
			$_SESSION["user_id"]=$admin["id"];
			$_SESSION["username"]=$admin["username"];
			$_SESSION["successmessage"]="welcome ".$_SESSION["username"];
			header("location:/blog/adminDashboard.php");
			exit;
		}
		else
		{
			$_SESSION["errormessage"]="Username or Password did not match";
		}
	}
?>
<html>
	<head>
		<title>Login</title>
	</head>
	<body style="background-color:white">
	<div style="height:10px; background-color:#27aae1;"></div>
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse"><!-- java script not working. data-toggle and data-target are function of javascript -->
						<span class="sr-only">Toggle-Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="blog.php"><img style="margin-top:-15px"src="images/spiddy.jpg" width=115;height=20;></a>
				</div>
			</div>
		</nav>
		<div class="line"style="height:10px; background-color:#27aae1;"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-offset-4 col-sm-4"><br><br><br><br>
					<?php echo errormessage(); echo successmessage();?>
					<h2>Welcome Back !</h2>
					<div>
						<form action="" method="post">
							<fieldset>
								<div class="form-group">
									<label for="username"><span style="color:rgb(251,174,44);font-family:Bitter;font-size:1.2em;">Username: </span></label>
									<div class="input-group input-group-lg">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-envelope text-primary"></span>
										</span>
										<input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
									</div>
								</div>
								<div class="form-group">
									<label for="password"><span style="color:rgb(251,174,44);font-family:Bitter;font-size:1.2em;">Password: </span></label>
									<div class="input-group input-group-lg">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-lock text-primary"></span>
										</span>
										<input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
									</div>
								</div>
								<br>
								<input class="btn btn-info btn-block" type="submit" name="submit" value="Login"></input>
							</fieldset><br>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>