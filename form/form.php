


 <?php




 

$path;
$name;
$disc;


  if($_GET['do'] == 'nieuw'){
	$path = 'zenders.php?do=maak_zender';

 } if($_GET['do'] == 'edit_zender'){
		 $path = 'zenders.php?do=update_zender';
    
   	$sql = "SELECT * FROM  zonders WHERE idzonder = :idznedr ";
   	$stmt = $con->prepare($sql);
   	$stmt->bindParam(":idznedr",$_GET['id']);
   	$stmt->execute();
   	$result = $stmt->fetch();


   	$name = $result['zname'];
   	$disc = $result['discribe'];
 }
  ?>
<form action="<?php echo $path; ?>" method="POST">

	<input type="hidden" name="id" required="" value="

	<?php if(isset($_GET['do']) && $_GET['do'] == 'edit_zender') {echo $result['idzonder'];} ?>

	">


	<label>zender naam</label><br>
	<input type="text" name="naam" required="" value="

	<?php if(isset($_GET['do']) && $_GET['do'] == 'edit_zender') {echo $name;} ?>

	">

	<br>
	<label>zender omschrijvijn</label><br>


	<input type="text" name="discribe" required="" value="

	<?php if(isset($_GET['do']) && $_GET['do'] == 'edit_zender') {echo $disc;} ?>

	">




	<br><br>


	<input type="submit" name="submit" value="

	<?php
	 if(isset($_GET['do']) && $_GET['do'] == 'edit_zender') {echo "Updte";}
	 else { 
	 	echo "submit";

	} ?>

	">
<br>
</form>