<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="./build/nv.d3.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js" charset="utf-8"></script>
    <script src="./build/nv.d3.js"></script>

    <style>
        text {
            font: 12px sans-serif;
        }
        svg {
            display: block;
        }
        html, body, #test1, svg {
            margin: 0px;
            padding: 0px;
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body class='with-3d-shadow with-transitions'>

<div id="test1" class="chartWrap">
    <svg></svg>
</div>
<?php
$handle1 = fopen("http://115.146.85.185:5984/englanddatanew/_design/englanddatanew/_view/englanddatanew","rb");
$content1 = "";
while(!feof($handle1)){
  $content1.=fread($handle1,100000);
}
fclose($handle1);
$content1=json_decode($content1,true);
$size1=sizeOf($content1["rows"]);

$englandAttendance=array();
$englandTweets=array();

for($i=0; $i<$size1; $i++){
  array_push($englandAttendance,(int)$content1["rows"][$i]["value"][2]);
}

for($i=0; $i<$size1; $i++){
  array_push($englandTweets,(int)$content1["rows"][$i]["value"][1]);
}

$englandAttendance = json_encode($englandAttendance,true);
$englandTweets = json_encode($englandTweets,true);



$handle2 = fopen("http://115.146.85.185:5984/spaindatanew/_design/spaindatanew/_view/spaindatanew","rb");
$content2 = "";
while(!feof($handle2)){
  $content2.=fread($handle2,100000);
}
fclose($handle2);
$content2=json_decode($content2,true);
$size2=sizeOf($content2["rows"]);

$spainAttendance=array();
$spainTweets=array();

for($i=0; $i<$size2; $i++){
  array_push($spainAttendance,(int)$content2["rows"][$i]["value"][2]);
}

for($i=0; $i<$size2; $i++){
  array_push($spainTweets,(int)$content2["rows"][$i]["value"][1]);
}

$spainAttendance = json_encode($spainAttendance,true);
$spainTweets = json_encode($spainTweets,true);



$handle3 = fopen("http://115.146.85.185:5984/italydatanew/_design/italydatanew/_view/italydatanew","rb");
$content3 = "";
while(!feof($handle3)){
  $content3.=fread($handle3,100000);
}
fclose($handle3);
$content3=json_decode($content3,true);
$size3=sizeOf($content3["rows"]);

$italyAttendance=array();
$italyTweets=array();

for($i=0; $i<$size3; $i++){
  array_push($italyAttendance,(int)$content3["rows"][$i]["value"][2]);
}

for($i=0; $i<$size3; $i++){
  array_push($italyTweets,(int)$content3["rows"][$i]["value"][1]);
}

$italyAttendance = json_encode($italyAttendance,true);
$italyTweets = json_encode($italyTweets,true);



$handle4 = fopen("http://115.146.85.185:5984/afldatanew/_design/afldatanew/_view/afldatanew","rb");
$content4 = "";
while(!feof($handle4)){
  $content4.=fread($handle4,100000);
}
fclose($handle4);
$content4=json_decode($content4,true);
$size4=sizeOf($content4["rows"]);

$aflAttendance=array();
$aflTweets=array();

for($i=0; $i<$size4; $i++){
  array_push($aflAttendance,(int)$content4["rows"][$i]["value"][2]);
}

for($i=0; $i<$size4; $i++){
  array_push($aflTweets,(int)$content4["rows"][$i]["value"][1]);
}

$aflAttendance = json_encode($aflAttendance,true);
$aflTweets = json_encode($aflTweets,true);
?>
<script>

    var chart;
    nv.addGraph(function() {
        chart = nv.models.scatterChart()
            .showDistX(true)
            .showDistY(true)
            .duration(300)
            .color(d3.scale.category10().range());

        chart.dispatch.on('renderEnd', function(){
            console.log('render complete');
        });

        chart.xAxis.tickFormat(d3.format('.02f'));
        chart.yAxis.tickFormat(d3.format('.02f'));

        d3.select('#test1 svg')
            .datum(nv.log(randomData(4,40)))
            .call(chart);

        nv.utils.windowResize(chart.update);
        chart.dispatch.on('stateChange', function(e) { nv.log('New State:', JSON.stringify(e)); });
        return chart;
    });


    function randomData(groups, points) { //# groups,# points per group
        var data = [],
            shapes = ['circle', 'cross', 'triangle-up', 'triangle-down', 'diamond', 'square'],
            league = ['England', 'Spain', 'Italy', 'AFL'],


            englandAttendance = <?php echo $englandAttendance; ?>,
            englandTweets = <?php echo $englandTweets; ?>,


            italyAttendance = <?php echo $italyAttendance; ?>,
            italyTweets = <?php echo $italyTweets; ?>,

            spainAttendance = <?php echo $spainAttendance; ?>,
            spainTweets = <?php echo $spainTweets; ?>,


            aflAttendance = <?php echo $aflAttendance; ?>,
            aflTweets = <?php echo $aflTweets; ?>,
            
            random = d3.random.normal();

        for (i = 0; i < league.length; i++) {
            data.push({
                key: league[i],
                values: [],
                slope: Math.random() - .01,
                intercept: Math.random() - .5
            });
        }
        for (j = 0; j < englandAttendance.length; j++) {
            data[0].values.push({
                x: englandTweets[j],
                y: englandAttendance[j],
                size: englandAttendance[j],
                shape: shapes[0]
            });
        }
        for (j = 0; j < italyAttendance.length; j++) {
            data[1].values.push({
                x: italyTweets[j],
                y: italyAttendance[j],
                size: italyAttendance[j],
                shape: shapes[1]
            });
        }
        for (j = 0; j < spainAttendance.length; j++) {
            data[2].values.push({
                x: spainTweets[j],
                y: spainAttendance[j],
                size: spainAttendance[j],
                shape: shapes[2]
            });
        }
        for (j = 0; j < aflAttendance.length; j++) {
            data[3].values.push({
                x: aflTweets[j],
                y: aflAttendance[j],
                size: aflAttendance[j],
                shape: shapes[3]
            });
        }
        return data;
    }

</script>
</body>
</html>