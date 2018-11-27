<?php
	session_start();
	function errormessage()
	{
		if(isset($_SESSION["errormessage"]))
		{
			$output="<div class=\" alert alert-danger \">";
			$output.=htmlentities($_SESSION["errormessage"]);
			$output.="</div>";
			$_SESSION["errormessage"]=null; //because when we again open our browser then at first there should not be any error message
			return $output;
		}
	}
	function successmessage()
	{
		if(isset($_SESSION["successmessage"]))
		{
			$output="<div class=\" alert alert-success \">";
			$output.=htmlentities($_SESSION["successmessage"]);
			$output.="</div>";
			$_SESSION["successmessage"]=null; //because when we again open our browser then at first there should not be any error message
			return $output;
		}
	}
?>