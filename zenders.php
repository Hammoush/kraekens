<?php
    include ("layout/header.php");
    include ("db.php"); ?>


    <!------------------------------------>  
<!---------------------zender kan updite 333333333333  --------------->
<?php
 if(isset($_GET['do']) && $_GET['do'] == 'edit_zender'){


     include('form/form.php');

 }


if(isset($_GET['do']) && $_GET['do'] == 'update_zender'){
    
    $name = $_POST['naam'];
    $disc = $_POST['discribe'];
    $id = (int)$_POST['id'];


   



    $sql = "UPDATE zonders SET zname=:zname, discribe=:zdis WHERE idzonder = :zid";

     $stmt = $con->prepare($sql);
    
    $array = [
        ':zname' => $name,
         ':zdis' => $disc,
         ':zid' => $id,

    ];
   
    $stmt->execute($array);
   



/// zorg ervoor dat u de DATABASE update//////
      $rowCount = $stmt->rowCount();
       if($rowCount){
        echo  $rowCount.':'. 'row updated successfully';
       }else {
        echo $rowCount . 'row failed update';
       }





}
?>
<!------------------------------------>  
<!---------------------zender kan aanmaken 222222222  ---------------> 
 <?php 


 if (isset($_GET['do']) && $_GET['do'] == 'nieuw' ) {

   
     include('form/form.php');



 } 



   if (isset($_GET['do']) && $_GET['do'] == 'maak_zender' ) {
        ///   verible maken  //
         $name = $_POST['naam'];
         $discribe = $_POST['discribe'];




         //// query maken   ////
       $sql = "INSERT INTO zonders (zname,discribe) VALUES (:x, :y)";
       $stmt = $con->prepare($sql);
      // $stmt->bindParam(":x",$name);
      // $stmt->bindParam(":y",$discribe);

        $array= [
            ':x' => $name,
            ':y' => $discribe
        ];  

        $stmt->execute($array);
      
        /// zorg ervoor dat u de DATABASE invoert

       $rowCount = $stmt->rowCount();
       if($rowCount){
        echo  $rowCount.':'. 'row inserted successfully';
       }else {
        echo $rowCount . 'row failed insert';
       }
     
 }
   ?>
 

   <!------------------------------------>  
<!---------------------zender kan verwijderen 4444444444  ---------------> 
<?php


 if (isset($_GET['do']) && $_GET['do'] == 'delete_zender' ) {
    $idzonder = $_GET['id'];
     $sql="DELETE FROM zonders WHERE idzonder = :idzonder ";
     $stmt = $con->prepare($sql);
     $stmt->bindParam(":idzonder",$idzonder);
     $stmt->execute();

      $rowCount = $stmt->rowCount();

       if($rowCount){

            echo  $rowCount.':'. 'row deleted successfully';

       }else {

            echo $rowCount . 'row failed deleted';

       }



}



?>

<!------------------------------------>  
<!---------------------zender kan tonnen111111111  --------------->   
<?php
    $sql="SELECT * FROM  zonders";
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

?>


    <div class="frontpage">
        <?php
        foreach ($result as $row) { ?>
            <div>
                <p ><?php echo $row['zname']; ?></p>
                <p><?php echo $row['discribe']; ?></p>
                <p><a href="programaoverzicht.php?idzonder=<?php echo $row['idzonder']; ?> ">summery programm</a></p>
                
                <p>
                    <a  href="zenders.php?do=edit_zender&id=<?php echo $row['idzonder']; ?> ">edit</a>
                    <a href="zenders.php?do=delete_zender&id=<?php echo $row['idzonder']; ?> ">delete</a>
                    
                </p>
            </div>

       <?php } ?>


    </div>
    <P><a href="zenders.php?do=nieuw">add channal</a></P>
    <P><a href="zemderAll.php">view all channal with its programms</a></P>


