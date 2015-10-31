// Author :  Weijia Chen
// Student Number : 616213
// Supervisor : Prof. Richard Sinnott
// Subject: COMP90055 COMPUTING PROJECT
// Project Name : Estimating Crowds Based on Social Media

// This program will catch the user input from web site 
// of Italy matches prediction

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/LocalRender.css">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
   <script>
    function getAway(str)
    {
      var xmlhttp;
      if (window.XMLHttpRequest)
        {xmlhttp=new XMLHttpRequest();}
      else
        {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}

      xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("away").innerHTML=xmlhttp.responseText;
          }
        }
      xmlhttp.open("GET","predictFilter_Ita/away.php?home="+str,true);
      xmlhttp.send();
    }

    function getStadium(str)
    {
      var xmlhttp;
      if (window.XMLHttpRequest)
        {xmlhttp=new XMLHttpRequest();}
      else
        {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}

      xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("stadium").innerHTML=xmlhttp.responseText;
          }
        }
      xmlhttp.open("GET","predictFilter_Ita/stadium.php?comb="+str,true);
      xmlhttp.send();
    }

    function getDate(str)
    {
      var xmlhttp;
      if (window.XMLHttpRequest)
        {xmlhttp=new XMLHttpRequest();}
      else
        {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}

      xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("date").innerHTML=xmlhttp.responseText;
          }
        }
      xmlhttp.open("GET","predictFilter_Ita/date.php?comb="+str,true);
      xmlhttp.send();
    }
   </script>

</head>
<body>
<!-- Nav starts -->
<?php
  require("shared/nav.html");
?>
<!-- Nav ends -->

<?php
  $handle = fopen("http://115.146.85.185:5984/italydatanew/_design/italydatanew/_view/italydatanew","rb");
  $content = "";
  while(!feof($handle)){
    $content.=fread($handle,100000);
  }
  fclose($handle);
  $content=json_decode($content,true);
  $size=sizeOf($content["rows"]);
?>

<form role="form" action="predictFilter_Ita/predictResult.php" method="POST">
  <div class="form-group col-md-6">
    <label for="home">HOME</label>
    <select class="form-control" id="home" name="home" onchange="getAway(this.value);" required>
      <option value="" selected>Select Home Team</option>
      <?php
        $home = $content["rows"][0]["key"][0];
        for($i=1; $i<$size; $i++){
          if($home == $content["rows"][$i]["key"][0]){
          }else{
            $home = $content["rows"][$i]["key"][0];
            echo "<option value=\"". $home."\">". $home."</option>";
          }

        }
      ?>
    </select>
  </div>

<div id="away">
</div>

<div id="stadium">
</div>

<div id="date">
</div>

<div class="col-md-12">
  <div class="col-md-3"></div>
  <div class="col-md-6"><br><br>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
  </div>
  <div class="col-md-3"></div>
</div>
</form>

</body>
</html>

