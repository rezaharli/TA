$("#input-password-confirm").on('focus change keyup', function(event){
     var serializedData = $("#form-username").serialize();

// Fire off the request to /form.php
     request = $.ajax({
          url: window.location.origin + "/hmmmm/user/do_username_check",
          type: "post",
          data: serializedData
     });

     if($("#input-username").val() != ""){
          request.done(function (response){
               if(response != ''){
                    if(response == '1'){
                         $("#status-username").html('Sudah digunakan');
                         $("#form-group-username").removeClass("has-success");
                         $("#form-group-username").addClass("has-error");
                    } else {
                         $("#status-username").html('');
                         $("#form-group-username").removeClass("has-success");
                         $("#form-group-username").removeClass("has-error");
                    }
                    $("#button-username-submit").prop("disabled", true);
                    $("#status-username").removeClass("text-green");
                    $("#status-username").addClass("text-red");
               } else if(response == ''){
                    $("#status-username").html('Tersedia');
                    $("#status-username").removeClass("text-red");
                    $("#status-username").addClass("text-green");
                    $("#button-username-submit").prop("disabled", false);
                    $("#form-group-username").removeClass("has-error");
                    $("#form-group-username").addClass("has-success");
               }
         });
     } else {
          $("#status-username").html('silahkan isi');
          $("#status-username").removeClass("text-green");
          $("#status-username").addClass("text-red");
          $("#button-username-submit").prop("disabled", true);
          $("#form-group-username").removeClass("has-success");
          $("#form-group-username").addClass("has-error");
     }
});