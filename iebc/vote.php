<?php include 'includes/voter_dashboard_header.php' ?>
<?php
$name = $row['id_num'];
$county = $row['county'];
$district = $row['district'];
$const = $row['constituency'];

$sql = "SELECT * FROM votes WHERE user = '$name' ";
$result = mysqli_query($conn,$sql);
$voted = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql1 = "SELECT * FROM candidates WHERE position = 'president'";
$result1 = mysqli_query($conn,$sql1);
$presidents = mysqli_fetch_all($result1,MYSQLI_ASSOC);

$sql2 = "SELECT * FROM candidates WHERE position = 'governor' AND place = '$county' ";
$result2 = mysqli_query($conn,$sql2);
$governors = mysqli_fetch_all($result2,MYSQLI_ASSOC);

$sql8 = "SELECT * FROM candidates WHERE position = 'senator' AND place = '$county' ";
$result8 = mysqli_query($conn,$sql8);
$senators = mysqli_fetch_all($result8,MYSQLI_ASSOC);

$sql3 = "SELECT * FROM candidates WHERE position = 'women representative' AND place = '$county' ";
$result3 = mysqli_query($conn,$sql3);
$women = mysqli_fetch_all($result3,MYSQLI_ASSOC);

$sql4 = "SELECT * FROM candidates WHERE position = 'member of parliament' AND place = '$district' ";
$result4 = mysqli_query($conn,$sql4);
$mps = mysqli_fetch_all($result4,MYSQLI_ASSOC);

$sql5 = "SELECT * FROM candidates WHERE position = 'member of county assembly' AND place = '$const' ";
$result5 = mysqli_query($conn,$sql5);
$mcas = mysqli_fetch_all($result5,MYSQLI_ASSOC);


if(isset($_POST['submit'])){
    $errors = array();
    $success = array();
    $id = $_POST['userId'];
    $county = $_POST['userCounty'];
    $district = $_POST['userDistrict'];
    $const = $_POST['userConst'];
    $president = $_POST['president'];
    $governor = $_POST['governor'];
    $senator = $_POST['senator'];
    $women = $_POST['women'];
    $mp = $_POST['mp'];
    $mca = $_POST['mca'];
    if(empty($president) && empty($governor) && empty($women) && empty($mp) && empty($mca)){
    array_push($errors, "Please select  A candidate");
    }else{
        $sql7 = "INSERT INTO votes(user, county, district, constituency, president, governor, senator, women, mp, mca)
        VALUES('$id', '$county', '$district', '$const', '$president', '$governor', '$senator', '$women','$mp', '$mca')";
        if(mysqli_query($conn,$sql7)){
            array_push($success, "You have Successfully casted Your Vote");
            file_put_contents('includes/votes.txt',$id.' '.$county.' '.$district.' '.$governor."\n",FILE_APPEND);
        }else{
            array_push($errors, "Vote Unsuccessfull");
            echo 'Error: '. mysqli_error($conn);
        }
    }
}

?>
<div style="margin-top:80px">
<?php include 'includes/messages.php' ?>
<?php if(empty($voted)): ?>
<div class="row container">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <img src="/iebc/images/k-lion.png" class="image-fluid" style="width: 215px; height:200px;" alt="">
                <div class="mt-4">
                    <a href="/iebc/progress.php" style="text-decoration: none; color:black;">Election Progress</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <div class="user">
        <input type="hidden" name="userId" value="<?php echo $row['id_num']?>">
    </div>
    <div class="userCounty">
        <input type="hidden" name="userCounty" value="<?php echo $row['county']?>">
    </div>
    <div class="userDistrict">
        <input type="hidden" name="userDistrict" value="<?php echo $row['district']?>">
    </div>
    <div class="userConst">
        <input type="hidden" name="userConst" value="<?php echo $row['constituency']?>">
    </div>
