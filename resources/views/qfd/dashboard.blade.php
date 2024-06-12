@extends('qfd.layouts.master')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        td {
            text-align: center;
        }
        .bg-red { background-color: #f8d7da; }
        .bg-blue { background-color: #cce5ff; }
        .bg-purple { background-color: #d1c4e9; }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Schedule</h4>
            </div>
            <div class="card-body">
                <button>Filter</button>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Monitoring QFD</th>
                            <th colspan="21                                                                                                                                                                                                                                                                                                                                         ">MONTH</th>
                        </tr>
                        <tr>
                            <th>Proses</th>
                            <th>Details</th>
                            <?php
                                $currentMonth = date('n'); // Current month as a number (1-12)
                                $currentYear = date('Y'); // Current year as a 4-digit number
                                $daysInMonth = date('t'); // Total days in the current month

                                // Get the remaining days in the current month
                                for ($i = date('j'); $i <= $daysInMonth; $i++) {
                                    echo "<th>{$i}</th>";
                                }
                                // Get the first 9 days of the next month
                                for ($i = 1; $i <= 9; $i++) {
                                    echo "<th>{$i}</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- ini buat ambil data di tabel --}}
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>
                                    {{-- Product : {{ $item['PRODUCT'] }}<br> --}}
                                    {{-- Product Desc : {{ $item['end_customer'] }} <br> --}}
                                    Start Date : {{ $item['start_date'] }}<br>
                                    DueDate : {{ $item['end_date'] }}<br>
                                </td>
                                @for ($i = date('j'); $i <= $daysInMonth; $i++)
                                    <td class="{{ in_array($i, [23, 24, 29]) ? 'bg-red' : (in_array($i, [25]) ? 'bg-blue' : '') }}"></td>
                                @endfor
                                @for ($i = 1; $i <= 9; $i++)
                                    <td class="{{ in_array($i, [3, 6, 7, 8, 9]) ? 'bg-red' : (in_array($i, [4, 5]) ? 'bg-blue' : '') }}"></td>
                                @endfor
                            </tr>
                            <tr>
                                <td colspan="2">
                                    {{-- SN : {{ $item['sn'] }}<br>
                                    Cust : {{ $item['customer'] }}<br>
                                    SO : {{ $item['so'] }} --}}
                                </td>
                                @for ($i = date('j'); $i <= $daysInMonth; $i++)
                                    <td class="{{ $i == 15 ? 'bg-purple' : ($i == 16 ? 'bg-purple' : '') }}">
                                        {{ $i == 15 ? 'P' : ($i == 16 ? 'A' : '') }}
                                    </td>
                                @endfor
                                @for ($i = 1; $i <= 9; $i++)
                                    <td></td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- PIE --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Persentase</h4>
                </div>
                <div class="card-body">
                    <div id="pieChartContainer">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var pieChart = document.getElementById('pieChart').getContext('2d');
    var myPieChart = new Chart(pieChart, {
        type: 'pie',
        data: {
            datasets: [{
                data: [50, 50],
                backgroundColor: ["#1d7af3", "#f3545d"],
                borderWidth: 0
            }],
            labels: ['Done', 'On Going']
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: 'rgb(154, 154)',
                    fontSize: 11,
                    usePointStyle: true,
                    padding: 20
                }
            },
            pieceLabel: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 14,
            },
            tooltips: false,
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    })
</script>
@endsection
