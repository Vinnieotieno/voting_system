<?php include 'includes/dashboard_header.php' ?>

<?php
 if(isset($_GET['updateId'])){
    $id = $_GET['updateId'];
    $sql ="SELECT * FROM voters WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
}
$errors = array();
$success = array();
$name = $id =  $pos = $place = $upload = '';
$nameErr = $idErr =  $posErr = $placeErr = $uploadErr = '';
if(isset($_POST['submit'])){
  if(empty($_POST['name'])){
    $nameErr = "Candidate's name is Required";
  }else{
    $name = filter_input(INPUT_POST, 'name' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  //validating id 
  if(empty($_POST['id'])){
    $idErr = "Candidate's ID is Required";
  }else{
    $id = filter_input(INPUT_POST, 'id' , FILTER_SANITIZE_NUMBER_INT);
  }
  //validating position 
  if(empty($_POST['pos'])){
    $posErr = "Candidate's Position is Required";
  }else{
    $pos = filter_input(INPUT_POST, 'pos' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  //validating place
  if(empty($_POST['place'])){
    $placeErr = "Candidate's place of Interest is Required";
  }else{
    $place = filter_input(INPUT_POST, 'place' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  //validating upload
  if(empty($_FILES['upload']['name'])){
    $uploadErr = "Candidate's Photo is Required";
  }
  if(empty($nameErr) && empty($posErr) && empty($placeErr) && empty($uploadErr)){
    $allowed_ext = array('png','jpg','jpeg','gif');
    $file_name = $_FILES['upload']['name'];
    $file_size = $_FILES['upload']['size'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $target_dir = "uploads/${file_name}";

    //get file extension
    $file_ext = explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));

    if(in_array($file_ext,$allowed_ext)){
      //Limiting the file size
      if($file_size <= 1000000){
        //We check to see if the candidate is already in Our database
        $sql = "SELECT * FROM candidates WHERE id_num = '$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0){
          array_push($errors, "Candidate cannot compete in two different post");
        }else{
          $sql2 = "INSERT INTO candidates(name, id_num, position, place, photo) VALUES('$name', '$id', '$pos', '$place', '$file_name')";
          if(mysqli_query($conn, $sql2)){
            //sucess
            move_uploaded_file($file_tmp, $target_dir);
            array_push($success, "Candidate posting was Successfull");
          }else{
            //error
            echo 'Error: '. mysqli_error($conn);
          }
        }
      } else{
        array_push($errors, "File is Too large");
      }
    }else{
      array_push($errors, "Invalid File Type");
    }
  }
}
?>
?>
 
<div style="margin-top: 100px;" class="row">
<?php include 'includes/messages.php' ?>
    <div class="col-md-5 m-auto">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" method="POST">
        <div class="mb-3">
                <label for="name" class="form-label">Candidate's Names</label>
                <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ;?> " id="name" name="name" placeholder=" Enter Full names">
                <div class="invalid-feedback">
                    <?php echo $nameErr ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control <?php echo $idErr ? 'is-invalid' : null ;?> " id="id" name="id" placeholder="National Identity Number">
                <div class="invalid-feedback">
                    <?php echo $idErr ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="pos" class="form-label">Position</label>
                <input type="text" class="form-control <?php echo $posErr ? 'is-invalid' : null ;?> " id="pos" name="pos" placeholder="The position candidate is interested in">
                <div class="invalid-feedback">
                    <?php echo $posErr ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="place" class="form-label">Place</label>
                <input type="text" class="form-control <?php echo $placeErr ? 'is-invalid' : null ;?> " id="place" name="place" placeholder=" example. Nairobi County">
                <div class="invalid-feedback">
                    <?php echo $placeErr ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="upload" class="form-label">Candidate's Photo</label>
                <input type="file" class="form-control <?php echo $uploadErr ? 'is-invalid' : null ;?> " id="upload" name="upload" >
                <div class="invalid-feedback">
                    <?php echo $uploadErr ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" class="form-control text-light bg-primary " id="submit" name="submit" value="Post Candidate" >
            </div>
    </form>
</div>
</div>
<?php include 'includes/footer.php' ?>