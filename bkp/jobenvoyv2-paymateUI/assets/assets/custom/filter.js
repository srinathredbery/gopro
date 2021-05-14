$(document).ready(function () {

    let minSal = null;
    let maxSal = null;
    check_time_filter();
    check_job_type_filter();
    check_job_cat_filter();
    check_job_cr_lvl_filter();
    check_gender_filter();
    check_min_max_salary_filter();
    check_job_qualification_filter();
    fill_seach_key();
    fill_country();
    limit_select();

});

$('#job_kw_search_home').keypress(function(e) {
    if(e.which === 13) {
        clear_page_no();
        do_job_search()
    }
});

$('#job_kw_search').keypress(function(e) {
    if(e.which === 13) {
        clear_page_no();
        var q = $(this).val();

        var url_query = window.location.search;

        var url = new URL(window.location);
        var q_fil = url.searchParams.get("q");

        if(q_fil === null)
        {
            if (url_query.indexOf('?') > -1){
                url_query += '&q='+q;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }else{
                url_query += '?q='+q;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }
        }
        else{
            url.searchParams.set("q", q);
            window.history.pushState("object or string", "Title", url);
            window.location.href;
        }
        location.reload();
    }
});

let country_search = $("#search_by_country option:selected").val();

$("#search_by_country").change(function (e) {
    country_search = $(this).find(":selected").val();
});

$('#job_kw_search_btn').click(function(e) {
    clear_page_no();
    do_job_search();
});

function do_job_search(){
    var q = $("#job_kw_search_home").val();

    var url = new URL(window.location);
    var query = url.searchParams.get("q");
    var q_country = url.searchParams.get("loc");
    let new_url = window.location.href;

    if (q && q !== ''){
        if(query === null)
        {
            if (new_url.indexOf('?') > -1){
                new_url += '&q='+q;
                // new_url +=url_query

            }else{
                new_url += 'jobs?q='+q;
                // new_url +=url_query
            }
        }
        else{
            url.searchParams.set("q", q);
            new_url +=url
        }
    }


    if (country_search && country_search !== ''){
        if(q_country === null)
        {
            if (new_url.indexOf('?') > -1){
                new_url += '&country='+country_search;
                // new_url +=url_query

            }else{
                new_url += 'jobs?country='+country_search;
                // new_url +=url_query
            }
        }
        else{
            url.searchParams.set("country", country_search);
            new_url +=url
        }
    }
    if (url != new_url)
        window.location.href = new_url;
}

$("#country_filter").change(function (e) {
    clear_page_no();
    let url_query = window.location.search;
    let url = new URL(window.location);

    let country_filter = $(this).find(":selected").val();

    // let toCur = $('#currency_list').find("option:selected").val();
    let current_country = url.searchParams.get("country");

    if (country_filter && country_filter !== ''){
        if(current_country === null)
        {
            if (url_query.indexOf('?') > -1){
                url_query += '&country='+country_filter;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
                url_query = window.location.search;
            }else{
                url_query += '?country='+country_filter;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
                url_query = window.location.search;
            }
        }
        else{
            url.searchParams.set("country", country_filter);
            window.history.pushState("object or string", "Title", url);
            window.location.href;
            url_query = window.location.search;
        }
    }
    else{
        let filter = "country";

        url = new URL(window.location);
        var filter_type = url.searchParams.get(filter);

        if(filter_type === null)
        {

        }
        else{
            url.searchParams.set(filter,"");
            window.history.pushState("object or string", "Title", url);
            window.location.href;
            clean_empty_url_filters(filter);
            // location.reload();
        }
    }
});

// $('#country_filter').on("select2:unselect", function (e) {
//
// });


$('.job-search-time-filter').on('click', function (e) {
    clear_page_no();
    let a = e.target.value;

    var url_query = window.location.search;

    var url = new URL(window.location);
    var time_fil = url.searchParams.get("time");

    if(time_fil === null)
    {
        if (url_query.indexOf('?') > -1){
            url_query += '&time='+a;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }else{
            url_query += '?time='+a;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }
    }
    else{
        url.searchParams.set("time", a);
        window.history.pushState("object or string", "Title", url);
        window.location.href;
    }
    location.reload();
});

