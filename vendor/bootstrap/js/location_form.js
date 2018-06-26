function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

$(document).ready(function() {

    $('#location_name').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $('#location_form').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        onkeyup: false,
        rules: {
            location_name :{
              required : true,
              remote: {
                url: getBaseUrl()+"/location/check_location",
                type: "post",
                data: {
                    location_name: function() {
                       return $( "#location_name" ).val();
                    },
                    location_id: function() {
                      return $("#location_id").val();
                    }
                  },
                error: function(data) {
                    location.href = getBaseUrl()+"/login"
                  }
                }
            }
        },
        messages: {
            location_name: {
              remote: "Location name already exist"
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
