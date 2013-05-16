<?php
	session_start();
	include("../../classes/User.class.php");
        

  if(isset($_POST['btnSignup']))
	{
		try{
			$user = new User();
			$user->Email = $_POST['email'];
			$user->Password = $_POST['paswoord'];
			$user->register();
		}
		catch(Exception $e){
			$error = $e->getMessage();
		}
	}
  if(isset($_POST['btnLogin'])){
    
    try {

      $user = new User();
      $user->email = $_POST['email'];
      $user->Password = $_POST['paswoord'];
      $user->canLogin();

      if($user->_logged_in == 1){

        $_SESSION['loggedin'] = $user->_logged_in;
        $_SESSION['email'] = $_POST['email'];
        header ("Location: twitter_tweets.php");

      }
      
    } catch (Exception $e) {
      
    }
    
  }
?>