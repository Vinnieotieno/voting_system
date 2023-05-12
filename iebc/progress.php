<?php include 'includes/voter_dashboard_header.php' ?>
<?php
$County = $row['county'];
$District = $row['district'];
$Const = $row['constituency'];
$sql = "SELECT president,COUNT(*) FROM votes GROUP BY president";
$result = mysqli_query($conn, $sql);
$votedPresident = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql1 = "SELECT governor,COUNT(*) as Casted_Votes FROM votes WHERE county = '$County' GROUP BY governor;";
$result1 = mysqli_query($conn, $sql1);
$votedGovernor = mysqli_fetch_all($result1,MYSQLI_ASSOC);

$sql2 = "SELECT senator,COUNT(*) as Casted_Votes FROM votes WHERE county = '$County' GROUP BY senator;";
$result2 = mysqli_query($conn, $sql2);
$votedSenator = mysqli_fetch_all($result2,MYSQLI_ASSOC);

$sql3 = "SELECT women,COUNT(*) as Casted_Votes FROM votes WHERE county = '$County' GROUP BY women;";
$result3 = mysqli_query($conn, $sql3);
$votedWomen = mysqli_fetch_all($result3,MYSQLI_ASSOC);

$sql4 = "SELECT mp,COUNT(*) as Casted_Votes FROM votes WHERE county = '$County' AND district = '$District' GROUP BY mp;";
$result4 = mysqli_query($conn, $sql4);
$votedMp = mysqli_fetch_all($result4,MYSQLI_ASSOC);

$sql5 = "SELECT mca,COUNT(*) as Casted_Votes FROM votes WHERE district = '$District' AND constituency = '$Const' GROUP BY mca;";
$result5 = mysqli_query($conn, $sql5);
$votedMca = mysqli_fetch_all($result5,MYSQLI_ASSOC);

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Presidential Seat', 'Kenya'],
        <?php foreach($votedPresident as $president):?>
            <?php echo "['".$president['president']."', ".$president['COUNT(*)']."],"; ?>
        <?php endforeach?>
        ]);

        var options = {
          title: 'Presidential Seat'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Presidential Seat', 'Kenya'],
        <?php foreach($votedGovernor  as $governor):?>
            <?php echo "['".$governor['governor']."', ".$governor['Casted_Votes']."],"; ?>
        <?php endforeach?>
        ]);

        var options = {
          title: 'Governor Seat'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Presidential Seat', 'Kenya'],
        <?php foreach($votedSenator  as $senator):?>
            <?php echo "['".$senator['senator']."', ".$senator['Casted_Votes']."],"; ?>
        <?php endforeach?>
        ]);

        var options = {
          title: 'Governor Seat'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Presidential Seat', 'Kenya'],
        <?php foreach($votedWomen  as $women):?>
            <?php echo "['".$women['women']."', ".$women['Casted_Votes']."],"; ?>
        <?php endforeach?>
        ]);

        var options = {
          title: 'Women Representative Seat'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
        
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Presidential Seat', 'Kenya'],
        <?php foreach($votedMp  as $mp):?>
            <?php echo "['".$mp['mp']."', ".$mp['Casted_Votes']."],"; ?>
        <?php endforeach?>
        ]);

        var options = {
          title: 'Mp Seat'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
        
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Presidential Seat', 'Kenya'],
        <?php foreach($votedMca  as $mca):?>
            <?php echo "['".$mca['mca']."', ".$mca['Casted_Votes']."],"; ?>
        <?php endforeach?>
        ]);

        var options = {
          title: 'MCA Seat'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart5'));
        
        chart.draw(data, options);
      }
    </script>
  </head>
  <style>
      body{
          overflow-x: hidden;
      }
  </style>
  <body>
      <div  style="margin-top:80px;background:#eaeaea;">
<div class="container row president">
    <div class="col-md-4 g-4 ">
        <div class="card my-4">
            <div class="card-header">
                <h5 class="text-center"><i class="bi bi-search"></i>  Search Location Progress </h5>
            </div>
            <div class="card-body">
                <a style="text-decoration:none; color:black;" href="/iebc/governorProgress.php">Governors</a> <br> <br>
                <a style="text-decoration:none; color:black;" href="/iebc/senatorProgress.php">Senators</a> <br> <br>
                <a style="text-decoration:none; color:black;" href="/iebc/mpProgress.php">Member of Parliament</a> <br> <br>
                <a style="text-decoration:none; color:black;" href="/iebc/mcaProgress.php">Member of County Assembly</a> <br> <br>
                <a style="text-decoration:none; color:white;" href="/iebc/vote.php" class="btn btn-dark"><i class="bi bi-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
    <div class="col-md-8 g-4">
        <p class="text-center text-success lead">Election Progress in your location</p>
        <div class="row">
            <div class="card my-4">
                <div class="card-header">
                    <h3 class="text-center">Presidential Seat</h3>
                </div>
                <div class="card-body">
                <div id="piechart"></div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="card my-4">
                <div class="card-header">
                    <h3 class="text-center">Governor Seat</h3>
                </div>
                <div class="card-body">
                <div id="piechart1"></div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="card my-4">
                <div class="card-header">
                    <h3 class="text-center">Senator Seat</h3>
                </div>
                <div class="card-body">
                <div id="piechart2"></div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="card my-4">
                <div class="card-header">
                    <h3 class="text-center">Women Representative Seat</h3>
                </div>
                <div class="card-body">
                <div id="piechart3"></div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="card my-4">
                <div class="card-header">
                    <h3 class="text-center">Member of Parliament Seat</h3>
                </div>
                <div class="card-body">
                <div id="piechart4"></div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="card my-4">
                <div class="card-header">
                    <h3 class="text-center">Member of County Assembly Seat</h3>
                </div>
                <div class="card-body">
                <div id="piechart5"></div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>


</body>
</html>

<?php include "includes/footer.php" ?>