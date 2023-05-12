<?php include "includes/dashboard_header.php" ?>
<?php
$errors = array();
$success = array();
$email = $subject =  $body = "";
$emailErr = $subjectErr =  $bodyErr = "";
if(isset($_POST['send'])){
    //validate email
    if(empty($_POST['email'])){
        $emailErr = "Email is Required";
    }else{
        $email = filter_input(INPUT_POST, 'email' ,FILTER_SANITIZE_EMAIL);
    }
    //validate subject
    if(empty($_POST['subject'])){
        $subjectErr = "Subject is Required";
    }else{
        $subject = filter_input(INPUT_POST, 'subject' ,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validate body
    if(empty($_POST['body'])){
        $bodyErr = "Body is Required";
    }else{
        $body = filter_input(INPUT_POST, 'body' ,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if(empty($emailErr) && empty($subjectErr) && empty($bodyErr)){
        $sql = "SELECT * FROM voters WHERE email = '$email'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            if(mail($email, $subject, $body)){
                array_push($success, "Email Sent Successfull");
            }else{
                array_push($errors, "Email was Not Sent");
            }
        }else{
            array_push($errors, "No such Voter");
        }
    }
}
?>
<div style="margin-top: 100px;">
    <h1 class="text-center text-warning">Contact Voter</h1>
    <p class="lead text-center">Send Voter an Email</p>
    <h3><?php include "includes/messages.php" ?> </h3>
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-body">
                    <form action="sendemail.php" method="POST">
                        <div class="mb-3">
                            <label for="email">Voter Email</label>
                            <input type="email" name="email" placeholder="Enter Voter Email" class="form-control <?php echo $emailErr ? 'is-invalid' : null ;?> ">
                            <div class="invalid-feedback">
                                <?php echo $emailErr ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" placeholder="Subject" class="form-control <?php echo $subjectErr ? 'is-invalid' : null ;?>">
                            <div class="invalid-feedback">
                                <?php echo $subjectErr ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="body">Body</label>
                            <textarea name="body" id="" cols="20" rows="5" type="text" class="form-control <?php echo $bodyErr ? 'is-invalid' : null ;?>" placeholder="Enter the Body of your Email"></textarea>
                            <div class="invalid-feedback">
                                <?php echo $bodyErr ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="send" class="btn btn-info btn-lg" value="Send Email">
                        </div>
                    </form>
                </div>
            </div>
            <a href="/iebc/admin_dashboard.php" class="btn btn-dark text-light my-3 px-4"><< Dashboard</a>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>