$('.job-type-filter').on('click', function (e) {

    clear_page_no();

    var a = $(e.target).val();
    var che = (e.target.checked) ? 1 : 0;


    var url_query = window.location.search;

    var url = new URL(window.location);
    var job_type_fil = url.searchParams.get("type");

    if(che === 1){
        if(job_type_fil === null){
            if (url_query.indexOf('?') > -1){
                url_query += '&type='+a;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }else{
                url_query += '?type='+a;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }
        }
        else{

            if(job_type_fil.indexOf(a)>-1){

            }
            else{
                url.searchParams.set("type", job_type_fil+','+a);
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }
        }
        $(e.target.id).trigger();
    }
    else if(che===0){

        if(job_type_fil === null){

        }
        else{

            if(job_type_fil.indexOf(','+a)>-1){
                url.searchParams.set("type", job_type_fil.replace(','+a,''));
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }

            else if(job_type_fil.indexOf(a)>-1){
                url.searchParams.set("type", job_type_fil.replace(a,''));
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }
            else{

            }
        }
        clean_empty_url_filters('type');
        $(e.target.id).trigger();
    }
    // location.reload();f
});

$('.job-cat').on('click', function (e) {

    clear_page_no();

    var a = $(e.target).val();
    var che = (e.target.checked) ? 1 : 0;


    var url_query = window.location.search;

    var url = new URL(window.location);
    var job_type_fil = url.searchParams.get("cat");

    if(che === 1){


        if(job_type_fil === null){
            if (url_query.indexOf('?') > -1){
                url_query += '&cat='+a;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }else{
                url_query += '?cat='+a;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }
        }
        else{

            if(job_type_fil.indexOf(a)>-1){

            }
            else{
                url.searchParams.set("cat", job_type_fil+','+a);
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }


        }
        $(e.target.id).trigger();
    }
    else if(che===0){

        if(job_type_fil === null){

        }
        else{

            if(job_type_fil.indexOf(','+a)>-1){
                url.searchParams.set("cat", job_type_fil.replace(','+a,''));
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }

            else if(job_type_fil.indexOf(a)>-1){
                url.searchParams.set("cat", job_type_fil.replace(a,''));
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }
            else{

            }


        }
        clean_empty_url_filters('cat');
        $(e.target.id).trigger();
    }
    // location.reload();
});

$('.car-lvl').on('click', function (e) {

    clear_page_no();

    var a = $(e.target).val();
    var che = (e.target.checked) ? 1 : 0;


    var url_query = window.location.search;

    var url = new URL(window.location);
    var job_type_fil = url.searchParams.get("cr_lvl");

    if(che === 1){


        if(job_type_fil === null){
            if (url_query.indexOf('?') > -1){
                url_query += '&cr_lvl='+a;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }else{
                url_query += '?cr_lvl='+a;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }
        }
        else{

            if(job_type_fil.indexOf(a)>-1){

            }
            else{
                url.searchParams.set("cr_lvl", job_type_fil+','+a);
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }


        }
        $(e.target.id).trigger();
    }
    else if(che===0){

        if(job_type_fil === null){

        }
        else{

            if(job_type_fil.indexOf(','+a)>-1){
                url.searchParams.set("cr_lvl", job_type_fil.replace(','+a,''));
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }

            else if(job_type_fil.indexOf(a)>-1){
                url.searchParams.set("cr_lvl", job_type_fil.replace(a,''));
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }
            else{

            }


        }
        clean_empty_url_filters('cr_lvl');
        $(e.target.id).trigger();
    }
    // location.reload();
});

$('.gender-filter').on('click', function (e) {

    clear_page_no();

    let a = e.target.value;

    var url_query = window.location.search;

    var url = new URL(window.location);
    var time_fil = url.searchParams.get("gen");

    if(time_fil === null)
    {
        if (url_query.indexOf('?') > -1){
            url_query += '&gen='+a;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }else{
            url_query += '?gen='+a;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }
    }
    else{
        url.searchParams.set("gen", a);
        window.history.pushState("object or string", "Title", url);
        window.location.href;
    }
    location.reload();
});


