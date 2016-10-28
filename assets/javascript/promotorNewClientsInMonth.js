  var val;
  var rows;

  $( window ).ready(function(){ $( window ).ajaxComplete(function(){ drawClientsInMonthChartData(); }); });
  $( ".clients_month" ).change(drawClientsInMonthChartData);

  function drawClientsInMonthChartData() {
    val = $('.clients_month').val();
    $.ajax({
      url: "http://pri.dev/promotor/new-clients-in-month",
      type: 'POST',
      data: { "clients_month": val },
      success: function(data){
        console.log(data);
        rows = JSON.parse(data);
        drawClientsInMonthChart();
      },
      error: function(data) {
        alert("nope");
      }
    });
  }
 
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  
  function drawClientsInMonthChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Days');
    dataTable.addColumn('number', 'Clients');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});
    var test = rows;
    console.log(test);
    dataTable.addRows(rows);

    var options = { legend: 'none',
                    hAxis: { 
                      maxAlternation:1, 
                      showTextEvery:1 
                    },
                    vAxis: {
                      viewWindow: {
                        min: 0
                      }
                    },
                    chartArea: {  width: "90%", height: "70%" } };
    var chart = new google.visualization.LineChart(document.getElementById('clients_in_month_chart'));

    chart.draw(dataTable, options);
  }