$( window ).ready(function(){ 
  var val;
  var clients_in_month_rows;
  var promotor_id = $("#clients_in_month_chart").data("promotorid");

  $( "#clients_first_tab" ).click(drawClientsInMonthChartData);
  $( ".clients_month" ).change(drawClientsInMonthChartData);

  function drawClientsInMonthChartData() {
    val = $('.clients_month').val();
    $.ajax({
      url: "/promotor/new-clients-in-month",
      type: 'POST',
      data: { "clients_month": val, "promotors_id": promotor_id },
      success: function(data){
        console.log(data);
        clients_in_month_rows = JSON.parse(data);
        drawClientsInMonthChart();
      },
      error: function(data) {
        alert("nope");
      }
    });
  }
   
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawClientsInMonthChart);
   
  function drawClientsInMonthChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Days');
    dataTable.addColumn('number', 'Clients');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows(clients_in_month_rows);

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

  drawClientsInMonthChartData();
});