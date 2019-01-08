window.onload = function(){

$('#form-mail-notification input[type="checkbox"]').change(function(){

//    console.log($(this).attr('name'));
//    console.log($(this).prop('checked'));

    $.ajax({
         url: './actions/top-quick-sidebar-settings/top-quick-sidebar-settings.php',
         type: 'POST',
         contentType: "application/x-www-form-urlencoded",
         data: { name: $(this).attr('name'), value: $(this).prop('checked') },
         success: function(response, status, xhr, $form) {

             if (response.status == 1) {

                 console.log("sucesso");

             } else {
                 console.log("erro");
             }

         }
    });

});



}