$('.salary-Filter').nstSlider({
    "crossable_handles": false,
    "left_grip_selector": ".leftGrip",
    "right_grip_selector": ".rightGrip",
    "value_bar_selector": ".bar",
    "rounding": 500,
    "value_changed_callback": function (cause, leftValue, rightValue) {
        let cur_code = $('#currency_list').find("option:selected").data("currency_code")+' ';
        $(this).parent().find('.min-salary-label').text(cur_code + leftValue.toLocaleString());
        $(this).parent().find('.max-salary-label').text(cur_code + rightValue.toLocaleString());
        minSal = leftValue;
        maxSal = rightValue;
    },
    "user_mouseup_callback":function (minValue, maxValue) {
        minSal = minValue;
        maxSal = maxValue;
    }
});

$('#currency_list').change(function () {

    let toCur = $(this).find("option:selected").data("currency_code");
    var ex_rate = 1;
    const api_url = base_url+'extras/currency_converter_api?f=USD&t='+toCur;
    $.get(api_url, function (data, status) {
        ex_rate = JSON.parse(data);
        ex_rate =  (Object.values(ex_rate))[0];
        // let new_val = Math.ceil((($('.salary-Filter').data("range_max_usd") * ex_rate)+1)/500)*500;
        let new_val = Math.ceil((($('.salary-Filter').data("range_max_usd") * ex_rate))/500)*500;
        $('.salary-Filter').data("range_max", new_val).nstSlider("refresh");
    });
});

$('#salary-filter').click(function (e) {

    clear_page_no();

    var url_query = window.location.search;
    var url = new URL(window.location);

    let toCur = $('#currency_list').find("option:selected").val();
    var cuCur = url.searchParams.get("cur");

    if(cuCur === null)
    {
        if (url_query.indexOf('?') > -1){
            url_query += '&cur='+toCur;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
            url_query = window.location.search;
        }else{
            url_query += '?cur='+toCur;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
            url_query = window.location.search;
        }
    }
    else{
        url.searchParams.set("cur", toCur);
        window.history.pushState("object or string", "Title", url);
        window.location.href;
        url_query = window.location.search;
    }

    var miSal = url.searchParams.get("mi_sal");

    if(miSal === null)
    {
        if (url_query.indexOf('?') > -1){
            url_query += '&mi_sal='+ minSal;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
            url_query = window.location.search;
        }else{
            url_query += '?mi_sal='+ minSal;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
            url_query = window.location.search;
        }
    }
    else{
        url.searchParams.set("mi_sal", minSal);
        window.history.pushState("object or string", "Title", url);
        window.location.href;
        url_query = window.location.search;
    }


    var mxSal = url.searchParams.get("mx_sal");
    if(mxSal === null)
    {
        if (url_query.indexOf('?') > -1){
            url_query += '&mx_sal='+maxSal;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
            url_query = window.location.search;
        }else{
            url_query += '?mx_sal='+maxSal;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
            url_query = window.location.search;
        }
    }
    else{
        url.searchParams.set("mx_sal", maxSal);
        window.history.pushState("object or string", "Title", url);
        window.location.href;
        url_query = window.location.search;
    }

    location.reload();
});


var minExp, maxExp;

$('.exp-Filter').nstSlider({
    "crossable_handles": false,
    "left_grip_selector": ".leftGrip",
    "right_grip_selector": ".rightGrip",
    "value_bar_selector": ".bar",
    "rounding": 1,
    "value_changed_callback": function (cause, leftValue, rightValue) {
        $(this).parent().find('.min-exp-label').text(leftValue+' year(s)');
        $(this).parent().find('.max-exp-label').text(rightValue+' years');
        minExp = leftValue;
        maxExp = rightValue;
    },
    "user_mouseup_callback":function (minValue, maxValue) {
        minExp = leftValue;
        maxExp = rightValue;
    }
});


