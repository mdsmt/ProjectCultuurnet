<?php
  session_start();
  include_once('inc_index.php');
  include_once('inc_edit_groep.php');


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
      if(isset($feedbackSignUpIn))
      {
        echo $feedbackSignUpIn;
      }
    ?>
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
              <h2>Groep aanpassen</h2>
             <?php  
              $db = new Db();
              $sql = "select groepshoofd from tblgroep where groepid = $_SESSION[idgroep];";
              $result  = $db->conn->query($sql);
              $resgroepleider = $result->fetch_array();
              $groepleider = $resgroepleider['groepshoofd'];
              if($_SESSION['userid'] != $groepleider){
                echo "Je hebt niet de rechten om de groep aan te passen";
              }else{
              $sql = "select * from tblgroep where groepid = $_SESSION[idgroep];";
              $result  = $db->conn->query($sql);
              $res = $result->fetch_array();
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post'>
             <?php if(isset($feedbackAanpassenGroep))
              {
                echo $feedbackAanpassenGroep;
              }?>
              <label for="groepnaam">Groepsnaam: </label><input id="groepnaam" type="text" name="groepnaam" value="<?php echo $res['groepnaam']; ?>"  />
              <label for="omschrijving">Omschrijving: </label><textarea id="omschrijving" type="text" name="omschrijving"  ><?php echo $res['omschrijving']; ?></textarea>
              <input type="submit" name="aanpassenGroep" value="Aanpassen"  />
            </form>

            <div id"aanvragen">
             <h4>Nieuwe aanvragen</h4>
            
            <?php
              $sql = 'select * from tblgroepuser where groepid = '. $_SESSION['idgroep'].' && isaccepted = 0';
              $result  = $db->conn->query($sql);
              
              if($result->num_rows == 0){
                echo "<div>Er zijn geen nieuwe aanvragen</div>";
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
                      <div id = "id<?php echo $row['userid'] ?>"><input type = "checkbox"
                         class = "chkGroepsaanvraag"
                         value = "<?php echo $row['userid'] ?>"
                         "chkid<?php echo $row['userid'] ?>" data-naam="<?php echo $naam ?> "data-voornaam="<?php echo $voornaam ?>" />            
                         <?php echo $voornaam . ' ' .   $naam  ?>
                        </div>
                  <?php 
                    }  
                  }
                } ?>
            <?php } ?>

            </div>
           <br /> 
            <div id="leden">
            <h4>Leden</h4>
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
                      <div  id = "id<?php echo $row['userid'] ?>"><?php echo $voornaam . ' ' .   $naam;  ?>
                        <a href="#" class='delMember' data-id='<?php echo $row['userid'] ?>'>Verwijder</a>           
                      </div>
                  <?php 
                    }  
                  }
                } 
               ?>
            </div>

            <div id="eventen">
             <br /> <h4>Evenementen</h4>
            <?php
              $sql = "select * from tblgroepevent where groepid = $_SESSION[idgroep] && isaccepted = 1;";
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
                  ?>
                  <div  id = "id<?php echo  $e->cdbid ?>"><?php echo  $e->title  ?>
                    <a href="#" class='delEvent' data-id='<?php echo  $e->cdbid ?>'>Verwijder</a>           
                  </div>
            <?php
            //  <a href='details.php?id=". $e->cdbid . "'>
             
            }
              } ?>  

            </div>


              <br/>
              <div id"accEvent">
                <h4>Nieuwe evenement aanvragen</h4>
              
              <?php
              $sql = "select * from tblgroepevent where groepid = $_SESSION[idgroep] && isaccepted = 0;";
              $result  = $db->conn->query($sql);
              $eventen ='';
              if($result->num_rows == 0){
                echo "<div>Er zijn geen nieuwe aanvragen</div>";
              }else{
                while($row = $result->fetch_array())
                {
                  $eventid = $row['eventid'];
                
                  $eventen = $eventen . $eventid . ";";
                  

              } 
                 $url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&cdbid=".$eventen."&format=json";
                 $events = json_decode(file_get_contents($url));
                foreach ($events as $e) {              
                  ?>
                  <div id = "id<?php echo $e->cdbid ?>"><input type = "checkbox"
                         class = "chkEventaanvraag"
                         value = "<?php echo $e->cdbid ?>"
                         "chkid<?php echo $e->cdbid ?>" data-titel="<?php echo $e->title ?>" />            
                         <?php echo $e->title  ?>
                        </div>

                 <?php }
                } ?>
        <?php  ?>
             </div>
            </div>
          </div>
        </section>
      </article>
    </div>
    <?php include_once('include/footer.php'); ?>
  </body>
</html>