<?php include 'includes/dashboard_header.php' ?>
<?php 
 $sql = "SELECT * FROM voters";
 $result = mysqli_query($conn,$sql);
 $voters = mysqli_fetch_all($result,MYSQLI_ASSOC);

 $time = time();
?>
<div style="margin-top: 100px;" class="container">
<a href="/iebc/registration.php" class="btn btn-info m-auto">Add Voter</a>
<a href="/iebc/includes/search.php" class="btn btn-warning mx-5">Search Voter</a>

<table  class="table table-stripe container">
    <thead>
        <th>No</th>
        <th>Name</th>
        <th>ID</th>
        <th>County</th>
        <th>Constituency</th>
        <th>Registration Center</th>
        <th>Status</th>
        <th>Action</th>

    </thead>

<?php if(empty($voters)): ?>
    <p class="lead">No voter Registered</p>
    <?php endif;?>
    <?php foreach($voters as $voter): ?>
        <tbody id="voters">
            <tr>
                <td><?php   echo $voter['id'];?></td>
                <td><?php  echo $voter['name'];?></td>
                <td><?php  echo $voter['id_num'];?></td>
                <td><?php  echo $voter['county'];?></td>
                <td><?php  echo $voter['constituency'];?></td>
                <td><?php  echo $voter['reg_center'];?></td>
                <td>
                    <?php 
                    $date = date("i");
                    if($date >= $voter['last_login']){
                        echo "<button class='btn btn-outline-success'>Online</button>";
                    }else{
                        echo "<button class='btn btn-outline-danger'>Offline</button>";
                    }
                    ?>
                </td>
                <td style="display: flex;">
                    <a href="/iebc/update.php?updateId=<?php  echo $voter['id'];?>" class="btn btn-info mx-2"><i class="bi bi-pen"></i>Update</a>
                    <a href="/iebc/includes/delete.php?deleteId=<?php  echo $voter['id'];?>" class="btn btn-danger"><i class="bi bi-x h4"></i>Delete</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>

        </table>
        <a href="/iebc/admin_dashboard.php" class="btn btn-primary">Dashboard</a>  
</div>

        <?php include 'includes/footer.php'?>