$('#exp-filter').click(function (e) {

    clear_page_no();

    var url_query = window.location.search;
    var url = new URL(window.location);

    var miExp = url.searchParams.get("mi_exp");

    if(miExp === null)
    {
        if (url_query.indexOf('?') > -1){
            url_query += '&mi_exp='+ minExp;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }else{
            url_query += '?mi_exp='+ minExp;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }
    }
    else{
        url.searchParams.set("mi_exp", minExp);
        window.history.pushState("object or string", "Title", url);
        window.location.href;
    }


    var mxExp = url.searchParams.get("mx_exp");
    if(mxExp === null)
    {
        if (url_query.indexOf('?') > -1){
            url_query += '&mx_exp='+maxExp;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }else{
            url_query += '?mx_exp='+maxExp;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }
    }
    else{
        url.searchParams.set("mx_exp", maxExp);
        window.history.pushState("object or string", "Title", url);
        window.location.href;
    }

    location.reload();

});

$('.q-lvl').on('click', function (e) {

    clear_page_no();

    var a = $(e.target).val();
    var che = (e.target.checked) ? 1 : 0;


    var url_query = window.location.search;

    var url = new URL(window.location);
    var job_type_fil = url.searchParams.get("q_lvl");

    if(che === 1){


        if(job_type_fil === null){
            if (url_query.indexOf('?') > -1){
                url_query += '&q_lvl='+a;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }else{
                url_query += '?q_lvl='+a;
                window.history.pushState("object or string", "Title", url_query);
                window.location.href;
            }
        }
        else{

            if(job_type_fil.indexOf(a)>-1){

            }
            else{
                url.searchParams.set("q_lvl", job_type_fil+','+a);
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }


        }
        $(e.target.id).trigger();
    }
    else if(che===0){

        if(job_type_fil === null){

        }
        else{

            if(job_type_fil.indexOf(','+a)>-1){
                url.searchParams.set("q_lvl", job_type_fil.replace(','+a,''));
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }

            else if(job_type_fil.indexOf(a)>-1){
                url.searchParams.set("q_lvl", job_type_fil.replace(a,''));
                window.history.pushState("object or string", "Title", url);
                window.location.href;
            }
            else{

            }


        }
        clean_empty_url_filters('q_lvl');
        $(e.target.id).trigger();
    }
    // location.reload();
});


//clear filter methods

//clear checkbox filters
$('.btn-clear-filter').on("click", function (e) {
    let filter = $(e.target).data("action-tag");

    var url = new URL(window.location);
    var filter_type = url.searchParams.get(filter);

    if(filter_type === null)
    {

    }
    else{
        url.searchParams.set(filter,"");
        window.history.pushState("object or string", "Title", url);
        window.location.href;
        clean_empty_url_filters(filter);
		clear_page_no();
        location.reload();
    }
});

$('#clear-salary-filter').click(function (e) {
    var filter = 'mx_sal';
    var filter2 = 'mi_sal';
    var url = new URL(window.location);
    var filter_type = url.searchParams.get(filter);
    var filter_type2 = url.searchParams.get(filter2);

    if(filter_type === null && filter_type2 === null)
    {

    }
    else{
        url.searchParams.set(filter,"");
        url.searchParams.set(filter2,"");
        window.history.pushState("object or string", "Title", url);
        window.location.href;
        clean_empty_url_filters(filter);
        clean_empty_url_filters(filter2);
        clear_page_no();

        location.reload();
    }

});

$('#clear-exp-filter').click(function (e) {
    var filter = 'mx_exp';
    var filter2 = 'mi_exp';
    var url = new URL(window.location);
    var filter_type = url.searchParams.get(filter);
    var filter_type2 = url.searchParams.get(filter2);

    if(filter_type === null && filter_type2 === null)
    {

    }
    else{
        url.searchParams.set(filter,"");
        // window.history.pushState("object or string", "Title", url);
        // window.location.href;
        // clean_empty_url_filters(filter);
        url.searchParams.set(filter2,"");
        window.history.pushState("object or string", "Title", url);
        window.location.href;
        clean_empty_url_filters(filter);
        clean_empty_url_filters(filter2);
		clear_page_no();

        location.reload();
    }

});


//check filters UI on load
function fill_seach_key() {
    var url = new URL(window.location);
    var q = url.searchParams.get("q");

    if(q){
        $('#job_kw_search').val(q);
    }
}
function fill_country() {
    var url = new URL(window.location);
    var q = url.searchParams.get("country");

    if(q){
        $('#country_filter').val(q).trigger('change');
    }
}

