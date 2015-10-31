<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/LocalRender.css">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Nav starts -->
<nav class="navbar navbar-inverse" id="navSpace">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Prediction System</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../index.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Leagues<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#TeamIntro1">Premier League</a></li>
            <li><a href="#TeamIntro2">La Liga</a></li>
            <li><a href="#TeamIntro3">Lega Serie A</a></li>
            <li><a href="#TeamIntro4">AFL</a></li>
          </ul>
        </li>
        <li><a href="../graph_all/layout.html">Scatter diagram</a></li>
      </ul>

    </div>
  </div>
</nav>
<!-- Nav ends -->

<?php
$comb=$_POST["away"];
$home=explode("_",$comb)[1];
$away=explode("_",$comb)[0];

$stadium=$_POST["stadium"];
$attendance=$_POST["date"];
$attendance=explode(".",$attendance)[0];
?>

    <div>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div style="text-align:center;">
          <span style="font-size: 50px;">Attendance Prediction Result</span>
        </div>

         <div class="multiColumns" style="font-size: 25px">
          The project prediction is one essential part of this estimating crowd system. Furthermore, the number of attendance staying in the specific stadium is based on the stadium capacity, the team rank and the nubmer of Twitter users. According to those elements numbers, the attendance number shows a linear regression relationship between those elements.
         </div><br/>
         
         <div>
            <table class="table table-hover" style="text-align:center">
                      <thead>
                        <tr>
                          <th style="text-align:center"></th>
                          <th style="text-align:center; font-size: 20px;">Home</th>
                          <th style="text-align:center; font-size: 20px;">Away</th>
                          <th style="text-align:center"></th>
                          <th style="text-align:center; font-size: 20px;">Attendance</th>
                          <th style="text-align:center; font-size: 20px;">Stadium</th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <?php
                          echo "
                          <td style=\"text-align:right\">".$home."</td>
                          <td><img src=\"../image/photos/AFL/".$home.".png\" style=\"height:40px; width: auto; vertical-align:text-bottom;\"/></td>
                          <td><img src=\"../image/photos/AFL/".$away.".png\" style=\"height:40px; width: auto; vertical-align:text-bottom;\"/></td>
                          <td style=\"text-align:left\">".$away."</td>
                          <td><span style=\"font-size: 15px; color: red;\"><b>".$attendance."</b></span></td>
                          <td>".$stadium."</td>
                          ";

                          ?>

                        </tr>
                      </tbody>
            </table>
         </div>
      </div>
      <div class="col-md-1"></div>
    </div>

</body>
</html>

