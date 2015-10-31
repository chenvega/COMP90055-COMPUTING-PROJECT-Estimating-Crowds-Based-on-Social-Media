<?php
$home=$_GET["home"];

  $handle = fopen("http://115.146.85.185:5984/spainpop/_design/spainpop/_view/spainpop","rb");
  $content = "";
  while(!feof($handle)){
    $content.=fread($handle,100000);
  }
  fclose($handle);
  $content=json_decode($content,true);
  $size=sizeOf($content["rows"]);

	$popular=array();
	$teams=array();

  for($i=0; $i<$size; $i++){
  	array_push($popular,$content["rows"][$i]["value"]);
  	array_push($teams,$content["rows"][$i]["key"]);
  }

  $getData = array($popular, $teams);
  echo json_encode($getData);
?>
