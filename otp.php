<?php include "includes/header_home.php" ?>
<?php 
$errors = array();
if(isset($_POST['submit'])){
    //validate input
    if(empty($_POST['otp'])){
        $otpErr = "Please fill in the field";
    }else{
        $otp = filter_input(INPUT_POST, 'otp', FILTER_SANITIZE_NUMBER_INT);
    }
    if(empty($otpErr)){
        $sql = "SELECT * FROM voters WHERE otp = '$otp'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row["id"];
            header("Location: /iebc/voter_dashboard.php");
        }else{
            array_push($errors, "Incorrect Code");
        }
    }
}
?>
<div style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-5 m-auto">
            <div class="card">
                <h2 class="text-center text-dark">Verification Code</h2>
                <p class="text-primary container">Please enter the verification code sent to your email</p>
                <div class="card-body">
                    <form action="otp.php" method="POST">
                        <div>
                            <label for="otp" class="form-label">Enter Code</label>
                            <input type="text" class="form-control <?php echo $otpErr ? 'is-invalid' : null ;?>" placeholder="Enter Code" name="otp">
                            <div class="invalid-feedback">
                                <?php echo $otpErr ?>
                            </div>
                        </div>
                        <input type="submit" class="form-control text-light bg-dark mt-5 " id="submit" name="submit" value="Send" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>