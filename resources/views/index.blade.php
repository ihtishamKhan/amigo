@extends('layouts.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Orders</p>
                                    <h4 class="mb-0">{{ $total_orders }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Completed</p>
                                    <h4 class="mb-0">{{ $completed_orders }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Canceled</p>
                                    <h4 class="mb-0">{{ $cancelled_orders }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Revenue</p>
                                    <h4 class="mb-0">£{{ $revenue }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center ">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">
                        <h4 class="card-title mb-4">Orders Status</h4>
                    </div>

                    <div id="stacked-column-chart" data-colors='["--bs-primary", "--bs-warning", "--bs-success"]'
                        class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>


    <script>
        // Add this in your blade template
        var chartData = @json($chart_data);
        console.log(chartData);

        function getChartColorsArray(chartId) {
            if (document.getElementById(chartId) !== null) {
                var colors = document.getElementById(chartId).getAttribute("data-colors");
                if (colors) {
                    colors = JSON.parse(colors);
                    return colors.map(function(value) {
                        var newValue = value.replace(" ", "");
                        if (newValue.indexOf(",") === -1) {
                            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                            if (color) return color;
                            else return newValue;;
                        } else {
                            var val = value.split(',');
                            if (val.length == 2) {
                                var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                                rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                                return rgbaColor;
                            } else {
                                return newValue;
                            }
                        }
                    });
                }
            }
        }

        // stacked column chart
        var linechartBasicColors = getChartColorsArray("stacked-column-chart");
        if (linechartBasicColors) {
            var options = {
                chart: {
                    height: 360,
                    type: 'bar',
                    stacked: true,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: true
                    }
                },

                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '15%',
                        endingShape: 'rounded',
                        borderRadius: 5,
                    },
                },

                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Orders',
                    data: chartData.orders
                }, {
                    name: 'Completed',
                    data: chartData.completed
                }, {
                    name: 'Cancelled',
                    data: chartData.cancelled
                }],
                xaxis: {
                    categories: chartData.dates,
                },
                colors: linechartBasicColors,
                legend: {
                    position: 'bottom',
                },
                fill: {
                    opacity: 1
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#stacked-column-chart"),
                options
            );

            chart.render();
        }
    </script>
@endsection
