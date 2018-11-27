<?php 
	include "style/publicstyle.php";
	include "database.php";
	include "session.php";
?>
<?php
	if(isset($_POST["submit"]))
	{
		$name=mysql_real_escape_string($_POST["name"]);
		$email=mysql_real_escape_string($_POST["email"]);
		$comment=mysql_real_escape_string(trim($_POST["comment"]));
		date_default_timezone_set("Asia/Kolkata");
		$currtime=time();
		$datetime=strftime("%d-%B-%Y %H:%M:%S",$currtime);
		$postid=$_GET["id"];
		if(strlen($comment)>500)
		{
			$_SESSION["errormessage"]="Comment should me less than 500 character";
		}
		else if(strlen($name)>200)
		{
			$_SESSION["errormessage"]="Too Long Name";
		}
		else if(strlen($comment)>200)
		{
			$_SESSION["errormessage"]="Too long email address";
		}
		else
		{
			$query="insert into comments(datetime,name,email,comment,status,admin_panel_id,approvedby) values ('$datetime','$name','$email','$comment','OFF','$postid','pending')";
			$execute=mysql_query($query);
			if($execute)
			{
				$_SESSION["successmessage"]="Comment added Successfully";
				header('Location: /blog/fullpost.php?id='.$postid);
				exit;
			}
			else
			{
				$_SESSION["errormessage"]="Oops Something went wrong.Comment failed to add.Please try after some time.";
				header('Location: /blog/fullpost.php?id='.$postid);
				exit;
				
			}
		}
	}
?>
<html>
	<head>
		<title>Full Blog</title>
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
						<li class="active"><a href="blog.php">Blog</a></li>
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
		<div class="container">
			<div class="blog-header">
				<h1>CMS Blog</h1>
				<p class="lead">This blog is made by Spiddy Creations</p>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
				<?php echo errormessage(); echo successmessage();?>
					<?php
						if(isset($_GET["searchbtn"]))
						{
							$search=$_GET["search"];
							$query="select * from admin_panel where datetime like '%$search%' OR post like '%$search%' OR category like '%$search%' OR title like '%$search%' order by datetime desc";
						}
						else
						{
							$fullpostid=$_GET["id"];
							$query="select * from admin_panel where id = '$fullpostid' order by datetime desc";
						}
						$execute=mysql_query($query);
						while($row=mysql_fetch_array($execute))
						{
							$title=$row["title"];
							$category=$row["category"];
							$post=$row["post"];
							$image=$row["image"];
							$author=$row["author"];
							$datetime=$row["datetime"];
							$id=$row["id"];?>
							<div class="blogpost thumbnail"><!-- blogpost class is cutom -->
								<img class="img-responsive img-rounded" src="image_upload/<?php echo $image;?>">
								<div class="caption">
									<h1 id="heading"> <?php echo $title;?> </h1>
									<p class="description">Category : <?php echo $category;?><br>Published on : <?php echo $datetime;?><br>By : <?php echo $author;?></p>
									<p class="post"><?php echo htmlentities(nl2br($post)) ;?></p>
								</div>
							</div><?php
						}
					?><br><br><br><br>
					<span style="color:rgb(251,174,44);font-family:Bitter;font-size:1.2em;"> Comments </span> <br>
						<?php
							$postid=$_GET["id"];
							$query="select * from comments where admin_panel_id='$postid' and status='ON' order by datetime desc";
							$execute=mysql_query($query);
							if($execute)
							{
								while($row=mysql_fetch_array($execute))
								{
									$comment_name=$row["name"];
									$comment_time=$row["datetime"];
									$comment=$row["comment"];?>
									<div class="comment_block">
										<img class="pull-left"src="images/comment_icon.jpg"width="50" height="60">
										<p class="comment-info"><?php echo $comment_name;?></p>
										<p class="description"><?php echo $comment_time;?></p>
										<p class="comment"><?php echo htmlentities(nl2br($comment));?></p>
									</div>
									<br><hr>
						  <?php }
							}
						?>
					<div>
						<?php $postid=$_GET["id"]; ?>
						<form action="fullpost.php?id=<?php echo $postid;?>" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
									<label for="name"><span style="color:rgb(251,174,44);font-family:Bitter;font-size:1.2em;">Name: </span></label>
									<input class="form-control" type="text" name="name" id="name" placeholder="Name" required>
								</div>
								<div class="form-group">
									<label for="email"><span style="color:rgb(251,174,44);font-family:Bitter;font-size:1.2em;">Email: </span></label>
									<input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
								</div>
								<div class="form-group">
									<label for="comment"><span style="color:rgb(251,174,44);font-family:Bitter;font-size:1.2em;">Comment: </span></label>
									<textarea class="form-control" type="text" name="comment" id="comment" required></textarea>
								</div>
								<br>
								<input class="btn btn-primary" type="submit" name="submit" value="Submit"></input>
							</fieldset><br>
						</form>
					</div>
				</div>
				<div class="col-sm-1">
				</div>
				<div class="col-sm-3">
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