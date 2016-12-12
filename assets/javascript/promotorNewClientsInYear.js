$( document ).ready(function(){ 
  var val;
  var clients_in_year_rows;
  var promotor_id = $("#clients_in_year_chart").data("promotorid");

  $( ".l2-tab-2" ).click(drawClientsInYearChartData);
  $( ".clients_year" ).change(drawClientsInYearChartData);
  $( "#select-tab" ).change(drawClientsInYearChartData);
  $( "#clients_in_year_chart" ).resize(drawClientsInYearChartData);
  $( window ).resize(drawClientsInYearChartData);

  function drawClientsInYearChartData() {
    val = $('.clients_year').val();
    $.ajax({
      url: "/promotor/new-clients-in-year",
      type: 'POST',
      data: { "clients_year": val, "promotors_id": promotor_id },
      success: function(data){
        console.log(data);
        clients_in_year_rows = JSON.parse(data);
        drawClientsInYearChart();
      },
      error: function(data) {
        alert("nope");
      }
    });
  }
   
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawClientsInYearChart);
   
  function drawClientsInYearChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Days');
    dataTable.addColumn('number', 'Clients');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows(clients_in_year_rows);

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
    var chart = new google.visualization.LineChart(document.getElementById('clients_in_year_chart'));

    chart.draw(dataTable, options);
  }

  drawClientsInYearChartData();
});