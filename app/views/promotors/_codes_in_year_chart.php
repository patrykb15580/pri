<?php
  #SELECT `used` FROM promotion_codes WHERE MONTH(`used`) = 10 
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  
  function drawChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Months');
    dataTable.addColumn('number', 'Codes');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows([
      <?php $year = date("Y-");
      $day = date("-d"); ?>
      ['Styczeń', <?= count($promotor->codesUsedInMonth($year.'1'.$day)) ?>,'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'1'.$day)) ?>'],
      ['Luty', <?= count($promotor->codesUsedInMonth($year.'2'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'2'.$day)) ?>'],
      ['Marzec', <?= count($promotor->codesUsedInMonth($year.'3'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'3'.$day)) ?>'],
      ['Kwiecień', <?= count($promotor->codesUsedInMonth($year.'4'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'4'.$day)) ?>'],
      ['Maj', <?= count($promotor->codesUsedInMonth($year.'5'.$day)) ?>,'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'5'.$day)) ?>'],
      ['Czerwiec', <?= count($promotor->codesUsedInMonth($year.'6'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'6'.$day)) ?>'],
      ['Lipiec', <?= count($promotor->codesUsedInMonth($year.'7'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'7'.$day)) ?>'],
      ['Sierpień', <?= count($promotor->codesUsedInMonth($year.'8'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'8'.$day)) ?>'],
      ['Wrzesień', <?= count($promotor->codesUsedInMonth($year.'9'.$day)) ?>,'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'9'.$day)) ?>'],
      ['Październik', <?= count($promotor->codesUsedInMonth($year.'10'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'10'.$day)) ?>'],
      ['Listopad', <?= count($promotor->codesUsedInMonth($year.'11'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'11'.$day)) ?>'],
      ['Grudzień', <?= count($promotor->codesUsedInMonth($year.'12'.$day)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth($year.'12'.$day)) ?>']
    ]);

    var options = { legend: 'none' };
    var chart = new google.visualization.LineChart(document.getElementById('codes_in_year_chart'));

    chart.draw(dataTable, options);
  }
</script>

<h3>Wykorzystane kody w ujęciu rocznym:</h3>
<div id="codes_in_year_chart"></div>
<br/><br/><br />
