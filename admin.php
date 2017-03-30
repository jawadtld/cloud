<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Admin Panel</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/admin.css" type="text/css">
    </head>
    
<body>

    <?php

    session_start();
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header ("Location: login.php");
    }

    ?>

    <?php include_once("analyticstracking.php") ?>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="http://www.jawadtld.tk">P.K Stores, Thalayad</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="http://www.jawadtld.tk/index.php#about">Today's rate</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="http://www.jawadtld.tk/index.php#portfolio">Download</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="http://www.jawadtld.tk/index.php#contact">Contact</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- <header>

        <div class="header-content">
            <div class="header-content-inner">
                <h1>"The best preparation for tomorrow is doing your best today"</h1>
                <hr>
                <p></p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">ഇന്നത്തെ വില</a>
            </div>
        </div>
    </header> -->

    <section id="form">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-offset-4 text-center">
                    <div>
                        <form method="post">
                        <select name="month">
                          <option  value="01">January</option>
                          <option value="02">February</option>
                          <option value="03">March</option>
                          <option value="04">April</option>
                          <option value="05">May</option>
                          <option selected value="06">June</option>
                          <option value="07">July</option>
                          <option value="08">August</option>
                          <option value="09">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                        <select name="year">
                          <option value="2015">2015</option>
                          <option selected value="2016">2016</option>
                          <option value="2017">2017</option>
                          <option value="2018">2018</option>
                        </select>
                        <button name="submit" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="visualisation">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-3 text-center">
                    <div id="visualization" style="width: 600px; height: 400px;"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="visualisation1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div id="visualization1" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="visualisation">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div id="linechart_material" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </section>
    

    <?php
 
    //include database connection
    include 'db_functions.php';
    $db = new DB_Functions();
    if (isset($_POST['submit'])) {
    $year=$_POST['year'];
    $month=$_POST['month'];
    //execute the query
    $result = $db->getincome($year,$month);
    $result1 = $db->getincome_each($year,$month);
    $result2 = $db->getincome_year($year);
    $row = mysql_fetch_array($result);
    
    $val1=$row['income_sum'];
    $val2=$row['expense_sum'];
    //get number of rows returned
    $num_results = mysql_num_rows($result);
 
    if( $num_results > 0){
    ?>
        <!-- load api -->
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        
        <script type="text/javascript">
            //load package
            google.charts.load('current', {'packages':['table','line']});
            google.load('visualization', '1', {packages: ['corechart']});
            
        </script>
 
        <script type="text/javascript">
            function drawVisualization() {
                var val1 = "<?php echo $val1 ?>";
                var val2 = "<?php echo $val2 ?>";
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['Catogory', 'Value'],
                    ['Income', <?php echo $val1 ?>],
                    ['Expense', <?php echo $val2 ?>]
                                    ]);
 
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization')).
                draw(data, {title:"Income / Expense of  <?php echo $month ?> - <?php echo $year ?>"});
            }

            function drawVisualization1() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['Date', 'Income','Expense'],
                    <?php
                    while( $row1 = mysql_fetch_assoc($result1) ){
                        extract($row1);
                        echo "['{$date}', {$income},{$expense}],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'Income / Expense of  <?php echo $month ?> - <?php echo $year ?>',
                    chartArea: {width: '50%'},
                    colors: ['#008000', '#FF0000'],
                    hAxis: {
                        title: 'Date',
                        minValue: 0
                            },
                    vAxis: {
                         title: 'Income / Expense'
                            }
                        };
 
                // Create and draw the visualization.
                new google.visualization.ColumnChart(document.getElementById('visualization1')).
                draw(data, options);
            }



 
            google.setOnLoadCallback(drawVisualization);
            google.setOnLoadCallback(drawVisualization1);
        </script>


        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            //google.charts.load('current', {'packages':['line']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {


              var data = google.visualization.arrayToDataTable([
                            ['Date', 'Income','Expense'],
                            <?php
                            while( $row2 = mysql_fetch_assoc($result2) ){
                                extract($row2);
                                echo "['{$date}', {$income},{$expense}],";
                            }
                            ?>
                        ]);

              var options = {
                chart: {
                  title: 'Box Office Earnings in First Two Weeks of Opening',
                  subtitle: 'in millions of dollars (USD)'
                },
                width: 900,
                height: 500
              };

              var chart = new google.charts.Line(document.getElementById('linechart_material'));

              chart.draw(data, options);
            }
        </script>
 
        
    <?php
 
    }else{
        echo "No programming languages found in the database.";
    }
  }
    ?>
  <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/scrollreveal.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>   
</body>
</html>