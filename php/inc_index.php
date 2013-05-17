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

			$sql = "select naam from tblusers where email = '$user->Email';";
			$result  = $db->conn->query($sql);
			$res = $result->fetch_array();
			$naam = $res['naam'];
			
			$sql = "select voornaam from tblusers where email = '$user->Email';";
			$result  = $db->conn->query($sql);
			$res = $result->fetch_array();
			$voornaam = $res['voornaam'];

			$user->CanLogin();
			$_SESSION['useremail'] = $user->Email;
			$_SESSION['name'] = $naam;
			$_SESSION['surname'] = $voornaam;
		}
		catch(Exception $e)
		{
			$feedbackSignUpIn = $e->getMessage();
		}
	}
	
?>