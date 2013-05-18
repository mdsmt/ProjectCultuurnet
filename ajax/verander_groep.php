<?php
	session_start();
		
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$_SESSION['idgroep'] = $id;

		}
		header('Content-type: application/json');

?>