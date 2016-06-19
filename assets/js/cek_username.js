$("#input-username").on('focus change keyup', function(event){
     var username = $("#input-username").val();

     var segment = window.location.href.split("/");
     
     var url = window.location.origin + "/fairship/profil/do_username_check";

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

$("#input-nip").on('focus change keyup', function(event){
     var nip = $("#input-nip").val();

     var segment = window.location.href.split("/");
     
     var url = window.location.origin + "/fairship/staff/do_nip_check";

     // jika berada di halaman profil berarti aksi pasti edit selain itu bukan edit
     if(segment[4] == 'staff') var aksi = 'tambah';

     request = $.ajax({
          url: url,
          type: "post",
          data: 'nip='+nip+'&aksi='+aksi+'&nip_lama='+segment[5]
     });

     if($("#input-nip").val() != ""){
          request.done(function (response){
               if(response != ''){
                    if(response == '1'){ //jika username sudah digunakan
                         $("#status-nip").html('Sudah digunakan');
                         $("#form-group-nip").removeClass("has-success");
                         $("#form-group-nip").addClass("has-error");
                    } else { //jika username sama dengan sebelumnya
                         $("#status-nip").html('');
                         $("#form-group-nip").removeClass("has-success");
                         $("#form-group-nip").removeClass("has-error");
                    }
                    $("#button-nip-submit").prop("disabled", true);
                    $("#status-nip").removeClass("text-green");
                    $("#status-nip").addClass("text-red");
               } else if(response == ''){ // jika username belum digunakan
                    $("#status-nip").html('Tersedia');
                    $("#status-nip").removeClass("text-red");
                    $("#status-nip").addClass("text-green");
                    $("#button-nip-submit").prop("disabled", false);
                    $("#form-group-nip").removeClass("has-error");
                    $("#form-group-nip").addClass("has-success");
               }
         });
     } else { // jika input tidak diisi
          $("#status-nip").html('silahkan isi');
          $("#status-nip").removeClass("text-green");
          $("#status-nip").addClass("text-red");
          $("#button-nip-submit").prop("disabled", true);
          $("#form-group-nip").removeClass("has-success");
          $("#form-group-nip").addClass("has-error");
     }
});

$("#input-nim").on('focus change keyup', function(event){
     var nim = $("#input-nim").val();

     var segment = window.location.href.split("/");
     
     var url = window.location.origin + "/fairship/mahasiswa/do_nim_check";

     // jika berada di halaman profil berarti aksi pasti edit selain itu bukan edit
     if(segment[4] == 'mahasiswa') var aksi = 'tambah';

     request = $.ajax({
          url: url,
          type: "post",
          data: 'nim='+nim+'&aksi='+aksi+'&nim_lama='+segment[5]
     });

     if($("#input-nim").val() != ""){
          request.done(function (response){
               if(response != ''){
                    if(response == '1'){ //jika username sudah digunakan
                         $("#status-nim").html('Sudah digunakan');
                         $("#form-group-nip").removeClass("has-success");
                         $("#form-group-nip").addClass("has-error");
                    } else { //jika username sama dengan sebelumnya
                         $("#status-nim").html('');
                         $("#form-group-nip").removeClass("has-success");
                         $("#form-group-nip").removeClass("has-error");
                    }
                    $("#button-nim-submit").prop("disabled", true);
                    $("#status-nim").removeClass("text-green");
                    $("#status-nim").addClass("text-red");
               } else if(response == ''){ // jika username belum digunakan
                    $("#status-nim").html('Tersedia');
                    $("#status-nim").removeClass("text-red");
                    $("#status-nim").addClass("text-green");
                    $("#button-nim-submit").prop("disabled", false);
                    $("#form-group-nip").removeClass("has-error");
                    $("#form-group-nip").addClass("has-success");
               }
         });
     } else { // jika input tidak diisi
          $("#status-nim").html('silahkan isi');
          $("#status-nim").removeClass("text-green");
          $("#status-nim").addClass("text-red");
          $("#button-nim-submit").prop("disabled", true);
          $("#form-group-nim").removeClass("has-success");
          $("#form-group-nim").addClass("has-error");
     }
});