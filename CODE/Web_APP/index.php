// Author :  Weijia Chen
// Student Number : 616213
// Supervisor : Prof. Richard Sinnott
// Subject: COMP90055 COMPUTING PROJECT
// Project Name : Estimating Crowds Based on Social Media

// This program is the main page of web site

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
     function NameMoveIn(str){
        document.getElementById("TeamName"+str).style.opacity = 1;
        document.getElementById("TeamLogo"+str).style.opacity = 1;
     }

     function NameMoveOut(str){
        document.getElementById("TeamName"+str).style.opacity = 0;
        document.getElementById("TeamLogo"+str).style.opacity = 0.4;
     }

     function iconMoveIn(){
        document.getElementById("fixed").style.opacity = 1;
     }

     function iconMoveOut(){
        document.getElementById("fixed").style.opacity = 0.2;

     }
   </script>
</head>
<body>
<!-- Nav starts -->
<?php
  require("shared/nav.html");
?>
<!-- Nav ends -->

<!-- 4logo starts -->
<div id="logo4">
   <div class="IndexDisplayImg">
      <a href="#TeamIntro1"><img src="image/EPL.png" class="TeamLogo" id="TeamLogo1" onmouseover="NameMoveIn(1)" onmouseout="NameMoveOut(1)"/></a>
      <img src="image/1.png" class="TeamName" id="TeamName1"/>
   </div>

   <div class="IndexDisplayImg">
      <a href="#TeamIntro2"><img src="image/SLL.png" class="TeamLogo" id="TeamLogo2" onmouseover="NameMoveIn(2)" onmouseout="NameMoveOut(2)"/></a>
      <img src="image/2.png" class="TeamName" id="TeamName2"/>
   </div>

   <div class="IndexDisplayImg">
      <a href="#TeamIntro3"><img src="image/seriea.png" class="TeamLogo" id="TeamLogo3" onmouseover="NameMoveIn(3)" onmouseout="NameMoveOut(3)"/></a>
      <img src="image/3.png" class="TeamName" id="TeamName3"/>
   </div>

   <div class="IndexDisplayImg">
      <a href="#TeamIntro4"><img src="image/AFL.png" class="TeamLogo" id="TeamLogo4" onmouseover="NameMoveIn(4)" onmouseout="NameMoveOut(4)"/></a>
      <img src="image/4.png" class="TeamName" id="TeamName4"/>
   </div>
</div>
<!-- 4logo ends -->

<!-- Introductions begin -->
<div id="TeamIntro1">
    <!-- introduction columns start -->
    <div>
      <div class="col-md-1"></div>
      <div class="col-md-10">

        <div>
          <img src="image/EPL.png" class="TeamLogo"/>
          <img src="image/1.png" class="TeamName"/><br/>
        </div>

         <div class="multiColumns">
          The Premier League is an English professional league for men's association football clubs. 
          At the top of the English football league system, it is the country's primary football competition. 
          Contested by 20 clubs, it operates on a system of promotion and relegation with the Football League. 
          Besides English clubs, the Welsh clubs that compete in the English football league system can also qualify to play.
          The Premier League is a corporation in which the 20 member clubs act as shareholders. 
          Seasons run from August to May, with teams playing 38 matches each (playing each team in the league twice, home and away) 
          total 380 matches in the season. Most games are played in the afternoons of Saturdays and Sundays, the other games during weekday evenings. 
          It is currently sponsored by Barclays Bank and thus officially known as the Barclays Premier League. 
          Outside England, it is commonly referred to as the English Premier League (EPL).
         </div>
         
         <div>
            <?php
               $dir1 = './image/photos/england';
               $handle1 = opendir($dir1);

               while(($file1 = readdir($handle1))!== false){
                  if($file1 !='.' && $file1 != '..'){
                     echo "<a href=\"details_Eng.php?team=".$file1."&league=england \"><img src=\"./image/photos/england/".$file1."\" class=\"teamDisplay\"/></a>";
                  }
               }
            ?>
         </div>
         <div class="buttons">
            <button class="btn btn-primary" onclick="window.location.href='graph_Eng/layout.html'">Graphs</button>
            <button class="btn btn-info" onclick="window.location.href='userInput_Eng.php'">Predict</button>
         </div>
      </div>
      <div class="col-md-1"></div>
    </div>
    <!-- introduction columns end -->
</div>

