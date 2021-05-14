$(document).ready(function () {
	// $('#submit_pay_proof').on('click', function(evt){
	// 	// evt.preventDefault();
	// 	$('#payment_proof_attachment').dmUploader('start');
	// 	$('.file-progress').fadeIn('fast');
	// });
});

$(function(){
    $('#jp_image_upload').dmUploader({ //
        url: base_url+'employer/job_posts/post_new/upload_image',
        maxFileSize: 3000000, // 3 Megs max
        auto: false,
        multiple: false,
        queue: false,
        extraData: function(){
            return{
                "white_rice_token":get_rice(),
                "job_post_id":$('#job_post_id').val(),
            };
        },
        onDragEnter: function(){
            // Happens when dragging something over the DnD area
            this.addClass('active');
        },
        onDragLeave: function(){
            // Happens when dragging something OUT of the DnD area
            this.removeClass('active');
        },
        onComplete: function(){
            // All files in the queue are processed (success or error)
            // ui_add_log('All pending tranfers finished');
        },
        onNewFile: function(id, file){
            // When a new file is added using the file selector or the DnD area
            $('#files').fadeIn('fast');
            ui_multi_add_file(id, file);
            $('#btnApiStart').fadeIn('fast');
        },
        onBeforeUpload: function(id){
            // about tho start uploading a file
            ui_multi_update_file_status(id, 'uploading', 'Uploading...');
            ui_multi_update_file_progress(id, 0, '', true);
        },
        onUploadProgress: function(id, percent){
            // Updating file progress
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data){
            // A file was successfully uploaded
            console.log('Server Response for file #' + id + ': ' + JSON.stringify(data));
            heads_up_success('Upload of file #' + id + ' COMPLETED', 'success');
            ui_multi_update_file_status(id, 'success', 'Upload Complete');
            ui_multi_update_file_progress(id, 100, 'success', false);
            $('.file-remove').hide();
			setTimeout(function(){ location.reload()},1000);
        },
        onUploadError: function(id, xhr, status, message){
            heads_up_error();
            ui_multi_update_file_status(id, 'danger', message);
            ui_multi_update_file_progress(id, 0, 'danger', false);
        },
        onFallbackMode: function(){
            // When the browser doesn't support this plugin :(
            console.log('Plugin cant be used here, running Fallback callback', 'danger');
        },
        onFileSizeError: function(file){
            heads_up_warning('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
        }
    });

    /*
      Global controls
    */
    $('#btnApiStart').on('click', function(evt){
        get_rice();
        evt.preventDefault();
        $('#jp_image_upload').dmUploader('start');
        $('.file-progress').fadeIn('fast');
    });

    $('#btnApiCancel').on('click', function(evt){
        evt.preventDefault();
        $('#jp_image_upload').dmUploader('cancel');
    });
});

$(function(){
    $('#jobseeker_resume_file_upload').dmUploader({ //
        url: base_url+'job_seeker/resume/upload_resume_file',
        maxFileSize: 3000000, // 3 Megs max
		extFilter: ["pdf", "doc", "docx"],
        auto: false,
        multiple: false,
        queue: false,
        extraData: function(){
            return{
                "white_rice_token":get_rice(),
                "r_id":new URL(window.location).searchParams.get("cv_id"),
            };
        },
        onDragEnter: function(){
            // Happens when dragging something over the DnD area
            this.addClass('active');
        },
        onDragLeave: function(){
            // Happens when dragging something OUT of the DnD area
            this.removeClass('active');
        },
        onComplete: function(){
            // All files in the queue are processed (success or error)
            // ui_add_log('All pending tranfers finished');
        },
        onNewFile: function(id, file){
            // When a new file is added using the file selector or the DnD area
            $('#files').fadeIn('fast');
            ui_multi_add_file(id, file);
            $('#btnApiStart').fadeIn('fast');

        },
        onBeforeUpload: function(id){
            // about tho start uploading a file
            ui_multi_update_file_status(id, 'uploading', 'Uploading...');
            ui_multi_update_file_progress(id, 0, '', true);
        },
        onUploadProgress: function(id, percent){
            // Updating file progress
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data){
            // A file was successfully uploaded
            console.log('Server Response for file #' + id + ': ' + JSON.stringify(data));
            heads_up_success('Uploading completed');
            ui_multi_update_file_status(id, 'success', 'Upload Complete');
            ui_multi_update_file_progress(id, 100, 'success', false);
            $('.file-remove').hide();
            setTimeout(function(){ location.reload()},1000);
        },
        onUploadError: function(id, xhr, status, message){
            heads_up_error();
            ui_multi_update_file_status(id, 'danger', message);
            ui_multi_update_file_progress(id, 0, 'danger', false);
        },
        onFallbackMode: function(){
            // When the browser doesn't support this plugin :(
            console.log('Plugin cant be used here, running Fallback callback', 'danger');
        },
        onFileSizeError: function(file){
            heads_up_warning('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
        },
		onFileExtError: function (file) {
			heads_up_info("Only PDF and Word Documets types are allowed");
		}
	});

    /*
      Global controls
    */
    $('#btnApiStart').on('click', function(evt){
        get_rice();
        evt.preventDefault();
        $('#jobseeker_resume_file_upload').dmUploader('start');
        $('.file-progress').fadeIn('fast');
    });

    $('#btnApiCancel').on('click', function(evt){
        evt.preventDefault();
        $('#jobseeker_resume_file_upload').dmUploader('cancel');
    });
});


function clear_file_input(that){
	$('.dm-uploader').dmUploader("reset");
    $('.file-input').val(null).trigger('change');
    $('#upload_file').fadeOut('fast');
    $('li.media').fadeOut('fast');
    $('#files').fadeOut('fast');
}

/*
* Some helper functions to work with our UI and keep our code cleaner
*/

function ui_single_update_active(element, active)
{
    element.find('div.file-progress').toggleClass('d-none', !active);
    element.find('input[type="text"]').toggleClass('d-none', active);

    element.find('input[type="file"]').prop('disabled', active);
    element.find('.btn').toggleClass('disabled', active);

    element.find('.btn i').toggleClass('fas-circle-o-notch fa-spin', active);
    element.find('.btn i').toggleClass('fas-folder-o', !active);
}

function ui_single_update_progress(element, percent, active)
{
    active = (typeof active === 'undefined' ? true : active);

    var bar = element.find('div.progress-bar');

    bar.width(percent + '%').attr('aria-valuenow', percent);
    bar.toggleClass('progress-bar-striped progress-bar-animated', active);

    if (percent === 0){
        bar.html('');
    } else {
        bar.html(percent + '%');
    }
}

function ui_single_update_status(element, message, color)
{
    color = (typeof color === 'undefined' ? 'muted' : color);

    element.find('small.status').prop('class','status text-' + color).html(message);
}

// Creates a new file and add it to our list
function ui_multi_add_file(id, file)
{
    var template = $('#files-template').text();
    template = template.replace('%%filename%%', file.name);

    template = $(template);
    template.prop('id', 'uploaderFile' + id);
    template.data('file-id', id);

    $('#files').find('li.empty').fadeOut(); // remove the 'no files yet'
    $('#files').empty(); // remove previous file
    $('#files').prepend(template);
}

// Creates a new file and add it to our list
function ui_multi_add_file_custom(id, file)
{
    var template = $('#files-template').text();
    template = template.replace('%%filename%%', file.name);

    template = $(template);
    template.prop('id', 'uploaderFile' + id);
    template.data('file-id', id);

    $('#files').find('li.empty').fadeOut(); // remove the 'no files yet'
    // $('#files').empty(); // remove previous file
    $('#files').prepend(template);
}

// Creates a new file and add it to our list
function ui_single_add_file_list(id, file)
{
    var template = $('#files-template').text();
    template = template.replace('%%filename%%', file.name);

    template = $(template);
    template.prop('id', 'uploaderFile' + id);
    template.data('file-id', id);

    $('#files').find('li.empty').fadeOut(); // remove the 'no files yet'
    $('#files').empty(); // remove previous file
    $('#files').prepend(template);
}

// Changes the status messages on our list
function ui_multi_update_file_status(id, status, message)
{
    $('#uploaderFile' + id).find('span').html(message).prop('class', 'status text-' + status);
}

// Updates a file progress, depending on the parameters it may animate it or change the color.
function ui_multi_update_file_progress(id, percent, color, active)
{
    color = (typeof color === 'undefined' ? false : color);
    active = (typeof active === 'undefined' ? true : active);

    var bar = $('#uploaderFile' + id).find('div.progress-bar');

    bar.width(percent + '%').attr('aria-valuenow', percent);
    bar.toggleClass('progress-bar-striped progress-bar-animated', active);

    if (percent === 0){
        bar.html('');
    } else {
        bar.html(percent + '%');
    }

    if (color !== false){
        bar.removeClass('bg-success bg-info bg-warning bg-danger');
        bar.addClass('bg-' + color);
    }
}

// Toggles the disabled status of Star/Cancel buttons on one particual file
function ui_multi_update_file_controls(id, start, cancel, wasError)
{
    wasError = (typeof wasError === 'undefined' ? false : wasError);

    $('#uploaderFile' + id).find('button.start').prop('disabled', !start);
    $('#uploaderFile' + id).find('button.cancel').prop('disabled', !cancel);

    if (!start && !cancel) {
        $('#uploaderFile' + id).find('.controls').fadeOut();
    } else {
        $('#uploaderFile' + id).find('.controls').fadeIn();
    }

    if (wasError) {
        $('#uploaderFile' + id).find('button.start').html('Retry');
    }
}
