// Gather Max/Min value from my array to handle the max/min value in my chart
var max = Math.max(...maxTemp) + 5;
var min = Math.min(...minTemp) - 5;

var ctxL = document.getElementById("lineChart").getContext('2d');

// Orange gradient
var gradient = ctxL.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(255,160,32,0.9)');
gradient.addColorStop(1, 'rgba(255,160,32,0.1)');

var myLineChart = new Chart(ctxL, {
	type: 'line',
	data: {
		labels: ["0", "1", "2", "3", "4"],
		datasets: [
			{
				data: minTemp,
				fill: false,
				borderColor: '#c8d2ec',
				pointBorderColor: '#828cdb',
				pointBackgroundColor: '#828cdb',
				pointHoverBorderColor: '#828cdb',
				pointHoverBackgroundColor: '#828cdb',
				datalabels: {
					align: 'bottom',
					anchor: 'start'
				}
			},
			{
				data: maxTemp,
				fill: '-1',
				backgroundColor: gradient,
				borderColor: '#ffa321',
				pointBorderColor: '#f58231',
				pointBackgroundColor: '#f58231',
				pointHoverBorderColor: '#f58231',
				pointHoverBackgroundColor: '#f58231',
				datalabels: {
					align: 'top',
					anchor: 'end'
				}
			}
		]
	},
	options: {
		responsive: true,
		legend: false,
		tooltips: false,
		elements: {
			line: {
				tension: 0.1
			}
		},
		scales: {
			xAxes: [{
				display: false,
				offset: true,
			}],
			yAxes: [{
				display: false,
				ticks: {
					suggestedMax: max,
					suggestedMin: min
				}
			}]
		},
		layout: {
			padding: {
				top: 8,
				bottom: 16
			}
		},
		plugins: {
			datalabels: {
				backgroundColor: 'slategrey',
				borderRadius: 8,
				color: 'white',
				font: {
					weight: 'bold',
					size: '14'
				}
			}
		}
	}
});