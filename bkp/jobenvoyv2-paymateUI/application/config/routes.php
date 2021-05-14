<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|   example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|   https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|   $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|   $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|   $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|       my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'home/view_home';
$route['404_override'] = 'extras/error_404';
$route['403_override'] = 'extras/error_403';
$route['error_not_authorized'] = 'extras/error_not_authorized';
$route['translate_uri_dashes'] = false;

$route['generatepdf'] = "welcome/convertpdf";
$route['convertpdfnew'] = "welcome/convertpdfnew";


$route['partner/:any'] = 'home/partner';


/* ***************
 *  Authentication
 * ***************/

//public urls

$route['login']='authentication/show_login';
$route['signup']='authentication/show_sign_up';
$route['logout']='authentication/logout';
$route['forgot_password']='authentication/view_password_reset';
$route['recover_account']='authentication/show_new_password_form';

$route['set_new_password']='authentication/perform_password_reset';
$route['change_new_password']='authentication/validate_password_change';
$route['request_password_reset']='authentication/reset_password';
$route['login_status']='authentication/check_user_login_status';

$route['dashboard']='navigation_control/redirect_dashboard';

//send Contact details
$route['send_cont_details']='authentication/send_cont_details';


//Protection
$route['rice_cookie'] = 'authentication/generate_csrf_token';

$route['confirm_email']='authentication/verify_email';
$route['confirm_email/(:any)']='authentication/verify_email/$1';
$route['confirm_email/(:any)/(:any)']='authentication/verify_email/$1';
$route['confirm_email/(:any)/(:any)/(:any)']='authentication/verify_email/$1';
$route['confirm_email/(:any)/(:any)/(:any)/(:any)']='authentication/verify_email/$1';

//Job routes
$route['jobs'] = "job/job_listing/view_job_ads";
$route['jobs/view_job_post'] = 'job/job_view/view_job_post';

$route['overseas_jobs'] = "job/job_listing/view_overseas_job_ads";


/* API or Services */
$route['api/get_job_list'] = 'job/job_listing/get_job_list';
$route['api/companies_list'] = 'superuser/su_ads/get_company_list';


/*
 ********
 *  Jobseeker *
 ********
 */
$route['job_seeker'] = 'navigation_control/redirect_dashboard';
$route['job_seeker/dashboard'] = 'job_seeker/job_seeker_dashboard';
$route['job_seeker/profile/my_profile'] = 'job_seeker/job_seeker_profile/job_seeker_view_profile';
$route['job_seeker/profile/upload_dp'] = 'job_seeker/job_seeker_profile/upload_profile_pic';

//profile completeness chart
$route['job_seeker/profile/get_profile_fill'] = 'job_seeker/job_seeker_profile/calculate_resume_fill_status';

//$route['job_seeker/resume'] = 'job_seeker/job_seeker_resume/job_seeker_view_resumes';
$route['job_seeker/resume/add_new'] = 'job_seeker/job_seeker_resume/job_seeker_add_new_resume';
$route['job_seeker/resume/view'] = 'job_seeker/job_seeker_public_profile/view_job_seeker_profile';

$route['job_seeker/job_seeker_resume/add_resume_video'] = 'job_seeker/job_seeker_resume/add_resume_video';


$route['job_seeker/resume/new'] = 'job_seeker/job_seeker_resume/job_seeker_new_resume';

$route['job_seeker/resume/save_new'] = 'job_seeker/job_seeker_resume/job_seeker_save_new_resume';
$route['job_seeker/resume/delete'] = 'job_seeker/job_seeker_resume/job_seeker_delete_resume';

$route['job_seeker/resume/add_about'] = 'job_seeker/job_seeker_resume/add_resume_about';
$route['job_seeker/resume/add_info'] = 'job_seeker/job_seeker_resume/add_resume_item';
$route['job_seeker/resume/del_res_section_item'] = 'job_seeker/job_seeker_resume/delete_resume_item';
$route['job_seeker/resume/edit_resume_item'] = 'job_seeker/job_seeker_resume/get_resume_data';

$route['job_seeker/resume/set_default'] = 'job_seeker/job_seeker_resume/set_default_resume';

$route['job_seeker/resume/upload_resume_file'] = 'job_seeker/job_seeker_resume/upload_resume';
$route['job_seeker/resume/delete_resume_file'] = 'job_seeker/job_seeker_resume/delete_resume_file_attachment';

