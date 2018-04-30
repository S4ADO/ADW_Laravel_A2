@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><a href = "/settings">Settings</a> - Statistics</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div align = "center">
                            Total number of tasks: {{$iTotalTasks}}

                            <!--Load the AJAX API-->
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">

                              // Load the Visualization API and the corechart package.
                              google.charts.load('current', {'packages':['corechart']});

                              // Set a callback to run when the Google Visualization API is loaded.
                              google.charts.setOnLoadCallback(drawChart);

                              // Callback that creates and populates a data table,
                              // instantiates the pie chart, passes in the data and
                              // draws it.
                              function drawChart() {

                                // Create the data table.
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'CompleteText');
                                data.addColumn('number', 'CompleteValue');
                                data.addRows([
                                  ['Not important', {{$notCompleteImportanceInfo[1]}}],
                                  ['Somewhat important', {{$notCompleteImportanceInfo[2]}}],
                                  ['Quite important', {{$notCompleteImportanceInfo[3]}}],
                                  ['Very important', {{$notCompleteImportanceInfo[4]}}],
                                  ['Urgent', {{$notCompleteImportanceInfo[5]}}]
                                ]);

                                // Set chart options
                                var options = {'title':'Incompleted task importance spread',
                                               'width':400,
                                               'height':300};

                                // Instantiate and draw our chart, passing in some options.
                                var chart = new google.visualization.PieChart(document.getElementById('first'));
                                chart.draw(data, options);
                              }
                            </script>
                            <!--Div that will hold the pie chart-->
                            <div id="first"></div>
                            Total number of incompleted tasks: {{$iIncompletedTasks}}
                            

                            <!--Load the AJAX API-->
                            <script type="text/javascript">

                              // Load the Visualization API and the corechart package.
                              google.charts.load('current', {'packages':['corechart']});

                              // Set a callback to run when the Google Visualization API is loaded.
                              google.charts.setOnLoadCallback(drawChart);

                              // Callback that creates and populates a data table,
                              // instantiates the pie chart, passes in the data and
                              // draws it.
                              function drawChart() {

                                // Create the data table.
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'CompleteText');
                                data.addColumn('number', 'CompleteValue');
                                data.addRows([
                                  ['Not important', {{$completeImportanceDateInfo[1]}}],
                                  ['Somewhat important', {{$completeImportanceDateInfo[2]}}],
                                  ['Quite important', {{$completeImportanceDateInfo[3]}}],
                                  ['Very important', {{$completeImportanceDateInfo[4]}}],
                                  ['Urgent', {{$completeImportanceDateInfo[5]}}]
                                ]);

                                // Set chart options
                                var options = {'title':'Incompleted task importance spread, past their expiration date',
                                               'width':400,
                                               'height':300};

                                // Instantiate and draw our chart, passing in some options.
                                var chart = new google.visualization.PieChart(document.getElementById('second'));
                                chart.draw(data, options);
                              }
                            </script>
                            <!--Div that will hold the pie chart-->
                            <div id="second"></div>
                            Total number of incompleted tasks past their expiration dates: {{$iIncompletedTasksPastDate}}

                            <!--Load the AJAX API-->
                            <script type="text/javascript">

                              // Load the Visualization API and the corechart package.
                              google.charts.load('current', {'packages':['corechart']});

                              // Set a callback to run when the Google Visualization API is loaded.
                              google.charts.setOnLoadCallback(drawChart);

                              // Callback that creates and populates a data table,
                              // instantiates the pie chart, passes in the data and
                              // draws it.
                              function drawChart() {

                                // Create the data table.
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'CompleteText');
                                data.addColumn('number', 'CompleteValue');
                                data.addRows([
                                  ['Not important', {{$completeImportanceInfo[1]}}],
                                  ['Somewhat important', {{$completeImportanceInfo[2]}}],
                                  ['Quite important', {{$completeImportanceInfo[3]}}],
                                  ['Very important', {{$completeImportanceInfo[4]}}],
                                  ['Urgent', {{$completeImportanceInfo[5]}}]
                                ]);

                                // Set chart options
                                var options = {'title':'Completed task importance spread',
                                               'width':400,
                                               'height':300};

                                // Instantiate and draw our chart, passing in some options.
                                var chart = new google.visualization.PieChart(document.getElementById('third'));
                                chart.draw(data, options);
                              }
                            </script>
                            <!--Div that will hold the pie chart-->
                            <div id="third"></div>
                            Total number of completed tasks: {{$iCompletedTasks}}
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