function check_time_filter() {
    var url = new URL(window.location);
    var time_fil = url.searchParams.get("time");

    if(time_fil){
        $('#'+time_fil).prop("checked", true);
    }
}

function check_job_type_filter() {

    var url = new URL(window.location);
    var type_filter = url.searchParams.get("type");
    if(type_filter){
        type_filter = type_filter.split(',');
        $.each(type_filter, function (index, value) {
            $('#'+value).prop('checked', true);
        });
    }
}

function check_job_cat_filter() {

    var url = new URL(window.location);
    var type_filter = url.searchParams.get("cat");
    if(type_filter){
        type_filter = type_filter.split(',');
        $.each(type_filter, function (index, value) {
            $('#cat-'+value).prop('checked', true);
        });
    }
}

function check_job_cr_lvl_filter() {

    var url = new URL(window.location);
    var type_filter = url.searchParams.get("cr_lvl");
    if(type_filter){
        type_filter = type_filter.split(',');
        $.each(type_filter, function (index, value) {
            $('#cr_lvl-'+value).prop('checked', true);
        });
    }
}

function check_gender_filter() {
    var url = new URL(window.location);
    var gender_filter = url.searchParams.get("gen");

    if(gender_filter){
        $('#'+gender_filter).prop("checked", true);
    }
}

function check_min_max_salary_filter() {
    var url = new URL(window.location);
    var cur_min_q = url.searchParams.get("mi_sal");
    var cur_max_q = url.searchParams.get("mx_sal");
    var selected_Currency = url.searchParams.get("cur");

    if (selected_Currency !== null){
        $('#currency_list').val(selected_Currency).trigger("chosen:updated");
    }
    if(cur_min_q !== null){
        $('.salary-Filter').data("cur_min", cur_min_q).nstSlider("refresh");
    }
    if (cur_max_q !== null){
        $('.salary-Filter').data("cur_max", cur_max_q).nstSlider("refresh");
    }

}

function check_job_qualification_filter() {
    var url = new URL(window.location);
    var type_filter = url.searchParams.get("q_lvl");
    if(type_filter){
        type_filter = type_filter.split(',');
        $.each(type_filter, function (index, value) {
            $('#q_lvl-'+value).prop('checked', true);
        });
    }
}

function clear_page_no(){

    var url = new URL(window.location);
    var filter_type = url.searchParams.get('per_page');

    if(filter_type === null)
    {

    }
    else{
        url.searchParams.set('per_page',"");
        window.history.pushState("object or string", "Title", url);
        window.location.href;
        clean_empty_url_filters('per_page');
    }
}

function clean_empty_url_filters(get_filter) {
    var dirty_url = new URL(window.location).searchParams.get(get_filter);
    if (dirty_url===''){
        var cur_url = window.location.search;

        if(cur_url.indexOf('&' + get_filter + '=')>-1){
            cur_url = cur_url.replace('&' + get_filter + "=", "");
            window.history.pushState("object or string", "Title", cur_url);

        }

        else if(cur_url.indexOf(get_filter)>-1){
            cur_url = cur_url.replace(get_filter + "=", "");
            window.history.pushState("object or string", "Title", cur_url);
        }

    }
}


/*Show results per page*/
$('#job_post_per_page').change(function () {
    clear_page_no();
    var limit = this.value;

    var url_query = window.location.search;

    var url = new URL(window.location);
    var q_fil = url.searchParams.get("lmt_per");

    if(q_fil === null)
    {
        if (url_query.indexOf('?') > -1){
            url_query += '&lmt_per='+limit;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }else{
            url_query += '?lmt_per='+limit;
            window.history.pushState("object or string", "Title", url_query);
            window.location.href;
        }
    }
    else{
        url.searchParams.set("lmt_per", limit);
        window.history.pushState("object or string", "Title", url);
        window.location.href;
    }
    location.reload();
});

function limit_select() {

    var url = new URL(window.location);
    var limit = url.searchParams.get("lmt_per");

    if(limit){
        $('#job_post_per_page').val(limit).trigger("chosen:updated");
    }
}

