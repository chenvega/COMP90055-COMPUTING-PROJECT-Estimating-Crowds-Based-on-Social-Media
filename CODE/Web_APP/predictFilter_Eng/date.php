<?php
$comb=$_GET["comb"];
$home=explode("_",$comb)[1];
$away=explode("_",$comb)[0];
  $handle = fopen("http://115.146.85.185:5984/englanddatanew/_design/englanddatanew/_view/englanddatanew","rb");
  $content = "";
  while(!feof($handle)){
    $content.=fread($handle,100000);
  }
  fclose($handle);
  $content=json_decode($content,true);
  $size=sizeOf($content["rows"]);


echo " 
<div class=\"form-group col-md-6\">
    <label for=\"date\">DATE</label>
    <select class=\"form-control\" id=\"date\" name=\"date\" required>
      <option value=\"\" selected>Select Match Date</option>";

        $date = $content["rows"][0]["key"][3];
        for($i=1; $i<$size; $i++){
          if($date != $content["rows"][$i]["key"][3] && $away == $content["rows"][$i]["key"][1] && $home == $content["rows"][$i]["key"][0]){
            $date = $content["rows"][$i]["key"][3];

            $Popular = $content["rows"][$i]["value"][3];
            $Capacity = $content["rows"][$i]["value"][0];
            $Tweets = $content["rows"][$i]["value"][1];

            $attendance = 23.90351956*$Popular + 0.83284123*$Capacity + 47.82458807*$Tweets+1486.04656637;
            echo "<option value=\"". $attendance."\">". $date."</option>";
        }
    }

echo "</select>
	</div>";
?>
