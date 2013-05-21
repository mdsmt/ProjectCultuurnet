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
         <h2>Groepen</h2>
         <?php
         $db = new Db();
         $sql = "select * from tblgroep";
         $result = $db->conn->query($sql);

         while($row = $result->fetch_array())
        {
         
          $groepnaam = $row['groepnaam'];
          $groepshoofd = $row['groepshoofd'];
          $groepid = $row['groepid'];

          $sql = 'select naam, voornaam from tblusers where userid =' . $groepshoofd;
         
          $resultgroep = $db->conn->query($sql);
          $res = $resultgroep->fetch_array();
          $naam = $res['naam'];
          $voornaam = $res['voornaam'];
          echo "<p id='lidworden'><a href='group_details.php?id=$groepid'>".$groepnaam . "</a> <small>door ".$naam." " . $voornaam."</small></p>";
        }       

         ?>
         

        </section>
      </article>
    </div>
       <?php include_once('include/footer.php'); ?>

  </body>
</html>
