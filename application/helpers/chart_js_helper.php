<!-- 
		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: 'Dataset 1',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}, {
				label: 'Dataset 2',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Chart.js Bar Chart'
					}
				}
			});

		}; -->

<?php
function chartjs($setdata, $type)
{
    $setdataa =
        [
            'labels' => ["20201", "20202", "20191", "20192"],
            'datasets' =>
            [
                'label' => 'Label 1',
                'data' => [1, 3, 2, 4]
            ],
            [
                'label' => 'Label 2',
                'data' => [1, 3, 2, 4]
            ],
        ];
    $temp = 'var config = { type: "' . $type . '" , data : { labels :[';
    foreach ($setdata['labels'] as $lb) {
        $temp .= '"' . $lb . '",';
    }
    $temp .= '],datasets:[';
    foreach ($setdata['datasets'] as $ds) {
        $temp .= '{label: "' . $ds['label'] . '",
                    backgroundColor: "#f0ff0f",
                    borderColor: "#f0ff0f",
                    borderWidth: 1,
                    data: [';
        foreach ($ds['data'] as $dt) {
            $temp .= $dt . ",";
        }
        $temp .= ']},';
    }
    $temp .= ']},
    options: {
        responsive: true,
        title: {
            display: true,
            text: "Chart.js Line Chart"
        },
        tooltips: {
            mode: "index",
            intersect: false,
        },
        hover: {
            mode: "nearest",
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: "Month"
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: "Value"
                }
            }]
        }}}';
    return $temp;
}
