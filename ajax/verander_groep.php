<?php
	session_start();
		
		if(isset($_POST['id']))
		{
			$sql = "select * from tblgroep;";
			$result  = $db->conn->query($sql);
			$res = $result->fetch_array();
			$groepleider = $res['groepshoofd'];

			if($groepleider = $_SESSION['userid']){
				$_SESSION['groepleider'] = 'ja'
			}
			else{
				$_SESSION['groepleider'] = 'nee'
			}
			$id = $_POST['id'];
			$_SESSION['idgroep'] = $id;

		}
		header('Content-type: application/json');

?>