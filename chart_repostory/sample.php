<?php 
//index.php
$connect = mysqli_connect("localhost", "root", "", "testing");
$query = "SELECT * FROM account";
$result = mysqli_query($connect, $query);
$chart_data = '';
$pie_data = '';
while($row = mysqli_fetch_array($result))
{
  $chart_data .= "{ year:'".$row["year"]."', profit:".$row["profit"].", purchase:".$row["purchase"].", sale:".$row["sale"]."}, ";
 
  $pie_data  .= "{ label: '".$row["year"]."', value: ".$row["profit"]." }, ";
 
  $data[] = array(
  'label'  => $row["year"],
  'value'  => $row["sale"]
 );

}
$chart_data = substr($chart_data, 0, -2);

$data = json_encode($data);

?>

<!doctype html>
<html lang='en'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='css/bootstrap.min.css'>
    <link rel='stylesheet' href='css/morris.css'>
    <script src="lib/all.js"></script>

    <title>Morris.js 0.6</title>
    <style>
      h1, h2 {
        font-weight: 300;
        margin-top: 20px;
        margin-bottom: 20px;
      }
      h3 { font-weight: 300; }
      .chart_morris {
        height: 250px;
        background-color: #fff;
      }
      canvas { max-height: 250px; }
    </style>
  </head>
