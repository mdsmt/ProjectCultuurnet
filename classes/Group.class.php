<?php
	include_once('Db.class.php');
			
	class Group
	{
		private $u_sGroupname;
		private $u_sDescription;
		private $u_sGroupleader;
				
		public function __set($p_sProperty, $p_vValue)
		{
				
			switch($p_sProperty)
			{
				case "Groupname":
				if($p_vValue == "")
				{
					throw new Exception("Gelieve groepsnaam in te vullen.");
				} else {
					$this->u_sGroupname = $p_vValue;
				}
				break;
				
				case "Description":
				if($p_vValue == '')
				{
					throw new Exception("De omschrijving mag niet leeg zijn of is te kort.");
				} else {
					$this->u_sDescription = $p_vValue;
				}
				break;

				case "Groupleader":
				if($p_vValue == "")
				{
					throw new Exception("Er is geen groepsleider opgegeven.");
				} else {
					$this->u_sGroupleader = $p_vValue;
				}
				break;
				
			}
		}
		
		public function __get($p_sProperty)
		{
			switch($p_sProperty)
			{
				case "Groupname":
				return $this->u_sGroupname;
				break;
				
				case "Description":
				return $this->u_sDescription;
				break;

				case "Groupleader":
				return $this->u_sGroupleader;
				break;
				
				
			}
		}
		
		public function AddGroup()
		{
			$db = new Db();
			$sql = "select * from tblgroep where groepnaam = '$this->u_sGroupname';";
			
			$result = $db->conn->query($sql);
			if($result->num_rows == 1)
			{
				throw new Exception("Er bestaat al een groep met deze naam, gelieve een andere naam te kiezen.");
			} else {
				$sql = "insert into tblgroep (groepnaam, omschrijving,groepshoofd) values
				('".$db->conn->real_escape_string($this->u_sGroupname)."',
				'".$db->conn->real_escape_string($this->u_sDescription)."',
				'".$db->conn->real_escape_string($this->u_sGroupleader)."');";
				$db->conn->query($sql);
				
			}
			
		}
		public function getGroup()
		{
			$db = new Db();
			$sql = "select userid from tblusers where email = '$_SESSION[useremail]';";
			$result  = $db->conn->query($sql);
			$res = $result->fetch_array();
			$id = $res['userid'];



			$sql = "select * from tblgroepuser where userid = $id";
			$result = $db->conn->query($sql);
			if($result->num_rows == 1)
			{
				throw new Exception("Deze persoon zit niet in een groep.");
			} else {
				$res = $result->fetch_array();
				$groepid = $res['groepid'];

				$sql = "select groepnaam from tblgroep where groepid = $groepid";
			}
		}
		
	}
?>