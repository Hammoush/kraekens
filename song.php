<?php




    include ("layout/header.php");
    include ("db.php"); 
    if(!isset($_SESSION['user'])){
    
    header('location:login.php');
}
    
?>
<!----------------------------------------------------------------------------------------------->  
<!--------------------------------------------------song kan verwijderen4444 ----- --------------->
<?php
	if (isset($_GET['do']) && $_GET['do'] == 'delete' ) {
		$sql = "DELETE FROM song WHERE idsong =:idsong ";
		$stmt= $con->prepare($sql);
		$stmt->bindParam(':idsong',$_GET['id']);
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
<!--------------------------------------------------song kan wijzigen3333333 ----- --------------->
<?php
		
	if (isset($_GET['do']) && $_GET['do'] == 'edit') {
		include('form3/form3.php');
		
	}
	///////////// als je submite done//////////////
	if (isset($_GET['do']) && $_GET['do'] == 'edit_song') {

  	////// query maken voor wijzigen //////////
		$sql="UPDATE song SET sname=:sname, duration=:duration WHERE idsong=:idsong  ";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idsong',$_POST['idsong']);
		$stmt->bindParam(':sname',$_POST['sname']);
		$stmt->bindParam(':duration',$_POST['duration']);
		$stmt->execute();

		////// condition maken als het  goed heeft gewerkt of niet //////////
		$rowCount=$stmt->rowCount();
		if ($rowCount) {
			echo "you wijzigen  :".$rowCount." row";
		}else{
			echo "you wijzigen  :".$rowCount." row";
		}
		
		
		
	}
	?>
<!----------------------------------------------------------------------------------------------->  
<!--------------------------------------------------song kan toevoegen2222222 ----- --------------->

<?php
		
	if (isset($_GET['do']) && $_GET['do'] == 'nieuw') {
		include('form3/form3.php');
		
	}
	if (isset($_GET['do']) && $_GET['do'] == 'nieuw_song') {
		$sql="INSERT INTO song (sname, duration) VALUES (:sname,:duration) ";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':sname',$_POST['sname']);
		$stmt->bindParam(':duration',$_POST['duration']);
		$stmt->execute();

		////// condition maken als het  goed heeft gewerkt of niet //////////
		$rowCount=$stmt->rowCount();
		if ($rowCount) {
			echo "you insert  :".$rowCount." row";
		}else{
			echo "you insert  :".$rowCount." row";
		}
		
	}

 ?>
<!----------------------------------------------------------------------------------------------->  
<!--------------------------------------------------song kan tonnen111111111 ----- --------------->
<?php 
////// query maken voor tonnen all data in database //////////
	$sql = "SELECT * FROM song ";
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
?>
	<div class="frontpage">
		<?php foreach ($result as $row) { ?>
			<div>
				<p><?php echo $row['sname']; ?></p>
				<p><?php echo $row['duration']; ?></p>
				
				<p>
					<a href="song.php?do=edit&id=<?php echo $row['idsong'];?>">edit</a>
					<a href="song.php?do=delete&id=<?php echo $row['idsong'];?>">delete</a>
				</p>
			</div>

			
	<?php  }  ?>
		
	</div>
	<p><a href="song.php?do=nieuw">add song</a></p>
	




<?php include ("layout/footer.php"); ?>