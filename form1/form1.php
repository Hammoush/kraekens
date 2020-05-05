
 <?php 

 	/////  veribles maken zonder waarde
 			$path;  
 			$name;
			$disc;

 	//// condition maken van Get voor aanmaken
 			if ($_GET['do'] == 'nieuw' ){

 	/////		geef de verible waarde	
 				$path = 'AllKanaal.php?do=maak_zender';
 			}


	//// condition maken van Get voor wijzigen
 			if ($_GET['do'] == 'edit') {
 				$path = 'AllKanaal.php?actie=wijzig_zender';
 	////   plaats oud waarden in input		
 			$sql = "SELECT * FROM zonders WHERE idzonder = :id";
 			$stmt = $con->prepare($sql);
 			$stmt->bindParam(':id', $_GET['id']);
 			$stmt->execute();
 			$result1 = $stmt->fetch();

 			
 			$name = $result1['zname'];
 			$disc = $result1['discribe'];
 			} 
 ?>	


<!---------   form maken voor aanmaken &  wijzigen             ------->

		<form method="POST" action=" <?php echo $path ?> ">
			<input type="hidden" name="id" value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'edit' ){
				echo $result1['idzonder'];
			}
			?> ">

			<label>zender naam</label><br>
			<input type="text" name="naam" required="" value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'edit' ){
				echo $name;
			}
			?> ">
			<br>
			<label>zender omschrijvijn</label><br>


			<input type="text" name="discribe" required="" value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'edit' ){
				echo $disc;
			}
			?> "><br><br>
			<input type="submit" name="submit" value="<?php
			if(isset($_GET['do']) && $_GET['do'] == 'edit' ){
				echo "WIJZIG";
			}else{
				echo"toevoegen";
			}
			?> " >
			
			
		</form><br>