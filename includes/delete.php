
<?php
include '../database/config.php';
if(isset($_GET['deleteId'])){
    $id = $_GET['deleteId'];

    $sql = "DELETE FROM voters WHERE id = '$id'";
   $result =  mysqli_query($conn,$sql);
   if($result){
       //echo "delete successfull";
       header('Location:/iebc/voterList.php');
   }
   else{
       die(mysqli_error($conn));
   }
}
?>