$route['job_seeker/cover_letter'] = 'job_seeker/job_seeker_cover_letter/view_cover_letter';
$route['job_seeker/cover_letter/edit'] = 'job_seeker/job_seeker_cover_letter/get_cover_letter';
$route['job_seeker/cover_letter/delete'] = 'job_seeker/job_seeker_cover_letter/delete_cover_letter';
$route['job_seeker/cover_letter/delete_cover_file'] = 'job_seeker/job_seeker_cover_letter/delete_cover_file_attachment';

$route['job_seeker/find_jobs/saved'] = 'job_seeker/job_seeker_find_jobs/view_shortlisted_jobs';
$route['job_seeker/find_jobs/save_this_job'] = 'job_seeker/job_seeker_find_jobs/save_this_job';

$route['job_seeker/applied_jobs'] = 'job_seeker/Job_seeker_job_applications/view_application_history';

$route['job_seeker/applied_jobs_interview']= 'job_seeker/Job_seeker_job_applications/view_application_history_interview';

$route['job_seeker/find_jobs/apply'] = 'job_seeker/job_seeker_job_applications';
$route['job_seeker/find_jobs/apply'] = 'job_seeker/job_seeker_job_applications';
$route['job_seeker/application/get_resumes'] = 'job_seeker/job_seeker_job_applications/get_jobseeker_resume_letter';
$route['job_seeker/application/get_selected_cover_letter'] = 'job_seeker/job_seeker_job_applications/get_selected_cover_letter';
$route['job_seeker/application/get_selected_resume'] = 'job_seeker/job_seeker_job_applications/get_selected_resume';
$route['job_seeker/application/send_application'] = 'job_seeker/job_seeker_job_applications/receive_job_application';
$route['job_seeker/application/withdraw_application'] = 'job_seeker/job_seeker_job_applications/withdraw_application';
$route['job_seeker/application/re_apply'] = 'job_seeker/job_seeker_job_applications/reapply_application';

$route['job_seeker/job_alerts'] = 'job_seeker/job_seeker_job_alerts/manage_job_alerts';
$route['job_seeker/job_alerts/subscribe'] = 'job_seeker/job_seeker_job_alerts/subscribe_job_alerts';
$route['job_seeker/job_alerts/subscribe/edit'] = 'job_seeker/job_seeker_job_alerts/edit_alert_frequency';
$route['job_seeker/job_alerts/un_subscribe'] = 'job_seeker/job_seeker_job_alerts/un_subscribe';

$route['job_seeker/change_password'] = 'authentication/view_change_account_password';


/*
 ********
 *  Employer  *
 ********
 */

$route['employer'] = 'navigation_control/redirect_dashboard';
$route['employer/dashboard'] = 'employer/employer_dashboard';



/*Employer profile*/
$route['employer/account/profile'] = 'employer/employer_profile/view_employer_profile';
$route['employer/account/profile/upload_logo'] = 'employer/employer_profile/upload_company_logo';
$route['employer/account/profile/upload_cover'] = 'employer/employer_profile/upload_company_cover_photo';
$route['employer/account/profile/delete_image'] = 'employer/employer_profile/delete_image';
$route['employer/account/profile/update'] = 'employer/employer_profile/save_employer_profile';





$route['employer/job_posts/ats_result_change_status'] = 'employer/employer_post_job/ats_result_change_status';

/*Employer job posts new*/
$route['employer/job_posts/load_profile']= 'employer/employer_post_job/load_profile';
$route['employer/job_posts/post_new'] = 'employer/employer_post_job/view_post_editor';


$route['employer/job_posts/remove_bucket'] = 'employer/employer_post_job/remove_bucket';

$route['employer/job_posts/ats_post_level_update'] = 'employer/employer_post_job/ats_post_level_update';




$route['employer/job_posts/post_new/post'] = 'employer/employer_post_job/make_new_post'; //to save post to db
$route['employer/job_posts/post_new/save_draft'] = 'employer/employer_post_job/save_draft_post'; //to save post to db

$route['employer/job_posts/add_questionnaire'] = 'employer/employer_post_job/add_questionnaire'; //add quz to post
$route['employer/job_posts/edit_questionnaire'] = 'employer/employer_post_job/edit_questionnaire';





$route['employer/job_posts/addratings'] = 'employer/employer_post_job/addratings'; //add quz to post


