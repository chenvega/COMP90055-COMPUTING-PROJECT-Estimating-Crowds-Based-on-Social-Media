// Author :  Weijia Chen
// Student Number : 616213
// Supervisor : Prof. Richard Sinnott
// Subject: COMP90055 COMPUTING PROJECT
// Project Name : Estimating Crowds Based on Social Media

// This program will show detailed information of Spain 
// Football League

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/LocalRender.css">
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  
</head>
<body>
<?php
  $team=$_GET["team"];
  $teamName = explode(".",$team)[0];
?>
</body>
</html>
<!-- Nav starts -->
<?php
  require("shared/nav.html");
?>
<!-- Nav ends -->

    <div>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div style="text-align:center;">
        <?php
          echo "
          <img src=\"./image/photos/spain/".$team."\" style=\"height:40px; width: auto; vertical-align:text-bottom;\"/>&nbsp;<span style=\"font-size: 50px; \">Match History</span>";
        ?>
        </div>

         <div class="multiColumns">
         </div><br/>
         
         <div>
          <?php
              $handle = fopen("http://115.146.85.185:5984/spaindatanew/_design/spaindatanew/_view/spaindatanew","rb");
              $content = "";
              while(!feof($handle)){
                $content.=fread($handle,100000);
              }
              fclose($handle);
              $content=json_decode($content,true);
              $size=sizeOf($content["rows"]);

              echo "<table class=\"table table-hover\" style=\"text-align:center\">
                      <thead>
                        <tr>
                          <th style=\"text-align:center; font-size: 20px;\">Time</th>
                          <th style=\"text-align:center\"></th>
                          <th style=\"text-align:center; font-size: 20px;\">Home</th>
                          <th style=\"text-align:center; font-size: 20px;\">Away</th>
                          <th style=\"text-align:center\"></th>
                          <th style=\"text-align:center; font-size: 20px;\">Attendance</th>
                          <th style=\"text-align:center; font-size: 20px;\">Stadium<span style=\"font-size: 15px;\">&nbsp;(Capacity)</span></th>
                        </tr>
                      </thead>
                      <tbody>";
              for($i=0; $i<$size; $i++){
                if($teamName == $content["rows"][$i]["key"][0] || $teamName == $content["rows"][$i]["key"][1]){
                  echo "
                        <tr>
                          <td>".$content["rows"][$i]["key"][3]."</td>
                          <td style=\"text-align:right\">".$content["rows"][$i]["key"][0]."</td>
                          <td><img src=\"./image/photos/spain/".$content["rows"][$i]["key"][0].".png\" style=\"height:40px; width: auto; vertical-align:text-bottom;\"/></td>
                          <td><img src=\"./image/photos/spain/".$content["rows"][$i]["key"][1].".png\" style=\"height:40px; width: auto; vertical-align:text-bottom;\"/></td>
                          <td style=\"text-align:left\">".$content["rows"][$i]["key"][1]."</td>
                          <td>".$content["rows"][$i]["value"][2]."</td>
                          <td>".$content["rows"][$i]["key"][2]."(".$content["rows"][$i]["value"][0].")</td>
                        </tr>
                    ";
                }
              }
              echo "
                </tbody>
              </table>";
          ?>
         </div>
      </div>
      <div class="col-md-1"></div>
    </div>


