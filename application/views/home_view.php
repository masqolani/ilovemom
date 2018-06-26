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
                <h1 class="page-header">ILOVEMOM GOES TO SINGAPORE</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php $this->load->view('_footer'); ?>
