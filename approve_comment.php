<?php 
	include "session.php";
	require_once "database.php";
?>
<?php
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
		$admin=$_SESSION["username"];
		$query="update comments set status='ON' , approvedby='$admin' where id='$id'";
		$execute=mysql_query($query);
		if($execute)
		{
			$_SESSION["successmessage"]="Comment Approved Successfully";
			header('Location: /blog/comments.php');
			exit;
		}
		else
		{
			$_SESSION["errormessage"]="Oops Something went wrong.Comment failed to get approved.Please try after some time.";
			header('Location: /blog/comments.php');
			exit;
		}
	}
?>
