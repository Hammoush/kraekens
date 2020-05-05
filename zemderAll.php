


<?php
   include('db.php');

  $sql = "SELECT zonders.idzonder, zonders.zname FROM zonders";
  $stmt = $con->prepare($sql);
  $stmt->execute();

  $result = $stmt->fetchAll();

   	foreach ($result as $row) {

$idz = $row['idzonder'];


   		 $sql="SELECT programma.pname, uitzending.*, zonders.zname,  medewerker.wfirstname, TIMEDIFF(uitzending.starttime, uitzending.lasttime) as diffTime
        	FROM uitzending 
        	INNER JOIN programma on uitzending.idprogramma = programma.idprogramma 
        	INNER JOIN zonders on uitzending.idzender = zonders.idzonder 
        	INNER JOIN medewerker on uitzending.presentator = medewerker.idworker 
        	WHERE zonders.idzonder = :idzonder ";



        	 $stmt=$con->prepare($sql);
		       $stmt->bindParam(":idzonder", $idz);
		       $stmt->execute();
		       $resultProgram =$stmt->fetchAll(PDO::FETCH_ASSOC);


   		?>

   		

   		 <div>
                    <h3><?= $row['zname'];  ?></h3>
                    <table border="1" style="border-collapse: collapse" >
                        <tr>
                            <td>Programma</td>
                            <td>date</td>
                            <td>firsttime</td>
                            <td>lasttime</td>
                            <td>diffrent time</td>
                            <td>wfirstname</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>
                        <?php

                            foreach ($resultProgram as $rowProgram){ ?>
                                <tr >
                                    <td><?php echo $rowProgram['pname'] ?></td>
                                    <td><?php echo $rowProgram['date'] ?></td>
                                    <td><?php echo $rowProgram['starttime'] ?></td>
                                    <td><?php echo $rowProgram['lasttime'] ?></td>
                                    <td><?php echo $rowProgram['diffTime'] ?></td>
                                    <td><?php echo $rowProgram['wfirstname'] ?></td>


                                    <td><a href="#">edit</a></td>
                                    <td><a href="#">delet</a></td>
                                </tr>


                        <?php } ?>

                    </table>

                </div>
                <p><a href="# ">prgramma aanmaken</a></p>









   		<?php


   	}
   
  


?>