$(document).ready(function () {
	get_profile_percentage();
});

// Uncomment to style it like Apple Watch
if (!Highcharts.theme) {
    Highcharts.setOptions({
        chart: {
            backgroundColor: 'transparent'
        },
        colors: ['#28a745', '#28a745', '#0CCDD6'],
        title: {
            style: {
                color: 'silver'
            }
        },
        tooltip: {
            style: {
                color: 'black'
            }
        }
    });
}
//
/**
 * In the chart render event, add icons on top of the circular shapes
 */
// function renderIcons() {

	// Move icon
	// if (!this.series[0].icon) {
	// 	this.series[0].icon = this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8])
	// 		.attr({
	// 			stroke: '#303030',
	// 			'stroke-linecap': 'round',
	// 			'stroke-linejoin': 'round',
	// 			'stroke-width': 2,
	// 			zIndex: 10
	// 		})
	// 		.add(this.series[0].group);
	// }
	// this.series[0].icon.translate(
	// 	this.chartWidth / 2 - 10,
	// 	this.plotHeight / 2 - this.series[0].points[0].shapeArgs.innerR -
	// 	(this.series[0].points[0].shapeArgs.r - this.series[0].points[0].shapeArgs.innerR) / 2
	// );
// }

var profile_percentage  = Highcharts.chart('pro-progress', {

	chart: {
		type: 'solidgauge',
		height: '135%',
		// events: {
			// render: renderIcons
		// }
	},

	title: {
		text: '',
		align: 'center',
		verticalAlign: 'middle',
		style: {
			fontSize: '14px',
			fontWeight: 'bold',
			color: 'rgba(255,136,37,0.85)'
		}
	},

	// tooltip: {
	// 	borderWidth: 0,
	// 	backgroundColor: 'none',
	// 	shadow: false,
	// 	style: {
	// 		fontSize: '12px'
	// 	},
	// 	pointFormat: '{series.name}<br><span style="font-size:2em; color: {point.color}; font-weight: bold">{point.y}%</span>',
	// 	positioner: function (labelWidth) {
	// 		return {
	// 			x: (this.chart.chartWidth - labelWidth) / 2,
	// 			y: (this.chart.plotHeight / 2) + 15
	// 		};
	// 	}
	// },

	pane: {
		startAngle: 0,
		endAngle: 360,
		background: [{ // Track for Move
			outerRadius: '100%',
			innerRadius: '75%',
			backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[0])
				.setOpacity(0.3)
				.get(),
			borderWidth: 0
		},
		// 	{ // Track for Exercise
		// 	outerRadius: '99%',
		// 	innerRadius: '87%',
		// 	backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[1])
		// 		.setOpacity(0.3)
		// 		.get(),
		// 	borderWidth: 0
		// }, { // Track for Stand
		// 	outerRadius: '86%',
		// 	innerRadius: '74%',
		// 	backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[2])
		// 		.setOpacity(0.3)
		// 		.get(),
		// 	borderWidth: 0
		// }
		]
	},

	yAxis: {
		min: 0,
		max: 100,
		lineWidth: 0,
		tickPositions: []
	},

	plotOptions: {
		solidgauge: {
			dataLabels: {
				enabled: false
			},
			linecap: 'round',
			stickyTracking: false,
			rounded: true
		}
	},

	credits: {
		enabled: false
	},
});

function get_profile_percentage() {
	let target_chart = 'profile-progress';
	$.ajax({
		dataType: 'JSON',
		url: base_url+'job_seeker/profile/get_profile_fill',
		cache: false,
		beforeSend: toggle_section_loader(target_chart),
		success: function(response){
			profile_percentage.update({
				title:{
					text: (response.overall) ? response.overall+'%': ''
				},
				series: [{
					name: 'Overall',
					data: [{
						color: Highcharts.getOptions().colors[0],
						radius: '100%',
						innerRadius: '75%',
						y: (response.overall) ? response.overall: 0
					}]
				},
				// 	{
				// 	name: 'Personal Info',
				// 	data: [{
				// 		color: Highcharts.getOptions().colors[1],
				// 		radius: '99%',
				// 		innerRadius: '87%',
				// 		y: (response.resume) ? response.resume: 0
				// 	}]
				// }, {
				// 	name: 'Professional Info',
				// 	data: [{
				// 		color: Highcharts.getOptions().colors[2],
				// 		radius: '86%',
				// 		innerRadius: '74%',
				// 		y: (response.profile) ? response.profile: 0
				// 	}]
				// }
				]

			}, true, true);
			$('#remaining-progress').text('Complete rest of the ' + (100 - response.overall) + '%');
			toggle_section_loader(target_chart);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			toggle_section_loader(target_chart);
		}
	});
}
