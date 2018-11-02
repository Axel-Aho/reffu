'use strict';

var $ = require('jquery');


window.onload = function() {
    
    var i = 1;
    var item = document.getElementById(i)
    var percent = $('#1').attr('value');
    var name = $('#1').attr('name');

    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "theme2",
        animationEnabled: true,
        title: {
            text: "Avaruuden tutkinta"
        },
        data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabelPlacement: "inside",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            showInLegend: true,
            legendText: "{label}",
            // dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            dataPoints: [{
                label: name,
                y: percent,
            }, {
                label: 'Internet Explorer',
                y: 11.84
            }, {
                label: 'Firefox',
                y: 10.85
            }, {
                label: 'Edge',
                y: 4.67
            }, {
                label: 'Safari',
                y: 4.18
            }]
        }]
    });
    chart.render();
     
    }