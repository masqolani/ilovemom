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
                <h1 class="page-header">About</h1>
            </div>
        </div>
        <!-- Graph -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <center><p><h1>- I LOVE MOM -</h1></p></center><br>
                        <!-- <p style="text-align: justify; font-size: 17px;">All right reserve</p> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Graph -->
    </div>
</div>
<!-- /#page-wrapper -->


<?php $this->load->view('_footer'); ?>
