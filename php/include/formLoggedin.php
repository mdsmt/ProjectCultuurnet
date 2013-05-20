<h3>Welkom  <?php echo $_SESSION['surname'] . " " . $_SESSION['name'];?></h3>
<!--<div class="one mobile half padded"><img src="http://placehold.it/120x85/198d98/ffffff/" alt=""></div>-->
<?php
	if(isset($feedbackGetGroup))
	{
		echo $feedbackGetGroup;
	}
	$db = new Db();
	$sql = "select userid from tblusers where email = '$_SESSION[useremail]';";
	$result  = $db->conn->query($sql);
	$res = $result->fetch_array();
	$id = $res['userid'];
	
	$sql = "select tblgroep.groepnaam, tblgroep.groepid from tblgroepuser inner join tblgroep on tblgroep.groepid = tblgroepuser.groepid where tblgroepuser.userid = '$id'";
	$result = $db->conn->query($sql);
	if($result->num_rows == 0)
	{
	?>
		<div>U zit nog niet in een groep.</div>
	<?php
	} else {
	?>
	<select id="slcGroep">
	<?php
		while($row = $result->fetch_array())
	{
?>
		<!-- <option value="<?php //echo $row['groepid']; ?>"><?php //echo $row['groepnaam']; ?></option>; -->

		<option value="<?php echo $row['groepid']; ?>" <?php if($row['groepid'] == $_SESSION['idgroep']) {echo 'selected';} ?>><?php echo $row['groepnaam']; ?></option>;
<?php
	}
?>
	</select>
<?php } ?>
</select>
<ul>
	<li><a href="addgroup.php">Groep toevoegen</a></li>
	<li><a href="group_details.php">Huidige groep</a></li>
	<li><a href="logout.php">Uitloggen</a></li>
</ul>
