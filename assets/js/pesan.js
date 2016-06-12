$(document).ready(function(){
    cekpesan();
    $("#tombol-pesan").click(function(){
        tampilkanpesan();
    });
});

function cekpesan(){
    $.ajax({
        url: window.location.origin + "/hmmmm/pesan/hitung",
        cache: false,
        success: function(msg){
            $("#jumlah-pesan").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}

function tampilkanpesan(){
    $.ajax({
        url: window.location.origin + "/hmmmm/pesan/get",
        cache: false,
        success: function(msg){
            // $("#loading").hide();
            $("#konten-pesan").html(msg);
        }
    });
}