/*Employer jobposts existing*/
$route['employer/job_posts/drafts'] = 'employer/employer_post_job/view_drafts_job_posts';
$route['employer/job_posts/drafts/edit'] = 'employer/employer_post_job/view_post_editor';
$route['employer/job_posts/drafts/delete'] = 'employer/employer_post_job/delete_drafts_job_post';
$route['employer/job_posts/drafts/ats_update_short_answer'] = 'employer/employer_post_job/delete_drafts_job_post';
$route['employer/job_posts/ats_offer_latter_comapny']= 'employer/employer_post_job/ats_offer_latter_comapny';
$route['employer/job_posts/ats_exam_setup_candidate']= 'employer/employer_post_job/ats_exam_setup_candidate';


$route['employer/job_posts/active'] = 'employer/employer_post_job/view_active_job_posts';
$route['employer/job_posts/expired'] = 'employer/employer_post_job/view_expired_job_posts';
$route['employer/job_posts/active/edit'] = 'employer/employer_post_job/view_post_editor';
$route['employer/job_posts/active/edit/delete_image'] = 'delete_resume_file_attachment';
$route['employer/job_posts/post_new/upload_image'] = 'employer/employer_post_job/upload_job_post_image';
$route['employer/job_posts/edit/delete_image'] = 'employer/employer_post_job/delete_post_file_attachment';

$route['employer/job_posts/ats_post_job'] = 'employer/employer_post_job/ats_post_job';
$route['employer/job_posts/ats_employer_job_post_ats_filter'] = 'employer/employer_post_job/ats_post_job_ats_filter';
$route['employer/job_posts/ats_post_job_load'] = 'employer/employer_post_job/ats_post_job_load';
$route['employer/job_posts/ats_exam_assing_emp_view']='employer/employer_post_job/ats_exam_assing_emp_view';
$route['employer/job_posts/ats_get_location']='employer/employer_post_job/ats_get_location';
$route['employer/job_posts/ats_get_contact']='employer/employer_post_job/ats_get_contact';
$route['employer/job_posts/ats_overall_data']='employer/employer_post_job/ats_overall_data';

$route['employer/job_posts/ats_exam_schedule_emp_view']='employer/employer_post_job/ats_exam_schedule_emp_view';
$route['employer/job_posts/ats_set_doc_data']='employer/employer_post_job/ats_set_doc_data';
$route['employer/job_posts/ats_update_short_answer']='employer/employer_post_job/ats_update_short_answer';

$route['employer/applications_received2'] = 'employer/employer_received_application/ats_view_all_applications';
//ats_exam_save
$route['employer/job_posts/ats_exam_save'] = 'employer/employer_post_job/ats_exam_save';
$route['employer/job_posts/ats_form_save'] = 'employer/employer_post_job/ats_form_save';
//employer/job_posts/ats_offer_latter_save
$route['employer/job_posts/ats_offer_latter_save'] = 'employer/employer_post_job/ats_offer_latter_save';
$route['employer/job_posts/ats_exam_assing_job'] = 'employer/employer_post_job/ats_exam_assing_job';
$route['employer/job_posts/ats_exam_assing_emp'] = 'employer/employer_post_job/ats_exam_assing_emp';
$route['employer/job_posts/ats_interview_confirm'] = 'employer/employer_post_job/ats_interview_confirm';

//employer/job_posts/ats_interview_confirm

$route['employer/job_posts/ats_question_save'] = 'employer/employer_post_job/ats_question_save';//employer/job_posts/ats_question_delete
$route['employer/job_posts/ats_question_delete'] = 'employer/employer_post_job/ats_question_delete';
$route['employer/job_posts/ats_question_load'] = 'employer/employer_post_job/ats_question_load';
$route['employer/job_posts/ats_question_form_delete'] = 'employer/employer_post_job/ats_question_form_delete';
//employer/job_posts/ats_question_offer_latter_delete
$route['employer/job_posts/ats_question_offer_latter_delete'] = 'employer/employer_post_job/ats_question_offer_latter_delete';
$route['employer/job_posts/ats_question_save_form'] = 'employer/employer_post_job/ats_question_save_form';
$route['employer/job_posts/ats_question_save_offer_latter'] = 'employer/employer_post_job/ats_question_save_offer_latter';
$route['employer/job_posts/load_exam'] = 'employer/employer_post_job/load_exam';
$route['employer/job_posts/load_exam_form'] = 'employer/employer_post_job/load_exam_form';
$route['employer/job_posts/load_exam_form2'] = 'employer/employer_post_job/load_exam_form2';
$route['employer/job_posts/load_exam_offer_later'] = 'employer/employer_post_job/load_exam_offer_later';
$route['employer/job_posts/load_exam_write_answer'] = 'employer/employer_post_job/load_exam_write_answer';
$route['employer/job_posts/ats_exam_summary'] = 'employer/employer_post_job/ats_exam_summary';
$route['employer/job_posts/ats_exam_summary_level'] = 'employer/employer_post_job/ats_exam_summary_level';
$route['employer/job_posts/ats_exam_delete'] = 'employer/employer_post_job/ats_exam_delete';
$route['job_seeker/job_posts_view/ats_exam_do'] = 'job_seeker/Job_seeker_job_alerts/ats_exam_do';
///

