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
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Biểu đồ</h3>
    </div>
    <div class="card-body">
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
</div>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // hoặc 'line', 'pie', etc.
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Doanh thu',
                data: [12, 19, 3, 5, 2, 3, 7],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection