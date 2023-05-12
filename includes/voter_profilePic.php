
<?php
include '../database/config.php';
  if(isset($_POST['submit'])){
    $allowed_ext = array('png','jpg','jpeg','gif');
    if(!empty($_FILES['upload']['name'])){
       
        $file_name = $_FILES['upload']['name'];
        $file_size = $_FILES['upload']['size'];
        $file_tmp = $_FILES['upload']['tmp_name'];
        $target_dir = "../uploads/${file_name}";

        //get file extension
        $file_ext = explode('.',$file_name);
        $file_ext = strtolower(end($file_ext));


        //validate file extension
        if(in_array($file_ext,$allowed_ext)){
            //limiting the size
            if( $file_size <=1000000){
               if(!empty($_SESSION['id'])){
                  $id = $_SESSION['id'];
                  //Remaining Update command
                  $sql = "UPDATE voters SET image = '$file_name' WHERE id = '$id' ";
                  $result = mysqli_query($conn, $sql);
                  if($result){
                    move_uploaded_file($file_tmp, $target_dir);
                    header('Location: /iebc/voter_dashboard.php');
                }
                    else{
                            //error
                          echo 'Error: '. mysqli_error($conn);
                      }
               } else{
                   $message = '';
               }
              
            }else{
              $message = '<p style="color:red;">File is too large</p>';
            }

        }else{
          $message = '<p style="color:red;">Invalid File type</p>';
        }

    }else{
        $message = '<p style="color:red;">Please choose a file to Upload</p>';
    }
}
if(isset($_POST['reset'])){
  if(!empty($_SESSION['id'])){
    $id = $_SESSION['id'];
    $sql = "UPDATE voters SET image = 'default3.jpg' WHERE id = '$id' ";
    $result = mysqli_query($conn, $sql);
    if($result){
      move_uploaded_file($file_tmp, $target_dir);
      header('Location: /iebc/voter_dashboard.php');
  }
      else{
              //error
            echo 'Error: '. mysqli_error($conn);
        }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Upload Profile Picture</title>
</head>
<body>
<div style="margin-top: 100px;" class="row">
<div class="col-md-5 m-auto">
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-info text-center py-4">Upload Profile Picture</h5>
        <?php echo $message ?? null ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
      
      <input type="file" name="upload"> <br>
      <br>
      <input type="submit" value="Upload Profile" name="submit" class="btn btn-info">
      <input type="submit" value="Remove Profile" name="reset" class="btn btn-primary mx-5">
    </form>
    </div>
</div>
<a href="/iebc/voter_dashboard.php" class="btn btn-dark mt-4"><< Back</a>
</div>
</div>
</body>
</html>
<?php include 'footer.php' ?>