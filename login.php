   <?php include 'includes/header_home.php' ?>
<?php 
$errors = array();
    //constants
    $id = $email = $password = '';
    $idErr = $emailErr = $passwordErr = '';
    //validate email
    if(empty($_POST['email'])){
        $emailErr = 'Email address is required';
    }else{
        $email = filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_EMAIL);
    }
       //validate id
       if(empty($_POST['id'])){
        $idErr = 'National Identification Number is required';
    }else{
        $id = filter_input(INPUT_POST, 'id' , FILTER_SANITIZE_NUMBER_INT);
    }
     //validate password
     if(empty($_POST['password'])){
        $passwordErr = 'password is required';
    }else{
        $password = filter_input(INPUT_POST, 'password' ,  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //if there is no error
    if(empty($idErr) && empty($emailErr) && empty($passwordErr) ){
        //check to see if the user exist in the db
        $sql = "SELECT * FROM voters WHERE id_num = '$id' AND email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0){
            //exists
            //Comparing Passwords
            if(md5($password) ===$row["password"]){
                //they match
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row["id"];
                header("Location: /iebc/voter_dashboard.php");
            } else{
                //they dont match
                array_push($errors, "Incorrect Password");
            }

        }else{
            //not exist
            array_push($errors, "Voter Does not Exist");
        }
    }

?>

<div style="padding-top: 50px;" class=" mt-5 text-center">
    <img style="width: 300px; height: 300px; border-radius: 50%;" src="/IEBC/images/kk.jpg" alt="">
</div>
<div class="container p-3">
    <h2 class="text-center text-primary ">Online Voter Registration</h2>
    <h4 class="text-center text-primary ">Sign In</h4>
    <?php include 'includes/messages.php' ?>
    <p class=" text-center lead text-primary">Please sign up to access Your Account</p>
   <div class="row">
       <div class="col-md-5 m-auto">
               <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
               <div class="mb-3">
                   <label for="id" class="form-label">National Identification Number</label>
                   <input type="number" class="form-control <?php echo $idErr ? 'is-invalid' : null ;?> " id="id" name="id" placeholder=" Enter Identification Number">
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
                <div class="mb-3">
                   <label for="password" class="form-label">Password</label>
                   <input type="password" class="form-control <?php echo $passwordErr ? 'is-invalid' : null ;?>" id="password" name="password" placeholder=" Enter password">
                   <div class="invalid-feedback">
                       <?php echo $passwordErr ?>
                   </div>      
                </div>
                <div class="mb-3">
                    <input type="checkbox" onclick="viewPass()"> show Password
                </div>
                <div class="mb-3">
                   <input type="submit" class="form-control text-light bg-dark " id="submit" name="submit" value="Sign In" >
               </div>
               </div>
               
           </form>
    </div>
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
<?php include 'includes/footer.php' ?>