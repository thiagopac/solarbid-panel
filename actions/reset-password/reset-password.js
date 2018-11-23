//== Class Definition
var SnippetReset = function() {

    var reset = $('#m_reset');

    var showMsg = function(form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        //alert.animateClass('fadeIn animated');
        mUtil.animateClass(alert[0], 'fadeIn animated');
        alert.find('span').html(msg);
    }

    var handleResetPasswordFormSubmit = function() {
        $('#m_login_reset_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    password: {
                        required: true
                    },
                    rpassword: {
                        required: true,
                        equalTo : '#password-reset'
                    }
                },
                messages: {
                    password: "Escolha uma uma senha",
                    rpassword: "A confirmação de senha deve ser igual ao campo senha"
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: './actions/reset-password/reset-password.php',
                type: 'POST',
                contentType: "application/x-www-form-urlencoded",
                data: $('#form-reset').serialize(),
                success: function(response, status, xhr, $form) {

                    if (response.status == 1) {

                        btn.attr('disabled', true);
                        showMsg(form, response.type, response.description);

                        setTimeout(function() {

                            //reset button to original state
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                            // display signup form
                            var resetForm = reset.find('.m-login__reset form');
                            resetForm.clearForm();
                            resetForm.validate().resetForm();

                            location.href = "./login";

                        }, 3000);

                    } else {
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            showMsg(form, response.type, response.description);
                        }, 2000);
                    }

                }
            });
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleResetPasswordFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetReset.init();
});
