<?php include "includes/header_home.php" ?>
<?php
if(isset($_POST['submit'])){
    $errors = array();
    $success = array();
    $username = $_POST['uname'];
    $password = $_POST['password'];
    $Cpassword = $_POST['Cpassword'];
    $name = $_POST['name'];
    $email =$_POST['email'];
    $id = $_POST['id'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $voter_num = $_POST['voter_num'];
    $county = $_POST['county'];
    $district = $_POST['district'];
    $const = $_POST['const'];
    $reg_center = $_POST['reg_center'];
    if($password != $Cpassword){
        array_push($errors, "Passwords do not match");
    }else{
        $sql = "SELECT * FROM voters WHERE email = '$email' AND id_num = '$id'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            array_push($errors, "Voter already Registered");
        }else{
            $hashedPassword = md5($password);
            $formatDOB = date('Y-m-d', strtotime($dob));
            $otp = substr(number_format(time()*rand(), 0, '', ''), 0, 5);
            $sql2 = "INSERT INTO voters(username, password, name, email, id_num, dob, mobile_no, gender, voter_num, county, district, constituency, reg_center, image,otp)
            VALUES('$username', '$hashedPassword', '$name', '$email', '$id', '$formatDOB', '$mobile', '$gender', '$voter_num', '$county', '$const', '$district', '$reg_center', 'default3.jpg','$otp') ";
            if(mysqli_query($conn, $sql2)){
                array_push($success, "Registration Completed Successfully");
                $subject =" IEBC Online voter Registration One time password";
                $body = "Welcome Back to <span style='color:green;'>IEBC online Voter registration</span>. Your code is '$otp'";
                
                if(mail($email, $subject, $body)){
                    header("Location: /iebc/otp.php");
                }
            }else{
                array_push($errors, "Registration Unsuccessful");
                echo 'Error: '. mysqli_error($conn);
            }
        }
    }

}
?>
<div style="padding-top: 50px;" class=" mt-5 text-center">
    <img style="width: 200px; height: 200px; border-radius: 50%;" src="/IEBC/images/s.jpg" alt="">
</div>
<div>
<h2 class="text-center text-primary ">Voters Registration Form</h2>
    <?php include 'includes/messages.php' ?>
    <p class=" text-center lead text-primary">Please register to be able to voter online in the coming elections</p>
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                        <div style="background: #eaeaea;" class="p-4 mb-4">
                            <span id="step-1" class="step text-center  text-dark mb-3"><i class="bi bi-arrow-right"></i> Login Details</span>
                            <span style="width: 200px;" id="step-2" class="step text-center  text-dark mb-3"><i class="bi bi-person-fill"></i> Personal Details</span>
                            <span id="step-3" class="step text-center text-dark mb-3"><i class="bi bi-box "></i> Voting Details</span>
                        </div>
                        <div class="tab" id="tab-1">
                            <p>Please Enter your login Details to proceed</p>
                            <div class="mb-3">
                                <label for="uname">UserName</label>
                                <input type="text" name="uname" placeholder="Enter Username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter password" class="form-control">
                                <div id="passError" class="matchPass">
                                    <p style="color: red;">Passwords Do Not match</p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password">Confirm password</label>
                                <input type="password" name="Cpassword" id="Cpassword" placeholder="Confirm Password" class="form-control" oninput="matchPass()">
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" onclick="showPass()"> show Password
                            </div>
                            <div class="index-btn-wrapper">
                                <div class="index-btn btn btn-outline-success" onclick="run(1, 2)">Next</div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="mb-3">
                                <label for="name">Full Names</label>
                                <input type="text" name="name" placeholder="Enter Full Names" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="mb-3">
                                <label for="id">Identification Number</label>
                                <input type="number" name="id" class="form-control" placeholder="Enter National Id">
                            </div>
                            <div class="mb-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="mobile">Mobile No.</label>
                                <input type="number" name="mobile" class="form-control" placeholder="Enter Mobile No.">
                            </div>
                            <div class="mb-3">
                                <label for="gender">Gender</label> <br>
                                <input type="radio" name="gender"  value="Male">Male
                                <input type="radio" name="gender"  value="Female">Female
                                <input type="radio" name="gender"  value="Others">Others
                            </div>
                            <div class="index-btn-wrapper">
                                <div class="index-btn btn btn-outline-danger" onclick="run(2, 1)">Previous</div>
                                <div class="index-btn btn btn-outline-success" onclick="run(2, 3)">Next</div>
                            </div>
                        </div>
                        <div class="tab" id="tab-3">
                            <div class="mb-3">
                                <label for="voter_num">Voters Number</label>
                                <input type="number" class="form-control" placeholder="Enter Voters Number" name="voter_num">
                            </div>
                            <div class="mb-3">
                                <label for="county">County</label>
                                <input type="text" name="county" placeholder="Enter County" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="district">District</label>
                                <input type="text" name="district" placeholder="Enter District" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="const">Constituency</label>
                                <input type="text" name="const" placeholder="Enter Constituency" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="regName">Registration Center</label>
                                <input type="text" name="reg_center" placeholder="Enter Registration Center" class="form-control">
                            </div>
                            <div class="index-btn-wrapper">
                                <div class="index-btn btn btn-outline-danger" onclick="run(3, 2)">Previous</div>
                                <div class="index-btn btn btn-outline-success" onclick="run(3, 4)">Next</div>
                            </div>
                        </div>
                        <div class="tab" id="tab-4">
                            <div class="index-btn-wrapper">
                            <div class="index-btn btn btn-outline-danger" onclick="run(4, 3)">Previous</div>
                            <input type="submit" class="form-control text-light bg-dark " id="submit" name="submit" value="Register" >
                        </div>
    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        //default tab
        $(".tab").css("display", "none");
        $("#tab-1").css("display", "block");
        function run(hideTab, showTab){
            if(hideTab < showTab){
                //press the next button
                //we validate first
                var currentTab = 0;
                x = $("#tab-"+hideTab);
                y = $(x).find("input");
                for(var i = 0; i < y.length; i++){
                    if(y[i].value == ""){
                        $(y[i]).css("background", "#ffdddd");
                        return false;
                    }
                }
            }
            
            //progress bar
            for(var i = 1; i < showTab; i++){
                $("#step-"+i).css("background", "lightgreen");
            }
            //switch tab
            $("#tab-"+hideTab).css("display", "none");
            $("#tab-"+showTab).css("display", "block");
            $("input").css("background" ,"#fff")
        }
        function showPass(){
    var password = document.getElementById("password")
    var Cpassword = document.getElementById("Cpassword")

    if(password.type === 'password' && Cpassword.type == 'password'){
        password.type = 'text' 
        Cpassword.type = 'text'
    }else{
        password.type = 'password' 
        Cpassword.type = 'password'
    }
}
function matchPass(){
    var password = document.getElementById("password").value;
    var Cpassword = document.getElementById("Cpassword").value; 
    var place = document.getElementById("passError")
    if(password != Cpassword){
        place.style.display = 'block';
    }else{
        place.style.display = 'none';
    }
}
</script>
<?php include "includes/footer.php" ?>