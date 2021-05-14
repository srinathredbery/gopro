$(document).ready(function () {
    get_js_user_growth_yearly();
    get_js_user_growth_overall();
    get_emp_user_growth_yearly();
    get_emp_user_growth_overall();
    get_job_post_growth_overall();
    get_job_post_growth_yearly();
    get_job_post_growth_overall();
    last_five_employers();
    last_five_job_seekers();
    last_five_jobs();
});

var pointStart = Date.UTC(2019,0,1);

var js_user_growth_yearly  = Highcharts.chart('js-user-growth-yearly', {

    chart: {
        height: 250,
    },

    title: {
        text: ''
    },
    yAxis: {
        title: {
            text: 'Number of Users'
        }
    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: [true,true]
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        },
    },

    series: [],

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
    },
    credits: {
        enabled: false
    },

});

var js_user_growth_overall = Highcharts.chart('js-user-growth-overall', {

    chart: {
        height: 250,
    },

    title: {
        text: ''
    },
    yAxis: {
        title: {
            text: 'Number of Users'
        }
    },
    plotOptions : {
        series  : {

        },
    },
    xAxis: {

        labels: {
            rotation: 0
        },

    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: [true,true]
    },

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
    },
    credits: {
        enabled: false
    },

});

var emp_user_growth_yearly  = Highcharts.chart('emp-user-growth-yearly', {

    chart: {
        height: 250,
    },

    title: {
        text: ''
    },
    yAxis: {
        title: {
            text: 'Number of Users'
        }
    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: [true,true]
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        },
    },

    series: [],

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
    },
    credits: {
        enabled: false
    },

});

var emp_user_growth_overall = Highcharts.chart('emp-user-growth-overall', {

    chart: {
        height: 250,
    },

    title: {
        text: ''
    },
    yAxis: {
        title: {
            text: 'Number of Users'
        }
    },
    plotOptions : {
        series  : {

        },
    },
    xAxis: {

        labels: {
            rotation: 0
        },

    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: [true,true]
    },

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
    },
    credits: {
        enabled: false
    },

});

var jobs_growth_yearly = Highcharts.chart('jobs-growth-yearly', {

    chart: {
        height: 250,
    },

    title: {
        text: ''
    },
    yAxis: {
        title: {
            text: 'Number of Users'
        }
    },
    plotOptions : {
        series  : {

        },
    },
    xAxis: {

        labels: {
            rotation: 0
        },

    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: [true,true]
    },

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
    },
    credits: {
        enabled: false
    },

});

var jobs_growth_overall = Highcharts.chart('jobs-growth-overall', {

    chart: {
        height: 250,
    },

    title: {
        text: ''
    },
    yAxis: {
        title: {
            text: 'Number of Users'
        }
    },
    plotOptions : {
        series  : {

        },
    },
    xAxis: {

        labels: {
            rotation: 0
        },

    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: [true,true]
    },

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
    },
    credits: {
        enabled: false
    },

});


$('.chart_change_year').change(function (e) {
    let target_chart =  e.target.id;
    let sel_year = $(this).find(":selected").val();
    switch(target_chart) {
        case "js_grow_chart_year_yearly":
            get_js_user_growth_yearly(sel_year);
            break;
        case "js_grow_chart_year_overall":
            get_js_user_growth_overall(sel_year);
            break;
        case "emp_grow_chart_year_yearly":
            get_emp_user_growth_yearly(sel_year);
            break;
        case "emp_grow_chart_year_overall":
            get_emp_user_growth_overall(sel_year);
            break;
        case "job_grow_chart_year_yearly":
            get_job_post_growth_yearly(sel_year);
            break;
        case "job_grow_chart_year_overall":
            get_job_post_growth_overall(sel_year);
            break;
        default:
        // code block
    }
});