<div class="precidency ">
    <div class="text-center py-2" style="background-color: #eaeaea;">
    <h2>Precidency Seat</h2>
    </div>
    <?php if(empty($presidents)) :?>
        <p class="lead text-center">Nothing in the presidency seat</p>
        <?php endif;?>
    <?php foreach($presidents as $president): ?>
        <div class="row pt-3 container">
            <div class="col-5 ">
                    <img style="width: 200px; height:150px; border-radius:5px;" src="/iebc/uploads/<?php echo $president['photo'] ?>" alt="" >
                        <p><b>Name:</b> <?php echo $president['name'] ?></p>
                        <p><b>Party:</b> <?php echo $president['party'] ?></p>
            </div>
            <div class="col-5 d-block d-none-sm ">
                <h6><u>Agender <span style="font-size: 13px;">(manifesto)</span></u> </h4>
                <p><?php echo $president['manifesto'] ?></p>
            </div>
            <div class="col-2">
                <h5>Vote</h5>
                <input type="radio" name="president" value="<?php echo $president['name'] ?>"> 
            </div>
        </div>
    <?php endforeach?>
</div>
<div class="governor pt-3">
    <div class="text-center py-2" style="background-color: #eaeaea;">
    <h2>Governors' Seat</h2>
    </div>
    <?php if(empty($governors)) :?>
        <p class="lead text-center">Nothing in the Governor's seat in your County</p>
        <?php endif;?>
    <?php foreach($governors as $governor): ?>
        <div class="row pt-3 container">
            <div class="col-5 ">
                    <img style="width: 200px; height:150px; border-radius:5px;" src="/iebc/uploads/<?php echo $governor['photo'] ?>" alt="" >
                        <p><b>Name:</b> <?php echo $governor['name'] ?></p>
                        <p><b>Party:</b> <?php echo $governor['party'] ?></p>
            </div>
            <div class="col-5 d-block d-none-sm ">
                <h6><u>Agender <span style="font-size: 13px;">(manifesto)</span></u> </h4>
                <p><?php echo $governor['manifesto'] ?></p>
            </div>
            <div class="col-2">
                <h5>Vote</h5>
                <input type="radio" name="governor" value="<?php echo $governor['name'] ?>"> 
            </div>
        </div>
    <?php endforeach?>
</div>
<div class="senator pt-3">
    <div class="text-center py-2" style="background-color: #eaeaea;">
    <h2>Senatorial Seat</h2>
    </div>
    <?php if(empty($senators)) :?>
        <p class="lead text-center">Nothing in the Senetorial seat in your County</p>
        <?php endif;?>
    <?php foreach($senators as $senator): ?>
        <div class="row pt-3 container">
            <div class="col-5 ">
                    <img style="width: 200px; height:150px; border-radius:5px;" src="/iebc/uploads/<?php echo $senator['photo'] ?>" alt="" >
                        <p><b>Name:</b> <?php echo $senator['name'] ?></p>
                        <p><b>Party:</b> <?php echo $senator['party'] ?></p>
            </div>
            <div class="col-5 d-block d-none-sm ">
                <h6><u>Agender <span style="font-size: 13px;">(manifesto)</span></u> </h4>
                <p><?php echo $senator['manifesto'] ?></p>
            </div>
            <div class="col-2">
                <h5>Vote</h5>
                <input type="radio" name="senator" value="<?php echo $senator['name'] ?>"> 
            </div>
        </div>
    <?php endforeach?>
