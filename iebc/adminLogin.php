<?php include 'includes/header_home.php'?>
<?php
   $errors = array();
   $name = $email = $password = '';
   $nameErr = $emailErr = $passwordErr = '';
   if(isset($_POST['submit'])){

    //VALIDATING NAME
       if(empty($_POST['name'])){
           $nameErr = "Name is Required";
       }else{
           $name = filter_input(INPUT_POST, 'name' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       }
       //VALIDATING EMAIL
       if(empty($_POST['email'])){
        $emailErr = "Email is Required";
    }else{
        $email = filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_EMAIL);
    }
       //VALDATING PASSWORD
       if(empty($_POST['name'])){
        $passwordErr = "Name is Required";
    }else{
        $password = filter_input(INPUT_POST, 'password' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if(empty($nameErr) && empty($emailErr) && empty($passwordErr)){
        //check if the person exists
        $sql = "SELECT * FROM admins WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0){
            //the user exists
            if(md5($password) === $row['password']){
                  //they match
                  $_SESSION["adminLogin"] = true;
                  $_SESSION["idNumber"] = $row["id"];
                  header("Location: /iebc/admin_dashboard.php");
            }else{
                      //they dont match
                      array_push($errors, "Incorrect Password");
            }
        }else{
               //not exist
               array_push($errors, "Voter Does not Exist");
        }
    }

   }

?>
<div style="margin-top: 100px;" class="row">
    <div class="col-md-5 m-auto">
        <div style="box-shadow: 3px 3px 10px 5px black;" class="card">
            <div class="card-body">
                <h3 class="card-title text-success text-center">Admin Sign In</h5>
                <?php include 'includes/messages.php' ?>
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                  <div class="mb-3">
                   <label for="name" class="form-label">Full Names</label>
                   <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ;?> " id="name" name="name" placeholder=" Enter Full names">
                   <div class="invalid-feedback">
                       <?php echo $nameErr ?>
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
                    <input type="checkbox" onclick="viewPass()" > show password
                </div>
                <div class="mb-3">
                   <input type="submit" class="form-control text-light bg-success " id="submit" name="submit" value="Sign In" >
               </div>
                </form>
            </div>
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
<?php include 'includes/footer.php'?>