<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Inactive Job Posts</h3>
                            <table class="datatable-init">
                                <thead>
                                <tr>
                                    <td>Title</td>
                                    <td>Posted Date</td>
                                    <td>Job Type</td>
                                    <td>No of Applicants</td>
                                    <td>Posted By</td>
                                    <td>Action</td>
									<td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($active_job_posts) && !empty($active_job_posts)){
                                    foreach ($active_job_posts as $active_post){
                                        if( !empty($active_post['job_post_job_type'])){
                                            if($active_post['job_post_job_type']==1)
                                                $job_type_class = 'tp';
                                            elseif($active_post['job_post_job_type']==2)
                                                $job_type_class = 'fl';
                                            elseif($active_post['job_post_job_type']==3)
                                                $job_type_class = 'ft';
                                            elseif($active_post['job_post_job_type']==4)
                                                $job_type_class = 'it';
                                            elseif($active_post['job_post_job_type']==5)
                                                $job_type_class = 'pt';
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="table-list-title">
                                                    <h3><a href="<?php echo !empty($active_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($active_post['job_post_id']): '' ?>" target="_blank" title=""><?php echo !empty($active_post['job_post_title']) ?  substr($active_post['job_post_title'], 0, 30) :''?></a></h3>
                                                </div>
                                            </td>
                                            <td>
                                                <span><?php echo !empty($active_post['job_post_posted_date']) ? date('dS M Y @ H:m:i', strtotime($active_post['job_post_posted_date'])) : ''?></span>
                                            </td>
                                            <td>
                                                <span class="job-is <?php echo $job_type_class?>"><?php echo !empty($active_post['job_type_name']) ?  $active_post['job_type_name'] :''?></span>
                                            </td>
                                            <td>
                                                <span class="status active">
                                                    <a <?php echo !empty($active_post['no_of_applications']) && $active_post['no_of_applications'] > 0 ? 'href="'.base_url().'employer/applications_received?jp_id='.$active_post['job_post_id'].'" title="View Applications Received"' : 'title="No Applications Received "' ?> ><?php echo !empty($active_post['no_of_applications']) ? $active_post['no_of_applications'] : 'No' ?> Applications</a>
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    <?php
//                                                    echo !empty($active_post['emp_first_name']) ?  $active_post['emp_first_name'] : 'EMP ID: '.$active_post['job_post_made_by']
                                                    if(!empty($active_post['emp_first_name']))
                                                        echo $active_post['emp_first_name'];
                                                    elseif ($_SESSION['company_id'] === $active_post['job_post_made_by'])
                                                        echo 'Admin';
                                                    else
                                                        echo 'EMP ID: '.$active_post['job_post_made_by'].$_SESSION['company_id'];

                                                    ?>
                                                </span>
                                            </td>
                                            <td>

                                                <ul class="action_job">
                                                    <li><span>View Job</span><a href="<?php echo !empty($active_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($active_post['job_post_id']): '' ?>" target="_blank" title=""><i class="la la-eye"></i></a>
                                                    </li>
                                                    <li><span>Edit</span><a href="<?php echo !empty($active_post['job_post_id']) ?  base_url().'employer/job_posts/drafts/edit?job_post='.$active_post['job_post_id'] :'' ?>" title=""><i class="la la-pencil"></i></a>
                                                    </li>
<!--                                                    <li class="del-job-post"><span>Delete</span><a title=""><i class="la la-trash-o"></i></a></li>-->
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="toggle-group">
                                                    <input type="checkbox" name="on-off-switch" onchange="job_post_status_switch(this)" id="<?php echo isset($active_post['job_post_id']) ? $active_post['job_post_id'] : ''?>" tabindex="1"
                                                        <?php
                                                        if(isset($active_post['post_status']) && $active_post['post_status'])
                                                            echo 'checked';
                                                        ?>
                                                    >
                                                    <label for="<?php echo isset($active_post['job_post_id']) ? $active_post['job_post_id'] : ''?>">

                                                    </label>
                                                    <div class="onoffswitch" aria-hidden="true">
                                                        <div class="onoffswitch-label">
                                                            <div class="onoffswitch-inner"></div>
                                                            <div class="onoffswitch-switch"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script>
	$(document).ready(function () {
		$('.datatable-init').DataTable({
			"order": []
		});
	})
</script>
