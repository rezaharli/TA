$(document).ready(
function(){
    cekpesan();
    $("#tombol-pesan").click(function(){
        tampilkanpesan();
    });

    $.ajax({
        url: window.location.origin + "/fairship/pesan/get_modal",
        cache: false,
        success: function(msg){
            $("#modal-message").html(msg);
        }
    });
});

function cekpesan(){
    $.ajax({
        url: window.location.origin + "/fairship/pesan/hitung",
        cache: false,
        success: function(msg){
            $("#jumlah-pesan").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}

function tampilkanpesan(){
    $.ajax({
        url: window.location.origin + "/fairship/pesan/get",
        cache: false,
        success: function(msg){
            // $("#loading").hide();
            $("#konten-pesan").html(msg);
        }
    });
}

