<?php
	session_start();
	
	include_once('inc_home.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
		<a href="logout.php">Afmelden</a>
	<div id="page">
		<?php if(isset($errorCheckin)) { ?>
			<p>
				<?php echo $errorCheckin; ?>
			</p>
		<?php } ?>
		<h1>U bent aangemeld.</h1>
	</div><!-- end pagee -->
</body>
</html>