function get_js_user_growth_yearly(year) {
    let sel_year = (year) ? year : new Date().getFullYear();
    let target_chart = 'js_grow_chart_year_annual';

    $.ajax({
        dataType: 'JSON',
        url: base_url+'superuser/get_data/js_user_growth_yearly?sel_year='+sel_year,
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){
            var chart_data = response;

            js_user_growth_yearly.update({
                xAxis: {
                    categories: chart_data.month
                },

                series: [
                    {
                        type: 'column',
                        name: 'New Job Seekers',
                        data: chart_data.count_js,
                        color: 'rgb(87,87,87)',
                    },
                    {
                        type: 'spline',
                        name: 'User Growth',
                        data: chart_data.aggregate_js,
                        color: '#678aef',
                    },
                ],

            }, true, true);
            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}

function get_js_user_growth_overall(year) {
    let sel_year = (year) ? year : new Date().getFullYear();
    let target_chart = 'js_grow_chart_year_overall';
    $.ajax({
        dataType: 'JSON',
        url: base_url+'superuser/get_data/js_user_growth_overall?sel_year='+sel_year,
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){
            var chart_data = response;
            js_user_growth_overall.update({
                xAxis: {
                    categories: chart_data.month
                },

                series: [
                    {
                        type: 'spline',
                        name: 'User Growth',
                        data: chart_data.aggregate_js,
                        color: '#26ae61',
                    },
                ],

            }, true, true);
            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}

function get_emp_user_growth_yearly(year) {
    let sel_year = (year) ? year : new Date().getFullYear();
    let target_chart = 'emp_grow_chart_year_yearly';

    $.ajax({
        dataType: 'JSON',
        url: base_url+'superuser/get_data/emp_user_growth_yearly?sel_year='+sel_year,
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){
            var chart_data = response;

            emp_user_growth_yearly.update({
                xAxis: {
                    categories: chart_data.month
                },

                series: [
                    {
                        type: 'column',
                        name: 'New Employers',
                        data: chart_data.count_emp,
                        color: 'rgb(87,87,87)',
                    },
                    {
                        type: 'spline',
                        name: 'User Growth',
                        data: chart_data.aggregate_emp,
                        color: '#678aef',
                    },
                ],

            }, true, true);
            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}

function get_emp_user_growth_overall(year) {
    let sel_year = (year) ? year : new Date().getFullYear();
    let target_chart = 'emp_grow_chart_year_overall';
    $.ajax({
        dataType: 'JSON',
        url: base_url+'superuser/get_data/emp_user_growth_overall?sel_year='+sel_year,
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){
            var chart_data = response;
            emp_user_growth_overall.update({
                xAxis: {
                    categories: chart_data.month
                },

                series: [
                    {
                        type: 'spline',
                        name: 'User Growth',
                        data: chart_data.aggregate_emp,
                        color: '#26ae61',
                    },
                ],

            }, true, true);
            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}

function get_job_post_growth_yearly(year) {
    let sel_year = (year) ? year : new Date().getFullYear();
    let target_chart = 'job_grow_chart_year_yearly';
    $.ajax({
        dataType: 'JSON',
        url: base_url+'superuser/get_data/job_post_growth_yearly?sel_year='+sel_year,
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){
            var chart_data = response;
            jobs_growth_yearly.update({
                xAxis: {
                    categories: chart_data.month
                },

                series: [
                    {
                        type: 'column',
                        name: 'New Jobs',
                        data: chart_data.count_post,
                        color: 'rgb(87,87,87)',
                    },
                    {
                        type: 'spline',
                        name: 'Total Jobs',
                        data: chart_data.aggregate_post_count,
                        color: '#678aef',
                    },
                ],

            }, true, true);
            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}

function get_job_post_growth_overall(year) {
    let sel_year = (year) ? year : new Date().getFullYear();
    let target_chart = 'job_grow_chart_year_overall';
    $.ajax({
        dataType: 'JSON',
        url: base_url+'superuser/get_data/job_post_growth_overall?sel_year='+sel_year,
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){
            var chart_data = response;
            jobs_growth_overall.update({
                xAxis: {
                    categories: chart_data.month
                },

                series: [
                    {
                        type: 'spline',
                        name: 'Total Jobs',
                        data: chart_data.aggregate_post_count,
                        color: '#26ae61',
                    },
                ],

            }, true, true);
            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}

function last_five_jobs() {
    let target_chart = 'last-5-jobs';
    $.ajax({
        dataType: 'HTML',
        url: base_url+'superuser/Su_dashboard/last_five_jobs',
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){

            $('#last-five-jobs tbody').append(response).hide().slideDown("slow");

            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}

function last_five_job_seekers() {
    let target_chart = 'last-5-jobseekers';
    $.ajax({
        dataType: 'HTML',
        url: base_url+'superuser/Su_dashboard/last_five_job_seekers',
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){

            $('#last-five-js tbody').append(response).hide().slideDown("slow");

            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}

function last_five_employers() {
    let target_chart = 'last-5-employers';
    $.ajax({
        dataType: 'HTML',
        url: base_url+'superuser/Su_dashboard/last_five_employers',
        cache: false,
        beforeSend: toggle_section_loader(target_chart),
        success: function(response){

            $('#last-five-emp tbody').append(response).hide().slideDown("slow");


            toggle_section_loader(target_chart);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggle_section_loader(target_chart);
        }
    });
}


