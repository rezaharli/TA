$("#input-password-confirm").on('focus change keyup', function(event){

     if($("#input-password-confirm").val() != ""){
          if ($("#input-password-confirm").val() != $("#input-password").val()) {
               $("#form-group-password-confirm").removeClass("has-success");
               $("#form-group-password-confirm").addClass("has-error");
               $("#button-password-submit").prop("disabled", true);
          } else {
               $("#form-group-password-confirm").removeClass("has-error");
               $("#form-group-password-confirm").addClass("has-success");
               $("#button-password-submit").prop("disabled", false);
          }
     } else {
          $("#form-group-password-confirm").removeClass("has-success");
          $("#form-group-password-confirm").addClass("has-error");
          $("#button-password-submit").prop("disabled", true);
     }
});