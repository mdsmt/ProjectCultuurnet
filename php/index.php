<?php
  session_start();
  include_once('inc_index.php');

  $url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&format=json";
  $events = json_decode(file_get_contents($url));
  $url2 = 'http://build.uitdatabank.be/api/events/report?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&format=json';
  $report = json_decode(file_get_contents($url2)); 
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
        <section class="four fifth padded">
          <h2>Filter</h2>
          <div class="one fifth padded">
            <label for="category">Categorie</label>
            <select name="category" class="category" id="category">
            <?php
              
              $headings = $report->report->headings->item;
             
              foreach($headings as $heading){
                echo "<option value='". $heading->name ."'>". $heading->name ."</option>";
                
              }
            ?>
            </select>
          </div>
           <div class="one fifth padded">
             <label for="provincie">Provincie</label>
            <select name="provincie" class="provincie" id="provincie">
              <?php
              $headings = $report->report->geo->item;
             
              foreach($headings as $heading){
                echo "<option value='". $heading->name ."'>". $heading->name ."</option>";
                
              }
            ?>
            </select>
          </div>
          <div class="one fifth padded">
             <label for="Leeftijd">Leeftijd</label>
            <input type="text" name="Leeftijd" id="Leeftijd">
          </div>
          <div class="one fifth padded">
            <label for="gratis">Gratis</label>
            <select name="gratis" class="gratis" id="gratis">
              <option value="nee">Nee</option>
              <option value="ja">Ja</option>
            </select>
          </div>
        </section>
        <section class="three fourths padded">
                <?php
                foreach ($events as $e) {
                  echo "<hr />";
                  echo "<img src = '" . $e->thumbnail ."' alt='' class='pull-right gap-right gap-bottom test'/>";
                  echo "<h3><a href='details.php?id=". $e->cdbid . "'>".$e->title."</a></h3>";
                  echo "<h5><small>". $e->heading ."</small></h5>";
                  echo "<p>" . $e->shortdescription . "</p>";
                }
                ?>
          </div>
        </section>
      </article>
    </div>
    <?php include_once('include/footer.php'); ?>
  </body>
</html>