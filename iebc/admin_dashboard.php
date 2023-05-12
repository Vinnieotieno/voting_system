 <?php include 'includes/dashboard_header.php' ?>
<?php
if(!empty($_SESSION["idNumber"])){
    $id = $_SESSION["idNumber"];
    $sql = "SELECT * FROM admins WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
}else{
    header("Location : /iebc/adminLogin.php");
}
?>

  <div style="padding-top: 100px;" class="row ">
      <div class="col-md-4">
          <div class="card">
              <div class="card-body">
                <div style="display: flex;">
                <h5  style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;" class="card-title px-1"> <?php echo $row['name']; ?> </h5>
            <div style="display: flex;">
            <div style="width: 10px; height:10px;border-radius:50%; background-color:green;"></div>
            <p style="color:green; width:55px; height:30px; border-radius:10px; border:1px solid green;">Online</p>
            </div>
                </div>
                <p class="lead">Main Navigator</p>
                <ul style="list-style-type: none; ">
                    <li class="mb-4"><a href="" style="text-decoration:none;color:black;">Dashboard</a></li>
                    <li class="mb-4">
                        <a style="text-decoration:none;color:black;" href="/iebc/newAdmin.php">New Admin</a>
                    </li>
                    <li class="mb-4">
                        <a style="text-decoration:none;color:black;" href="/iebc/voterList.php">Manage Voters</a>
                    </li>
                    <li class="mb-4">
                        <a style="text-decoration:none;color:black;" href="/iebc/candidateList.php">Manage Election candidates</a>
                    </li>
                    <li class="mb-4">
                        <a href="/iebc/candidates.php" style="text-decoration:none;color:black;">Election Candidates</a>
                    </li>
                    <li class="mb-4">
                        <a href="/iebc/sendemail.php" style="text-decoration:none;color:black;">Contact Voter</a>
                    </li>
                    <li class="mb-4">
                        <a href="/iebc/progress.php" style="text-decoration:none;color:black;">Election Progress</a>
                    </li>
                    <li class="mb-4">
                        <a href="/iebc/configuration.php" style="text-decoration:none;color:black;">Configuration</a>
                    </li>
                    <li class="mb-4">
                        <a href="/iebc/report.php" style="text-decoration:none;color:black;">Report</a>
                    </li>
                    <li class="my-3">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            Settings
                        </button>
                        <ul style="background-color: green;" class="dropdown-menu " aria-labelledby="dropdownMenu2">
                            <li><a href="/iebc/includes/admin_changePass.php" class="dropdown-item" type="button">Change password</a></li>
                        </ul>
                        </div>
                      </li>
                      <li class="mt-4">
                          <a href="/iebc/includes/logout.php" class="btn btn-danger">Log out</a>
                      </li>
                  </ul>
                  
              </div>
          </div>
      </div>
      <div class="col-md-8 g-3">
          <h1><i class="bi bi-gear h1"></i> Admin Dashboard</h1>
     <section  class="container">
         <div class="row">
             <div class="col-md-5 g-3">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Voter Profile</h5>
                         <div class="text-center">
                             <img style="width: 200px; height:200px; border-radius:50%;" src="/iebc/uploads/<?php echo $row['image'] ?>" alt="">
                         </div>
                         <h4 class="text-center lead"><?php echo $row['name']; ?> </h2>
                         <h4>Title:</h4>
                         <p class="text-secondary"><?php echo $row['title']; ?></p>
                         <a href="/iebc/includes/profilePic.php" class="btn btn-info">Profile picture </a>
                 </div>
             </div>
            </div>
             <div class="col-md-7 g-3">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="card-title">Personal Information</h4>
                          <p class="text-primary py-2">ID/Passport: <span class="px-5 text-dark"><?php echo $row['id_num']; ?></span></p>
                          <p class="text-primary py-2">Full Name: <span class="px-5 text-dark"><?php echo $row['name']; ?></span></p>
                          <p class="text-primary py-2">Gender: <span class="px-5 text-dark"><?php echo $row['gender']; ?></span></p>
                          <p class="text-primary py-2">Phone Number: <span class="px-5 text-dark"><?php echo $row['phone']; ?></span></p>
                          <p class="text-primary py-2">Email Address: <span class="px-5 text-dark"><?php echo $row['email']; ?></span></p>
                     </div>
                 </div>
             </div>
</div>
</div>
     </section>

      </div>
  </div>
  <?php include 'includes/footer.php' ?>