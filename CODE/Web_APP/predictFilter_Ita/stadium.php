<?php
$comb=$_GET["comb"];
$home=explode("_",$comb)[1];
$away=explode("_",$comb)[0];
  $handle = fopen("http://115.146.85.185:5984/italydatanew/_design/italydatanew/_view/italydatanew","rb");
  $content = "";
  while(!feof($handle)){
    $content.=fread($handle,100000);
  }
  fclose($handle);
  $content=json_decode($content,true);
  $size=sizeOf($content["rows"]);

echo "  
<div class=\"form-group col-md-6\">
    <label for=\"stadium\">STADIUM</label>
    <select class=\"form-control\" id=\"stadium\" name=\"stadium\" required>
      <option value=\"\" selected>Select Stadium</option>";

        $stadium = $content["rows"][0]["key"][2];
        for($i=1; $i<$size; $i++){
          if($stadium != $content["rows"][$i]["key"][2] && $away == $content["rows"][$i]["key"][1] && $home == $content["rows"][$i]["key"][0]){
            $stadium = $content["rows"][$i]["key"][2];
            echo "<option value=\"". $stadium."\">". $stadium."</option>";
        }
    }

echo "</select>
	</div>";
?>
