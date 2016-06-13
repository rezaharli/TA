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
            Acara Himpunan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('proposal_himpunan/logbook_pengajuan'); ?>">Logbook Pengajuan</a></li>
            <li class="active">Tambah Acara dan Panitia</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url("proposal_himpunan/do_tambah_acara?id_pengajuan=".$id_pengajuan); ?>" enctype="multipart/form-data">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Acara</h3>
                        </div><!-- /.box-header -->

                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama Acara</label>
                                <input type="text" class="form-control" id="nama_acara" placeholder="Nama Acara" name="nama_acara" value="<?php echo (!empty($acara->nama_acara)) ? $acara->nama_acara : ""; ?>">
                            </div>
                            <div class="form-group">
                                <label>Tempat Acara</label>
                                <input type="text" class="form-control" id="tempat_acara" placeholder="Tempat Acara" name="tempat_acara"  value="<?php echo (!empty($acara->nama_acara)) ? $acara->tempat_acara : ""; ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Acara</label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Acara" name="tanggal_acara"  value="<?php echo (!empty($acara->nama_acara)) ? $acara->tanggal_acara : ""; ?>">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Acara</label>
                                <textarea class="form-control" id="deskripsi_acara" placeholder="Deskripsi Acara" name="deskripsi_acara"><?php echo (!empty($acara->nama_acara)) ? $acara->deskripsi_acara : ""; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload Poster Acara (jpg/png)</label>
                                <?php if (!empty($acara->poster_acara)): ?>
                                    <img id="poster_preview" class="img-responsive" src="<?php echo base_url()."assets/upload/acara/acara_".$acara->id."/".$acara->poster_acara; ?>" alt="" />
                                <?php endif; ?>
                                <input type="file" class="form-control" id="poster" name="poster_acara">
                            </div><!-- /.box-body -->
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit &nbsp;<i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- form start -->
            <!-- <form role="form" method="post" action="<?php echo base_url("proposal_himpunan/do_tambah_panitia?id_pengajuan=".$id_pengajuan); ?>" enctype="multipart/form-data"> -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Panitia</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12 column">
                            <form action="<?php echo base_url("proposal_himpunan/do_tambah_panitia"); ?>" method="POST">
                                <input type="hidden" name="id_acara" value="<?php echo (!empty($acara->id)) ? $acara->id : "";  ?>">
                                <input type="hidden" name="id_pengajuan" value="<?php echo (!empty($id_pengajuan)) ? $id_pengajuan : "";  ?>">

                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr >
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th class="text-center" width="30%">
                                                NIM
                                            </th>
                                            <th class="text-center">
                                                Nama
                                            </th>
                                            <th class="" width="10%">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-container">
                                    <?php if (!empty($all_panitia)): ?>
                                        <?php foreach ($all_panitia as $key => $panitia): ?>
                                            <input type="hidden" class="id_panitia" name="id_panitia[]" value="<?php echo $panitia->id; ?>">
                                            <tr class="row-cloned">
                                                <td class="no">
                                                    <?php echo (++$key); ?>
                                                </td>
                                                <td>
                                                    <input type="text" name='nim[]' value="<?php echo ($panitia->nim); ?>"  placeholder='NIM' class="form-control"/>
                                                </td>
                                                <td>
                                                    <input type="text" name='nama[]' value="<?php echo ($panitia->nama); ?>" placeholder='Nama' class="form-control"/>
                                                </td>
                                                <td>
                                                    <a href="#" title="Hapus" class="btn btn-danger btn-delete"><i class="fa fa-minus-circle"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                        <tr class="row-cloned">
                                            <td class="no">
                                                <?php echo (++$key); ?>
                                            </td>
                                            <td>
                                                <input type="text" name='nim[]'  placeholder='NIM' class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name='nama[]' placeholder='Nama' class="form-control"/>
                                            </td>
                                            <td>
                                                <a href="#" title="Hapus" class="btn btn-danger btn-delete"><i class="fa fa-minus-circle"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer">
                                <div class="pull-right">
                                    <a href="javascript:void(0)" class="btn btn-success" id="btn-add"><i class="fa fa-plus"></i>&nbsp; Tambah Panitia</a>
                                    <button type="submit" class="btn btn-primary">Submit &nbsp;<i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- </form> -->
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
        var $clonedRow = $('.row-cloned').last().clone(true, true);
        $clonedRow.find('input').val("");
        $clonedRow.appendTo('.row-container');
        $clonedRow.find('.no').html(++no);
    });

    $('.btn-delete').on('click', function(event) {
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
        if(!empty($this->session->userdata('notif_upload'))){
          if ($this->session->userdata('notif_upload')) {
              echo 'alert("Tambah acara berhasil")';
          } else {
              echo 'alert("Tambah acara gagal")';
          }
          $this->session->unset_userdata('notif_upload');
        }
    ?>

}); 
</script>