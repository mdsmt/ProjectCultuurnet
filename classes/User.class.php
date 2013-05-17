<?php
	include_once('Db.class.php');
			
	class User
	{
		private $u_sName;
		private $u_sSurname;
		private $u_sEmail;
		private $u_sPassword;
		private $u_sPasswordConfirm;
		
		private $salt = "dfDçSDiefjk2q3lmfd8sq";
		
		public function __set($p_sProperty, $p_vValue)
		{
				
			switch($p_sProperty)
			{
				case "Name":
				if($p_vValue == "")
				{
					throw new Exception("Gelieve uw naam in te vullen.");
				} else {
					$this->u_sName = $p_vValue;
				}
				break;
				
				case "Surname":
				if($p_vValue == "")
				{
					throw new Exception("Gelieve uw achternaam in te vullen.");
				} else {
					$this->u_sSurname = $p_vValue;
				}
				break;
				
				case "Email":
				if($p_vValue == "")
				{
					throw new Exception("Gelieve een e-mailadres in te vullen.");
				} else {
					$this->u_sEmail = $p_vValue;
				}
				break;
				
				case "Password":
				if($p_vValue == "")
				{
					throw new Exception("Gelieve een wachtwoord in te vullen.");
				} else if(strlen($p_vValue) < 2) {
					throw new Exception("Gelieve een wachtwoord van minstens 8 karakters in te vullen.");
				} else {
					$this->u_sPassword = md5($p_vValue . $this->salt);
				}
				break;
				
				case "PasswordConfirm":
				if($p_vValue == "")
				{
					throw new Exception("Gelieve uw wachtwoord opnieuw in te vullen.");
				} else if(md5($p_vValue . $this->salt) != $this->u_sPassword) {
					throw new Exception("De wachtwoorden komen niet overeen.");
				} else {
					$this->u_sPasswordConfirm = md5($p_vValue . $this->salt);
				}
				break;
			}
		}
		
		public function __get($p_sProperty)
		{
			switch($p_sProperty)
			{
				case "Name":
				return $this->u_sName;
				break;
				
				case "Surname":
				return $this->u_sSurname;
				break;
				
				case "Email":
				return $this->u_sEmail;
				break;
				
				case "Password":
				return $this->u_sPassword;
				break;
				
				case "PasswordConfirm":
				return $this->u_sPasswordConfirm;
				break;
			}
		}
		
		public function Register()
		{
			$db = new Db();
			$sql = "select * from tblusers where Email = '$this->u_sEmail';";
			$result = $db->conn->query($sql);
			
			if($result->num_rows == 1)
			{
				throw new Exception("Dit e-mailadres wordt al gebruikt, gelieve een ander e-mailadres te kiezen.");
			} else {
				$sql = "insert into tblusers (naam, voornaam, email, paswoord) values
				('".$db->conn->real_escape_string($this->u_sName)."',
				'".$db->conn->real_escape_string($this->u_sSurname)."',
				'".$db->conn->real_escape_string($this->u_sEmail)."',
				'".$db->conn->real_escape_string($this->u_sPassword)."');";
				$db->conn->query($sql);
				
				$loggedin = 'true';
				$_SESSION['loggedin'] = $loggedin;
				
				header('Location: index.php');
			}
			
			
		}
		
		public function CanLogin()
		{
			$db = new Db();
			$sql = "select * from tblusers where email = '".$db->conn->real_escape_string($this->u_sEmail)."' and paswoord = '".$db->conn->real_escape_string($this->u_sPassword)."';";
			$result = $db->conn->query($sql);
			
			if($result->num_rows == 1)
			{
				$loggedin = 'true';
				$_SESSION['loggedin'] = $loggedin;
				
				header('Location: index.php');
			} else {
				throw new Exception('Uw gegevens zijn niet gekend, gelieve ze opnieuw te controleren.');
			}
			
		}
		
	}
?>