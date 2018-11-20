//== Class Definition
var SnippetLogin = function() {

    var login = $('#m_login');

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

    //== Private Functions

    var displaySignUpForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');

        login.addClass('m-login--signup');
        mUtil.animateClass(login.find('.m-login__signup')[0], 'flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');

        login.addClass('m-login--signin');
        mUtil.animateClass(login.find('.m-login__signin')[0], 'flipInX animated');
        //login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var displayForgetPasswordForm = function() {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');

        login.addClass('m-login--forget-password');
        //login.find('.m-login__forget-password').animateClass('flipInX animated');
        mUtil.animateClass(login.find('.m-login__forget-password')[0], 'flipInX animated');

    }

    var handleFormSwitch = function() {
        $('#m_login_forget_password').click(function(e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });

        $('#m_login_forget_password_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#m_login_signup').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function() {
        $('#m_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: './actions/login/login.php',
                type: 'POST',
                contentType: "application/x-www-form-urlencoded",
                data: $('#form-signin').serialize(),
                success: function(response, status, xhr, $form) {

                    if (response.status == 1) {

                      btn.attr('disabled', true);
                      showMsg(form, 'success', response.description);

                        setTimeout(function() {

                            //reset button to original state
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                            location.href = "./main?page=dashboard";

                        }, 2000);

                    } else {
                      setTimeout(function() {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        showMsg(form, 'danger', response.description);
                      }, 2000);
                    }
                }
            });
        });
    }

    var handleSignUpFormSubmit = function() {
        $('#m_login_signup_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    username: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    },
                    rpassword: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    agree: {
                        required: true
                    }
                },
                messages: {
                    username: "Informe o nome de usuário",
                    email: "Informe o e-mail",
                    password: "Escolha uma uma senha",
                    rpassword: "Confirme a senha escolhida",
                    role: "Selecione o tipo de usuário",
                    agree: "É necessário aceitar os Termos de Uso para efetuar o cadastro no site"
                }
        });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: './actions/login/login.php',
                type: 'POST',
                contentType: "application/x-www-form-urlencoded",
                data: $('#form-signup').serialize(),
                success: function(response, status, xhr, $form) {

                    if (response.status == 1) {

                        btn.attr('disabled', true);
                        showMsg(form, 'success', response.description);
                        form.clearForm();
                        form.validate().resetForm();


                        setTimeout(function() {

                            //reset button to original state
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                            // display signup form
                            displaySignInForm();
                            var signInForm = login.find('.m-login__signin form');
                            signInForm.clearForm();
                            signInForm.validate().resetForm();

                        }, 2000);

                    } else {
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            showMsg(form, 'danger', response.description);
                        }, 2000);
                    }

                }
            });
        });
    }

    var handleForgetPasswordFormSubmit = function() {
        $('#m_login_forget_password_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: './actions/login/login.php',
                type: 'POST',
                contentType: "application/x-www-form-urlencoded",
                data: $('#form-forgotpassword').serialize(),
                success: function(response, status, xhr, $form) {

                    if (response.status == 1) {

                        btn.attr('disabled', true);
                        showMsg(form, 'success', response.description);
                        form.clearForm();
                        form.validate().resetForm();


                        setTimeout(function() {

                            //reset button to original state
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                            // display signup form
                            displaySignInForm();
                            var signInForm = login.find('.m-login__signin form');
                            signInForm.clearForm();
                            signInForm.validate().resetForm();

                        }, 2000);

                    } else {
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            showMsg(form, 'danger', response.description);
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
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetLogin.init();
});
