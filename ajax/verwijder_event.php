<?php
	session_start();
	include_once('../classes/Db.class.php');
		if(isset($_POST['eventid']))
		{
			try{ 
			$db = new Db();

			$eventid = $_POST['eventid'];
			$sql = 'DELETE FROM tblgroepevent WHERE eventid ="'.$eventid. '" && groepid='. $_SESSION['idgroep'];
			$result = $db->conn->query($sql);
			$feedbackEventDelete = "succes";

			}
			catch(Exception $e)
			{
				$feedbackEventDelete = $e->getMessage();
			}
		}
		header('Content-type: application/json');
		echo json_encode($feedbackEventDelete);



?>