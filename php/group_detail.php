<?php
	session_start();
	$groepid = $_SESSION['idgroep'];
	header('location:group_details.php?id='.$groepid);
?>