<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
</head>

<body>
    <div id="container"></div>
</body>

<script src="https://code.highcharts.com/highcharts.js"></script>

<?php
use App\User;
use Illuminate\Support\Facades\DB;

$userData = User::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');
?>

<script type="text/javascript">
    var userData = <?php echo json_encode($userData)?>;

    Highcharts.chart('container', {
        title: {
            text: 'New User Growth'
        },
        xAxis: {
            categories: ['July', 'August', 'September',
                'October', 'November', 'December'
            ]
        },
        yAxis: {
            title: {
                text: 'Number of New Users'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New Users',
            data: userData
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });

</script>

</html>