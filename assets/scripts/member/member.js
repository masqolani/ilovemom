function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

$(document).ready(function() {

  // $('#member_list').DataTable({
  //     "ajax": getBaseUrl() + "/member/get_member_json",
  //     "columns": [
  //         { "data": "registration_number" },
  //         { "data": "member_name" },
  //         { "data": "grade_name" },
  //         { "data": "type_name" },
  //         { "data": "event_name" },
  //         { "data": "seat" },
  //         { "data": "attend_status" },
  //         { "data": "actions" }
  //     ],
  //     "order": [[ 1, "desc" ]]
  // });

  // modified search
  $('div.dataTables_filter input').focus();
  $('.dataTables_filter input[type="search"]').
  attr('placeholder','looking for anything...').
  css({'width':'350px','display':'inline-block'});

  // event filter
  $('#eventFilter').on('change', function(){
    var filter_value = $(this).val();
    var new_url = getBaseUrl() + "/member/get_member_json/"+filter_value;
    $("#member_list").DataTable().ajax.url(new_url).load();
  });

  // print ticket
  $("#ticketprint").click(function() {
      $('#printarea').printThis();
      return false;
  });

  // update attendance status
  $("#member_list").on("click", "#attend_status", function(){
    $.ajax({
      type: "post",
      url: getBaseUrl() + "/member/set_attended",
      data: {member_id : $(this).attr("member_id")},
      success: function(data){
        var data = JSON.parse(data);
        console.log(data);

        if(data.status = 'true') {

          if(data.result[0].meeting_point == null){
            var meeting_point = "";
          } else {
            var meeting_point = data.result[0].meeting_point;
          }

          if(data.result[0].gate_in == null){
            var gate_in = "";
          } else {
            var gate_in = data.result[0].gate_in;
          }

          var response = '<div id="printarea">'+
                          '<div style="text-align: center; max-width: 10cm;">'+
                            '<h4>'+ data.result[0].member_name +'</h4>'+
                            '<h5><b>Class: <b/><i>'+ data.result[0].grade_name +'</i></h5>'+
                            '<h5><b>Trophy: </b><i>'+ data.result[0].get_award +'</i></h5>'+
                            '<h5><b>Session: </b><i>'+ data.result[0].member_session +'</i></h5>'+
                            '<h5><b>Gate: </b><i>'+ gate_in +'</i></h5>'+
                            '<h5><b>Table: </b><i>'+ data.result[0].trophy_table +'</i></h5>'+
                            '<h5><b>Meeting Point: </b><i>'+ meeting_point +'</i></h5>'+
                            '<h5><b>Chair: </b><i>'+ data.seat +'</i></h5>'+
                          '</div>'+
                        '</div>';

          $('.modal-body').html(response);
          $('#print_modal').modal('show');

          $("#member_list").DataTable().ajax.reload(null, false);
        } else {
          alert("Member has not been attend");
          $("#member_list").DataTable().ajax.reload(null, false);
        }
      },
      error: function(data){
        alert('something wrong');
        $("#member_list").DataTable().ajax.reload(null, false);
      }
    });
  });

  $("#member_list").on("click", "#detail_member", function(){
    $.ajax({
      type: "post",
      url: getBaseUrl() + "/member/get_detail_member_json_by_id",
      data: {member_id : $(this).attr("member_id")},
      success: function(data){
        var data = JSON.parse(data);

        console.log(data);

        if(data != 'false') {

          var status = "<a class='btn btn-sm btn-danger'>Doesn't Attend</a>";
          if(data.attend_status == 1){
            var status = "<a class='btn btn-sm btn-success'>Attend</a>";
          }

          var response = '<table class="table table-bordered">'+
                            '<thead>'+
                              '<tr class="info">'+
                                '<th>Registration Number</th>'+
                                '<th>Student ID</th>'+
                                '<th>Name</th>'+
                                '<th>Class</th>'+
                                '<th>Type</th>'+
                                '<th>Event</th>'+
                                '<th>Seat</th>'+
                              '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                              '<tr>'+
                                '<td>'+data.registration_number+'</td>'+
                                '<td>'+data.student_id+'</td>'+
                                '<td>'+data.member_name+'</td>'+
                                '<td>'+data.grade_name+'</td>'+
                                '<td>'+data.event_name+'</td>'+
                                '<td>'+data.type_name+'</td>'+
                                '<td>'+data.seat+'</td>'+
                              '</tr>'+
                            '</tbody>'+
                          '</table>';

          response += '<table class="table table-bordered">'+
                            '<thead>'+
                              '<tr class="info">'+
                                '<th>Session</th>'+
                                '<th>Attendance</th>'+
                                '<th>Gate</th>'+
                                '<th>Get Award</th>'+
                                '<th>Trophy Table</th>'+
                                '<th>Center</th>'+
                                '<th>instructor</th>'+
                              '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                              '<tr>'+
                                '<td>'+status+'</td>'+
                                '<td>'+data.member_session+'</td>'+
                                '<td>'+data.gate_in+'</td>'+
                                '<td>'+data.get_award+'</td>'+
                                '<td>'+data.trophy_table+'</td>'+
                                '<td>'+data.center+'</td>'+
                                '<td>'+data.instructor+'</td>'+
                              '</tr>'+
                            '</tbody>'+
                          '</table>';
            response += '<table class="table table-bordered">'+
                              '<thead>'+
                                '<tr class="info">'+
                                  '<th>Plakat</th>'+
                                  '<th>Rank</th>'+
                                  '<th>Among Of</th>'+
                                  '<th>Math</th>'+
                                  '<th>EE</th>'+
                                  '<th>EFL</th>'+
                                '</tr>'+
                              '</thead>'+
                              '<tbody>'+
                                '<tr>'+
                                  '<td>'+data.plakat+'</td>'+
                                  '<td>'+data.rank+'</td>'+
                                  '<td>'+data.among_of+'</td>'+
                                  '<td>'+data.math+'</td>'+
                                  '<td>'+data.ee+'</td>'+
                                  '<td>'+data.efl+'</td>'+
                                '</tr>'+
                              '</tbody>'+
                            '</table>';

          response += '<table class="table table-bordered">'+
                            '<thead>'+
                              '<tr class="info">'+
                                '<th>CM</th>'+
                                '<th>CE</th>'+
                                '<th>CF</th>'+
                                '<th>Trophy at Class</th>'+
                                '<th>ASHR Level</th>'+
                                '<th>Meeting Point</th>'+
                              '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                              '<tr>'+
                                '<td>'+data.cm+'</td>'+
                                '<td>'+data.ce+'</td>'+
                                '<td>'+data.cf+'</td>'+
                                '<td>'+data.trophy_at_class+'</td>'+
                                '<td>'+data.ashr_level+'</td>'+
                                '<td>'+data.meeting_point+'</td>'+
                              '</tr>'+
                            '</tbody>'+
                          '</table>';

          $('.modal-body').html(response);
          $('#detail_member_modal').modal('show');

          $("#member_list").DataTable().ajax.reload(null, false);
        } else {
          alert("Member not found");
          $("#member_list").DataTable().ajax.reload(null, false);
        }
      },
      error: function(data){
        alert('something wrong');
        $("#member_list").DataTable().ajax.reload(null, false);
      }
    });
  });

});
