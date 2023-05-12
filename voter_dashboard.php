<?php include 'includes/voter_dashboard_header.php' ?>
<?php
if(isset($_SESSION["id"])){
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM voters WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
}else{
    header("Location : /iebc/login.php");
}
?>
<div style="margin-top: 100px;" class="row container">
 <div class="col-md-4 g-3">
     <div class="card">
         <div class="card-body">
             <h5 class="card-title text-primary text-center">Profile Information</h5>
             <div class="text-center">
                 <img style="width: 200px; height:200px; border-radius:50%;" src="/iebc/uploads/<?php echo $row['image'] ?>" alt="">
             </div>
             <p class="p-3 text-center text-primary lead"><b><i><?php echo $row['username'] ?></i></b></p>
             <a href="/iebc/includes/voter_profilePic.php" class="btn btn-outline-primary">Upload Profile</a>
         </div>
     </div>
 </div>
 <div class="col-md-8 g-3">
 <div class="row">
     <div class="col-md-4 g-4">
         <div style="background-color: maroon;" class="card">
             <div class="text-center card-body">
             <i class="bi bi-envelope h1"></i>
                 <h5 class="card-title"> Email Address</h5>
                 <p class=""><?php echo $row['email'] ?></p>
             </div>
         </div>
     </div>
     <div class="col-md-4 g-4">
     <div style="background-color: gold;" class="card">
             <div class="text-center card-body">
             <i class="bi bi-building h1"></i>
                 <h5 class="card-title"> Constituency</h5>
                 <p class=""><?php echo $row['constituency'] ?></p>
             </div>
         </div>
     </div>
     <div class="col-md-4 g-4">
     <div style="background-color: green;" class="card">
             <div class="text-center card-body">
             <i class="bi bi-house h1"></i>
                 <h5 class="card-title"> Polling Station</h5>
                 <p class=""><?php echo $row['reg_center'] ?></p>
             </div>
         </div>
     </div>
 </div>
 <div class="row p-4">
 <div  class="card ">
         <div class="card-body">
             <h5 class="card-title text-primary text-center">Personal Details</h5>
             <p class="text-primary py-2">ID/Passport: <span class="px-5 text-dark"><?php echo $row['id_num']; ?></span></p>
                          <p class="text-primary py-2">Full Name: <span class="px-5 text-dark"><?php echo $row['name']; ?></span></p>
                          <p class="text-primary py-2">Gender: <span class="px-5 text-dark"><?php echo $row['gender']; ?></span></p>
                          <p class="text-primary py-2">Voters Number: <span class="px-5 text-dark"><?php echo $row['voter_num']; ?></span></p>
                          <p class="text-primary py-2">Date of Birth: <span class="px-5 text-dark"><?php echo $row['dob']; ?></span></p>
                          <p class="text-primary py-2">County : <span class="px-5 text-dark"><?php echo $row['county']; ?></span></p>
                          <p class="text-primary py-2">Telephone No. : <span class="px-5 text-dark"><?php echo $row['mobile_no']; ?></span></p>
         </div>
     </div>
 </div>
 </div>
</div>
<?php include 'includes/footer.php' ?>