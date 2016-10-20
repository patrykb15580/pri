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
      ['Styczeń', <?= count($promotor->codesUsedInMonth(1)) ?>,'Liczba kodów: <?= count($promotor->codesUsedInMonth(1)) ?>'],
      ['Luty', <?= count($promotor->codesUsedInMonth(2)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(2)) ?>'],
      ['Marzec', <?= count($promotor->codesUsedInMonth(3)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(3)) ?>'],
      ['Kwiecień', <?= count($promotor->codesUsedInMonth(4)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(4)) ?>'],
      ['Maj', <?= count($promotor->codesUsedInMonth(5)) ?>,'Liczba kodów: <?= count($promotor->codesUsedInMonth(5)) ?>'],
      ['Czerwiec', <?= count($promotor->codesUsedInMonth(6)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(6)) ?>'],
      ['Lipiec', <?= count($promotor->codesUsedInMonth(7)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(7)) ?>'],
      ['Sierpień', <?= count($promotor->codesUsedInMonth(8)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(8)) ?>'],
      ['Wrzesień', <?= count($promotor->codesUsedInMonth(9)) ?>,'Liczba kodów: <?= count($promotor->codesUsedInMonth(9)) ?>'],
      ['Październik', <?= count($promotor->codesUsedInMonth(10)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(10)) ?>'],
      ['Listopad', <?= count($promotor->codesUsedInMonth(11)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(11)) ?>'],
      ['Grudzień', <?= count($promotor->codesUsedInMonth(12)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInMonth(12)) ?>']
    ]);

    var options = { legend: 'none' };
    var chart = new google.visualization.LineChart(document.getElementById('tooltip_action'));

    chart.draw(dataTable, options);
  }
</script>

<h3>Wykorzystane kody w ujęciu rocznym:</h3>
<div id="tooltip_action"></div>
<br/><br/><br />
