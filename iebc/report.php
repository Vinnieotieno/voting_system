<?php include "includes/dashboard_header.php" ?>
<?php
$sql = "SELECT county FROM votes GROUP BY county";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<section style="margin-top:100px">
    <div class="row">
        <div class="col-md-5 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center text-success">Generate a County Report</h3>
                </div>
                <div class="card-body">
                    <form action="pdfReport.php" method="POST" target="blank">
                        <select name="county" id="" class="form-control">
                            <?php foreach($rows as $row): ?>
                                <option value="<?php echo $row['county'] ?>"><?php echo $row['county'] ?></option>
                            <?php endforeach ?>
                        </select> <br><br>
                        <button type="submit" name="button" class="btn btn-outline-success">Genarate Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "includes/footer.php" ?>