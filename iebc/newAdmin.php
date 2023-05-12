<?php include 'includes/dashboard_header.php'?>
<?php
$name = $email  = $id = $phoneNum = $title = $gender = $password = $Cpassword = '';
$nameErr = $emailErr  = $idErr = $phoneNumErr = $titleErr = $genderErr = $passwordErr = $CpasswordErr = '';
$errors = array();
$success = array();
if(isset($_POST['submit'])){
    //validating name
    if(empty($_POST['name'])){
        $nameErr = "Full name is Required";
    } else{
        $name = filter_input(INPUT_POST, 'name' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validating id
    if(empty($_POST['id'])){
        $idErr = "ID/Passport required";
    }else{
        $id = filter_input(INPUT_POST, 'id' , FILTER_SANITIZE_NUMBER_INT);
    }

    //validating email
    if(empty($_POST['email'])){
        $idErr = "Email Address is Required";
    } else{
        $email = filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_EMAIL);
    }

    //validating phone Number
    if(empty($_POST['phoneNum'])){
        $phoneNumErr = "Phone Number Is required";
    } else{
        $phoneNum = filter_input(INPUT_POST, 'phoneNum' , FILTER_SANITIZE_NUMBER_INT);
    }
    //validating title
    if(empty($_POST['title'])){
        $titleErr = "Your Position in the Organization is Required";
    }else{
        $title = filter_input(INPUT_POST, 'title' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validate gender
    if(empty($_POST['gender'])){
        $genderErr = 'Gender is required';
    }else{
        $gender = filter_input(INPUT_POST, 'gender' ,  FILTER_SANITIZE_ENCODED);
    }
    //validate password
    if(empty($_POST['password'])){
        $passwordErr = 'password is required';
    }else{
        $password = filter_input(INPUT_POST, 'password' ,  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validate confirm password
    if(empty($_POST['Cpassword'])){
        $CpasswordErr = 'Confirm password is required';
    }else{
        $Cpassword = filter_input(INPUT_POST, 'Cpassword' ,  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validating the strength of password
    if(strlen($password) > 6 && strlen($password) < 20 && preg_match('`[A-Z]`', $password) && preg_match('`[a-z]`', $password) && preg_match('`[0-9]`', $password)){
    
    }else{
        $passwordErr = 'password must be atleast 6 characters and atmost 20 characters <br>
        At least one Uppercase <br>
        At least one lower case <br>
        At least one digit';
    }
      //Checking to see if passwords are the same
    if($password != $Cpassword){
        $CpasswordErr = 'Passwords do not match';
    }
    //if there is no error
    if(empty($nameErr) && empty($idErr) && empty($emailErr) && empty($phoneNumErr) && empty($titleErr) && empty($genderErr) && empty($passwordErr) && empty($CpasswordErr)){
       //check to see if the person is registered
       $sql = "SELECT * FROM admins WHERE email = '$email' AND id_num = '$id'";
       $result = mysqli_query($conn,$sql);
       $row = mysqli_fetch_assoc($result);
       if(mysqli_num_rows($result) > 0){
           //exists
           array_push($errors, "The Admin is in the System");
       } else{
           //we now add admin
           $hashedPassword = md5($password);
           $sql2 = "INSERT INTO admins(name, email, phone, id_num, gender, password, title, image) VALUES('$name', '$email', '$phoneNum', '$id', '$gender', '$hashedPassword', '$title', 'default3.jpg')";
           $result2 = mysqli_query($conn, $sql2);
           if($result2){
               array_push($success, "Admin Successfully Added");
           }else{
               array_push($errors, "Admin was not Added,Please try Again");
               echo 'Error: '. mysqli_error($conn);
           }
       }
    }
}
?>
<div style="margin-top: 100px;" class="row">
  <div class="col-md-5 m-auto">
      <div class="card">
          <div class="card-body">
              <h3 class="card-title text-center text-info">Add new Admin</h3>
              <?php include 'includes/messages.php' ?>
              <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
               <div class="mb-3">
                   <label for="name" class="form-label">Full Names</label>
                   <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ;?> " id="name" name="name" placeholder=" Enter Full names">
                   <div class="invalid-feedback">
                       <?php echo $nameErr ?>
                   </div>
               </div>
               <div class="mb-3">
                   <label for="id" class="form-label">ID/Passport</label>
                   <input type="number" class="form-control <?php echo $idErr ? 'is-invalid' : null ;?> " id="id" name="id" placeholder=" Enter Identification Number/Passport">
                   <div class="invalid-feedback">
                       <?php echo $idErr ?>
                   </div>
               </div>
               <div class="mb-3">
                   <label for="email" class="form-label">Email Address</label>
                   <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null ;?> " id="email" name="email" placeholder=" Enter Email Address">
                   <div class="invalid-feedback">
                       <?php echo $emailErr ?>
                   </div>
                </div>
               <div class="row">
                   <div class="col-6">
                   <div class="mb-3">
                   <label for="phoneNum" class="form-label">Phone Number</label>
                   <input type="number" class="form-control <?php echo $phoneNumErr ? 'is-invalid' : null ;?> " id="phoneNum" name="phoneNum" placeholder="Phone Number">
                   <div class="invalid-feedback">
                       <?php echo $phoneNumErr ?>
                   </div>     
                </div>
                   </div>
                   <div class="col-6">
                   <div class="mb-3">
                   <label for="title" class="form-label">Title</label>
                   <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : null ;?> " id="title" name="title" placeholder=" Enter your Title">
                   <div class="invalid-feedback">
                       <?php echo $titleErr ?>
                   </div>      
                </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-7 m-auto">
                       <label for="gender">Gender</label> <br>
                       <input type="radio" class=" <?php echo $genderErr ? 'is-invalid' : null ;?> " name="gender" value="Female"> Female
                       <input type="radio" class=" <?php echo $genderErr ? 'is-invalid' : null ;?> " name="gender" value="Male"> Male
                       <input type="radio" class=" <?php echo $genderErr ? 'is-invalid' : null ;?> " name="gender" value="Other"> Other
                       <div class="invalid-feedback">
                       <?php echo $genderErr ?>
                   </div>  
                    </div>
               </div>
               <div class="mb-3">
                   <label for="password" class="form-label">Password</label>
                   <input type="password" class="form-control <?php echo $passwordErr ? 'is-invalid' : null ;?>" id="password" name="password" placeholder=" Enter password">
                   <div class="invalid-feedback">
                       <?php echo $passwordErr ?>
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
                    <input type="checkbox" onclick="showPass()"> show Password
                </div>
               <div class="mb-3">
                   <input type="submit" class="form-control text-light bg-info " id="submit" name="submit" value="Add Admin" >
               </div>
           </form>
          </div>
      </div>
      <a href="/iebc/admin_dashboard.php" class="btn btn-dark text-light my-3 px-4"><< Dashboard</a>
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

<?php include 'includes/footer.php'?>