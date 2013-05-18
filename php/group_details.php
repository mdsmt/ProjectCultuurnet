<?php
session_start();
include_once('inc_index.php');
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
    <script type="text/javascript">
      // extend Modernizr to have datauri test
      (function(){
        var datauri = new Image();
        datauri.onerror = function() {
          Modernizr.addTest('datauri', function () { return false; });
        };
        datauri.onload = function() {
          Modernizr.addTest('datauri', function () { return (datauri.width == 1 && datauri.height == 1); });
          Modernizr.load({
            test: Modernizr.datauri,
            nope: '../css/no-datauri.css'
          });
        };
        datauri.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
      })();
      // fallback if SVG unsupported
      Modernizr.load({
        test: Modernizr.inlinesvg,
        nope: [
          '../css/no-svg.css'
        ]
      });
      // polyfill for HTML5 placeholders
      Modernizr.load({
        test: Modernizr.input.placeholder,
        nope: [
          '../css/placeholder_polyfill.css',
          '../js/libs/placeholder_polyfill.jquery.js'
        ]
      });
      
    </script>
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
         <?php
         if(!isset($_SESSION['idgroep'])){

            echo "<p>Je bent niet ingelogd.</p>";
  
         }else{
          include_once('../classes/Db.class.php');
          $db = new Db();
          $sql = "select userid from tblgroepuser where groepid = $_SESSION[idgroep];";
          $result  = $db->conn->query($sql);
          $res = $result->fetch_array();
          $userid = $res['userid'];

          if($result->num_rows == 0){
            echo "<p>Je bent niet gemachtigd voor deze groep</p>";
          }else{
          $db = new Db();
          $sql = "select * from tblgroep where groepid = $_SESSION[idgroep];";
          $result  = $db->conn->query($sql);
          $res = $result->fetch_array();     
?>    <h2><?php echo $res['groepnaam'] . " ";?>
      <?php
        $sql = "select groepshoofd from tblgroep where groepid = $_SESSION[idgroep];";
        $result  = $db->conn->query($sql);
        $resgroepleider = $result->fetch_array();
        $groepleider = $resgroepleider['groepshoofd'];
        if($_SESSION['userid'] == $groepleider){
      ?>
      <small><a href='edit_groep.php'>edit</a></small>
      <?php } ?></h2>
      <p><?php echo $res['omschrijving'];?></p>


      <hr>

      <h2>Evenementen</h2>
        <?php
          $db = new Db();

          $sql = "select * from tblgroepevent where groepid = $_SESSION[idgroep];";
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
        
        $result  = $db->conn->query($sql);
        foreach ($events as $e) {
              echo "<hr />";
              echo "<img src = '" . $e->thumbnail ."' alt='' class='pull-right gap-right gap-bottom test'/>";
              echo "<h3><a href='details.php?id=". $e->cdbid . "'>".$e->title."</a></h3>";
              echo "<p><small>". $e->calendarsummary . " " .$e->heading ."</small></p>";

              echo "<h5><small>". $e->heading ."</small></h5>";
              echo "<p>" . $e->shortdescription . "</p>";
            }
        }


        ?>
      

          <?php } ?>
          </div>
         

        </section>
      </article>
    </div>
       <?php include_once('include/footer.php'); ?>

  </body>
</html>
<?php
}



?>