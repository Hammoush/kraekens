 <?PHP if (isset($_GET['wat je wil']) ) {
        ///   verible maken  //
         $name = $_POST['form'];
         $discribe = $_POST['form'];


         //// query maken   ////
       $sql = "INSERT INTO zonders (zname,discribe) VALUES (:x, :y)";
       $stmt = $con->prepare($sql);
       $stmt->bindParam(":x",$name);
       $stmt->bindParam(":y",$discribe);

     /*   $array= [
     
            ':x' => $name,
            ':y' => $discribe
        ];  */

        $stmt->execute();
      
        /// zorg ervoor dat u de DATABASE invoert

       $rowCount = $stmt->rowCount();
       if($rowCount){
        echo  $rowCount . 'row inserted successfully';
       }else {
        echo $rowCount . 'row failed insert';
       }
     
 }
   ?>