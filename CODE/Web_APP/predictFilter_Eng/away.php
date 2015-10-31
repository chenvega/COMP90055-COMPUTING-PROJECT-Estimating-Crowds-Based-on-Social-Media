<?php
$home=$_GET["home"];

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
    <label for=\"away\">AWAY</label>
    <select class=\"form-control\" id=\"away\" name=\"away\" onchange=\"getDate(this.value)\" required>
      <option value=\"\" selected>Select Away Team</option>";

        $away = $content["rows"][0]["key"][1];
        for($i=1; $i<$size; $i++){
          if($away != $content["rows"][$i]["key"][1] && $home == $content["rows"][$i]["key"][0]){
            $away = $content["rows"][$i]["key"][1];
            echo "<option value=\"". $away."_".$home."\">". $away."</option>";
        }
    }

echo "</select>
	</div>";
?>
