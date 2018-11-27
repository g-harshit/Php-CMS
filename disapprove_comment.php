<?php 
	include "session.php";
	require_once "database.php";
?>
<?php
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
		$query="update comments set status='OFF' where id='$id'";
		$execute=mysql_query($query);
		if($execute)
		{
			$_SESSION["successmessage"]="Comment Dis-Approved Successfully";
			header('Location: /blog/comments.php');
			exit;
		}
		else
		{
			$_SESSION["errormessage"]="Oops Something went wrong.Comment failed to get dis-approve.Please try after some time.";
			header('Location: /blog/comments.php');
			exit;
		}
	}
?>
