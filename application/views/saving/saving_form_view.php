<?php

if (!isset($this->session->userdata['logged_in']))
    redirect('login');

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('_header'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Saving Form</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
	             <?php if($this->session->flashdata('error')): ?>
	                <p class='alert alert-danger'> <?php echo $this->session->flashdata('error'); ?> </p>
	            <?php endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
	                    <h4 class="panel-title pull-left" style="padding-top: 7px;"><?php echo $form_title; ?></h4>
	                    <div class="btn-group pull-right">
	                        <a href="<?php echo base_url('saving'); ?>" class="btn btn-primary">
	                            <i class="fa fa-arrow-left"></i>
	                            Back to List Saving
	                        </a>
	                    </div>
	                </div>
                  <div class="panel-body">
                      <div class="row">
                          <form id="saving_form" enctype='multipart/form-data' action="<?php echo $form_action; ?>" method="post" role="form" style="display: block;">
                              <div class="col-lg-12">
                                <input type="hidden" class="form-control" name="saving_id" id="saving_id" value="<?php echo (!empty($data['saving_id'])) ? $data['saving_id'] : "" ?>">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Name</label>
                                      <select id="user_id" name="user_id" class="form-control">
                                        <option value="">Select Name</option>
                                        <?php
                                          foreach($user as $row) {
                                            $selected='';
                                            if(!empty($data['user_id'])){
                                              if($row['user_id'] == $data['user_id']){
                                                 $selected='selected="selected"';
                                              }
                                            }
                                            echo '<option value="'.$row['user_id'].'" '.$selected.'>'.$row['first_name'].' '.$row['last_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Saving</label>
                                      <input type="text" class="form-control" name="amount" id="amount" value="<?php echo (!empty($data['amount'])) ? $data['amount'] : "" ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                      <label for="transfer_picture">Select Transfer Image</label>
                                      <input type="file" name="transfer_picture" class="form-control" id="transfer_picture">
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                    <label></label>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </div>
                                </div>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php $this->load->view('_footer'); ?>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/saving/saving_form.js'); ?>"></script>
