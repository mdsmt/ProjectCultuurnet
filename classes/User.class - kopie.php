<?php
	include_once('Db.class.php');
	Class User{
		private $m_sName;
		private $m_sPassword;
		private $m_sEmail;
		
		public function __get($p_sProperty) {
			switch ($p_sProperty) {
				case 'Name':
					return $this->m_sName;
					break;
				case 'Email':
					return $this->m_sEmail;
					break;
				case 'Password':
					return $this->m_sPass;
					break;
			}
	}
		public function __set($p_sProperty, $p_vValue){
			switch($p_sProperty){
				case "Name":
				$this->m_sName = $p_vValue;
				break;

				case "Password":
				$this->m_sPassword = $p_vValue;
				break;

				case "Email":
				$this->m_sEmail = $p_vValue;
				break;
			}
		}

		public function register(){
			$db = new Db();
			$salt = "kjlsnfgkjgjebgjhlbgngjhbdsfjhfefsasvz";

			$sql = "INSERT INTO tblusers(email, paswoord) VALUES 
					('"
						.$db->conn->real_escape_string($this->m_sEmail)."', '"
						.$db->conn->real_escape_string(md5($this->m_sPassword)).$salt."'
						)";
			$db->conn->query($sql);
			header('location:../index.php?');
			$test = "SELECT * FROM tblimdtalksusers where email = ". $db->conn->real_escape_string($this->Name);
			$result = $db->conn->query($test);
			if($result->num_rows == 0){
				$db->conn->query($sql);
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $this->Name;
				echo "<h1>zever het werkt</h1>";
				//header('location:tweet.php');
			}
			else
			{
				throw new Exception("This email is already in our system!");
			}

		}
	}
	



?>