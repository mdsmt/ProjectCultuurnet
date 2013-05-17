<?php
	include_once('Db.class.php');
			
	class Usergroup
	{
		private $u_sGroupid;
		private $u_sUserid;

		public function __set($p_sProperty, $p_vValue)
		{
				
			switch($p_sProperty)
			{
				case "Groupid":
				if($p_vValue == "")
				{
					throw new Exception("De groepsid is niet meegegeven.");
				} else {
					$this->u_sGroupid = $p_vValue;
				}
				break;
				
				case "Userid":
				if($p_vValue == "")
				{
					throw new Exception("De userid is niet meegegeven.");
				} else {
					$this->u_sUserid = $p_vValue;
				}
				break;
			
			}
		}
		
		public function __get($p_sProperty)
		{
			switch($p_sProperty)
			{
				case "Groupid":
				return $this->u_sGroupid;
				break;
				
				case "Userid":
				return $this->u_sUserid;
				break;

				
				
				
			}
		}
		
		public function AddUserToGroup()
		{
			$isaccepted = 0;
			$db = new Db();
			$sql = "select * from tblgroepuser where userid = '$this->u_sUserid' AND groepid = '$this->u_sGroupid';";
			$result = $db->conn->query($sql);

			



			if($result->num_rows == 1)
			{
				throw new Exception("Deze persoon is al lid van de groep.");
			} else {
				$sql = "select groepshoofd from tblgroep where groepid = $this->u_sGroupid;";
				$result  = $db->conn->query($sql);
				$res = $result->fetch_array();
				$groupleader = $res['groepshoofd'];
				var_dump($groupleader);
				var_dump($this->u_sUserid);
				if($groupleader == $this->u_sUserid){
					$isaccepted = 1;
				}

				$sql = "insert into tblgroepuser (groepid, userid,isaccepted) values
				('".$db->conn->real_escape_string($this->u_sGroupid)."',
				'".$db->conn->real_escape_string($this->u_sUserid)."',
				'".$db->conn->real_escape_string($isaccepted)."');";
				$db->conn->query($sql);
				
			}
			
			
		}
		
		
	}
?>