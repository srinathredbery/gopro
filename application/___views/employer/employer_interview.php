<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-10 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec interview-calender">
                            <h3>Active Job Posts</h3>
                                <div id="lnb">
                                    <div class="lnb-new-schedule">
                                        <button id="btn-new-schedule" type="button"
                                                class="btn btn-default btn-block lnb-new-schedule-btn"
                                                data-toggle="modal">
                                            New schedule
                                        </button>
                                    </div>
                                    <div id="lnb-calendars" class="lnb-calendars">
                                        <div>
                                            <div class="lnb-calendars-item">
                                                <label>
                                                    <input class="tui-full-calendar-checkbox-square" type="checkbox"
                                                           value="all" checked>
                                                    <span></span>
                                                    <strong>View all</strong>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="calendarList" class="lnb-calendars-d1">
                                        </div>
                                    </div>
                                </div>

                                <div id="right">
                                    <div id="menu">
                                    <span class="dropdown">
                                        <button id="dropdownMenu-calendarType"
                                                class="btn btn-default btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="true">
                                            <i id="calendarTypeIcon" class="calendar-icon ic_view_month"
                                               style="margin-right: 4px;"></i>
                                            <span id="calendarTypeName">Dropdown</span>&nbsp;
                                            <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu"
                                            aria-labelledby="dropdownMenu-calendarType">
                                            <li role="presentation">
                                                <a class="dropdown-menu-title" role="menuitem"
                                                   data-action="toggle-daily">
                                                    <i 21class="calendar-icon ic_view_day"></i>Daily
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a class="dropdown-menu-title" role="menuitem"
                                                   data-action="toggle-weekly">
                                                    <i class="calendar-icon ic_view_week"></i>Weekly
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a class="dropdown-menu-title" role="menuitem"
                                                   data-action="toggle-monthly">
                                                    <i class="calendar-icon ic_view_month"></i>Month
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a class="dropdown-menu-title" role="menuitem"
                                                   data-action="toggle-weeks2">
                                                    <i class="calendar-icon ic_view_week"></i>2 weeks
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a class="dropdown-menu-title" role="menuitem"
                                                   data-action="toggle-weeks3">
                                                    <i class="calendar-icon ic_view_week"></i>3 weeks
                                                </a>
                                            </li>
                                            <li role="presentation" class="dropdown-divider"></li>
                                            <li role="presentation">
                                                <a role="menuitem" data-action="toggle-workweek">
                                                    <input type="checkbox" class="tui-full-calendar-checkbox-square"
                                                           value="toggle-workweek"
                                                           checked>
                                                    <span class="checkbox-title"></span>Show weekends
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" data-action="toggle-narrow-weekend">
                                                    <input type="checkbox" class="tui-full-calendar-checkbox-square"
                                                           value="toggle-narrow-weekend">
                                                    <span class="checkbox-title"></span>Narrower than weekdays
                                                </a>
                                            </li>
                                        </ul>
                                    </span>
                                        <span id="menu-navi">
                                        <button type="button" class="btn btn-default btn-sm move-today"
                                                data-action="move-today">Today</button>
                                        <button type="button" class="btn btn-default btn-sm move-day"
                                                data-action="move-prev">
                                            <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm move-day"
                                                data-action="move-next">
                                            <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                                        </button>
                                    </span>
                                        <span id="renderRange" class="render-range"></span>
                                    </div>
                                    <div id="calendar">
                                        <!---->
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="account-popup-area modal-popup-area" id="interview_popup">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>
        <div class="profile-title">
            <h3>Schedule an Interview</h3>
        </div>
        <form class="form-resume-add-item" id="work-exp">
            <div class="resumeadd-form">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pf-title">Select Job Opening <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <select name="" id= "" class="chosen">
                                <?php
                                if (isset($interview_schedules) && !empty($interview_schedules)) {
                                    foreach ($interview_schedules as $schedule) {
                                        ?>
                                        <option value="<?php echo !empty($schedule['job_post_id']) ? $schedule['job_post_id'] : '' ?>">
                                            <?php echo !empty($schedule['job_post_title']) ? $schedule['job_post_title'] : ''?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="pf-title">Interview Date <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input type="text" class="datetimepicker-input date-picker" id="interview_date" data-toggle="datetimepicker" data-target="#interview_date"/>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <span class="pf-title">Start Time <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input type="text" class="datetimepicker-input time-picker" id="interview_start_time" data-toggle="datetimepicker" data-target="#interview_start_time"/>



                        </div>
                    </div>
                    <div class="col-lg-3">
                        <span class="pf-title">End Time <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input type="text" class="datetimepicker-input time-picker" id="interview_end_time" data-toggle="datetimepicker" data-target="#interview_end_time"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn-orange col-lg-3 col-md-3 offset-md-9" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/snip/dist/tui-code-snippet.js"></script>
<!--<script type="text/javascript" src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>-->
<!--<script type="text/javascript" src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chance/1.0.13/chance.min.js"></script>

<script src="<?php echo base_url() ?>assets/plugins/calender/dist/tui-calendar.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/calender/examples/js/data/calendars.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/calender/examples/js/data/schedules.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/calender/examples/js/app.js" type="text/javascript"></script>






