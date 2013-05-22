<?php
      if(isset($feedbackSignUpIn))
      {
        echo $feedbackSignUpIn;
      }?>

<form action="" method="post">
	<h3 id="registreer">Registreren</h3>
	<div id="registratie">
		<input type="text" name="name" placeholder="Naam"  />
		<input type="text" name="surname" placeholder="Voornaam"  />
		<input type="email" name="email" placeholder="email" />
		<input type="password" name="password" placeholder="password"  />
		<input type="password" name="passwordconfirm" placeholder="confirm password" />
		<input type="submit" name="signup" value="Registreer"  />
	</div>
</form>
<form action="" method="post">
	<h3 id="login">Inloggen</h3>
	<div id="inloggen">
		<input type="email" name="email" placeholder="email"  />
		<input type="password" name="password" placeholder="password"  />
		<input type="submit" name="signin" value="Inloggen"  />
	</div>
</form>