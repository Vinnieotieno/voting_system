<?php include 'includes/voter_dashboard_header.php' ?>
<?php
$sql = "SELECT * FROM candidates";
$result = mysqli_query($conn,$sql);
$candidates = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div style="margin-top:100px;" class="row container px-5">
<?php if(empty($candidates)): ?>
    <p class="lead text-center">No Candidate details Available</p>

<?php endif; ?>
<?php foreach($candidates as $candidate):?>
<div class="col-md-3  g-4">

    <div class="card">
        <div class="card-body">
        <div class="text-center">
            <img style="width: 150px; 
            height:150px; 
            border-radius:50%;
            " src="/iebc/uploads/<?php echo $candidate['photo'] ?>" alt="" class="text-center">
            </div>
            <h5 class="card-title py-3"><b>Position:</b> <?php echo $candidate['position'];?></h5>
            <p class="lead"><B>Name:</B><?php echo $candidate['name'] ?></p>
            <p class="lead"><b>Place:</b><?php echo $candidate['place'] ?></p>
            
        </div>
        <div class="p-3">
            <a href="" class="btn btn-info">Learn More</a>
        </div>
    </div>
    </div>
    <?php endforeach ?>

</div>
<?php include 'includes/footer.php' ?>