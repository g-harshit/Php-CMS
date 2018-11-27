<?php 
	include "session.php";
	include "style/adminDashboard_style.php";
	require_once "database.php";
	if(!isset($_SESSION["user_id"]))
	{
		$_SESSION["errormessage"]="Login Required";
		header("location:login.php");
		exit;
	}
?>
<?php
	if(isset($_POST["submit"]))
	{
		$category=$_POST["category"];
		date_default_timezone_set("Asia/Kolkata");
		$currtime=time();
		$datetime=strftime("%d-%B-%Y %H:%M:%S",$currtime);
		$admin=$_SESSION["username"];
		if(strlen($category)>99)
		{
			$_SESSION["errormessage"]="Too long name for Category";
		}
		else
		{
			$query="insert into category(datetime,name,creatorname) values ('$datetime','$category','$admin')";
			$execute=mysql_query($query);
			if($execute)
			{
				$_SESSION["successmessage"]="Category added Successfully";
			}
			else
			{
				$_SESSION["errormessage"]="Oops Something went wrong.Category failed to add.Please try after some time.";
			}
		}
	}
?>
<html>
	<head>
		<title>Category</title>
	</head>
	<body>
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
				<div class="collapse navbar-collapse" id="collapse">
					<ul class="nav navbar-nav">
						<li><a href="#">Home</a></li>
						<li><a href="blog.php">Blog</a></li>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Services</a></li>
						<li><a href="#">Contact Us</a></li>
						<li><a href="#">Features</a></li>
					</ul>
					<form action="blog.php" class="navbar-form navbar-right">
						<div class="form-group">
							<input class="form-control"type="text" name="search" placeholder="Search" required>
						</div>
						<button class="btn btn-default" name="searchbtn">Go</button>
					</form>
				</div>
			</div>
		</nav>
		<div class="line"style="height:10px; background-color:#27aae1;"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
					<h4 style="color:#ffffff">Spiddy Creations</h4>
					<ul id="side_menu"class="nav nav-pills nav-stacked">
						<li>
							<a href="AdminDashboard.php"><span class="glyphicon glyphicon-th"></span> Dashboard</a>
						</li>
						<li>
							<a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span> Add New Post</a>
						</li>
						<li class="active">
							<a href="categories.php"><span class="glyphicon glyphicon-tags"></span> Categories</a>
						</li>
						<li>
							<a href="admin.php"><span class="glyphicon glyphicon-user"></span> Manage Admins</a>
						</li>
						<li>
							<a href="comments.php"><span class="glyphicon glyphicon-comment"></span> Comments
								<?php
									$comment_query="select count(*) from comments where status='OFF'";
									$comment_execute=mysql_query($comment_query);
									$comment_row=mysql_fetch_array($comment_execute);
									$disapproved_comments=array_shift($comment_row);
								?>
								<span class="label pull-right label-warning"><?php if($disapproved_comments != 0) echo $disapproved_comments; ?></span>
							</a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-equalizer"></span> Live Blog</a>
						</li>
						<li>
							<a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a>
						</li>
					</ul>
				</div>
				<div class="col-sm-10">
					<h1>Manage Categories</h1>
					<?php echo errormessage(); echo successmessage();?>
					<div>
						<form action="" method="post">
							<fieldset>
								<div class="form-group">
									<label for="categoryname"><span style="color:rgb(251,174,44);font-family:Bitter;font-size:1.2em;">Name: </span></label>
									<input class="form-control" type="text" name="category" id="categoryname" placeholder="Name" required>
								</div><br>
								<input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Category"></input>
							</fieldset><br>
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>Sr.No</th>
								<th>Date & Time</th>
								<th>Category Name</th>
								<th>Creator Name</th>
								<th>Action</th>
							</tr>
							<?php
								$query="select * from category order by datetime desc";
								$execute=mysql_query($query);
								$srno=0;
								while($row=mysql_fetch_array($execute))
								{
									$id=$row["id"];
									$datetime=$row["datetime"];
									$name=$row["name"];
									$creator=$row["creatorname"];
									$srno++;?>
									<tr>
										<td><?php echo $srno;?></td>
										<td><?php echo $datetime;?></td>
										<td><?php echo $name;?></td>
										<td><?php echo $creator;?></td>
										<td><a href="delete_category.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a></td>
									</tr><?php
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<hr><p>Theme By | Harshit Gupta | &copy;2016-2020 --- All right reserved.</p>
			<a style="color:white;text-decoration:none;cursor:pointer;font-weight:bold;"href="">
				<p>
					This site is only use for study purpose spiddy creations have all right reserved.No one is allowed to distribute
					copies other than <br> &trade; spiddycreations.com &trade; Udemy ; &trade; Skillshare; &trade; StackSkills
				</p><hr> </a>
		</div>
		<div style="height:10px; background:#27aae1">
		</div>
	</body>
</html>