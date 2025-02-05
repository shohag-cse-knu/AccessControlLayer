'use strict';
$(document).ready(function() {
    /*Area chart*/
        var chart = AmCharts.makeChart("statestics-chart", {
            "type": "serial",
            "marginTop": 0,
            "hideCredits": true,
            "marginRight": 0,
            "dataProvider": [{
                "month": "01-01-2021",
                "value": 0.98
            }, {
                "month": "05-01-2021",
                "value": 1.87
            }, {
                "month": "09-01-2021",
                "value": 0.97
            }, {
                "month": "10-01-2021",
                "value": 1.64
            }, {
                "month": "21-01-2021",
                "value": 0.40
            }, {
                "month": "22-01-2021",
                "value": 2.90
            }, {
                "month": "23-01-2021",
                "value": 5.2
            }, {
                "month": "01-02-2021",
                "value": 0.77
            }, {
                "month": "05-02-2021",
                "value": 3.1
            }],
            "valueAxes": [{
                "axisAlpha": 0,
                "dashLength": 6,
                "gridAlpha": 0.1,
                "position": "left"
            }],
            "graphs": [{
                "id": "g1",
                "bullet": "round",
                "bulletSize": 9,
                "lineColor": "#4680ff",
                "lineThickness": 2,
                "negativeLineColor": "#4680ff",
                "type": "smoothedLine",
                "valueField": "value"
            }],
            "chartCursor": {
                "cursorAlpha": 0,
                "valueLineEnabled": false,
                "valueLineBalloonEnabled": true,
                "valueLineAlpha": false,
                "color": '#fff',
                "cursorColor": '#FC6180',
                "fullWidth": true
            },
            "categoryField": "month",
            "categoryAxis": {
                "gridAlpha": 0,
                "axisAlpha": 0,
                "fillAlpha": 1,
                "fillColor": "#FAFAFA",
                "minorGridAlpha": 0,
                "minorGridEnabled": true
            },
            "export": {
                "enabled": true
            }
        });
        /*donut chart*/

});