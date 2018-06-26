function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

$(document).ready(function() {

    $('#export_member_form').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        onkeyup: false,
        rules: {
            event_id :{
              required : true
            },
            type_id :{
              required : true
            }
        },
        messages: {
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
