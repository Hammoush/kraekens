


<?php
	$path;
	if (isset($_GET['do']) && $_GET['do'] == 'nieuw') {
		$path='song.php?do=nieuw_song';	
	}
	if (isset($_GET['do']) && $_GET['do'] == 'edit') {
		$path='song.php?do=edit_song';
		$sql="SELECT * FROM song WHERE idsong=:idsong";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idsong',$_GET['id']);
		$stmt->execute();
		$result3 = $stmt->fetch();
		$idsong=$result3['idsong'];
		$sname=$result3['sname'];
		$duration=$result3['duration'];
		
	}
?>

<form method="POST" action="<?php echo $path; ?>">
	<input type="hidden" name="idsong" value="<?php if(isset($_GET['do']) && $_GET['do']=='edit' ){
		echo $idsong;
	} ?>"><br><br>
	<input type="text" name="sname" value="<?php if(isset($_GET['do']) && $_GET['do']=='edit' ){
		echo $sname;
	} ?>"><br><br>
	<input type="time" name="duration" value="<?php if(isset($_GET['do']) && $_GET['do']=='edit' ){
		echo $duration;
	} ?>"><br><br>
	<input type="submit" name="submit" value="<?php if(isset($_GET['do']) && $_GET['do']=='edit' ){
		echo "wijzigen";
	}else{ echo"Toevoegen";} ?>"><br><br>
</form>