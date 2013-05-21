<?php
	session_start();
	include_once('../classes/Db.class.php');
		if(isset($_POST['eventid']))
		{
			try{ 
			$db = new Db();

			$eventid = $_POST['eventid'];
			$sql = 'update tblgroepevent SET isaccepted ="1" where eventid = "'. $eventid . '" && groepid = "'.$_SESSION['idgroep']. '"';
			$result = $db->conn->query($sql);
			$feedbackEventAccept = "succes";
			}
			catch(Exception $e)
			{
				$feedbackEventAccept = $e->getMessage();
			}
		}
		header('Content-type: application/json');
		echo json_encode($feedbackEventAccept);
?>