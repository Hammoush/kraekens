<?php
session_start();

if(isset($_SESSION['user'])){
    
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" type="text/css" href="css/style.css ">


</head>





<body>
<div class="wraper">
	<div class="login">
		<div  class="mede">
			<?php
				include('db.php');
			  if (isset($_POST['submit'])) {
			  	$wfirstname=$_POST['wfirstname'];
			  	$wlastname=$_POST['wlastname'];

			 	$sql = "SELECT idworker, wfirstname, wlastname FROM medewerker WHERE wfirstname = :wfirstname 
			  	AND wlastname = :wlastname    ";
			  	$stmt = $con->prepare($sql);
			  	$stmt->bindParam(':wfirstname',$wfirstname);
			  	$stmt->bindParam(':wlastname',$wlastname);
			  	$stmt->execute();
			  	$user = $stmt->fetch();
			  	
			  	
			    /// zorg ervoor dat u de DATABASE update//////
			      $rowCount = $stmt->rowCount();

			       if($rowCount){

			       	$_SESSION['user'] = $user['idworker'];
			       	 header('location:index.php');

			        // echo "  welcome to you : ".$wfirstname."</div>" .  $_SESSION['user']; 
			       }else {
			        echo $wfirstname . ' : if you dont have account you can register';
			       }

			       
			  
}
			?>
			<h1>Login als medewerker</h1>
			<form method="POST" action="login.php">
				<label>gebruik naam</label><br><br>
				<input type="text" name="wfirstname" placeholder="gebruik naam"><br><br>
				<label>wachtword</label><br><br>
				<input type="text" name="wlastname" placeholder="gebruik naam"><br><br>
				<input type="submit" name="submit">
			</form>
			<p>you can here : <a href="mregistratie.php">registratie</a></p>
		</div>
		
	</div>
</div>

</body>
</html>