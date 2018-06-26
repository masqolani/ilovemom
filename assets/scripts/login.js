$(document).ready(function() {

	function getBaseUrl() {
	    var l = window.location;
	    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
	    return base_url;
	}

	$("#form_login").validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
        focusInvalid: false, 
        ignore: "",
		rules: {
			username: {
				required: true,
				// email: true
			},
			password: 'required'
		},
		messages: {
			username: {
				required: 'Email is required',
				// email: 'Email must contain a valid email address (with @ and .)'
			},
			password: 'Password is required'
		},
		highlight: function(element, errorClass, validClass) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest('.form-group').removeClass('has-error');
		},
	  	submitHandler: function(form) { 
	  		form.submit();
	        console.log('login berhasil');
	  	}
	});

	$("#register-form").validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
        focusInvalid: false, 
        ignore: "",
		rules: {
			username: {
				required: true,
			},
			first_name: {
				required: true,
			},
			last_name: {
				required: true,
			},
			email: {
				required: true,
				email: true,
			},
			first_password: {
				required: true,
				minlength : 5,

			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: '#first_password'
			}
		},
		messages: {
			username: 'diisi woy.',
			first_name: 'diisi woy.',
			last_name: 'diisi woy.',
			email: {
				required: 'diisi woy.',
				email: 'email yang bener woy',
			},
			first_password: {
				required: 'diisi woy.',
				minlength: 'panjang minimal 5 woy',
			},
			confirm_password: {
				required: 'diisi woy.',
				minlength: 'panjang minimal 5 woy',
				equalTo: 'password lu ga sama woy'
			},
		},
		highlight: function(element, errorClass, validClass) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest('.form-group').removeClass('has-error');
		},
	  	submitHandler: function() { 
	  		$.ajax({
	            url: 'register',
	            type: 'POST',
	            data: $("#register-form").serialize(),
	            success: function(data) {
	            	alert('register berhasil');
	            },
	            error:function(response) {
		        	alert("error register");
		       	}
        	});
	  	}
	});
});