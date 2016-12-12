$( document ).ready(function(){ 
  var clients_in_range_rows;
  var promotor_id = $("#clients_in_range_chart").data("promotorid");

  $( "#clients_date_from" ).datepicker({ dateFormat: 'yy-mm-dd' }).change(drawClientsInRangeChartData);
  $( "#clients_date_to" ).datepicker({ dateFormat: 'yy-mm-dd' }).change(drawClientsInRangeChartData);

  $( ".l2-tab-3" ).click(drawClientsInRangeChartData);
  $( "#select-tab" ).change(drawClientsInRangeChartData);
  $( "#clients_in_range_chart" ).resize(drawClientsInRangeChartData);
  $( window ).resize(drawClientsInRangeChartData);

  function drawClientsInRangeChartData() {
    val_from = $('#clients_date_from').val();
    val_to = $('#clients_date_to').val();
    $.ajax({
      url: "/promotor/new-clients-in-range",
      type: 'POST',
      data: { "clients_from": val_from, "clients_to": val_to, "promotors_id": promotor_id },
      success: function(data){
        console.log(data);
        clients_in_range_rows = JSON.parse(data);
        drawClientsInRangeChart();
      },
      error: function(data) {
        alert("nope");
      }
    });
  }
   
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawClientsInRangeChart);
   
  function drawClientsInRangeChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Date');
    dataTable.addColumn('number', 'Clients');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows(clients_in_range_rows);

    var options = { legend: 'none',
                    hAxis: { 
                      maxAlternation:1, 
                      showTextEvery:1, 
                    },
                    vAxis: {
                      viewWindow: {
                        min: 0
                      }
                    },
                    chartArea: {  width: "90%", height: "50%" } };
    var chart = new google.visualization.LineChart(document.getElementById('clients_in_range_chart'));

    chart.draw(dataTable, options);
  }
});