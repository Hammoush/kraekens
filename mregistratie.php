<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>



</head>
<body>
	<?php        include('db.php');
				if (isset($_POST['submit'])) {
					$wfirstname=$_POST['wfirstname'];
					$wlastname=$_POST['wlastname'];
					$img=$_POST['img'];
					$rol=$_POST['rol'];
					
					
				$sql = "INSERT INTO medewerker (wfirstname,wlastname,img,rol) VALUES (:wfirstname,:wlastname,:img,:rol)";
				
					
				$stmt = $con->prepare($sql);
				$stmt->bindParam(':wfirstname',$wfirstname);
				$stmt->bindParam(':wlastname',$wlastname);
				$stmt->bindParam(':img',$img);
				$stmt->bindParam(':rol',$rol);
				$stmt->execute();
				
				/// zorg ervoor dat u de DATABASE update//////
			      $rowCount = $stmt->rowCount();
			       if($rowCount){
			        header('location:login.php');
			       }else {
			        echo $rowCount . 'row failed toevoegen';
			       }
				}
			  ?>

			<h1>register </h1>
			<form method="post" >
				<label>gebruik naam</label><br><br>
				<input type="text" name="wfirstname" placeholder="gebruik naam"><br><br>

				<label>Achter naam</label><br><br>
				<input type="text" name="wlastname" placeholder="Achter naam"><br><br>
				<label> img</label><br><br>
				<input type="text" name="img" placeholder="img"><br><br>
				<label> rol</label><br><br>
				<input type="text" name="rol" placeholder="rol"><br><br>
				<input type="submit" name="submit">
			</form>
			<br> 
		
</body>
</html>