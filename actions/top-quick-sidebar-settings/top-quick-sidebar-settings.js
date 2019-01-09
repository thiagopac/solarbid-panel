window.onload = function(){

$('#form-mail-notification input[type="checkbox"]').change(function(){

    var showMsg = function(type, msg) {

        toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000"
            };
            toastr[type](msg);
    }

    $.ajax({
         url: './actions/top-quick-sidebar-settings/top-quick-sidebar-settings.php',
         type: 'POST',
         contentType: "application/x-www-form-urlencoded",
         data: { name: $(this).attr('name'), value: $(this).prop('checked') },
         success: function(response, status, xhr, $form) {

             if (response.status == 1) {

                 showMsg(response.type, response.description);

             } else {
                 showMsg(response.type, response.description);
             }

         }
    });

});

}
