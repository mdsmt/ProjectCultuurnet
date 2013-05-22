<?php
session_start();
include_once('inc_index.php');
$groepid = $_GET['id'];
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]>   <html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]>   <html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
  <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>I &hearts; Culture in group</title>
    <link rel="apple-touch-icon" href="../images/apple-icons/apple-touch-icon-precomposed.png">
    <link rel="apple-touch-icon" sizes="57x57" href="../images/apple-icons/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/apple-icons/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/apple-icons/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../images/apple-icons/apple-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileImage" content="../images/apple-icons/apple-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <!-- jQuery -->
    <script type="text/javascript" src="../js/libs/jquery-1.8.2.min.js"></script>
    <!-- framework css -->
    <link type="text/css" rel="stylesheet" href="../css/groundwork.css"><!--[if IE]>
    <link type="text/css" rel="stylesheet" href="../css/groundwork-ie.css"><![endif]--><!--[if lt IE 9]>
    <script type="text/javascript" src="../js/libs/html5shiv.min.js"></script><![endif]--><!--[if IE 7]>
    <link type="text/css" rel="stylesheet" href="../css/font-awesome-ie7.min.css"><![endif]-->

  </head>
  <body>
   <?php include_once('include/nav.php');?>
    <div class="container">
      <div class="padded">
      </div>
      <article class="row">
        <aside class="one fifth padded border-right">
    
        <?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true')
        {
        include_once('include/formLoggedin.php');
        }else{
          include_once('include/formLogin.php');
        }?>
          <hr>
          <h3>Popular events</h3>
          <div class="row">
            <div class="one mobile half padded"><img src="http://placehold.it/120x85/198d98/ffffff/" alt=""></div>
            <div class="one mobile half padded"><img src="http://placehold.it/120x85/198d98/ffffff/" alt=""></div>
          </div>
           <h3>Suggested events</h3>
          <div class="row">
            <div class="one mobile half padded"><img src="http://placehold.it/120x85/198d98/ffffff/" alt=""></div>
            <div class="one mobile half padded"><img src="http://placehold.it/120x85/198d98/ffffff/" alt=""></div>
          </div>
        </aside>
        <section class="three fourths padded">
         <?php
         if(!isset($_SESSION['loggedin'])){
            echo "<p>Je moet ingelogd zijn om de informatie van de groepen te kunnen zien.</p>";
          }else{
          include_once('../classes/Db.class.php');
          $sql = "select * from tblgroepuser where groepid = $groepid && isAccepted = 1 && userid=$_SESSION[userid]";
          $result  = $db->conn->query($sql);
          $res = $result->fetch_array();
          if($result->num_rows == 0){
            $sql = "select * from tblgroepuser where groepid = $groepid && isAccepted = 0 && userid=$_SESSION[userid];";
            $result2  = $db->conn->query($sql);
            if($result2->num_rows == 0){
            echo "<p id='lidworden'>Je bent nog geen lid van deze groep <a class='success button small lidworden' data-userid = ".$_SESSION['userid']." data-groepid='".$groepid. "'>Wordt lid!</a></p>";
            }else{
              echo "<p id='lidworden'>De groepshoofd moet je lidmaatschap nog bevestigen.</p>";
            }
          }else{
         

          $sql = "select * from tblgroep where groepid = $groepid;";
          $result  = $db->conn->query($sql);
          $res = $result->fetch_array();     
?>    <h2><?php echo $res['groepnaam'] . " ";?>
      <?php
        $sql = "select groepshoofd from tblgroep where groepid = $groepid;";
        $result  = $db->conn->query($sql);
        $resgroepleider = $result->fetch_array();
        $groepleider = $resgroepleider['groepshoofd'];
        if($_SESSION['groepleider'] == 'ja'){
      ?>
      <small><a href='edit_groep.php?id=<?php echo $groepid; ?>'>edit</a></small>
      <?php } ?></h2>
      <p><?php echo $res['omschrijving'];?></p>


      <hr>
      <h2>
      Leden
      </h2>
      <?php
              $sql = 'select * from tblgroepuser where groepid = '. $_SESSION['idgroep'].' && isaccepted = 1';
              $result  = $db->conn->query($sql);
              
              if($result->num_rows == 0){
                echo "<div>Er zijn geen leden</div>";
              }else{
                while($row = $result->fetch_array())
                {
                  $sql = 'select * from tblusers where userid = '. $row['userid'];
                  $resultuser  = $db->conn->query($sql);
                  //$res = $result->fetch_array();
                  while($row = $resultuser->fetch_array())
                  {
                      $naam = $row['naam'];
                      $voornaam = $row['voornaam'];
                        ?>
                      <div  id = "id<?php echo $row['userid'] ?>">
                        <?php echo $voornaam . ' ' .   $naam;  ?>
                      </div>
                  <?php 
                    }  
                  }
                } 
               ?>
<hr>
      <h2>Evenementen</h2>
        <?php
          $db = new Db();

          $sql = "select * from tblgroepevent where groepid = $groepid && isAccepted = 1;";
          $result  = $db->conn->query($sql);
          $eventen = "";
          
          if($result->num_rows == 0)
          {
          ?>
         <div>Nog geen evenementen in deze groep.</div>
          <?php
         } else {
           while($row = $result->fetch_array())
        {
         
          $eventid = $row['eventid'];
          
          $eventen = $eventen . $eventid . ";";
        }       
        $url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&cdbid=".$eventen."&format=json";
        $events = json_decode(file_get_contents($url));
        
        foreach ($events as $e) {
              echo "<hr />";
              echo "<img src = '" . $e->thumbnail ."' alt='' class='pull-right gap-right gap-bottom test'/>";
              echo "<h3><a href='details.php?id=". $e->cdbid . "'>".$e->title."</a></h3>";
              echo "<p><small>". $e->calendarsummary . " " .$e->heading ."</small></p>";
              $sql = 'select isAanwezig from tblgroepuserevent where userid='. $_SESSION['userid'] . '&& groepid = ' . $groepid . '&& eventid="'.$e->cdbid.'"';
              $result = $db->conn->query($sql);
              $res = $result->fetch_array();
              $isAanwezig = $res['isAanwezig'];
              if($result->num_rows == 0){
                echo "<p id='aanwezig". $e->cdbid ."'><a class='small success button aanwezig' data-eventid='". $e->cdbid . "'><small>Aanwezig</small></a>
                                                      <a class='small error button afwezig' data-eventid='". $e->cdbid . "'><small>Afwezig</small></a>
                                                      </p>";
                 echo "<h5><small>". $e->heading ."</small></h5>";
                 echo "<p>" . $e->shortdescription . "</p>";
              }
              else{
                if($isAanwezig == 1){
                  echo "<p id='aanwezig". $e->cdbid ."' class='success'>Aanwezig <a class='small error button afwezig' data-eventid='". $e->cdbid . "'><small>Afwezig</small></a></p>";
                }elseif($isAanwezig == 0){
                  echo "<p id='aanwezig". $e->cdbid ."' class='error'><a class='small success button aanwezig' data-eventid='". $e->cdbid . "'><small>Aanwezig</small></a> Afwezig </p>";
                }
             


             
            }
        }}


        ?>
      

          <?php } ?>
          </div>
         

        </section>
      </article>
    </div>
         <?php include_once('include/footer.php'); ?>

<?php
}



?>