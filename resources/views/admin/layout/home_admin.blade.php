@extends('admin.layout.admin_template')
@section('title','Trang chủ')
@section('content')
<style>
    .btn-delete-user {
        background-color: red;
        color: white;
        border: none;
        border-radius: 10px;
        margin: 5px 0;
        height: 30px;
    }

    .btn-change-user {
        background-color: #66FF00;
        color: black;
        border: none;
        border-radius: 10px;
        margin: 5px 0;
        height: 30px;
    }

    .input-checkbox {
        text-align: center;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div style="width: 50%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // hoặc 'line', 'pie', v.v.
            data: {
                labels: @json($months),
                datasets: [{
                    label: '# of Orders',
                    data: @json($totals),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection