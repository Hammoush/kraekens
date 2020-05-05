<?php
    include ("layout/header.php");
    include ("db.php"); 
    
?>
<!----------------------------------------------------------------------------------------------->  
<!--------------------------------------------------zender kan verwijderen4444 ----- --------------->
<?php
	if (isset($_GET['actie']) && $_GET['actie'] == 'delete' ) {
		/////verible van gET opslan
		$idz=$_GET['id'];

  	////// query maken voor verwijderen //////////
		$sql="DELETE FROM zonders WHERE idzonder=:idzonder";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idzonder',$idz);
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



<!---------------------------------------------------------------------------------------------->  
<!--------------------------------------------------zender kan wijzigen33333 ----- --------------->
<?php
	if (isset($_GET['do']) && $_GET['do'] == 'edit') {
		include('form1/form1.php');
	}

///////////// als je submite done//////////////
	if (isset($_GET['actie']) && $_GET['actie'] == 'wijzig_zender') {
	//////// opslan waarden in verible	
			 $name = $_POST['naam'];
   			 $disc = $_POST['discribe'];
  			 $id = (int)$_POST['id'];
  	////// query maken voor wijzigen //////////
	 $sql = "UPDATE zonders SET zname=:zname, discribe=:zdis WHERE idzonder = :zid";
     $stmt = $con->prepare($sql);
     $stmt->bindParam(':zname',$name);
     $stmt->bindParam(':zdis',$disc);
     $stmt->bindParam(':zid',$id);
   	 $stmt->execute();
	/// zorg ervoor dat u de DATABASE update//////
      $rowCount = $stmt->rowCount();
       if($rowCount){
        echo  $rowCount.':'. 'row updated successfully';
       }else {
        echo $rowCount . 'row failed update';
       }
}
 ?>
<!---------------------------------------------------------------------------------------------------->  
<!--------------------------------------------------zender kan aanmaken 22222222 ----- --------------->
<?php
	if (isset($_GET['do']) && $_GET['do'] == 'nieuw' ) {
		include('form1/form1.php');
	}
	if (isset($_GET['do']) && $_GET['do'] == 'maak_zender') {
		////// maak verible die waarde opslan//////////
		$name = $_POST['naam'];
		$dis = $_POST['discribe'];
		////// query maken voor aanmaken //////////
		$sql = "INSERT INTO zonders (zname,discribe ) VALUES (:x, :y) ";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':x',$name);
		$stmt->bindParam(':y',$dis);
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
<!--------------------------------------------------zender kan tonnen111111111 ----- --------------->
<?php 
////// query maken voor tonnen all data in database //////////
	$sql = "SELECT * FROM zonders ";
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
?>
	<div class="frontpage">
		<?php foreach ($result as $row) { ?>
			<div>
				<p><?php echo $row['zname']; ?></p>
				<p><?php echo $row['discribe']; ?></p>
				<p><a href="SummeryProgramm.php?idzonder=<?php echo $row['idzonder']; ?>">summery programm</a></p>
				<p>
					<a href="AllKanaal.php?do=edit&id=<?php echo $row['idzonder'];?>">edit</a>
					<a href="AllKanaal.php?actie=delete&id=<?php echo $row['idzonder'];?>">delete</a>
				</p>
			</div>

			
	<?php  }  ?>
		
	</div>
	<p><a href="AllKanaal.php?do=nieuw">add channal</a></p>
	<p><a href="#">view all channal with its programms</a></p>




<?php include ("layout/footer.php"); ?>