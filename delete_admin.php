<?php 
	include "session.php";
	require_once "database.php";
?>
<?php
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
		$query="delete from admin where id='$id'";
		$execute=mysql_query($query);
		if($execute)
		{
			$_SESSION["successmessage"]="User Deleted Successfully";
			header('Location: /blog/admin.php');
			exit;
		}
		else
		{
			$_SESSION["errormessage"]="Oops Something went wrong.User failed to delete.Please try after some time.";
			header('Location: /blog/admin.php');
			exit;
		}
	}
?>
