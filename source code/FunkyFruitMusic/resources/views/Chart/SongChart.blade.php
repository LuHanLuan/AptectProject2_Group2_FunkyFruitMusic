<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
</head>

<body>
    <div id="container1"></div>
</body>

<script src="https://code.highcharts.com/highcharts.js"></script>

<?php
use App\Song;
use Illuminate\Support\Facades\DB;

$songData = Song::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');
?>

<script type="text/javascript">
    var songData = <?php echo json_encode($songData)?>;

    Highcharts.chart('container1', {
        title: {
            text: 'New Songs 2020'
        },
        xAxis: {
            categories: ['January','February','March','April','May','June','July', 'August', 'September',
                'October', 'November', 'December'
            ]
        },
        yAxis: {
            title: {
                text: 'Number of New Songs'
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
            name: 'New Songs',
            data: songData
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