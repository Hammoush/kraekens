<?php
   include ('db.php');




   if (isset($_GET['do']) && $_GET['do'] == 'delete') {
    
      $sql = "DELETE FROM uitzending WHERE uitzending.date = :zdate";


       $stmt = $con->prepare($sql);
       $stmt->bindParam(':zdate',$_GET['date']);

       $stmt->execute(); 
      

   }






	


        $sql="SELECT programma.idprogramma, programma.pname, uitzending.*, TIMEDIFF(uitzending.starttime, uitzending.lasttime) as diffTime,  zonders.zname,  medewerker.wfirstname 
        	FROM uitzending 
        	INNER JOIN programma on uitzending.idprogramma = programma.idprogramma 
        	INNER JOIN zonders on uitzending.idzender = zonders.idzonder 
        	INNER JOIN medewerker on uitzending.presentator = medewerker.idworker 
        	WHERE zonders.idzonder = :idzonder  order by uitzending.date ASC";

		       $stmt=$con->prepare($sql);
		       $stmt->bindParam(":idzonder",$_GET['idzonder']);
		       $stmt->execute();
		       // 1. PDO::FETCH_ASSOC return name of array
		       // 2. PDO::FETCH_NUM return index of array
		       // 3. PDO::FETCH_BOTH return both name and index
		       $result=$stmt->fetchAll(/*PDO::FETCH_ASSOC*/);


		       ?>
                <div>
                    <h3><?= $result[0]['zname'];  ?></h3>
                    <table border="1" style="border-collapse: collapse" >
                        <tr>
                            <td>Programma</td>
                            <td>date</td>
                            <td>firsttime</td>
                            <td>lasttime</td>
                            <td>duur</td>
                            <td>wfirstname</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>
                        <?php

                            foreach ($result as $row){    print_r($row); ?>
                                <tr >
                                    <td><?php echo $row['pname'] ?></td>
                                    <td><?php echo $row['date'] ?></td>
                                    <td><?php echo $row['starttime'] ?></td>
                                    <td><?php echo $row['lasttime'] ?></td>
                                    <td><?php echo $row['diffTime'] ?></td>
                                    <td><?php echo $row['wfirstname'] ?></td>


                                    <td><a href="#">edit</a></td>
                                    <td><a href="programaoverzicht.php?idzonder=<?php echo $_GET['idzonder']?>
                                    &date=<?php echo $row['date']; ?>
                                    &do=delete">delet</a></td>
                                </tr>


                        <?php } ?>

                    </table>

                </div>
                <p><a href="# ">prgramma aanmaken</a></p>





  <!------

     <div style="margin: 20px auto; width: 50%; border: 1px solid #000; padding: 3px">
                 <div style="padding: 3px">Naam zonder : <?php // echo $row['zendernaam'] ; ?></div>


                 <div>
                        <table style="border: 1px solid black">

                            <tr>
                               <td><?php //echo $row['omschrijven'] ?></td>
                                <td><?php// echo $row['datum'] ?></td>
                                <td><?php// echo $row['begintijd'] ?></td>
                                <td><?php// echo $row['eindtijd'] ?></td>
                                <td><?php// echo $row['voornaam'] ?></td>
                                <td><a href="#">wijzig</a></td>
                                <td><a href="#">delet</a></td>
                            </tr>
                        </table>
                  </div>








     </div>



