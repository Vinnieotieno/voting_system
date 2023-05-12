<?php include 'includes/dashboard_header.php' ?>
<?php
if(isset($_POST['submit'])){
    $host = $root = $password = $db_name = "";
    $hostErr = $rootErr = $passwordErr = $db_nameErr = "";
    //validate host
    if(empty($_POST['host'])){
        $hostErr = 'Host Name is required';
    }else{
        $host = filter_input(INPUT_POST, 'host' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validate root
    if(empty($_POST['root'])){
        $rootErr = 'Root is required';
    }else{
        $root = filter_input(INPUT_POST, 'root' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validate Password
    //validate bd name
    if(empty($_POST['db_name'])){
        $db_nameErr = 'Database Name is required';
    }else{
        $db_name = filter_input(INPUT_POST, 'db_name' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if(empty($hostErr) && empty($rootErr) && empty($db_nameErr)){
        $file = 'database/db_config.php';
        $handle = fopen($file, 'w');
        $content = "<?php
        define('DB_HOST','$host');
        define('DB_USER','$root');
        define('DB_PASS','$password');
        define('DB_NAME','$db_name');
        
        
        //create Connection
       new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        ?>";
        fwrite($handle, $content);
        fclose($handle);
    }

    }

?>
<div style="margin-top: 100px;" class="row">
    <div class="col-md-5 m-auto">
        <div style="box-shadow: 3px 3px 10px 5px black;" class="card">
            <div class="card-body">
                <h3 class="card-title text-success text-center">Configuration Form</h5>
                <?php include 'includes/messages.php' ?>
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                  <div class="mb-3">
                   <label for="host" class="form-label">Local Host</label>
                   <input type="text" class="form-control <?php echo $hostErr ? 'is-invalid' : null ;?> " id="name" name="host" placeholder=" Enter Full names">
                   <div class="invalid-feedback">
                       <?php echo $hostErr ?>
                   </div>
               </div>
               <div class="mb-3">
                   <label for="root" class="form-label">Database Root</label>
                   <input type="text" class="form-control <?php echo $rootErr ? 'is-invalid' : null ;?> " id="email" name="root" placeholder=" Enter Email Address">
                   <div class="invalid-feedback">
                       <?php echo $rootErr ?>
                   </div>
                </div>
                <div class="mb-3">
                   <label for="password" class="form-label">Database Password</label>
                   <input type="password" class="form-control <?php echo $passwordErr ? 'is-invalid' : null ;?>" id="password" name="password" placeholder=" Enter password">
                   <div class="invalid-feedback">
                       <?php echo $passwordErr ?>
                   </div>      
                </div>
                <div class="mb-3">
                   <label for="db_name" class="form-label">Database Name</label>
                   <input type="text" class="form-control <?php echo $db_nameErr ? 'is-invalid' : null ;?>" id="password" name="db_name" placeholder=" Enter password">
                   <div class="invalid-feedback">
                       <?php echo $db_nameErr ?>
                   </div>      
                </div>
                <div class="mb-3">
                   <input type="submit" class="form-control text-light bg-success " id="submit" name="submit" value="Configure Database" >
               </div>
                </form>
            </div>
        </div>
        <a href="/iebc/admin_dashboard.php" class="btn btn-dark text-light my-3 px-4"><< Dashboard</a>
    </div>
</div>