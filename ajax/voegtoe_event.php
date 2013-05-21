<?php
  session_start();
  include_once('../classes/Db.class.php');
    if(isset($_POST['eventid']))
    {
      try{ 
        $db = new Db();

        $eventid = $_POST['eventid'];
        $sql = 'select * from tblgroepevent where eventid ="' . $eventid . '" && groepid = ' . $_SESSION['idgroep'];
        $result = $db->conn->query($sql);
       if($result->num_rows == 0)
        {
          $sql = 'insert into tblgroepevent(eventid, groepid) values ("' . $eventid . '",' . $_SESSION['idgroep'].')';
          $result = $db->conn->query($sql);
          $feedbackInsertEvent = "succes";
        }else{
          $feedbackInsertEvent = "failed";
        }
      }
      catch(Exception $e)
      {
        $feedbackInsertEvent = $e->getMessage();
      }
   }
   header('Content-type: application/json');
   echo json_encode($feedbackInsertEvent);
?>