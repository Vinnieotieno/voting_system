<?php include "../database/config.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Online Voters Registration</title>
</head>
<body>
<nav class="nav1 navbar navbar-expand-lg navbar-light fixed-top mb-5">
        <div class="container">
          <a class=" navbar-brand" href="/IEBC/homePage.php"><i class="bi bi-gear-fill h1 "></i> Admin Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="bg-warning navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav ms-auto ">
              <a class="nav-link text-dark" href="#"></a>
              
             
            </div>
          </div>
        </div>
</nav>
<div style="margin-top:100px ;" class="container ">
    <div class="row">
        <div class="col-6">
            <h1>Search For a Voter</h1>
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; }?>" placeholder="Search Voter">
                    <button type="submit"  class="btn btn-success">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Registration Center</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_GET['search'])){
                    $filtervalues = $_GET['search'];
                    $query = "SELECT * FROM voters WHERE CONCAT(name,email,id_num) LIKE '%$filtervalues%'";
                    $query_run = mysqli_query($conn, $query);
                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $voter){
                            ?>
                            <tr>
                                <td><?php echo $voter['id'] ?></td>
                                <td><?php echo $voter['name'] ?></td>
                                <td><?php echo $voter['email'] ?></td>
                                <td><?php echo $voter['id_num'] ?></td>
                                <td style="display: flex;">
                                    <a href="/iebc/update.php?updateId=<?php  echo $voter['id'];?>" class="btn btn-info mx-2"><i class="bi bi-pen"></i>Update</a>
                                    <a href="/iebc/includes/delete.php?deleteId=<?php  echo $voter['id'];?>" class="btn btn-danger"><i class="bi bi-x h4"></i>Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="5"><h3 class="text-center">No Record Found</h3></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <a href="/iebc/voterList.php" class="mt-5 btn btn-dark"><i class="bi bi-arrow-left"></i> Back</a>
</div>