<?php
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
  $url = "http://build.uitdatabank.be/api/event/".$id."?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&format=json";
  $event = json_decode(file_get_contents($url));
 
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
    <!-- Modernizr -->
    <script src="../js/libs/modernizr-2.6.2.min.js"></script>
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
        include_once('include/formLogin.php');
        }else{
        include_once('include/formLoggedin.php');
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
          <h1>
          <?php 
         /* echo $event->event->eventdetails->eventdetail->title;*/
          if(count($event->event->eventdetails->eventdetail) > 1){
            echo $event->event->eventdetails->eventdetail[0]->title;
          }
          else{
            echo $event->event->eventdetails->eventdetail->title;
          }
          ?></h1>
          <?php
          if(count($event->event->eventdetails->eventdetail) > 1){
            $images = $event->event->eventdetails->eventdetail[0]->media->file;
          }
          else{
            $images = $event->event->eventdetails->eventdetail->media->file;
          }
          if(count($images)>1){
            foreach ($images as $image) {
              if($image->mediatype =="photo"){
                echo "<img src = '" . $image->hlink ."'/>";
              }
            }
          }
          else{
             echo "<img src = '" . $images->hlink ."'/>";
          }
          ?>    
          <p><big>Wanneer?</big>
          <?php
              /*if($event->event->calendar->timestamps){
                echo $event->event->calendar->timestamps->timestamp->date . ' om ';
                echo $event->event->calendar->timestamps->timestamp->timestart;
              }
              else{
                $period = $event->event->calendar->periods->period;
                echo 'van ' . $period->datefrom . ' tot ' . $period->dateto;
                foreach ($period->weekscheme as $p) {
                  if($p->friday && $p->friday->opentype == "open"){
                    echo "<br />Vrijdag van " . $period->weekscheme->friday->openingtime->from . " tot "
                    . $period->weekscheme->friday->openingtime->to;
                  }
                }
              }*/
              if(count($event->event->eventdetails->eventdetail) > 1){
                echo $event->event->eventdetails->eventdetail[0]->calendarsummary;
              }
              else{
                echo $event->event->eventdetails->eventdetail->calendarsummary;
              }
            ?></p>
          <p><big>Prijs?</big> 
            <?php 
            if(count($event->event->eventdetails->eventdetail) > 1){
              
              if(isset($event->event->eventdetails->eventdetail->price->pricevalue)){
                $price = $event->event->eventdetails->eventdetail->price->pricevalue ;
                echo '€'. $price ;
              }
              else{
                echo 'free';
              }
            }else{

              if(isset($event->event->eventdetails->eventdetail->price->pricevalue)){
                $price = $event->event->eventdetails->eventdetail->price->pricevalue;
                echo '€'. $price;
              }
              else{
                echo 'Gratis';
              }
                
              } ?></p>
          <h2>Beschrijving</h2>
          <p><?php 
             if(count($event->event->eventdetails->eventdetail) > 1){
                echo $event->event->eventdetails->eventdetail[0]->shortdescription;
              }
              else{
                echo $event->event->eventdetails->eventdetail->shortdescription;;
              }
            ?></p>
          <p><?php 

              if(count($event->event->eventdetails->eventdetail) > 1){
                if(isset($event->event->eventdetails->eventdetail[0]->longdescription)){
                  echo $event->event->eventdetails->eventdetail->price->pricevalue;
                }
                else{
                  echo "Geen longdescription mogelijk";
                }
              }
              else{
                if(isset($event->event->eventdetails->eventdetail->longdescription)){
                  echo $event->event->eventdetails->eventdetail->longdescription;
                }
                else{
                  echo "Geen longdescription mogelijk";
                }
              }
          ?></p> 
          </div>
         

        </section>
      </article>
    </div>
    <footer class="footer align-right">
      <p>&copy 2013 Gary Hepting. Free to use, but <a href="mailto:groundwork@sidereel.com">give me a shout </a>if you find GroundworkCSS extremely useful!</p>
    </footer>
    <!-- scripts-->
    <script type="text/javascript" src="../js/plugins/jquery.cycle2.js"></script>
    <script type="text/javascript" src="../js/groundwork.all.js"></script>
    <!-- google analytics-->
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
      _gaq.push(['_trackPageview']);
      (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
      
    </script>
  </body>
</html>