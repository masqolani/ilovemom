function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

$(document).ready(function() {

    $('#member_name').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $('#registration_number').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $('#member_form').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        onkeyup: false,
        rules: {
            member_name :{
              required : true,
              remote: {
                url: getBaseUrl()+"/member/check_member",
                type: "post",
                data: {
                    member_name: function() {
                       return $( "#member_name" ).val();
                    },
                    member_id: function() {
                      return $("#member_id").val();
                    },
                    event_id: function() {
                      return $("#event_id").val();
                    }
                  },
                error: function(data) {
                    location.href = getBaseUrl()+"/login"
                  }
                }
            },
            registration_number :{
              required : true,
              remote: {
                url: getBaseUrl()+"/member/check_member",
                type: "post",
                data: {
                    registration_number: function() {
                       return $( "#registration_number" ).val();
                    },
                    member_id: function() {
                      return $("#member_id").val();
                    },
                    event_id: function() {
                      return $("#event_id").val();
                    }
                  },
                error: function(data) {
                    location.href = getBaseUrl()+"/login"
                  }
                }
            },
            event_id :{
              required : true
            },
            member_session :{
              required : true
            },
            grade_id :{
              required : true
            },
            type_id :{
              required : true
            }
        },
        messages: {
            member_name: {
              remote: "Member name already exist"
            },
            registration_number: {
              remote: "Registration number already exist"
            }
        },
        invalidHandler: function (event, validator) { //display error alert on form submit
        },
        highlight: function (element) { // hightlight error inputs
           $(element)
                 .closest('.form-group').addClass('has-error'); // set error class to the control group
         },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

});