$route['job_seeker/job_posts_view/ats_post_job_view'] = 'job_seeker/job_seeker_job_alerts/ats_post_job_view';
$route['job_seeker/job_posts_view/ats_exam_summary'] = 'job_seeker/job_seeker_job_alerts/ats_exam_summary';
$route['job_seeker/job_posts/ats_setup_exam_maker'] = 'job_seeker/job_seeker_job_alerts/ats_setup_exam_maker';
$route['job_seeker/job_posts/load_exam'] = 'job_seeker/job_seeker_job_alerts/load_exam';
$route['job_seeker/job_posts/ats_exam_assing_emp'] = 'job_seeker/job_seeker_job_alerts/ats_exam_assing_emp';
$route['job_seeker/job_posts_view/ats_interview_confirm'] = 'job_seeker/job_seeker_job_alerts/ats_interview_confirm';

//employer/job_posts/ats_overall_data_add
$route['employer/job_posts/ats_overall_data_add'] = 'employer/employer_post_job/ats_overall_data_add';
$route['employer/job_posts/ats_setup_exam'] = 'employer/employer_post_job/ats_setup_exam';
$route['employer/job_posts/ats_setup_exam_maker'] = 'employer/employer_post_job/ats_setup_exam_maker';
$route['employer/job_posts/ats_setup_exam_maker_mark'] = 'employer/employer_post_job/ats_setup_exam_maker_mark';
$route['employer/job_posts/ats_setup_exam_maker_next'] = 'employer/employer_post_job/ats_setup_exam_maker_next';
$route['employer/job_posts/ats_setup_exam_maker_result'] = 'employer/employer_post_job/ats_setup_exam_maker_result';
$route['employer/job_posts/ats_result'] = 'employer/employer_post_job/ats_result';
$route['employer/job_posts/ats_Interviewee'] = 'employer/employer_post_job/ats_ats_Interviewee';
///employer/job_posts/ats_interviewee_list
$route['employer/job_posts/ats_interviewee_list'] = 'employer/employer_post_job/ats_interviewee_list';
$route['employer/job_posts/ats_interviewee_form'] = 'employer/employer_post_job/ats_interviewee_form';
$route['employer/job_posts/ats_interviewee_offer_latter']= 'employer/employer_post_job/ats_interviewee_offer_latter';
$route['employer/job_posts/ats_interviewee_form_details'] = 'employer/employer_post_job/ats_interviewee_form_details';
$route['employer/job_posts/ats_interviewee_form_maker'] = 'employer/employer_post_job/ats_interviewee_form_maker';
//employer/job_posts/ats_interviewee_offer_latter_maker
$route['employer/job_posts/ats_interviewee_offer_latter_maker'] = 'employer/employer_post_job/ats_interviewee_offer_latter_maker';


$route['employer/job_posts/ats_interviewee_form_maker'] = 'employer/employer_post_job/ats_interviewee_form_maker';


$route['employer/job_posts/ats_interviewee_form_maker_view']='employer/employer_post_job/ats_interviewee_form_maker_view';
//employer/job_posts/ats_interviewee_form_maker_save
$route['employer/job_posts/ats_interviewee_form_maker_save'] = 'employer/employer_post_job/ats_interviewee_form_maker_save';
$route['employer/job_posts/ats_setup_exam_view'] = 'employer/employer_post_job/ats_setup_exam_view';
$route['employer/job_posts/ats_exam_ctg'] = 'employer/employer_post_job/ats_exam_ctg';
$route['employer/job_posts/ats_emp_wise_answer']='employer/employer_post_job/ats_emp_wise_answer';
$route['employer/job_posts/ats_emp_schedule_exam']='employer/employer_post_job/ats_emp_schedule_exam';

