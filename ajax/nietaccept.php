<?php
	session_start();
	include_once('../classes/Db.class.php');
		if(isset($_POST['userid']))
		{
			try{ 
			$db = new Db();

			$userid = $_POST['userid'];
			$sql = 'DELETE FROM tblgroepuser WHERE userid ="'.$userid. '" && groepid='. $_SESSION['idgroep'];
			$result = $db->conn->query($sql);
			$feedbackNietAccept = "succes";

			}
			catch(Exception $e)
			{
				$feedbackNietAccept = $e->getMessage();
			}
		}
		header('Content-type: application/json');
		echo json_encode($feedbackNietAccept);



?>