<div id="TeamIntro2">
    <!-- introduction columns start -->
    <div>
      <div class="col-md-1"></div>
      <div class="col-md-10">

        <div>
          <img src="image/SLL.png" class="TeamLogo"/>
          <img src="image/2.png" class="TeamName"/><br/>  
        </div>

         <div class="multiColumns">
          The Liga de Fútbol Profesional (LFP) was founded on the 26th of July 1984. 
          It is a sports association made up of all the public limited sports companies 
          and football clubs in the First and Second Division that participate in official 
          professional competitions on a national scale.
          The LFP forms part of the Real Federación Española de Fútbol but has 
          legal autonomy in its organisation and functioning. It is responsible for 
          the organisation of state football leagues, always in coordination with RFEF.
           Currently, the Liga de Fútbol Profesional is formed by a total of 42 teams: 
           20 in the First Division and 22 in the Second Division.
         </div>

         <div>
            <?php
               $dir2 = './image/photos/spain';
               $handle2 = opendir($dir2);

               while(($file2 = readdir($handle2))!== false){
                  if($file2 !='.' && $file2 != '..'){
                     echo "<a href=\"details_Spa.php?team=".$file2."&league=spain\"><img src=\"./image/photos/spain/".$file2."\" class=\"teamDisplay\"/></a>";
                  }
               }
            ?>
         </div>
         <div class="buttons">
            <button class="btn btn-primary" onclick="window.location.href='graph_Spa/layout.html'">Graphs</button>
            <button class="btn btn-info" onclick="window.location.href='userInput_Spa.php'">Predict</button>
         </div>
      </div>
      <div class="col-md-1"></div>
    </div>
    <!-- introduction columns end -->
</div>

<div id="TeamIntro3">
    <!-- introduction columns start -->
    <div>
      <div class="col-md-1"></div>
      <div class="col-md-10">
          <div>
            <img src="image/seriea.png" class="TeamLogo"/>
            <img src="image/3.png" class="TeamName"/><br/>  
          </div>

         <div class="multiColumns">
          The Lega Nazionale Professionisti Serie A (Italian for National League 
          of Professionals Serie A), commonly known as Lega Serie A (Serie A League), 
          is the governing body that runs the major professional football competitions in Italy, most prominently the Serie A.
          It was founded on 1 July 2010. In the past the television rights of the Serie A clubs were sold separately, 
          and the league "Serie A" had to financial support Serie B through divided part of the Serie A TV revenues to Serie B clubs. 
          On 30 April 2009, Serie A announced a split from Serie B. Nineteen of the twenty clubs voted in favour of the move. 
          Relegation-threatened Lecce voted against. 
         </div>

         <div>
            <?php
               $dir3 = './image/photos/italy';
               $handle3 = opendir($dir3);

               while(($file3 = readdir($handle3))!== false){
                  if($file3 !='.' && $file3 != '..'){
                     echo "<a href=\"details_Ita.php?team=".$file3."&league=italy\"><img src=\"./image/photos/italy/".$file3."\" class=\"teamDisplay\"/></a>";
                  }
               }
            ?>
         </div>
         <div class="buttons">
            <button class="btn btn-primary" onclick="window.location.href='graph_Ita/layout.html'">Graphs</button>
            <button class="btn btn-info" onclick="window.location.href='userInput_Ita.php'">Predict</button>
         </div>
      </div>
      <div class="col-md-1"></div>
    </div>
    <!-- introduction columns end -->
</div>

<div id="TeamIntro4">
  <div>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div>
          <img src="image/AFL.png" class="TeamLogo"/>
          <img src="image/4.png" class="TeamName"/><br/>  
        </div>
         <div class="multiColumns">
          The Australian Football League (AFL) is the highest-level professional competition in the 
          sport of Australian rules football. Through the AFL Commission, the AFL also serves as the sport's 
          governing body, and is responsible for controlling the Laws of the Game. 
          The league was founded as the Victorian Football League (VFL) as a breakaway from the previous Victorian 
          Football Association (VFA), with its inaugural season commencing in 1897. Originally comprising only teams 
          based in the Australian state of Victoria, the competition's name was changed to the Australian Football 
          League for the 1990 season, after expanding to other states throughout the 1980s.
          The league currently consists of 18 teams spread over five of Australia's six states 
          (Tasmania being the exception). Matches have been played in all mainland states and territories of Australia, 
          as well as in New Zealand. The AFL season currently consists of a pre-season competition, 
          followed by a 23-round regular (or "home-and-away") season, which runs during the Australian winter 
          (March to September). The top eight teams then play off in a four-round finals series, 
          culminating in the AFL Grand Final, which is held at the Melbourne Cricket Ground each year. 
          The winning team in the Grand Final is termed the "premiers", and is awarded the premiership cup. 
         </div>
         <div>
            <?php
               $dir4 = './image/photos/AFL';
               $handle4 = opendir($dir4);

               while(($file4 = readdir($handle4))!== false){
                  if($file4 !='.' && $file4 != '..'){
                     echo "<a href=\"details_AFL.php?team=".$file4."&league=AFL\"><img src=\"./image/photos/AFL/".$file4."\" class=\"teamDisplay\"/></a>";
                  }
               }
            ?>
         </div>
         <div class="buttons">
            <button class="btn btn-primary" onclick="window.location.href='graph_AFL/layout.html'">Graphs</button>
            <button class="btn btn-info" onclick="window.location.href='userInput_AFL.php'">Predict</button>
         </div>
      </div>
      <div class="col-md-1"></div>
  </div>
<!-- Introductions end -->
</div>
<a href="#logo4"><img src="image/back-to-top.png" id="fixed" onmouseover="iconMoveIn()" onmouseout="iconMoveOut()" /></a>


</body>
</html>

