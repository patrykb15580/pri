$( window ).ready(function(){ 
  var codes_in_range_rows;
  var promotor_id = $("#codes_in_range_chart").data("promotorid");

  $( "#codes_date_from" ).datepicker({ dateFormat: 'yy-mm-dd' }).change(drawCodesInRangeChartData);
  $( "#codes_date_to" ).datepicker({ dateFormat: 'yy-mm-dd' }).change(drawCodesInRangeChartData);

  $( "#codes_third_tab" ).click(drawCodesInRangeChartData);

  function drawCodesInRangeChartData() {
    val_from = $('#codes_date_from').val();
    val_to = $('#codes_date_to').val();
    $.ajax({
      url: "/promotor/codes-used-in-range",
      type: 'POST',
      data: { "codes_from": val_from, "codes_to": val_to, "promotors_id": promotor_id },
      success: function(data){
        console.log(data);
        Codes_in_range_rows = JSON.parse(data);
        drawCodesInRangeChart();
      },
      error: function(data) {
        alert("nope");
      }
    });
  }
   
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCodesInRangeChart);
   
  function drawCodesInRangeChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Date');
    dataTable.addColumn('number', 'Codes');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows(Codes_in_range_rows);

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
    var chart = new google.visualization.LineChart(document.getElementById('codes_in_range_chart'));

    chart.draw(dataTable, options);
  }

  drawCodesInRangeChartData();
});