<?php
// echo json_encode($this->session->userdata['logged_in']);die;

if (!isset($this->session->userdata['logged_in']))
    redirect('login');

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('_header'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Saving</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php if($this->session->flashdata('success')): ?>
                <p class='alert alert-success'> <?php echo $this->session->flashdata('success'); ?> </p>
            <?php endif; ?>

             <?php if($this->session->flashdata('error')): ?>
                <p class='alert alert-danger'> <?php echo $this->session->flashdata('error'); ?> </p>
            <?php endif; ?>
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7px;"><?php echo $title; ?></h4>
                    <?php if($this->session->userdata['logged_in']['user_status_id'] == "1") { ?>
                    <div class="btn-group pull-right">
                        <a href="<?php echo base_url('saving/create_saving'); ?>" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Add New Saving
                        </a>
                    </div>
                  <?php } ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="saving_list">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Total Saving</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                      </tfoot>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>

<div class="modal fade" id="detail_saving_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Saving Detail</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<?php $this->load->view('_footer'); ?>

<script type="text/javascript">

function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

$('#saving_list').DataTable({
    "ajax": getBaseUrl() + "/saving/get_saving_json",
    "columns": [
        { "data": "name" },
        { "data": "total_saving" },
        { "data": "actions" }
    ],
    "order": [[ 0, "asc" ]]
});

$("#saving_list").on("click", "#detail_saving", function(){
    $.ajax({
      type: "post",
      url: getBaseUrl() + "/saving/get_saving_by_user_id",
      data: {user_id : $(this).attr("user_id")},
      success: function(data){
        var data = JSON.parse(data);

        console.log(data);

        if(data != 'false') {

          var total_saving = 0;
          for (i = 0; i < data.length; i++) {
            total_saving += parseInt(data[i].amount);
          }

          var response = '<table class="table table-bordered">'+
                            '<thead>'+
                              '<tr class="info">'+
                                '<th>Name</th>'+
                                '<th>Last Saving</th>'+
                                '<th>Total Saving</th>'+
                              '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                              '<tr>'+
                                '<td>'+data[0].first_name+' '+data[0].last_name+'</td>'+
                                '<td>'+data[data.length-1].saving_date+'</td>'+
                                '<td>'+'Rp. ' +total_saving+'</td>'+
                              '</tr>'+
                            '</tbody>'+
                          '</table>';

          response += '<table class="table table-bordered">'+
                            '<thead>'+
                              '<tr class="info">'+
                                '<th>Saving Date</th>'+
                                '<th>Amount</th>'+
                                '<th>Transfer Image</th>'+
                              '</tr>'+
                            '</thead>'+
                            '<tbody>';

                  for (i = 0; i < data.length; i++) {
                    response += '<tr>'+
                                  '<td>'+data[i].saving_date+'</td>'+
                                  '<td>'+'Rp. ' +data[i].amount+'</td>'+
                                  '<td><a href="assets/uploads/'+data[i].transfer_picture+'" target="_blank">'+
                                  '<img src="assets/uploads/'+data[i].transfer_picture+'" width="100"></a></td>'+
                                '</tr>';
                  }

          response += '</tbody>'+
                      '</table>';

          $('.modal-body').html(response);
          $('#detail_saving_modal').modal('show');

        } else {
          alert("User not found");
        }
      },
      error: function(data){
        alert('something wrong');
        $("#saving_list").DataTable().ajax.reload(null, false);
      }
    });
  });
</script>
