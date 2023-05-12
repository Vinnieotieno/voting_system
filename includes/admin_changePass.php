<?php
include '../database/config.php';
$success = array();
$errors = array();
$oldPassword = $newPassword = $Cpassword ='';
$oldPasswordErr = $newPasswordErr = $CpasswordErr ='';
if(isset($_POST['reset'])){
           //validate password
        if(empty($_POST['oldPassword'])){
            $oldPasswordErr = 'Old password is required';
        }else{
            $oldPassword = filter_input(INPUT_POST, 'oldPassword' ,  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        //validate password
        if(empty($_POST['newPassword'])){
        $newPasswordErr = 'New password is required';
    }else{
        $newPassword = filter_input(INPUT_POST, 'newPassword' ,  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
        //validate confirm password
        if(empty($_POST['Cpassword'])){
            $CpasswordErr = 'Confirm password is required';
        }else{
            $Cpassword = filter_input(INPUT_POST, 'Cpassword' ,  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        //
        if(strlen($newPassword) > 6 && strlen($newPassword) < 20 && preg_match('`[A-Z]`', $newPassword) && preg_match('`[a-z]`', $newPassword) && preg_match('`[0-9]`', $newPassword)){
        
        }else{
            $newPasswordErr = 'password must be atleast 6 characters and atmost 20 characters <br>
            At least one Uppercase <br>
            At least one lower case <br>
            At least one digit';
        }
        //Checking to see if passwords are same
        if($newPassword != $Cpassword){
            $CpasswordErr = 'Passwords do not match';
        }

        if(empty($oldPasswordErr) && empty($newPasswordErr) && empty($CpasswordErr)){
        if(!empty($_SESSION["idNumber"])){
            $id = $_SESSION["idNumber"];
            $sql = "SELECT * FROM admins WHERE id = '$id'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            if(md5($oldPassword) === $row['password']){
                //password is correct
                $hashedPassword = md5($newPassword);
                $sql2 = "UPDATE admins SET password = '$hashedPassword' WHERE id = '$id'";
                if(mysqli_query($conn,$sql2)){
                    //updated
                    header('Location: /iebc/admin_dashboard.php');
                }else{
                    echo 'Error: '. mysqli_error($conn);
                    array_push($errors, "Password not Reset, Try again");
                }
            }else{
                echo 'Error: '. mysqli_error($conn);
                array_push($errors, "Incorrect Password");
            }
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
    <title>Change Password</title>
</head>
<body>
<div style="margin-top: 100px;" class="row">
<div class="col-md-5 m-auto">
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-info text-center py-4">Reset Password</h5>
        <?php include 'messages.php' ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <div class="mb-3">
                   <label for="oldPassword" class="form-label">Old Password</label>
                   <input type="password" class="form-control <?php echo $oldPasswordErr ? 'is-invalid' : null ;?>" id="oldPassword" name="oldPassword" placeholder=" Enter old password">
                   <div class="invalid-feedback">
                       <?php echo $oldPasswordErr ?>
                   </div>      
                </div>
    <div class="mb-3">
                   <label for="newPassword" class="form-label">New Password</label>
                   <input type="password" class="form-control <?php echo $newPasswordErr ? 'is-invalid' : null ;?>" id="newPassword" name="newPassword" placeholder=" Enter new password">
                   <div class="invalid-feedback">
                       <?php echo $newPasswordErr ?>
                   </div>      
                </div>
    <div class="mb-3">
                   <label for="Cpassword" class="form-label">Confirm Password</label>
                   <input type="password" class="form-control <?php echo $CpasswordErr ? 'is-invalid' : null ;?> " id="Cpassword" name="Cpassword" placeholder=" Confirm password">
                   <div class="invalid-feedback">
                       <?php echo $CpasswordErr ?>
                   </div>      
                </div>
                <div class="mb-3">
                    <input type="checkbox" onclick="viewPass()"> show Password
                </div>
    <div class="mb-4">
        <input type="submit" class="form-control bg-danger" name="reset" value="Reset Password">
    </div>
    </form>
    </div>
</div>
<a href="/iebc/admin_dashboard.php" class="btn btn-dark mt-4"><< Back</a>
</div>
</div>
<script>
   function viewPass(){
    var password = document.getElementById("password")
   

    if(password.type === 'password'){
        password.type = 'text' 
    }else{
        password.type = 'password' 
        
    }
   }
</script>
</body>
</html>
<?php include 'footer.php' ?>