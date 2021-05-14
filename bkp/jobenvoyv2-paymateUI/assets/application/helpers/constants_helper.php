<?php
/**
 * Created by PhpStorm.
 * User: simfyz
 * Date: 2/15/2019
 * Time: 9:26 AM
 */


//Versions
define('VERSION_NO', get_system_version());
define('BUILD_NO', get_system_build());

define('SYSTEM_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/");

define('USER_PRO_PIC_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/user_dp/');
define('USER_PRO_PIC_READ_DIR', base_url().'uploads/user_dp/');

define('EMP_LOGO_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/employer_logo/');
define('EMP_LOGO_READ_DIR', base_url().'uploads/employer_logo/');

define('EMP_COVER_PIC_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/employer_cover_pic/');
define('EMP_COVER_PIC_READ_DIR', base_url().'uploads/employer_cover_pic/');

define('JOB_POST_IMG_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/job_posts/');
define('JOB_POST_IMG_READ_DIR', base_url().'uploads/job_posts/');

define('ADV_IMG_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/adv_images/');
define('ADV_IMG_READ_DIR', base_url().'uploads/adv_images/');

define('TNX_PROOF_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/tnx_proofs/');
define('TNX_PROOF_READ_DIR', base_url().'uploads/tnx_proofs/');

define('IMAGES_READ_DIR', base_url().'assets/styles/images/');

define('JOB_SEEKER_RESUME_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/resume/');
define('JOB_SEEKER_RESUME_READ_DIR',base_url() .'uploads/resume/');

define('JOB_SEEKER_COVER_LETTER_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/cover_letter/');
define('JOB_SEEKER_COVER_LETTER_READ_DIR',base_url() .'uploads/cover_letter/');

define('BLOG_IMG_SAVE_DIR', $_SERVER["DOCUMENT_ROOT"].base_url().'uploads/blog/');
define('BLOG_IMG_READ_DIR',base_url() .'uploads/blog/');
define('BLOG_DEFAULT_IMG',base_url() .'uploads/blog/');

define('DEFAULT_PRO_PIC', base_url().'assets/styles/images/defaults/pro_pic.png');
define('DEFAULT_EMP_LOGO', base_url().'assets/styles/images/defaults/emp_default_logo.jpg');
define('DEFAULT_RESUME_ICON', base_url().'assets/styles/images/defaults/resume.png');

//Ads
define('ADS_REDIRECT', base_url().'ads/click');
