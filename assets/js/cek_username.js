$("#input-username").on('focus change keyup', function(event){
     var username = $("#input-username").val();

     var segment = window.location.href.split("/");
     
     var url = window.location.origin + "/hmmmm/profil/do_username_check";

     // jika berada di halaman profil berarti aksi pasti edit selain itu bukan edit
     if(segment[4] == 'profil') var aksi = 'edit';

     request = $.ajax({
          url: url,
          type: "post",
          data: 'username='+username+'&aksi='+aksi+'&username_lama='+segment[5]
     });

     if($("#input-username").val() != ""){
          request.done(function (response){
               if(response != ''){
                    if(response == '1'){ //jika username sudah digunakan
                         $("#status-username").html('Sudah digunakan');
                         $("#form-group-username").removeClass("has-success");
                         $("#form-group-username").addClass("has-error");
                    } else { //jika username sama dengan sebelumnya
                         $("#status-username").html('');
                         $("#form-group-username").removeClass("has-success");
                         $("#form-group-username").removeClass("has-error");
                    }
                    $("#button-username-submit").prop("disabled", true);
                    $("#status-username").removeClass("text-green");
                    $("#status-username").addClass("text-red");
               } else if(response == ''){ // jika username belum digunakan
                    $("#status-username").html('Tersedia');
                    $("#status-username").removeClass("text-red");
                    $("#status-username").addClass("text-green");
                    $("#button-username-submit").prop("disabled", false);
                    $("#form-group-username").removeClass("has-error");
                    $("#form-group-username").addClass("has-success");
               }
         });
     } else { // jika input tidak diisi
          $("#status-username").html('silahkan isi');
          $("#status-username").removeClass("text-green");
          $("#status-username").addClass("text-red");
          $("#button-username-submit").prop("disabled", true);
          $("#form-group-username").removeClass("has-success");
          $("#form-group-username").addClass("has-error");
     }
});