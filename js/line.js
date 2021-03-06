$(function () {

    'use strict';

    // ChartJS


    function openComplaintsGraph() {

        $.get('api/json/all/complaints/open',function (data) {

            var salesChartCanvas = $('.salesChart').get(0).getContext('2d');
            var salesChart       = new Chart(salesChartCanvas);

            console.log(data.open);

            var salesChartData = {
                labels  : data.date,
                datasets: [
                    {
                        label               : 'Open',
                        fillColor           : '#f56954',
                        strokeColor         : 'rgb(210, 214, 222)',
                        pointColor          : 'rgb(210, 214, 222)',
                        pointStrokeColor    : '#d15247',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgb(220,220,220)',
                        data                : data.open
                    }
                ]
            };

            var salesChartOptions = {
                // Boolean - If we should show the scale at all
                showScale               : true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                // String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                // Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                // Boolean - Whether the line is curved between points
                bezierCurve             : true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot                : false,
                // Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                // String - A legend template
                legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            };

            // Create the line chart
            salesChart.Line(salesChartData, salesChartOptions);
        });
    }
    function pendingComplaintsGraph() {

        $.get('api/json/all/complaints/pending',function (data) {

            var salesChartCanvas = $('.salesChart').get(0).getContext('2d');
            var salesChart       = new Chart(salesChartCanvas);

            console.log(data.pending);

            var salesChartData = {
                labels  : data.date,
                datasets: [
                    {
                        label               : 'pending',
                        fillColor           : '#F39C12',
                        strokeColor         : 'rgb(210, 214, 222)',
                        pointColor          : 'rgb(210, 214, 222)',
                        pointStrokeColor    : '#d15247',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgb(220,220,220)',
                        data                : data.pending
                    }
                ]
            };

            var salesChartOptions = {
                // Boolean - If we should show the scale at all
                showScale               : true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                // String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                // Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                // Boolean - Whether the line is curved between points
                bezierCurve             : true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot                : false,
                // Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                // String - A legend template
                legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            };

            // Create the line chart
            salesChart.Line(salesChartData, salesChartOptions);
        });
    }

    function closedComplaintsGraph() {

        $.get('api/json/all/complaints/closed',function (data) {

            var salesChartCanvas = $('.salesChart').get(0).getContext('2d');
            var salesChart       = new Chart(salesChartCanvas);

            console.log(data.closed);

            var salesChartData = {
                labels  : data.date,
                datasets: [
                    {
                        label               : 'closed',
                        fillColor           : '#00A65A',
                        strokeColor         : 'rgb(210, 214, 222)',
                        pointColor          : 'rgb(210, 214, 222)',
                        pointStrokeColor    : '#d15247',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgb(220,220,220)',
                        data                : data.closed
                    }
                ]
            };

            var salesChartOptions = {
                // Boolean - If we should show the scale at all
                showScale               : true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                // String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                // Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                // Boolean - Whether the line is curved between points
                bezierCurve             : true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot                : false,
                // Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                // String - A legend template
                legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            };

            // Create the line chart
            salesChart.Line(salesChartData, salesChartOptions);
        });
    }

    function  removeAddToCanvas() {

        var canvas  =  $('<canvas  class="salesChart" style="height: 180px; width: 645px;" width="967" height="270"></canvas>');

        $("#empty").empty();

        $("#empty").append(canvas);

    }
    openComplaintsGraph();

    $("#open-graph").click(function (e) {

        removeAddToCanvas();
        openComplaintsGraph();
    });

    $("#pending-graph").click(function (e) {

        removeAddToCanvas();
        pendingComplaintsGraph();

    });

    $("#closed-graph").click(function (e) {

        removeAddToCanvas();
        closedComplaintsGraph();

    });


    // - PIE CHART -
    // -------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    var pieChart       = new Chart(pieChartCanvas);

    $.get('api/json/all/complaints/piechart',function (data) {

        console.log(data);
        console.log("open = "+data.open);
        console.log("closed = "+data.closed);
        console.log("pending = "+data.pending);
        console.log("total = "+data.total);

        var PieData        = [
            {
                value    : data.open,
                color    : '#f56954',
                highlight: '#f56954',
                label    : 'Open'
            },
            {
                value    : data.closed,
                color    : '#00a65a',
                highlight: '#00a65a',
                label    : 'Closed'
            },
            {
                value    : data.pending,
                color    : '#f39c12',
                highlight: '#f39c12',
                label    : 'Pending'
            },

        ];
        var pieOptions     = {
            // Boolean - Whether we should show a stroke on each segment
            segmentShowStroke    : true,
            // String - The colour of each segment stroke
            segmentStrokeColor   : '#fff',
            // Number - The width of each segment stroke
            segmentStrokeWidth   : 1,
            // Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            // Number - Amount of animation steps
            animationSteps       : 100,
            // String - Animation easing effect
            animationEasing      : 'easeOutBounce',
            // Boolean - Whether we animate the rotation of the Doughnut
            animateRotate        : true,
            // Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale         : false,
            // Boolean - whether to make the chart responsive to window resizing
            responsive           : true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio  : false,
            // String - A legend template
            legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
            // String - A tooltip template
            tooltipTemplate      : '<%=value %> <%=label%> Comp'
        };

        pieChart.Doughnut(PieData, pieOptions);
        // - END PIE CHART -

    });





});