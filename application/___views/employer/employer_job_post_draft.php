<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Draft Job Posts</h3>
                            <table class="datatable-init">
                                <thead>
                                <tr>
                                    <td>Title</td>
                                    <td>Saved Date</td>
                                    <td>Saved By</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($draft_job_posts) && !empty($draft_job_posts)){
                                    foreach ($draft_job_posts as $draft_post){
                                        ?>
                                        <tr id="<?php echo !empty($draft_post['job_post_id']) ?  $draft_post['job_post_id'] :''?>">
                                            <td>
                                                <div class="table-list-title">
                                                    <h3><a href="<?php echo !empty($draft_post['job_post_id']) ?  base_url().'employer/job_posts/drafts/edit?job_post='.$draft_post['job_post_id'] :'' ?>" title="">
                                                            <?php echo !empty($draft_post['job_post_title']) ?  substr($draft_post['job_post_title'], 0, 30) :''?>
                                                        </a></h3>
                                                </div>
                                            </td>
                                            <td>
                                                <span><?php echo !empty($draft_post['job_post_posted_date']) ? date('dS M Y @ H:m:i', strtotime($draft_post['job_post_posted_date'])) : ''?></span>
                                            </td>
                                            <td>
                                                <span><?php echo !empty($draft_post['job_post_made_by']) ?  substr($draft_post['job_post_made_by'], 0, 30) :''?></span>
                                            </td>
                                            <td>
                                                <ul class="action_job">
                                                    <li><span>View Job</span><a title=""><i class="la la-eye"></i></a>
                                                    </li>
                                                    <li><span>Edit</span><a href="<?php echo !empty($draft_post['job_post_id']) ?  base_url().'employer/job_posts/drafts/edit?job_post='.$draft_post['job_post_id'] :'' ?>" title=""><i class="la la-pencil"></i></a>
                                                    </li>
                                                    <li class="del-job-post"><span>Delete</span><a title=""><i class="la la-trash-o"></i></a></li>
                                                </ul>
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
