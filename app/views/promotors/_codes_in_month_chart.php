<?php
  #SELECT `used` FROM promotion_codes WHERE MONTH(`used`) = 10 
  #SELECT * FROM promotion_codes WHERE `used` > "2016-09-11 00:00:00" AND `used` < "2016-10-24 00:00:00"
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
/*
<script type="text/javascript">
  function drawLogScales() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Days');
      data.addColumn('number', 'Clients');
      data.addColumn('number', 'Codes');

      data.addRows([
        <?php
          $days = cal_days_in_month(CAL_GREGORIAN, date("m") , date("Y") );
          for ($i=0; $i < $days; $i++) { ?>
            ['<?= $i ?>', <?= count($promotor->codesUsedInDay($i)) ?>, <?= count($promotor->newClientsInDay($i)) ?>],
          <?php }
      ?>
      ]);

      var options = {
        hAxis: {
          title: 'Liczba kodów',
        },
        hAxis: {
          title: 'Liczba klientów',
        },
        vAxis: {
          title: 'Dzień miesiąca',
        },
        colors: ['#a52714', '#097138']
      };

      var chart = new google.visualization.LineChart(document.getElementById('codes_and_clients_in_month_chart'));
      chart.draw(data, options);
    }
</script>*/
?>
<script type="text/javascript">

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  
  function drawChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Days');
    dataTable.addColumn('number', 'Codes');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows([
      <?php
          $days = cal_days_in_month(CAL_GREGORIAN, date("m") , date("Y") );
          for ($i=0; $i < $days; $i++) { 
            $date = date("Y-m-").$i;?>
            ['<?= $i ?>', <?= count($promotor->codesUsedInDay($date)) ?>, 'Liczba kodów: <?= count($promotor->codesUsedInDay($date)) ?>'],
          <?php }
      ?>
    ]);

    var options = { legend: 'none' };
    var chart = new google.visualization.LineChart(document.getElementById('codes_in_month_chart'));

    chart.draw(dataTable, options);
  }
</script>
<h3>Wykorzystane kody w bieżącym miesiącu (<?= PolishMonthName::NAMES[date("m")] ?>):</h3>
<div id="codes_in_month_chart"></div>
<br/><br/><br />