<body>
  <div class="container" style="width:600px;margin: 0px auto; border: 1px solid #cebbfb; border-radius: 5px;">
    <h3>Standard line chart 
      <span class='float-right'>
        <a id='std_line' tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true' >
          <i class='fas fa-info-circle'></i>
        </a>
      </span>
    </h3>
    <div id='chart_line_1' class='chart_morris'></div>
  </div>

   <div class="container" style="width:600px;margin: 0px auto; border: 1px solid #cebbfb; border-radius: 5px;">
            <h3>
              Non-linear trend line
              <span class='float-right'>
                <a tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true' data-content="<pre><code>...<br>lineWidth: 0,<br>trendLine: true,<br>trendLineType: 'polynomial',<br>...</code></pre>">
                  <i class='fas fa-info-circle'></i>
                </a>
              </span>
            </h3>
            <div id='chart_line_2' class='chart_morris'></div>
    </div>

      <div class="container" style="width:600px;margin: 0px auto; border: 1px solid #cebbfb; border-radius: 5px;">
        <h3>
          Step chart 
          <span class='float-right'>
            <a tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true' data-content="<pre><code>...<br>lineType: 'step',<br>...</code></pre>">
              <i class='fas fa-info-circle'></i>
            </a>
          </span>
        </h3>
        <div id='chart_line_3' class='chart_morris'></div>
      </div>

      <div class="container" style="width:600px;margin: 0px auto; border: 1px solid #cebbfb; border-radius: 5px;">
        <h3>
          Standard bar chart
          <span class='float-right'>
            <a id='std_bar' tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true'>
              <i class='fas fa-info-circle'></i>
            </a>
          </span>
        </h3>
        <div id='chart_hist_1' class='chart_morris'></div>
      </div>

      <div class="container" style="width:600px;  height: 600px; margin: 0px auto; border: 1px solid #cebbfb; border-radius: 5px;">
         <h3>
          Horizontal bar chart
          <span class='float-right'>
            <a tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true' data-content="<pre><code>...<br>horizontal: true<br>...</code></pre>">
              <i class='fas fa-info-circle'></i>
            </a>
          </span>
        </h3>
        <div id='chart_hist_2' class='chart_morris' style="height: 600px;"></div>
      </div>
  
      <div class="container" style="width:600px;margin: 0px auto; border: 1px solid #cebbfb; border-radius: 5px;">
            <h3>
              Combo chart
              <span class='float-right'>
                <a id='combo_bar' tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true'>
                  <i class='fas fa-info-circle'></i>
                </a>
              </span>
            </h3>
            <div id='chart_hist_3' class='chart_morris'></div>
          </div>
          
          
      <hr>
      <div class='container'>
        <div class='row' style='margin-bottom: 20px;'>
          <div class='col-md-4 col-sm-12 text-center'>
            <h3>
              Standard donut chart
              <span class='float-right'>
                <a id='std_donut' tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true'>
                  <i class='fas fa-info-circle'></i>
                </a>
              </span>
            </h3>
            <div id='chart_pie_1' class='chart_morris'></div>
            <div id='chart_pie_1_legend' class='text-center'></div>
          </div>
          <div class='col-md-4 col-sm-12 text-center'>
            <h3>
              Datalabels
              <span class='float-right'>
                <a tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true' data-content="<pre><code>...<br>dataLabels: true,<br>dataLabelsPosition: 'outside',<br>showPercentage: true,<br>...</code></pre>">
                  <i class='fas fa-info-circle'></i>
                </a>
              </span>
            </h3>
            <div id='chart_pie_2' class='chart_morris'></div>
            <div id='chart_pie_2_legend' class='text-center'></div>
          </div>
          <div class='col-md-4 col-sm-12 text-center'>
            <h3>
              Pie chart
              <span class='float-right'>
                <a tabindex='0' class='btn btn-lg btn-link btn-sm' role='button' data-toggle='popover' data-trigger='click' data-html='true' data-content="<pre><code class='text-left'>...<br>dataLabels: true,<br>donutType: 'pie',<br>...</code></pre>">
                  <i class='fas fa-info-circle'></i>
                </a>
              </span>
            </h3>
            <div id='chart_pie_3' class='chart_morris'></div>
            <div id='chart_pie_3_legend'></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src='lib/jquery-3.2.1.slim.min.js'></script>
  <script src='lib/popper.min.js'></script>
  <script src='lib/bootstrap.min.js'></script>
  
  <script src='lib/raphael.min.js' crossorigin='anonymous'></script>
  <script src='lib/regression.js' crossorigin='anonymous'></script>
  <script src='morris.js'></script>
 
  <script>
    Morris.Line({
        element: 'chart_line_1',
        data:[<?php echo $chart_data; ?>],
        dataLabels: false,
        xkey:'year',
        ykeys:['profit', 'purchase', 'sale',],
        labels:['Profit', 'Purchase', 'Sale'],
        hideHover:'auto'
    });

    Morris.Line({
      element: 'chart_line_2',
      data:[<?php echo $chart_data; ?>],
      dataLabels: false,
      xkey:'year',
      ykeys:['profit', 'purchase', 'sale'],
      labels:['Profit', 'Purchase', 'Sale'],
      lineWidth: 0,
      trendLine: true,
      trendLineType: 'polynomial'
    });

    Morris.Line({
      element: 'chart_line_3',
      dataLabels: false,
      data:[<?php echo $chart_data; ?>],
      xkey:'year',
      ykeys:['profit', 'purchase', 'sale'],
      labels:['Profit', 'Purchase', 'Sale'],
      lineType: 'step'
    });

    Morris.Bar({
      element: 'chart_hist_1',
      dataLabels: false,
      data:[<?php echo $chart_data; ?>],
      xkey:'year',
      ykeys:['profit', 'purchase', 'sale'],
      labels:['Profit', 'Purchase', 'Sale'],
    });

    Morris.Bar({
      element: 'chart_hist_2',
      dataLabels: false,
      data:[<?php echo $chart_data; ?>],
      xkey:'year',
      ykeys:['profit', 'purchase', 'sale'],
      labels:['Profit', 'Purchase', 'Sale'],
      horizontal: true,
    });

    Morris.Bar({
      element: 'chart_hist_3',
      dataLabels: false,
      data:[<?php echo $chart_data; ?>],
      xkey:'year',
      ykeys:['profit', 'purchase', 'sale'],
      labels:['Profit', 'Purchase', 'Sale'],
      nbYkeys2: 1,
    });

    pie_data = [  
        <?=$pie_data;?>
      ];

    Morris.Donut({
      element: 'chart_pie_1',
      data: pie_data
    }).options.colors.forEach(function(color, a){ 
      if (pie_data[a] != undefined) {
        var node = document.createElement('span');
        node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data[a].label+'</span>';
        document.getElementById("chart_pie_1_legend").appendChild(node);
      }
    });

    Morris.Donut({
      element: 'chart_pie_2',
      data: pie_data,
      dataLabels: true,
      showPercentage: true,
      dataLabelsPosition: 'outside'
    }).options.colors.forEach(function(color, a){ 
      if (pie_data[a] != undefined) {
        var node = document.createElement('span');
        node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data[a].label+'</span>';
        document.getElementById("chart_pie_2_legend").appendChild(node);
      }
    });

    Morris.Donut({
      element: 'chart_pie_3',
      data: pie_data,
      donutType: 'pie',
      dataLabels: true
    }).options.colors.forEach(function(color, a){ 
      if (pie_data[a] != undefined) {
        var node = document.createElement('span');
        node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data[a].label+'</span>';
        document.getElementById("chart_pie_3_legend").appendChild(node);
      }
    });

  </script>
</body>
</html>