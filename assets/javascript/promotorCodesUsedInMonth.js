$( document ).ready(function(){ 

  var val;
  var codes_in_month_rows;
  var promotor_id = $("#codes_in_month_chart").data("promotorid");

  $( "#codes_first_tab" ).click(drawClientsInMonthChartData);
  $( ".codes_month" ).change(drawClientsInMonthChartData);

  function drawClientsInMonthChartData() {
    val = $('.codes_month').val();
    $.ajax({
      url: "http://pri.dev/promotor/codes-used-in-month",
      type: 'POST',
      data: { "codes_month": val, "promotors_id": promotor_id },
      success: function(data){
        console.log(data);
        codes_in_month_rows = JSON.parse(data);
        drawCodesInMonthChart();
      },
      error: function(data) {
        alert("nope");
      }
    });
  }
   
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCodesInMonthChart);
    
  function drawCodesInMonthChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Days');
    dataTable.addColumn('number', 'Codes');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows(codes_in_month_rows);

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
    var chart = new google.visualization.LineChart(document.getElementById('codes_in_month_chart'));

    chart.draw(dataTable, options);
  }

  drawClientsInMonthChartData();
});
  