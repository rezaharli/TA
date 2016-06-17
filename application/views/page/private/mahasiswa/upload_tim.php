<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datepicker/datepicker3.css" media="screen" title="no title" charset="utf-8">

<!-- JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/datepicker/locales/bootstrap-datepicker.id.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/select2/select2.min.js"></script>

<!-- SCRIPT -->
<script>
$(function() {
    $( "#datepicker" ).datepicker({
        language : 'id',
        format : 'yyyy-mm-dd'
    });
});
</script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sertifikat Lomba
      <small><?php echo $nama ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
      <li><a href="#">Sertifikat</a></li>
      <li><a href="#">Upload</a></li>
    </ol>
  </section>

  <!-- Main content -->
<section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Upload Nim Tim Anda</h3>
                        </div><!-- /.box-header -->
                        
                        <div class="box-body">
                            <form role="form" method="post" action="<?php echo base_url("proposal/upload_tim"); ?>" enctype="multipart/form-data">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr >
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th class="text-center" width="80%">
                                                NIM - Nama
                                            </th>
                                            <!-- <th class="text-center">
                                                Aksi
                                            </th> -->
                                            <th class="text-center" width="10%">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-container">
                                        <script>
                                        function select2_panitia(){
                                            return {
                                                minimumInputLength: 4,
                                                placeholder: 'NIM - Nama',
                                                allowClear: true,
                                                ajax: {
                                                    url: '<?php echo base_url('proposal/ambil_data') ?>',
                                                    dataType: 'json',
                                                    type: 'GET',
                                                    data: function (term) {
                                                        return {
                                                            q: term
                                                        };
                                                    },
                                                    processResults: function (data) {
                                                        return {
                                                            results: data.mahasiswa
                                                        };
                                                    },
                                                }
                                            }
                                        }
                                        </script>

                                        <?php $i = 1; ?>


                                        <tr class="row-cloned">
                                            <td class="no"><?php echo ($i); ?></td>
                                                <?php $i++ ?>

                                            <td>
                                                <select id="select2_<?php echo ($i); ?>" class="select2 form-control" name="nim[]" value=""></select>
                                            </td>
                                            <td>
                                                <a href="#" title="Hapus" class="btn btn-danger btn-delete"><i class="fa fa-minus-circle"></i></a>
                                            </td>
                                        </tr>

                                        <script>
                                            $("#select2_<?php echo ($i); ?>").select2(select2_panitia());
                                        </script>

                                    </tbody>
                                </table>
                                <div class="box-footer">
                                <div class="pull-right">
                                    <a href="javascript:void(0)" class="btn btn-success" id="btn-add"><i class="fa fa-plus"></i>&nbsp; Tambah</a>
                                    <button type="submit" class="btn btn-primary">Submit &nbsp;<i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            </form>
                        </div><!-- /.box-body -->                   
                    </div><!-- /.box -->
                </div>
        </div>
    </section>
</div>

<!-- page script -->
<script>
$(function () {
    $("#example1").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    $('#btn-add').click(function(event) {
        var no = parseInt($('.row-cloned:last > .no').html());
        var new_row = $('.row-container').append('<tr class="row-cloned"><td class="no">'+(++no)+'</td><td><select id="select2_'+no+'" class="select2 form-control" name="nim[]" value=""></select></td><td><a href="#" title="Hapus" class="btn btn-danger btn-delete"><i class="fa fa-minus-circle"></i></a></td></tr>');
        new_row.find('.select2').select2(select2_panitia());
    });

    $(document).on('click', '.btn-delete', function(event) {
        var $clonedRow = $('.row-cloned');
        if ($clonedRow.length > 1) {
            $(this).parent().parent().remove();
        }
        reloadNomor();
    });

    var reloadNomor = function(){
        var $clonedRow = $('.row-cloned');
        $.each($clonedRow, function(key, value){
            $(this).find('.no').html(++key);
        });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#poster_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#poster").change(function(){
        readURL(this);
    });

    // <!-- alert sukses tidak -->
    <?php
    if($this->session->flashdata('status') !== null){
        echo '<script type="text/javascript">';
        if ($this->session->flashdata('status')) {
            echo 'alert("Buat acara himpunan berhasil")';
        } else {
            echo 'alert("Buat acara himpunan gagal")';
        }
        echo '</script>';
    }
    ?>
}); 
</script>
    
