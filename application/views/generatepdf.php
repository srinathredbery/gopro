<!DOCTYPE html>
<html>
<style>
    body{
        font-size:14px;
        font-family: "Times New Roman", Times, serif;
        margin-top: 100px;
    }
</style>
<?php
$title="";
$date="";
$subject="";
$salutation="";
$header="";
$footer="";
$signature="";
for ($i=0; $i<count($active_job_posts); $i++) {
    if ($active_job_posts[$i]['description']!=null) {
        $title = $active_job_posts[$i]['description'];
    } else {
        $title="";
    }
    if ($active_job_posts[$i]['date']!=null) {
        $date = explode(" ", $active_job_posts[$i]['date'])[0];
        $date =DateTime::createFromFormat('Y-m-d', $date)->format('jS F Y');
    } else {
        $date="";
    }
    $subject= $active_job_posts[$i]['subject'];
    $salutation=$active_job_posts[$i]['salutation'];
    $header=$active_job_posts[$i]['header'];
    $footer=$active_job_posts[$i]['footer'];
    $signature=$active_job_posts[$i]['signature'];

    $position=$active_job_posts[$i]['position'];
    break;
}


?>
<head>
    <title><?php echo $title; ?></title>
</head>
<body>
<div class="row">
    <div class="col-md-4">
        <?php echo $date; ?>
    </div>
    <div class="col-md-8">

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <b><h2><?php echo $subject; ?></h2></b>
    </div>
    <div class="col-md-8">

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <b>Dear <?php echo $salutation; ?>,</b>
    </div>
    <div class="col-md-8">

    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12" style="text-align: left;">
        <?php echo $header; ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 text-center" >
        <ul>
        <?php
        for ($i=0; $i<count($active_job_posts); $i++) {
            $type= $active_job_posts[$i]['type'];
            $question= $active_job_posts[$i]['question'];
            $value= $active_job_posts[$i]['value'];
            if ($type==3) {
                echo '<li>'.$question.' :'.$value.'</li> <br>';
            }
            ?> <br> <?php
        }
        ?>
        </ul>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12" style="text-align: left;">
        <?php echo $footer; ?>
    </div>
</div>
<br>
<br>
<br>
<br>
<div class="row">

    <table style="width: 100%;">

        <tr style="width: 100%;">
            <td style="width: 30%;"><?php echo $signature; ?></td>
            <td style="width: 40%;"></td>
            <td style="width: 30%;">................................</td>
        </tr>
        <tr>
            <td  style="width: 30%;"><?php echo $position; ?></td>
            <td  style="width: 40%;"></td>
            <td  style="width: 30%;">You'r Signature / Date</td>
        </tr>
        <tr>
            <td  style="width: 30%;"></td>
            <td  style="width: 40%;"></td>
            <td  style="width: 30%;"> </td>
        </tr>
    </table>



</div>
<div>
    This is a computer generated offer letter and does not require a signature.
</div>

</body>
</html>
