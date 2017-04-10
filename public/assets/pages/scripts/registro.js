var Login = function() {

    var handleRegister = function() {

        $('#frm_registra').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                razon_social: {
                    required: true
                },
                ciec: {
                    required: true,
                },
                periodo: {
                    required: true,
                },
                nombre: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                celular: {
                    required: true,
                    number: true
                },
                password: {
                    required: true
                },
                rpassword: {
                    equalTo: "#valida_pass"
                }
            },

            messages: { // custom messages for radio buttons and checkboxes
                razon_social: {
                    required: "Debe escribir la razón social o nombre de la empresa"
                },
                ciec: {
	                required: "Es necesario que escriba su contraseña CIEC"
                },
                nombre: {
	                required: "Es necesario que escriba su nombre"
                },
                email: {
	                required: "Es necesario que escriba una cuenta de correo electrónico"
                },
                celular: {
	                required: "Es necesario que escriba su número celular"
                },
                password: {
	                required: "Es necesario que escriba una contraseña"
                },
                rpassword: {
	                required: "Es necesario que escriba nuevamente su contraseña"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });

        $('#frm_registra input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#frm_registra').validate().form()) {
                    //$('#frm_registra').submit();
                    registra();
                }
                return false;
            }
        });

        jQuery('#register-btn').click(function() {
            jQuery('.login-form').hide();
            jQuery('#frm_registra').show();
        });

        jQuery('#register-back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('#frm_registra').hide();
        });
    }

    return {
        //main function to initiate the module
        init: function() {

            handleRegister();

        }

    };

}();
function loguea(){
	$('.btn-login').hide();
	$('#load').show();
	
	var email = $('#email').val();
	var pass = $('#valida_pass').val();

	
	$.post('ac/login.php','email='+email+'&pass='+pass,function(data) {
		if(data==1){
			window.location = 'index.php';
		}else{
			$('#rfc').focus();
			$('.alert').html(data);
			$('.alert').show('Fast');
			$('#load').hide();
			$('.btn-login').show();
		}
	});
}
jQuery(document).ready(function() {
    Login.init();
});