$route['employer/job_posts/inactive'] = 'employer/employer_post_job/view_inactive_job_posts';
$route['employer/job_posts/set_status'] = 'employer/employer_post_job/post_status_switcher';
$route['employer/job_posts/ats_save_interviewer'] = 'employer/employer_post_job/ats_save_interviewer';
//employer/job_posts/ats_save_interviewer_details
$route['employer/job_posts/ats_save_interviewer_details'] ='employer/employer_post_job/ats_save_interviewer_details';
$route['employer/job_posts/ats_delete_interviewer'] ='employer/employer_post_job/ats_delete_interviewer';
$route['employer/job_posts/ats_delete_interviewer_form'] ='employer/employer_post_job/ats_delete_interviewer_form';
$route['employer/job_posts/ats_delete_interviewer_offer_latter'] ='employer/employer_post_job/ats_delete_interviewer_offer_latter';
$route['employer/job_posts/ats_delete_interviewer_details'] ='employer/employer_post_job/ats_delete_interviewer_details';
$route['employer/job_posts/get_data_emp_mcq'] ='employer/employer_post_job/get_data_emp_mcq';
$route['employer/job_posts/get_data_emp_short_answer'] ='employer/employer_post_job/get_data_emp_short_answer';
$route['employer/job_posts/get_tot_percentage'] ='employer/employer_post_job/get_tot_percentage';
///
/* Employer Application and Interview */
$route['employer/applications_received'] = 'employer/employer_received_application/view_all_applications';
$route['employer/employer_list'] = 'employer/employers';
$route['employer/applications_received/view_candidate/cover_letter'] = 'employer/employer_received_application/view_cover_letter';

//Purchase Post Plans
$route['employer/subscription/tnx_history'] = 'employer/employer_transactions/transaction_history';
$route['employer/transactions/process_payment/pay_offline'] = 'employer/employer_transactions/process_offline_transaction';
$route['employer/transactions/submit_proof'] = 'employer/employer_transactions/submit_transaction_proof_uploads';
$route['employer/transactions/revoke'] = 'employer/employer_transactions/revoke_pending_tnx';

//Freebutton
$route['employer/transactions/process_payment/pay_offline2'] = 'employer/employer_transactions/process_offline_transaction2';

$route['employer/subscription/plans'] = 'employer/employer_payment_plans/view_plans';
$route['employer/subscription/plans/view_plan'] = 'employer/employer_payment_plans/view_plan';
$route['employer/subscription/plans/place_order'] = 'employer/employer_payment_plans/place_job_post_package_order';
$route['employer/subscription/plans/place_order2'] = 'employer/employer_payment_plans/place_job_post_package_order2';

$route['employer/orders/summary'] = 'employer/employer_payment_plans/order_summary';

//Interview
$route['employer/interview/calendar'] = 'employer/employer_interview';
$route['employer/interview/create_interview_calender'] = 'employer/employer_interview/create_job_interview_calendar';
$route['employer/interview/get_all_interview_calender'] = 'employer/employer_interview/get_all_interview_calendar';

$route['employer/interview/schedule_an_interview'] = 'employer/employer_interview/create_interview_schedule';
$route['employer/interview/get_all_schedules'] = 'employer/employer_interview/get_all_schedules';

$route['employer/resume/view'] = 'job_seeker/job_seeker_public_profile/view_job_seeker_profile';

//Employer Public View
$route['employer/company/view'] = 'employer/employer_public_profile/view_employer_public_profile';

//Employer account management
$route['employer/account/manage_users'] = 'employer/employer_manage_user';
$route['employer/account/manage_users/add_new'] = 'employer/employer_manage_user/validate_new_user';
$route['employer/account/manage_users/change_user_access'] = 'employer/employer_manage_user/enable_disable_user';
$route['employer/account/manage_users/assign_user'] = 'employer/employer_manage_user/assign_user_to_group';

$route['employer/account/order_history'] = 'employer/employer_transactions/transaction_history';

$route['employer/account/manage_user_groups'] = 'employer/employer_user_groups_and_polices/view_user_group_manager';
$route['employer/account/manage_user_groups/create_new_group'] = 'employer/employer_user_groups_and_polices/add_new_user_group';
$route['employer/account/manage_user_groups/set_permissions'] = 'employer/employer_user_groups_and_polices/save_user_group_access';
$route['employer/account/manage_user_groups/get_permissions'] = 'employer/employer_user_groups_and_polices/get_existing_permissions';

