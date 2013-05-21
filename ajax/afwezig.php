<?php
	session_start();
	include_once('../classes/Db.class.php');
		if(isset($_POST['eventid2']))
		{
			try{ 
				$eventid = $_POST['eventid2'];
				$db = new Db();
	            $sql = 'Select * from tblgroepuserevent where eventid="' . $eventid . '" AND groepid ="' .$_SESSION['idgroep'] .'" AND userid="' . $_SESSION['userid'].'" AND (isAanwezig = "0" OR isAanwezig = "1")' ;
	            $result  = $db->conn->query($sql);

	            if($result->num_rows != 0){
					$feedbackAanwezig = 'fail';	
					 $sql = 'update tblgroepuserevent SET isAanwezig ="0" where eventid = "'. $eventid . '" AND groepid = "'.$_SESSION['idgroep']. '" AND userid = "'.$_SESSION['userid'].'"';
					 $result  = $db->conn->query($sql);


	            }else{
		            $sql = 'insert into tblgroepuserevent(eventid, groepid, userid, isAanwezig) values ("' . $eventid . '","' . $_SESSION['idgroep'] . '","'  . $_SESSION['userid']. '", "0")';
					$result = $db->conn->query($sql);
					$feedbackAanwezig = "succes";
	          }
			}
			catch(Exception $e)
			{
				$feedbackAanwezig = $e->getMessage();
			}
		}
		header('Content-type: application/json');
		echo json_encode($feedbackAanwezig);
?>