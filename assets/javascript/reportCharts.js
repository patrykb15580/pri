$(document).ready(function(){
  var val = $("#report-chart").data("month");
  var report_rows;
  var promotor_id = $("#report-chart").data("promotorid");

  function reportChartData() {
    $.ajax({
      url: "/promotor/codes-used-in-month",
      type: 'POST',
      data: { "codes_month": val, "promotors_id": promotor_id },
      success: function(data){
        console.log(data);
        report_rows = JSON.parse(data);
        reportChart();
      },
      error: function(data) {
        alert("nope");
      }
    });
  }
   
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(reportChart);
    
  function reportChart() {

    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Days');
    dataTable.addColumn('number', 'Codes');

    // A column for custom tooltip content
    dataTable.addColumn({type: 'string', role: 'tooltip'});

    dataTable.addRows(report_rows);

    var options = { legend: 'none',
                    hAxis: { 
                      maxAlternation:0, 
                      showTextEvery:1 
                    },
                    vAxis: {
                      viewWindow: {
                        min: 0
                      }
                    },
                    chartArea: {  width: "100%", height: "80mm" } };

    var chart_div = document.getElementById('report-chart');
    var chart = new google.visualization.LineChart(chart_div);

    google.visualization.events.addListener(chart, 'ready', function () {
        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        console.log(chart_div.innerHTML);
      });


    chart.draw(dataTable, options);
  }

  reportChartData();
});