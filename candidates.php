<?php include 'includes/dashboard_header.php' ?>
<?php
$errors = array();
$success = array();
$name = $id =  $pos = $place= $party = $upload = '';
$nameErr = $idErr =  $posErr = $placeErr = $partyErr = $uploadErr = '';
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
    //validating place
    if(empty($_POST['manifesto'])){
      $manifestoErr = "Candidate's Manifesto is Required";
    }else{
      $manifesto = filter_input(INPUT_POST, 'manifesto' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
        //validating party
        if(empty($_POST['party'])){
          $partyErr = "Candidate's Political Party is Required";
        }else{
          $party = filter_input(INPUT_POST, 'party' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
  //validating upload
  if(empty($_FILES['upload']['name'])){
    $uploadErr = "This Field is Required";
  }
  if(empty($nameErr) && empty($posErr) && empty($placeErr) && empty($uploadErr) && empty($partyErr)){
    $allowed_ext = array('png','jpg','jpeg','gif','pdf');
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
          $sql2 = "INSERT INTO candidates(name, id_num, position, place, manifesto, party, photo) VALUES('$name', '$id', '$pos', '$place', '$manifesto','$party', '$file_name')";
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
<div style="margin-top: 100px;" class="row">
<div class="col-md-6 m-auto">
  <div class="card">
      <div class="card-body">
          <h3 class="card-title text-primary text-center"><i class="bi bi-box h1"></i> Election Candidate's Details</h3>
          <?php include 'includes/messages.php' ?>
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
                  <select class="form-control" name="pos" id="pos"> Select Position
                  <option value="president">President</option>
                  <option value="governor">Governor</option>
                  <option value="senator">Senator</option>
                  <option value="women representative">Women Representative</option>
                  <option value="member of parliament">Member of Parliament</option>
                  <option value="member of county assembly">MCA</option>
                  </select>
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
                  <label for="party" class="form-label">Political party</label>
                  <input type="text" class="form-control <?php echo $partyErr ? 'is-invalid' : null ;?> " id="party" name="party" placeholder=" example. Jubillee Party">
                  <div class="invalid-feedback">
                      <?php echo $partyErr ?>
                  </div>
              </div>

              <div class="mb-3">
                  <label for="manifesto" class="form-label">Manifesto</label>
                 <textarea name="manifesto" id="" cols="20" rows="4"  class="form-control <?php echo $manifestoErr ? 'is-invalid' : null ;?> " placeholder="Enter Candidate's Manifesto"></textarea>
                  <div class="invalid-feedback">
                      <?php echo $manifestoErr ?>
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
  <a href="/iebc/admin_dashboard.php" class="btn btn-dark mt-4"><< Back</a>
</div>
</div>
<?php include 'includes/footer.php' ?>