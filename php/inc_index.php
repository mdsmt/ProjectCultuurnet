<?php
	include_once('../classes/Db.class.php');
	include_once('../classes/User.class.php');
	
	
	
	if(isset($_POST['signup']))
	{
		try
		{
			$user = new User();
			$user->Name = $_POST['name'];
			$user->Surname = $_POST['surname'];
			$user->Email = $_POST['email'];
			$user->Password = $_POST['password'];
			$user->PasswordConfirm = $_POST['passwordconfirm'];
			$user->Register();
			$_SESSION['useremail'] = $user->Email;
			$_SESSION['name'] = $user->Name;
			$_SESSION['surname'] = $user->Surname;
		}
		catch(Exception $e)
		{
			$feedbackSignUpIn = $e->getMessage();
		}
	}
	
	if(isset($_POST['signin']))
	{
		try
		{
			$user = new User();
			$user->Email = $_POST['email'];
			$user->Password = $_POST['password'];
			$db = new Db();

			$sql = "select naam, userid, voornaam from tblusers where email = '$user->Email';";
			$result  = $db->conn->query($sql);
			$res = $result->fetch_array();
			$naam = $res['naam'];
			$voornaam = $res['voornaam'];
			$userid = $res['userid'];

			$sql = "select groepid from tblgroepuser where userid = $userid;";
			$result  = $db->conn->query($sql);
			$res = $result->fetch_array();
			$groepid = $res['groepid'];

			$user->CanLogin();
			$_SESSION['useremail'] = $user->Email;
			$_SESSION['name'] = $naam;
			$_SESSION['surname'] = $voornaam;
			$_SESSION['idgroep'] = $groepid;
			$_SESSION['userid'] = $userid;
			if($groepleider = $userid){
				$_SESSION['groepleider'] = 'ja';
			}
			else{
				$_SESSION['groepleider'] = 'nee';
			}

		}
		catch(Exception $e)
		{
			$feedbackSignUpIn = $e->getMessage();
		}
	}
	
?>