<?php
	session_start();
	include_once('../classes/Db.class.php');
		if(isset($_POST['groepid']))
		{
			try{ 
			$db = new Db();

			$groepid = $_POST['groepid'];
			$userid =$_POST['userid'];
			$sql = 'insert into tblgroepuser(userid, groepid, isaccepted) values ('.$userid.','.$groepid.', 0) ';
			$result = $db->conn->query($sql);
			$feedbackLidWorden = "succes";

			}
			catch(Exception $e)
			{
				$feedbackLidWorden = $e->getMessage();
			}
		}
		header('Content-type: application/json');
		echo json_encode($feedbackLidWorden);



?>