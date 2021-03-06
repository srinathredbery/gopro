<?php
/**
 * Created by PhpStorm.
 * User: simfyz
 * Date: 2/15/2019
 * Time: 9:26 AM
 */

$banner = $_SERVER['SERVER_NAME'].'/assets/styles/images/email/header-bg.jpg';
$fb_img = $_SERVER['SERVER_NAME'].'/assets/styles/images/email/fb.png';
$linkedin_img = $_SERVER['SERVER_NAME'].'/assets/styles/images/email/in.png';
$twitter_img = $_SERVER['SERVER_NAME'].'/assets/styles/images/email/tt.png';

define('EMAIL_HEADER',
    '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta id="viewport" name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />

<title>Jobenvoy Welcome email</title>


<style>

@media only screen and (max-width: 480px) {	
	table { width: 100%; margin: 0 auto;}
	table tr td { width: 100% !important;}
	.footer{width:100% !important;}
	.form-table{width:100% !important;}
	.form-table tr td{text-align:left; width:auto !important; /*display:block !important;*/ text-align:center !important;}
	.form-table tr td img { width: 55% !important; height:auto !important;}
	.top-banner tr td img{height:auto !important; }
	.mobile-view{display:block !important;}
	.desktp-view{display:none !important;}
	.mobile-device{display:block !important;}
	.noraml-deivice{display:none !important;}
	.mobile-device tr td img{width: 100% !important;}
	
}

@media only screen and (max-width: 640px) {	
	table { width: 100%; margin: 0 auto;}
	table tr td { width: 100% !important;}
	.footer{width:100% !important;}
	.form-table{width:100% !important;}
	.form-table tr td{text-align:left; width:auto !important;}
	#app-img img{padding-bottom:0 !important;}
	.top-banner tr td img{width:100%;}
}

@media only screen and (max-width: 640px) {	
		table { width: auto; margin: 0 auto;}
	   table tr td { width: 100% !important; text-align:center;}
	  .footer{width:100% !important;}
	.form-table{width:100% !important;}
	.form-table tr td{text-align:left; width:auto !important;}
}

span.preheader { display: none !important; }
</style>


</head>

<body bgcolor="#ececec" style="background-color:#ececec; margin-top:0;">
<table border="0" width="600" align="center" bgcolor="#ececec" style="background-color:#ececec; padding:0;">

  <tr style="padding:0;">
    <td style="padding:0;">
    
        <table width="640" style="max-width:640px; border-radius: 6px; margin-top: 10px;" align="center" bordercolor="#f4f4f4" bgcolor="#FFFFFF" cellpadding="5" cellspacing="0" border="0">
        
          <tr>
          
            <td bgcolor="#FFFFFF" style="border-radius: 6px 6px 0 0;">
                
                <table border="0" width="100%" cellpadding="5" cellspacing="0" class="top-banner">
                
                  <tr>
                  
                    <td align="right" width="100%">
                        <a href="#" target="_blank" title="Jobenvoy">
                            <img src="'.$banner.'" title="Jobenvoy" width="100%" alt="Jobenvoy" />
                        </a>
                    </td>
                    
                  </tr>
                  
                </table>
                
            </td>
            
          </tr>
          
          
          <tr bgcolor="#FFFFFF">
          
            <td>
                
                <table border="0" width="100%" cellpadding="25" cellspacing="0" style="width:100% !important;">
                
                  <tr>
                  
                    <td>

');

define('EMAIL_BODY',
    '
         <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 24px; color: #333; line-height: 140%; text-align:justify;font-weight:bold;"><b>Welcome to Jobenvoy.com!</br>Your first step in finding the best job for you.  </b></p>
                        
						<p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 15px; color: #333; line-height: 160%; text-align:justify;font-weight:bold;"><b>Hi</b></p>
                        <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
                        	Thank you for registering with Jobenvoy.com! Check out all the ways you can land the best job on Jobenvoy.com: 
                        </p>
                        
						
						<table border="0" width="100%" cellpadding="15" cellspacing="0" style="width:100% !important;">
							<tr>
								<td>
							<p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
								<b>My Profile:</b> Complete your profile so companies can connect with you directly and
	continue to keep in touch with you.
							</p>
							 <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
								<b>My Resume:</b> Set your job alerts and stay updated with the new jobs that match your search! 
							</p>
							 <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
								<b>My Apply History:</b>  Stay on top of your job search by using your apply history to followup on job applications.
							</p>
								</td>
							</tr>	
                        </table>
    ');

define('EMAIL_FOOTER',
    '
    <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
                        	Thanks for joining Jobenvoy.com. We look forward to help your career search. 
                        </p>
                        
                        <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
                        	Sincerely,
						</p>
						 <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 15px; color: #333; line-height: 160%; text-align:justify;font-weight:bold;"><b>The Jobenvoy Team</b></p>
                        
                        
                    </td>
                    
                  </tr>
                  
                </table>
                
            </td>
            
          </tr>
          
          
          
          <tr>
          
            <td style="padding:0;">
                
                <table border="0" width="100%" cellpadding="6" cellspacing="0" style="border-radius: 0px 0px 6px 6px; background: #1f3864 none repeat scroll 0% 0%; color: #E2E2E2;" class="footer">
                
                  <tr>
				  <td align="center" style="padding-top: 15px;"> 				 
				  <a href="#" target="_blank"><img width="20" height="20" style="margin-right:5px" src="'.$fb_img.'"/></a>
				  <a href="#" target="_blank"><img width="20" height="20" style="margin-right:5px" src="'.$twitter_img.'"/></a>
				  <a href="#" target="_blank"><img width="20" height="20" style="margin-right:5px" src="'.$linkedin_img.'"/></a>
				  </td>
				  
				  </tr> <tr>
                  
                    <td align="center">                    
                        <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 12px; color: #FFF; font-weight:bold; line-height: 140%;margin-top: -10px;">
                        Jobenvoy.com | Level 6 | World Trade Center | Colombo 01. <br />
                            <a href="mailto:info@jobenvoy.com" style="text-decoration:none; color:#FFF;">info@jobenvoy.com</a> | <a href="http://jobenvoy.com/" style="text-decoration:none; color:#FFF;" target="_blank" title="Jobenvoy">www.jobenvoy.com</a>
                        </p>                    
                    </td>
                    
                  </tr>
                </table>
                
            </td>
            
          </tr>
          
          
        </table>

    </td>
  </tr>
</table>







</body>


</html>

    
    ');

define('WELCOME_MAIL',

    '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta id="viewport" name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />

<title>Jobenvoy Welcome email</title>


<style>

@media only screen and (max-width: 480px) {	
	table { width: 100%; margin: 0 auto;}
	table tr td { width: 100% !important;}
	.footer{width:100% !important;}
	.form-table{width:100% !important;}
	.form-table tr td{text-align:left; width:auto !important; /*display:block !important;*/ text-align:center !important;}
	.form-table tr td img { width: 55% !important; height:auto !important;}
	.top-banner tr td img{height:auto !important; }
	.mobile-view{display:block !important;}
	.desktp-view{display:none !important;}
	.mobile-device{display:block !important;}
	.noraml-deivice{display:none !important;}
	.mobile-device tr td img{width: 100% !important;}
	
}

@media only screen and (max-width: 640px) {	
	table { width: 100%; margin: 0 auto;}
	table tr td { width: 100% !important;}
	.footer{width:100% !important;}
	.form-table{width:100% !important;}
	.form-table tr td{text-align:left; width:auto !important;}
	#app-img img{padding-bottom:0 !important;}
	.top-banner tr td img{width:100%;}
}

@media only screen and (max-width: 640px) {	
		table { width: auto; margin: 0 auto;}
	   table tr td { width: 100% !important; text-align:center;}
	  .footer{width:100% !important;}
	.form-table{width:100% !important;}
	.form-table tr td{text-align:left; width:auto !important;}
}

span.preheader { display: none !important; }
</style>


</head>

<body bgcolor="#ececec" style="background-color:#ececec; margin-top:0;">
<table border="0" width="600" align="center" bgcolor="#ececec" style="background-color:#ececec; padding:0;">

  <tr style="padding:0;">
    <td style="padding:0;">
    
        <table width="640" style="max-width:640px; border-radius: 6px; margin-top: 10px;" align="center" bordercolor="#f4f4f4" bgcolor="#FFFFFF" cellpadding="5" cellspacing="0" border="0">
        
          <tr>
          
            <td bgcolor="#FFFFFF" style="border-radius: 6px 6px 0 0;">
                
                <table border="0" width="100%" cellpadding="5" cellspacing="0" class="top-banner">
                
                  <tr>
                  
                    <td align="right" width="100%">
                        <a href="#" target="_blank" title="Jobenvoy">
                            <img src="'.$banner.'" title="Jobenvoy" width="100%" alt="Jobenvoy" />
                        </a>
                    </td>
                    
                  </tr>
                  
                </table>
                
            </td>
            
          </tr>
          
          
          <tr bgcolor="#FFFFFF">
          
            <td>
                
                <table border="0" width="100%" cellpadding="25" cellspacing="0" style="width:100% !important;">
                
                  <tr>
                  
                    <td>
                    
                        <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 24px; color: #333; line-height: 140%; text-align:justify;font-weight:bold;"><b>Welcome to Jobenvoy.com!</br>Your first step in finding the best job for you.  </b></p>
                        
						<p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 15px; color: #333; line-height: 160%; text-align:justify;font-weight:bold;"><b>Hi</b></p>
                        <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
                        	Thank you for registering with Jobenvoy.com! Check out all the ways you can land the best job on Jobenvoy.com: 
                        </p>
                        
						
						<table border="0" width="100%" cellpadding="15" cellspacing="0" style="width:100% !important;">
							<tr>
								<td>
							<p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
								<b>My Profile:</b> Complete your profile so companies can connect with you directly and
	continue to keep in touch with you.
							</p>
							 <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
								<b>My Resume:</b> Set your job alerts and stay updated with the new jobs that match your search! 
							</p>
							 <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
								<b>My Apply History:</b>  Stay on top of your job search by using your apply history to followup on job applications.
							</p>
								</td>
							</tr>	
                        </table>
						
						<p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
                        	Thanks for joining Jobenvoy.com. We look forward to help your career search. 
                        </p>
                        
                        <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 13px; color: #333; line-height: 160%; text-align:justify;">
                        	Sincerely,
						</p>
						 <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 15px; color: #333; line-height: 160%; text-align:justify;font-weight:bold;"><b>The Jobenvoy Team</b></p>
                        
                        
                    </td>
                    
                  </tr>
                  
                </table>
                
            </td>
            
          </tr>
          
          
          
          <tr>
          
            <td style="padding:0;">
                
                <table border="0" width="100%" cellpadding="6" cellspacing="0" style="border-radius: 0px 0px 6px 6px; background: #1f3864 none repeat scroll 0% 0%; color: #E2E2E2;" class="footer">
                
                  <tr>
				  <td align="center" style="padding-top: 15px;"> 				 
				  <a href="#" target="_blank"><img width="20" height="20" style="margin-right:5px" src="'.$fb_img.'"/></a>
				  <a href="#" target="_blank"><img width="20" height="20" style="margin-right:5px" src="'.$twitter_img.'"/></a>
				  <a href="#" target="_blank"><img width="20" height="20" style="margin-right:5px" src="'.$linkedin_img.'"/></a>
				  </td>
				  
				  </tr> <tr>
                  
                    <td align="center">                    
                        <p style="font-family: HelveticaNeue,sans-serif; border-collapse: collapse; font-size: 12px; color: #FFF; font-weight:bold; line-height: 140%;margin-top: -10px;">
                        Jobenvoy.com | Level 6 | World Trade Center | Colombo 01. <br />
                            <a href="mailto:info@jobenvoy.com" style="text-decoration:none; color:#FFF;">info@jobenvoy.com</a> | <a href="http://jobenvoy.com/" style="text-decoration:none; color:#FFF;" target="_blank" title="Jobenvoy">www.jobenvoy.com</a>
                        </p>                    
                    </td>
                    
                  </tr>
                </table>
                
            </td>
            
          </tr>
          
          
        </table>

    </td>
  </tr>
</table>







</body>


</html>');