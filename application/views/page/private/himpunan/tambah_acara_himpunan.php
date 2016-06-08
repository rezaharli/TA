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
            <li><a href="#">Pengajuan</a></li>
            <li class="active">Tambah Acara</li>
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
                                <input type="text" class="form-control" id="nama_acara" placeholder="Nama Acara" name="nama_acara">
                            </div>
                            <div class="form-group">
                                <label>Tempat Acara</label>
                                <input type="text" class="form-control" id="tempat_acara" placeholder="Tempat Acara" name="tempat_acara">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Acara</label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Acara" name="tanggal_acara">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Acara</label>
                                <textarea class="form-control" id="deskripsi_acara" placeholder="Deskripsi Acara" name="deskripsi_acara"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload Poster Acara (jpg/png)</label>
                                <input type="file" class="form-control" id="file" name="poster_acara">
                            </div><!-- /.box-body -->
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
                        </div><!-- /.box-header -->
                        
                        <!-- <a href=""><button id="add_row" type="button" class="btn btn-default"><span class="fa fa-plus"></span>&nbsp;Tambah Baris</button></a>
                        &nbsp;
                        <a href="#"><button id="delete_row" type="button" class="btn btn-default"><span class="fa fa-minus"></span>&nbsp;Hapus Baris</button></a>

                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id='addr0'>
                                        <td>1</td>
                                        <td><input type="text" name='nim'  placeholder='NIM' class="form-control"/></td>
                                        <td><input type="text" name='nama' placeholder='Nama Panitia' class="form-control"/></td>
                                        <td></td>
                                    </tr>
                                    <tr id='addr1'></tr>
                                </tbody>
                            </table>
                        </div><!--box-body 
                        <div class="box-footer">
                            <a href="<?php echo base_url("proposal_himpunan/do_tambah_panitia?id_acara=".$id_pengajuan); ?>">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </a>
                        </div>
                    </div> -->

                    
                    <div class="box-body">
                        <div class="col-md-12 column">
                            <table class="table table-bordered table-hover" id="tab_logic">
                                <thead>
                                    <tr >
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th class="text-center">
                                            Name
                                        </th>
                                        <th class="text-center">
                                            Mail
                                        </th>
                                        <th class="text-center">
                                            Mobile
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id='addr0'>
                                        <td>
                                        1
                                        </td>
                                        <td>
                                        <input type="text" name='name0'  placeholder='Name' class="form-control"/>
                                        </td>
                                        <td>
                                        <input type="text" name='mail0' placeholder='Mail' class="form-control"/>
                                        </td>
                                        <td>
                                        <input type="text" name='mobile0' placeholder='Mobile' class="form-control"/>
                                        </td>
                                    </tr>
                                    <tr id='addr1'></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row' class="pull-right btn-default">Delete Row</a>
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

    var i=1;
    $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='mail"+i+"' type='text' placeholder='Mail'  class='form-control input-md'></td><td><input  name='mobile"+i+"' type='text' placeholder='Mobile'  class='form-control input-md'></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
    });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });

    <!-- alert sukses tidak -->
    <?php
    if($this->session->flashdata('status') !== null){
        echo '<script type="text/javascript">';
        if ($this->session->flashdata('status') == 1) {
            echo 'alert("Buat acara himpunan berhasil")';
        } else {
            echo 'alert("Buat acara himpunan gagal")';
        }
        echo '</script>';
    }
    ?>
</script>