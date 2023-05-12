<?php include 'includes/dashboard_header.php' ?>
<?php 
 $sql = "SELECT * FROM candidates";
 $result = mysqli_query($conn,$sql);
 $candidates = mysqli_fetch_all($result,MYSQLI_ASSOC)
?>
<div style="margin-top: 100px;" class="container">
<table  class="table table-stripe container">
    <thead>
        <th>No</th>
        <th>Name</th>
        <th>ID</th>
        <th>Place </th>
        <th>Position </th>
         <th>Action</th>
    </thead>

<?php if(empty($voters)): ?>
    <p class="lead">No candidate Registered</p>

    <?php endif;?>
    <?php foreach($candidates as $candidate): ?>
        <tbody>
            <tr>
                <td><?php   echo $candidate['id'];?></td>
                <td><?php  echo $candidate['name'];?></td>
                <td><?php  echo $candidate['id_num'];?></td>
                <td><?php  echo $candidate['place'];?></td>
                <td><?php  echo $candidate['position'];?></td>
                <td style="display: flex;">
                    <a href="/iebc/Can_update.php?updateId=<?php  echo $candidate['id'];?>" class="btn btn-info mx-2"><i class="bi bi-pen"></i>Update</a>
                    <a href="/iebc/includes/delete.php?deleteId=<?php  echo $candidate['id'];?>" class="btn btn-danger"><i class="bi bi-x h4"></i>Delete</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>

        </table>
        <a href="/iebc/admin_dashboard.php" class="btn btn-primary">Dashboard</a>  
</div>
        <?php include 'includes/footer.php'?>