<?php
	include_once('../classes/Db.class.php');
	if(isset($_POST['aanpassenGroep'])){
		$groepnaam = $_POST['groepnaam'];
		$omschrijving = $_POST['omschrijving'];

		$db = new Db();
		$sql = 'update tblgroep SET groepnaam ="'. $groepnaam. '", omschrijving = "'. $omschrijving .'" where groepid = '. $_SESSION['idgroep'];
		$result = $db->conn->query($sql);

		$feedbackAanpassenGroep = "De groep is aangepast";
		}


?>