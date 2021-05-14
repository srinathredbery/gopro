<!DOCTYPE html>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GA_UID?>"></script>
    <script>
        let ga_uid = "<?php echo GA_UID;?>";
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', ga_uid);
    </script>

    <meta charset="utf-8">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo isset($page_title)? $page_title.DYNAMIC_PAGE_TITLE : STATIC_PAGE_TITLE?></title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="CreativeLayers">
    <meta name="theme-color" content="#040e2b" />
    <meta name="robots" content="noindex">

    <meta property="og:url"           content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo isset($page_title)? $page_title.DYNAMIC_PAGE_TITLE : STATIC_PAGE_TITLE?>" />
    <meta property="og:description"   content="Connecting great candidates with great jobs has been our passion. Find the world’s Best Jobs with us" />

    <meta property="og:image"         content="http://www.RbJobs.com/assets/styles/images/OMRAN_logo.png" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url()?><!--assets/styles/images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" href="<?php echo base_url()?><!--assets/styles/images/favicon/android-icon-192x192.png">
<link rel="shortcut icon" href="<?php echo base_url()?><!--assets/styles/images/favicon/favicon-96x96.png" type="image/png" />
<link rel="manifest" href="<?php echo base_url()?><!--assets/styles/images/favicon/manifest.json">

  

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/css/icons.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/css/fonts/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/css/fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/css/style.css<?php echo '?build='.BUILD_NO?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/css/chosen.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/css/colors/colors.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/css/bootstrap.css" />
<!--    <link rel="stylesheet" type="text/css" href="--><?php //echo base_url()?><!--assets/styles/css/bootstrap-datepicker.css" />-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/ntf/css/ntf.min.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/Croppie-2.6.4/croppie.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/validation/css/bootstrapValidator.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/uploader/css/jquery.dm-uploader.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/editor/ui/trumbowyg.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/Holdon/HoldOn.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/EasyAutocomplete-1.3.5/easy-autocomplete.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2/css/select2.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/datatables.css">

    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css">
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/calender/dist/tui-calendar.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/calender/examples/css/default.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/calender/examples/css/icons.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/css/css-loader.css">
<!--    <link rel="stylesheet" href="--><?php //echo base_url()?><!--assets/plugins/date/css/datepicker.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/css/tempusdominus-bootstrap-4.css">


    <script src="<?php echo base_url() ?>assets/plugins/chartjs-2.7.2/chart.bundle.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/styles/js/jquery.min.js" type="text/javascript"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="<?php echo base_url() ?>assets/custom/time_moment.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>

    <link rel="stylesheet" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/css/custom.css<?php echo '?build='.BUILD_NO?>" />

    <script> var base_url = "<?php echo base_url()?>"; var rice_cookie = null; var current_browsing_user; var logged_in = "<?php echo $this->session->logged_in ?>"  </script>
</head>


