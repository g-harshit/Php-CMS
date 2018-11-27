<?php 
	include "session.php";
	require_once "database.php";
?>
<?php
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
		$query="delete from category where id='$id'";
		$execute=mysql_query($query);
		if($execute)
		{
			$_SESSION["successmessage"]="Category Deleted Successfully";
			header('Location: /blog/categories.php');
			exit;
		}
		else
		{
			$_SESSION["errormessage"]="Oops Something went wrong.Category failed to delete.Please try after some time.";
			header('Location: /blog/categories.php');
			exit;
		}
	}
?>
