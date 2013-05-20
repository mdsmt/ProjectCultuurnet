<?php
	session_start();
	include_once('../classes/Db.class.php');
		if(isset($_POST['userid']))
		{
			try{ 
			$db = new Db();

			$userid = $_POST['userid'];
			$sql = 'DELETE FROM tblgroepuser WHERE userid ='.$userid;
			$result = $db->conn->query($sql);
			$feedbackMemberDelete = "succes";

			}
			catch(Exception $e)
			{
				$feedbackMemberDelete = $e->getMessage();
			}
		}
		header('Content-type: application/json');
		echo json_encode($feedbackMemberDelete);



?>