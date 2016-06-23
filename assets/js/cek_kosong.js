$("#input-nama").on('focus change keyup', function(event){
     var nama = $("#input-nama").val();
     var email = document.getElementById('input-email').value;
     var staff = document.getElementById('input-staff').value;

     if(nama == ""){
          $("#status-nama").html('silahkan isi');
          $("#status-nama").removeClass("text-green");
          $("#status-nama").addClass("text-red");
          $("#form-group-nama").removeClass("has-success");
          $("#form-group-nama").addClass("has-error");
     }else{
          $("#status-nama").html('');
          $("#status-nama").removeClass("text-red");
          $("#status-nama").addClass("text-green");
          $("#form-group-nama").removeClass("has-error");
          $("#form-group-nama").addClass("has-success");
     }
     if (nama == "" || email == "" || staff=="") {
          $(".button-submit").prop("disabled", true);
     }else{
          $(".button-submit").prop("disabled", false);
     }
});

$("#input-email").on('focus change keyup', function(event){
     var email = $("#input-email").val();
     var nama = document.getElementById('input-nama').value;
     var staff = document.getElementById('input-staff').value;

     if($("#input-email").val() == ""){
          $("#status-email").html('silahkan isi');
          $("#status-email").removeClass("text-green");
          $("#status-email").addClass("text-red");
          $("#form-group-email").removeClass("has-success");
          $("#form-group-email").addClass("has-error");
     }else{
          $("#status-email").html('');
          $("#status-email").removeClass("text-red");
          $("#status-email").addClass("text-green");
          $("#form-group-email").removeClass("has-error");
          $("#form-group-email").addClass("has-success");
     }

     if (nama == "" || email == "" || staff=="") {
          $(".button-submit").prop("disabled", true);
     }else{
          $(".button-submit").prop("disabled", false);
     }
});

$("#input-kelas").on('focus change keyup', function(event){
     var kelas = $("#input-kelas").val();
     var email = document.getElementById('input-email').value;

     if(nim == ""){
          $("#status-kelas").html('silahkan isi');
          $("#status-kelas").removeClass("text-green");
          $("#status-kelas").addClass("text-red");
          $("#form-group-kelas").removeClass("has-success");
          $("#form-group-kelas").addClass("has-error");
     }else{
          $("#status-kelas").html('');
          $("#status-kelas").removeClass("text-red");
          $("#status-kelas").addClass("text-green");
          $("#form-group-kelas").removeClass("has-error");
          $("#form-group-kelas").addClass("has-success");
     }
     if (kelas == "" || email == "") {
          $(".button-submit").prop("disabled", true);
     }else{
          $(".button-submit").prop("disabled", false);
     }
});