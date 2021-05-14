'use strict';

/* eslint-disable require-jsdoc, no-unused-vars */

var CalendarList = [];

function CalendarInfo() {
    this.id = null;
    this.name = null;
    this.checked = true;
    this.color = null;
    this.bgColor = null;
    this.borderColor = null;
}

function addCalendar(calendar) {
    CalendarList.push(calendar);
}

function findCalendar(id) {
    var found;

    CalendarList.forEach(function(calendar) {
        if (calendar.id === id) {
            found = calendar;
        }
    });

    return found || CalendarList[0];
}

function get_job_calendar() {

    return new Promise( function (resolve, reject) {
        return resolve(
            $.get(base_url+"employer/interview/get_all_interview_calender", function(data, status){
            return data;
        }))
    });
}

function gen_cal_from_db() {
	var calendar;
	var id = 0;

	get_job_calendar().then(function (data) {

		var jc = JSON.parse(data);
		$.each(jc, function (index, value) {
			calendar = new CalendarInfo();
			id += 1;
			calendar.id = value.id;
			calendar.name = value.name;
			calendar.color = value.color;
			calendar.bgColor = value.bgColor;
			calendar.dragBgColor = value.dragBgColor;
			calendar.borderColor = value.borderColor;
			addCalendar(calendar);
		})

		gen_cal();

	}).catch(function () {

	});
}

// set calendars
function gen_cal() {
	var calendarList = document.getElementById('calendarList');
	var html = [];
	CalendarList.forEach(function(calendar, index) {
		html[index] = '<div class="lnb-calendars-item"><label>' +
			'<input type="checkbox" class="tui-full-calendar-checkbox-round" value="' + calendar.id + '" checked>' +
			'<span style="border-color: ' + calendar.borderColor + '; background-color: ' + calendar.bgColor + ';"></span>' +
			'<span>' + calendar.name + '</span>' +
			'</label></div>';
	});
	calendarList.innerHTML = html.join('\n');
}