</div>
<div class="women_rep pt-3">
    <div class="text-center py-2" style="background-color: #eaeaea;">
    <h2>Women Representative Seat</h2>
    </div>
    <?php if(empty($women)) :?>
        <p class="lead text-center">Nothing in the women Representative seat in your County</p>
        <?php endif;?>
    <?php foreach($women as $woman): ?>
        <div class="row pt-3 container">
            <div class="col-5 ">
                    <img style="width: 200px; height:150px; border-radius:5px;" src="/iebc/uploads/<?php echo $woman['photo'] ?>" alt="" >
                        <p><b>Name:</b> <?php echo $woman['name'] ?></p>
                        <p><b>Party:</b> <?php echo $woman['party'] ?></p>
            </div>
            <div class="col-5 d-block d-none-sm ">
                <h6><u>Agender <span style="font-size: 13px;">(manifesto)</span></u> </h4>
                <p><?php echo $woman['manifesto'] ?></p>
            </div>
            <div class="col-2">
                <h5>Vote</h5>
                <input type="radio" name="women" value="<?php echo $woman['name'] ?>"> 
            </div>
        </div>
    <?php endforeach?>
</div>
<div class="mps pt-3">
    <div class="text-center py-2" style="background-color: #eaeaea;">
    <h2>Member of Parliament <span style="font-size: 13px;">(MP)</span> Seat</h2>
    </div>
    <?php if(empty($mps)) :?>
        <p class="lead text-center">Nothing in the Members of Parliament seat in your District</p>
        <?php endif;?>
    <?php foreach($mps as $mp): ?>
        <div class="row pt-3 container">
            <div class="col-5 ">
                    <img style="width: 200px; height:150px; border-radius:5px;" src="/iebc/uploads/<?php echo $mp['photo'] ?>" alt="" >
                        <p><b>Name:</b> <?php echo $mp['name'] ?></p>
                        <p><b>Party:</b> <?php echo $mp['party'] ?></p>
            </div>
            <div class="col-5 d-block d-none-sm ">
                <h6><u>Agender <span style="font-size: 13px;">(manifesto)</span></u> </h4>
                <p><?php echo $mp['manifesto'] ?></p>
            </div>
            <div class="col-2">
                <h5>Vote</h5>
                <input type="radio" name="mp" value="<?php echo $mp['name'] ?>"> 
            </div>
        </div>
    <?php endforeach?>
</div>
<div class="mps pt-3">
    <div class="text-center py-2" style="background-color: #eaeaea;">
    <h2>Member of County Assembly <span style="font-size: 13px;">(MP)</span> Seat</h2>
    </div>
    <?php if(empty($mcas)) :?>
        <p class="lead text-center">Nothing in the Members of County Assembly seat in your District</p>
        <?php endif;?>
    <?php foreach($mcas as $mca): ?>
        <div class="row pt-3 container">
            <div class="col-5 ">
                    <img style="width: 200px; height:150px; border-radius:5px;" src="/iebc/uploads/<?php echo $mca['photo'] ?>" alt="" >
                        <p><b>Name:</b> <?php echo $mca['name'] ?></p>
                        <p><b>Party:</b> <?php echo $mca['party'] ?></p>
            </div>
            <div class="col-5 d-block d-none-sm ">
                <h6><u>Agender <span style="font-size: 13px;">(manifesto)</span></u> </h4>
                <p><?php echo $mca['manifesto'] ?></p>
            </div>
            <div class="col-2">
                <h5>Vote</h5>
                <input type="radio" name="mca" value="<?php echo $mca['name'] ?>"> 
            </div>
        </div>
    <?php endforeach?>
</div>
<div class="mt-4 text-center">
    <input type="submit" name="submit" value="Vote" class="btn btn-outline-success ">
</div>
</form>
    </div>
</div>
<?php else : ?>
    
    <div class="row container">
        <div class="col-md-4 g-4">
        <div class="card">
            <div class="card-body">
                <img src="/iebc/images/k-lion.png" class="image-fluid" style="width: 215px; height:200px;" alt="">
                <div class="mt-4">
                    <a href="/iebc/progress.php" style="text-decoration: none; color:black;">Election Progress</a>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-8 g-4">
        <h3 class="text-center">You have Already voted!!!</h3>
        </div>
    </div>
<?php endif ?>
</div>
<?php include "includes/footer.php" ?>