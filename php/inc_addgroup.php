<?php
	include_once('../classes/Db.class.php');
	include_once('../classes/Group.class.php');
	include_once('../classes/Usergroup.class.php');
	
	
	if(isset($_POST['addgroup']))
	{
		try
		{
			$group = new Group();
			$groepnaam = $_POST['groepnaam'];
			$group->Groupname = $groepnaam;
			$group->Description = $_POST['omschrijving'];

			$db = new Db();

			$sql = "select userid from tblusers where email = '$_SESSION[useremail]';";
			$result  = $db->conn->query($sql);
			$res = $result->fetch_array();
			$id = $res['userid'];

			$group->Groupleader = $id;
			$group->AddGroup();

			$usergroup = new Usergroup();
			$usergroup->Userid = $id;

			$sql = "select groepid from tblgroep where groepnaam = '$groepnaam';";
			$result  = $db->conn->query($sql);
			$res = $result->fetch_array();
			$groepid = $res['groepid'];
			$usergroup->Groupid = $groepid;
			$usergroup->AddUserToGroup();
		}
		catch(Exception $e)
		{
			$feedbackAddGroup = $e->getMessage();
		}
	}
	
	
	
?>