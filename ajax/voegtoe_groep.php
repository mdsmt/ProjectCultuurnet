<?php
	session_start();
	include_once('../classes/Db.class.php');
		if(isset($_POST['userid']))
		{
			try{ 
			$db = new Db();

			$userid = $_POST['userid'];
			$sql = 'update tblgroepuser SET isaccepted ="1" where userid = "'. $userid . '" && groepid = "'.$_SESSION['idgroep']. '"';
			$result = $db->conn->query($sql);
			$feedbackUserAccept = "succes";

			}
			catch(Exception $e)
			{
				$feedbackUserAccept = $e->getMessage();
			}
		}
		header('Content-type: application/json');
		echo json_encode($feedbackUserAccept);
?>