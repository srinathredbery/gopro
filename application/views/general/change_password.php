<section>
    <div class="block no-padding">
        <div class="<?php echo !empty($_SESSION['user_type']) && $_SESSION['user_type']==1 || $_SESSION['user_type']==2 ? 'container-fluid' : 'container' ?>">
            <div class="row no-gape">
                <!--include side bar for employer-->

                <?php
                if (!empty($_SESSION['user_type']) && $_SESSION['user_type']==1)
                    $this->load->view('include/side_bar_left_employer');
                elseif (isset($_SESSION['user_type']) && $_SESSION['user_type']==2)
                    $this->load->view('include/side_bar_left_employer');
                elseif (isset($_SESSION['user_type']) && $_SESSION['user_type']==3)
                    $this->load->view('include/side_bar_left_job_seeker');
                ?>
                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Change Password</h3>
                            <div class="change-password">
                                <form id="change_password_form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="pf-field mb-3">
                                                <span class="pf-title">Current Password</span>
                                                <input type="password" name="old_password" />
                                            </div>

                                            <div class="pf-field mb-3">
                                                <span class="pf-title">New Password</span>
                                                <input type="password" name="password" />
                                            </div>

                                            <div class="pf-field mb-3">
                                                <span class="pf-title">Confirm Password</span>
                                                <input type="password" name="password_confirm" />
                                            </div>
                                            <!--            Success message-->
                                            <div class="credentials-label sign-up-success mt-3" id="reset_success_message">
                                                <div class="">
                                                    <i class="fas fa-check-circle p-2 float-left"></i>
                                                    <p class="text-left d-block">.</p>
                                                </div>
                                            </div>

                                            <!--            Error Message -->
                                            <div class="credentials-label  mt-3" id="reset_error_message">
                                                <div class="">
                                                    <i class="fas fa-exclamation-circle p-2 float-left"></i>
                                                    <p class="text-left d-block"> Something went wrong, Please contact our support</p>
                                                </div>
                                            </div>
                                            <button type="submit" id="change_pass">Change Password</button>
                                        </div>
                                        <div class="col-lg-6">
                                            <i class="la la-key big-icon"></i>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
