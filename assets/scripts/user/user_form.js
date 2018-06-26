function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

jQuery.extend(jQuery.validator.messages, {
    equalTo: "Please enter the same password."
});

$(document).ready(function() {

    $('#user_form').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        onkeyup: false,
        rules: {
            username :{
              required : true,
              remote: {
                url: getBaseUrl()+"/user/check_user",
                type: "post",
                data: {
                    username: function() {
                       return $( "#username" ).val();
                    },
                    user_id: function() {
                      return $("#user_id").val();
                    }
                  },
                error: function(data) {
                    location.href = getBaseUrl()+"/login"
                  }
                }
            },
            first_name : {
              required : true
            },
            last_name : {
              required : true
            },
            email : {
              required : true,
              email : true,
              remote: {
                url: getBaseUrl()+"/user/check_user",
                type: "post",
                data: {
                    email: function() {
                       return $( "#email" ).val();
                    },
                    user_id: function() {
                      return $("#user_id").val();
                    }
                  },
                error: function(data) {
                    location.href = getBaseUrl()+"/login"
                  }
                }
            },
            password : {
              required : true,
              minlength : 6
            },
            retype_password : {
              required : true,
              equalTo : "#password"
            },
            user_status_id : {
              required : true
            }
        },
        messages: {
            username: {
              remote: "Username already exist"
            },
            email: {
              remote: "Email already exist"
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
