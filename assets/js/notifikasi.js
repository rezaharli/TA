$(document).ready(function(){
    cek();
    $("#tombol-notifikasi").click(function(){
        tampilkan();
    });
});

function cek(){
    $.ajax({
        url: window.location.origin + "/fairship/notifikasi/hitung",
        cache: false,
        success: function(msg){
            $("#jumlah-notifikasi").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}

function tampilkan(){
    $.ajax({
        url: window.location.origin + "/fairship/notifikasi/get",
        cache: false,
        success: function(msg){
            // $("#loading").hide();
            $("#konten-notifikasi").html(msg);
        }
    });
}