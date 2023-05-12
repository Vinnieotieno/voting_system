<?php include 'includes/dashboard_header.php' ?>
<?php
$errors = array();
$success = array();
 if(isset($_GET['updateId'])){
    $idNum = $_GET['updateId'];
    $sql ="SELECT * FROM voters WHERE id = '$idNum'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $uname = $name = $id = $email = $mobile = $county = $constName = $regName = $voterNum = $dob = $gender ='';
    $uname = $_POST['uname'];
    $name = $_POST['name'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $county = $_POST['county'];
    $constName = $_POST['constName'];
    $regName = $_POST['regName'];
    $voterNum = $_POST['voterNum'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $formatDOB = date('Y-m-d', strtotime($dob));
    $sql = "UPDATE voters SET username = '$uname', name ='$name', id_num = '$id', email='$email', mobile_no = '$mobile' ,county = '$county', constituency_name = '$constName', registration_center = '$regName', voter_num = '$voterNum', WHERE id = '$idNum'";

if(mysqli_query($conn, $sql)){
    //Success
    array_push($success, "Successfully Updated ");
  
}
else{
     //error
    echo 'Error: '. mysqli_error($conn);
}
}
}
?>
 
<div style="margin-top: 100px;" class="row">
<?php include 'includes/messages.php' ?>
    <div class="col-md-5 m-auto">
            <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
            <div class="mb-3">
                <label for="uname" class="form-label">Username</label>
                <input type="text" class="form-control " id="uname" name="uname"  value="<?php echo $row['username']; ?>">
                
                </div>
            <div class="mb-3">
                <label for="name" class="form-label">Full Names</label>
                <input type="text" class="form-control  " id="name" name="name" value="<?php echo $row['name']; ?>">
                
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">National Identification Number</label>
                <input type="number" class="form-control " id="id" name="id"  value="<?php echo $row['id_num']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control " id="email" name="email"  value="<?php echo $row['email']; ?>">
                
                </div>
                <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="number" class="form-control " id="mobile" name="mobile"  value="<?php echo $row['mobile_no']; ?>">
                
                </div>
                <div class="mb-3">
                <label for="County" class="form-label">County</label>
                <input type="text" class="form-control " id="county" name="county"  value="<?php echo $row['county']; ?>">
                
                </div>
            <div class="row">
                <div class="col-6">
                <div class="mb-3">
                <label for="constName" class="form-label">Constituency Name</label>
                <input type="text" class="form-control " id="constName" name="constName"  value="<?php echo $row['constituency']; ?>">
                
            </div>
                </div>
                <div class="col-6">
                <div class="mb-3">
                <label for="regName" class="form-label">Registration Center Name</label>
                <input type="text" class="form-control " id="regName" name="regName"  value="<?php echo $row['reg_center']; ?>">
            </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                <div class="mb-3">
                <label for="voterNum" class="form-label">Voters Number</label>
                <input type="number" class="form-control" id="voterNum" name="voterNum"  value="<?php echo $row['voter_num']; ?>">    
            </div>
                </div>
                <div class="col-6">
                <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control " id="dob" name="dob"  value="<?php echo $row['dob']; ?>">
                
            </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5 m-auto">
                    <label   for="gender">Gender</label> <br>
                    <input  type="radio" class="" name="gender" value="<?php echo $row['gender']; ?>"> Female
                    <input type="radio" class="" name="gender" value="<?php echo $row['gender']; ?>"> Male
                    <input type="radio" class="" name="gender" value="<?php echo $row['gender']; ?>"> Other
                </div>
            </div>
            <div class="mt-3 text-center">
                <input type="submit" class="form-control text-light bg-dark text-center  " id="update" name="update" value="Update" >
            </div>
        </form>
        <a href="/iebc/voterList.php" class="btn btn-dark"> <i class="bi bi-arrow-left">Back</i></a>
</div>
</div>
<?php include 'includes/footer.php' ?>