$route['employer/account/change_password'] = 'change_password/view_change_account_password';

/*
 * Super User
 *
 * */
$route['superuser'] = 'navigation_control/redirect_dashboard';
$route['superuser/dashboard'] = 'superuser/su_dashboard';
$route['superuser/manage_post/pending'] = 'superuser/su_manage_posts/view_pending_posts';
$route['superuser/manage_post/approved'] = 'superuser/su_manage_posts/view_approved_posts';
$route['superuser/manage_post/rejected'] = 'superuser/su_manage_posts/view_rejected_posts';

$route['superuser/approvedFeatured'] =  'superuser/su_manage_posts/view_approved_posts_Featured';
$route['superuser/addFeatured'] =  'superuser/Su_manage_posts/addFeatured';
$route['superuser/removeFeatured'] =  'superuser/Su_manage_posts/removeFeatured';

//$route['superuser/manage_post/ats'] = 'superuser/su_manage_posts/ats';

//$route['superuser/Su_manage_posts/job_industry/delete'] = 'superuser/su_manage_site_content/delete_cms_content';

//superuser/Su_manage_posts/addFeatured

$route['superuser/manage_post/pending/get_data'] = 'superuser/su_manage_posts/get_pending';
$route['superuser/manage_post/approved/get_data'] = 'superuser/su_manage_posts/view_approved_posts';
$route['superuser/manage_post/rejected/get_data'] = 'superuser/su_manage_posts/view_rejected_posts';

$route['superuser/manage_post/action/approve'] = 'superuser/su_manage_posts/approve_post';
$route['superuser/manage_post/action/reject'] = 'superuser/su_manage_posts/reject_post';

//Super user ads
$route['superuser/ads/manage'] = 'superuser/su_ads/manage_ads';
$route['superuser/ads/new'] = 'superuser/su_ads/view_new_ad_form';
$route['superuser/ads/new/save'] = 'superuser/su_ads/create_new_add';
$route['superuser/ads/edit/save'] = 'superuser/su_ads/edit_ad';

//Super user ad edit
$route['superuser/ads/manage/edit'] = 'superuser/su_ads/edit_job_post_view';

$route['superuser/ads/switch'] = 'superuser/su_ads/post_status_switcher';
$route['superuser/ads/preview'] = 'superuser/su_ads/get_ad_preview';
$route['superuser/ads/delete'] = 'superuser/su_ads/delete_an_ad';

$route['superuser/ads/add_new_client'] = 'superuser/su_ads/add_new_company';

//Super user manage jobseekers
$route['superuser/manage_users/jobseekers'] = 'superuser/su_manage_users/view_job_seekers_list';
$route['superuser/manage_users/employers'] = 'superuser/su_manage_users/view_job_employer_list';

$route['superuser/manage_users/jobseekers/edit_resume'] = 'job_seeker/job_seeker_resume/job_seeker_new_resume';

//Super candidate search
$route['superuser/candidate_search'] = 'superuser/su_candidate_search/view_page';
//** get data */
$route['superuser/candidate_search/do_search'] = 'superuser/su_candidate_search/do_search';
//** View resume */
$route['superuser/candidate_search/do_search'] = 'superuser/su_candidate_search/do_search';
$route['superuser/candidate_search/view_resume'] = 'job_seeker/job_seeker_public_profile/view_job_seeker_profile';

//manage site contents
$route['superuser/manage_content/job_industry'] = 'superuser/su_manage_site_content/view_job_industry';
$route['superuser/manage_content/job_industry/add_or_edit'] = 'superuser/su_manage_site_content/add_edit_job_cms';
$route['superuser/manage_content/job_industry/delete'] = 'superuser/su_manage_site_content/delete_cms_content';

$route['superuser/manage_content/job_category'] = 'superuser/su_manage_site_content/view_job_category';
$route['superuser/manage_content/job_category/add_or_edit'] = 'superuser/su_manage_site_content/add_edit_job_cms';
$route['superuser/manage_content/job_category/delete'] = 'superuser/su_manage_site_content/delete_cms_content';

$route['superuser/manage_content/job_type'] = 'superuser/su_manage_site_content/view_job_type';
$route['superuser/manage_content/job_type/add_or_edit'] = 'superuser/su_manage_site_content/add_edit_job_cms';
$route['superuser/manage_content/job_type/delete'] = 'superuser/su_manage_site_content/delete_cms_content';

