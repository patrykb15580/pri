$( '#codes_second_tab' ).click(function(){
  var val;
  var codes_in_year_rows;
  var promotor_id = $("#codes_in_year_chart").data("promotorid");

  $.ajax({
    url: "http://pri.dev/promotor/codes-used-in-year",
    type: 'POST',
    data: { "promotors_id": promotor_id },
    success: function(data){
      console.log(data);
      codes_in_year_rows = JSON.parse(data);
      drawCodesInYearChart();
    },
    error: function(data) {
      alert("nope");
    }
  });

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCodesInYearChart);
    
  function drawCodesInYearChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Months');
    dataTable.addColumn('number', 'Codes');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows(codes_in_year_rows);

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
    var chart = new google.visualization.LineChart(document.getElementById('codes_in_year_chart'));

    chart.draw(dataTable, options);
  }
});