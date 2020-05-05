<?php
///// connected met database
	include('db.php');
 ?>
 <!----------------------------------------------------------------------------------------------->  
<!-------------------------------------------------- uitzinding  wijzigen ----- --------------->

<?php
		
	if (isset($_GET['do']) && $_GET['do'] == 'wijzig') {
		include('form2/form2.php');
	}
	if (isset($_GET['do']) && $_GET['do']=='wijzig_uitzinding') {

		 // print_r($_POST);
		$udate = $_POST['date'];	
		$firsttime = $_POST['firsttime'];	
		$lasttime = $_POST['lasttime'];	
		$idpro = $_POST['pname'];	
		$idpres = $_POST['mfistname'];	
		
		$sql = "UPDATE uitzending SET uitzending.date = :udate, starttime = :starttime, lasttime = :lasttime , idprogramma = :idpro, presentator = :idpres WHERE uitzending.date = :iddate";
		$stmt = $con->prepare($sql);



		$stmt->bindParam(':idpro',$idpro);
		$stmt->bindParam(':idpres',$idpres);
		$stmt->bindParam(':udate',$udate);
		$stmt->bindParam(':starttime',$firsttime);
		$stmt->bindParam(':lasttime',$lasttime);
		$stmt->bindParam(':iddate',$_GET['date']);
		$stmt->execute();
		/// zorg ervoor dat u de DATABASE update//////
		      $rowCount = $stmt->rowCount();
		       if($rowCount){
		        echo  $rowCount.':'. 'row Update successfully';
		       }else {
		        echo $rowCount . 'row failed Update';
		       }
		}

?>
 <!----------------------------------------------------------------------------------------------->  
<!--------------------------------------------------nieuw uitzinding  aanmaken ----- --------------->
	<?php
		if (isset($_GET['do']) && $_GET['do']=='nieuw') {
			include('form2/form2.php');

		}
		if (isset($_GET['do']) && $_GET['do']=='maak_uitzinding') {


			$idpro = intval($_POST['pname']);
			$udate = $_POST['date'];	
			$firsttime =  $_POST['firsttime'];	
			$lasttime = $_POST['lasttime'];	
			$idpres = intval($_POST['mfistname']);
			$idzender=  $_GET['idzonder'];
			

			$sql = "INSERT INTO uitzending(idzender, idprogramma, presentator, uitzending.date, starttime, lasttime) 
			VALUES(:idzender, :idpro, :idpres, :udate, :starttime, :lasttime)";
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':idzender',$idzender);
			$stmt->bindParam(':idpro',$idpro);
			$stmt->bindParam(':idpres',$idpres);
			$stmt->bindParam(':udate',$udate);
			$stmt->bindParam(':starttime',$firsttime);
			$stmt->bindParam(':lasttime',$lasttime);
			$stmt->execute();
		/// zorg ervoor dat u de DATABASE update//////
		      $rowCount = $stmt->rowCount();
		       if($rowCount){
		        echo  $rowCount.':'. 'row inserted successfully';
		       }else {
		        echo $rowCount . 'row failed insrted';
		       }
			
		
		}
	?>
 <!----------------------------------------------------------------------------------------------->  
<!--------------------------------------------------verwijderen alle uitzending ----- --------------->
	<?php
		if (isset($_GET['do']) && $_GET['do']=='delete') {
     // query maken voor verwijderen //////////
			$sql="DELETE FROM uitzending WHERE uitzending.date=:zdate ";
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':zdate',$_GET['date']);
			$stmt->execute();
			/// zorg ervoor dat u de DATABASE update//////
		      $rowCount = $stmt->rowCount();
		       if($rowCount){
		        echo  $rowCount.':'. 'row deleted successfully';
		       }else {
		        echo $rowCount . 'row failed deleted';
		       }
		}
	 ?>
 <!----------------------------------------------------------------------------------------------->  
<!--------------------------------------------------tonnen alle uitzending ----- --------------->
 <?php 
 /////   verbile opslan die komt via GET
 		$idz=$_GET['idzonder'];

////// query maken voor tonnen all data in database //////////
 		$sql="SELECT zonders.zname, uitzending.*, TIMEDIFF(uitzending.starttime, uitzending.lasttime)as duur,
 				 programma.pname, medewerker.wfirstname
		FROM zonders
		INNER JOIN uitzending ON uitzending.idzender = zonders.idzonder 
		INNER JOIN programma ON uitzending.idprogramma = programma.idprogramma
		INNER JOIN medewerker ON uitzending.presentator = medewerker.idworker
		WHERE zonders.idzonder=:idzonder order by uitzending.date asc ";

		
		
		$stmt= $con->prepare($sql);
		$stmt->bindParam(":idzonder",$idz);
		$stmt->execute();
		$result=$stmt->fetchAll();
		
		?>
	<div>
			<h3><?php echo $result[0]['zname']; ?></h3>


			<table border="1" style="border-collapse: collapse;">
				<tr>
					<td>Programma</td>
					<td>date</td>
					<td>fisttime</td>
					<td>lasttime</td>
					<td>duur</td>
					<td>Prentator</td>
					<td>wijzig</td>
					<td>delete</td>
				</tr>
			<?php foreach ($result as $row1 ) { ?>
				<tr>
					<td><?php echo $row1['pname']; ?></td>
					<td><?php echo $row1['date']; ?></td>
					<td><?php echo $row1['starttime']; ?></td>
					<td><?php echo $row1['lasttime']; ?></td>
					<td><?php echo $row1['duur']; ?></td>
					<td><?php echo $row1['wfirstname']; ?></td>
					<td><a href="SummeryProgramm.php?idzonder=<?php echo $_GET['idzonder'] ?>
					&date=<?php echo$row1['date']; ?>
					&do=wijzig">wijzig </a></td>
					<td><a href="SummeryProgramm.php?idzonder=<?php echo $_GET['idzonder'] ?>
					&date=<?php echo$row1['date']; ?>
					&do=delete">verwijderen </a></td>
				</tr>

				
		<?php	} ?>
			</table>
			</div>
			<p><a href="SummeryProgramm.php?do=nieuw&
				idzonder=<?php echo $_GET['idzonder'] ?>">add programa</a></p>
		