//Super user account management
$route['superuser/account/manage_users'] = 'superuser/Su_manage_super_user';
$route['superuser/account/manage_users/add_new'] = 'superuser/Su_manage_super_user/validate_new_user';
$route['superuser/account/manage_users/edit_user'] = 'superuser/Su_manage_super_user/get_user_data';
$route['superuser/account/manage_users/delete_user'] = 'superuser/Su_manage_super_user/delete_user';
$route['superuser/account/manage_users/change_user_access'] = 'superuser/Su_manage_super_user/enable_disable_user';
$route['superuser/account/manage_users/assign_user'] = 'superuser/Su_manage_super_user/assign_user_to_group';

$route['superuser/account/manage_user_groups'] = 'superuser/Su_manage_super_user_groups_and_polices/view_user_group_manager';
$route['superuser/account/manage_user_groups/create_new_group'] = 'superuser/Su_manage_super_user_groups_and_polices/add_new_user_group';
$route['superuser/account/manage_user_groups/delete'] = 'superuser/Su_manage_super_user_groups_and_polices/delete_user_group';
$route['superuser/account/manage_user_groups/set_permissions'] = 'superuser/Su_manage_super_user_groups_and_polices/save_user_group_access';
$route['superuser/account/manage_user_groups/get_permissions'] = 'superuser/Su_manage_super_user_groups_and_polices/get_existing_permissions';

//Super user account management
$route['superuser/account/change_password'] = 'change_password/view_change_account_password';

//Super user plans
$route['superuser/job_posting_plans/manage_plans'] = 'superuser/Su_job_posting_plan/view_plan_manager';
$route['superuser/job_posting_plans/manage_plans/create_new'] = 'superuser/Su_job_posting_plan/create_modify_plan';
$route['superuser/job_posting_plans/manage_plans/get_plan'] = 'superuser/Su_job_posting_plan/get_plan_data';
$route['superuser/job_posting_plans/manage_plans/switch'] = 'superuser/Su_job_posting_plan/switch_plan';
$route['superuser/job_posting_plans/manage_plans/delete'] = 'superuser/Su_job_posting_plan/delete_plan';

$route['superuser/job_posting_plans/orders'] = 'superuser/Su_job_posting_orders/view_orders';
$route['superuser/job_posting_plans/orders/get_data'] = 'superuser/Su_job_posting_orders/get_orders_data';
$route['superuser/job_posting_plans/orders/get_order'] = 'superuser/Su_job_posting_orders/get_order_data';
$route['superuser/job_posting_plans/orders/view_order'] = 'superuser/Su_job_posting_orders/view_order_approval';

$route['superuser/job_posting_plans/orders/process_txn'] = 'superuser/Su_job_posting_orders/transaction_approval';


//Ads click counter
$route['ads/click'] = 'superuser/su_ad_counter/redirect_ad';

//Get data
$route['superuser/get_data/js_user_growth_yearly'] = 'superuser/su_dashboard/js_user_growth_yearly';
$route['superuser/get_data/emp_user_growth_yearly'] = 'superuser/su_dashboard/emp_user_growth_yearly';
$route['superuser/get_data/js_user_growth_overall'] = 'superuser/su_dashboard/js_user_growth_overall';
$route['superuser/get_data/emp_user_growth_overall'] = 'superuser/su_dashboard/emp_user_growth_overall';
$route['superuser/get_data/job_post_growth_yearly'] = 'superuser/su_dashboard/job_post_growth_yearly';
$route['superuser/get_data/job_post_growth_overall'] = 'superuser/su_dashboard/job_post_growth_overall';

$route['superuser/get_data/all_job_seekers'] = 'superuser/su_manage_users/get_job_seekers_list';
$route['superuser/get_data/all_employers'] = 'superuser/su_manage_users/get_employers_list';


//Blog
$route['blog'] = 'blog';
$route['blog/view'] = 'blog/view_blog_post';

//Extras
$route['about'] = 'extras/view_about_us';
$route['contact'] = 'extras/view_contact_us';
$route['how_it_works'] = 'extras/view_how_it_works';
$route['faq'] = 'extras/view_faq_page';
$route['terms'] = 'extras/view_tos_page';
$route['privacy'] = 'extras/view_privacy_page';


//Pricing
$route['pricing'] = 'pricing_subscription';
