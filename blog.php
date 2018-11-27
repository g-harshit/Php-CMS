<?php 
	include "style/publicstyle.php";
	include "database.php";
	include "session.php";
?>
<html>
	<head>
		<title>Blog</title>
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
					<?php
						$query="select count(*) from admin_panel";
						$execute=mysql_query($query);
						$row=mysql_fetch_array($execute);
						$total_post=array_shift($row);
						$total_pages=ceil(($total_post/3));
						
						
						$pageNo=1;
						if(isset($_GET["searchbtn"]))
						{
							$search=$_GET["search"];
							$query="select * from admin_panel where datetime like '%$search%' OR post like '%$search%' OR category like '%$search%' OR title like '%$search%' order by datetime desc";
						}
						else
						{
							if(isset($_GET["pg"]))
							{
								$pageNo=$_GET["pg"];
							}
							if($pageNo<1)$pageNo=1;
							if($pageNo>$total_pages)$pageNo=$total_pages;
							$query="select * from admin_panel order by datetime desc";
						}
						$execute=mysql_query($query);
						$start=($pageNo*3)-3;
						$end=($pageNo*3);
						$sno=0;
						while($row=mysql_fetch_array($execute))
						{
							$sno++;
							if($sno>$start && $sno<=$end)
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
										<p class="post">
											<?php if(strlen($post)>150) $post=substr($post,0,150)."...";?>
											<?php echo $post ?>
										</p>
										
									</div>
									<a href="fullpost.php?id=<?php echo $id ?>"><span class="btn btn-info">Read More &rsaquo;&rsaquo;<span></a>
								</div><?php
							}
						}
						if(!isset($_GET["searchbtn"]))
						{?>
							<nav>
								<ul class="pagination pull-left pagination-lg"><?php
									if($pageNo>1)
									{?>
										<li><a href="blog.php?pg=<?php echo $pageNo-1; ?>">&laquo</a></li><?php
									}
									for($i=1;$i<=$total_pages;$i++)
									{
										if($i==$pageNo)
										{?>
											<li class="active"><a href="blog.php?pg=<?php echo $i; ?>"><?php echo $i;?></a></li><?php
										}
										else
										{?>
											<li><a href="blog.php?pg=<?php echo $i; ?>"><?php echo $i;?></a></li><?php
										}
									}
									if($pageNo<$total_pages)
									{?>
										<li><a href="blog.php?pg=<?php echo $pageNo+1; ?>">&raquo</a></li><?php
									}?>
								</ul>
							</nav><?php
						}
					?>
				</div>
				<div class="col-sm-1">
				</div>
				<div class="col-sm-3">
					<h2 class="text-center">About Us</h2><br>
					<img class="img-responsive img-circle"src="images/frog.jpg"><br>
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