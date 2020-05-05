
<?php 

$sql = "SELECT programma.idprogramma,programma.pname FROM programma ";
$stmt = $con->prepare($sql);
$stmt->execute();
$ProgrammaResults = $stmt->fetchAll();




$sql = "SELECT medewerker.idworker,medewerker.wfirstname FROM medewerker ";
$stmt = $con->prepare($sql);
$stmt->execute();
$medewerkerResults = $stmt->fetchAll();

















	$path;
	if (isset($_GET['do']) && $_GET['do']=='nieuw') {
		$path = 'SummeryProgramm.php?do=maak_uitzinding&idzonder=' . $_GET['idzonder'];
	}
	if (isset($_GET['do']) && $_GET['do']=='wijzig') {
		$path = 'SummeryProgramm.php?do=wijzig_uitzinding&idzonder=' . $_GET['idzonder'].'&date='.$_GET['date'];
		$sql = "SELECT zonders.zname, uitzending.*, TIMEDIFF(uitzending.starttime, uitzending.lasttime)as duur,
 				 programma.pname, medewerker.wfirstname
		FROM zonders
		INNER JOIN uitzending ON uitzending.idzender = zonders.idzonder 
		INNER JOIN programma ON uitzending.idprogramma = programma.idprogramma
		INNER JOIN medewerker ON uitzending.presentator = medewerker.idworker
		WHERE uitzending.date= :udate";
		
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':udate', $_GET['date']);
		$stmt->execute();
		$result3 = $stmt->fetch();
		



		$pname=$result3['pname'];
		$udate=$result3['date'];
		$first=$result3['starttime'];
		$last=$result3['lasttime'];
		$presentator=$result3['wfirstname'];




	}
 ?>


<form action="<?php echo $path ?>" method="POST" >


	<input type="hidden" name="id" value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'wijzig' ){
				echo $result3['idzonder'];
			}
			?> " >



	

				<select name="pname">

					<?php foreach ($ProgrammaResults as $programma) {
						# code...
					  ?>
				  <option value="<?php echo $programma['idprogramma']; ?>"><?php echo $programma['pname']; ?></option>

				<?php }  	?>

				</select><br>
				


			


			<select name="mfistname">

					<?php foreach ($medewerkerResults as $medewerker) {
						# code...
					  ?>

				  <option value="<?php echo $medewerker['idworker']; ?>"><?php echo $medewerker['wfirstname']; ?></option>

				<?php }  	?>

				</select>
				


		
			






			<br>
	<input placeholder="date" type="date" name="date"  value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'wijzig' ){
				echo $udate;
			}
			?>" ><br>
	<input placeholder="firsttime" type="time" name="firsttime"  value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'wijzig' ){
				echo $first;
			}
			?>" ><br>
	<input placeholder="lasttime" type="time" name="lasttime"  value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'wijzig' ){
				echo $last;
			}
			?>" ><br>

	
	<input type="submit" name="submit"  value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'wijzig' ){
				echo "wijzig";
			}else{
				echo"toevoegen";
			}
			?> ">
	
</form>