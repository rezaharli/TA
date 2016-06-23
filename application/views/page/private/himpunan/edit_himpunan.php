<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Profil
            <small><?php echo $himpunan->nama ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit Profil Himpunan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url(); ?>himpunan/do_update">
            
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Himpunan</h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <?php if (!empty(validation_errors())): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                <ul>
                                    <?php echo validation_errors('<li>', '</li>'); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label>Nama Himpunan *</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Himpunan" value="<?= set_value('nama', $himpunan->nama) ?>" name="nama">

                        </div>
                        <div class="form-group">
                            <label>Program Studi *</label>
                            <input type="text" class="form-control" id="prodi" placeholder="Program Studi" value="<?= set_value('prodi', $himpunan->prodi) ?>" name="prodi">
                        </div>
                        <div class="form-group">
                            <label>Penanggung Jawab</label>
                            <input type="text" disabled class="form-control" id="id_penanggungjawab" placeholder="NIM" value= "<?= $himpunan->id_penanggungjawab ?> - <?= $user->nama ?>" name="id_penanggungjawab">
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>               
                </div><!-- /.box -->
            </div>
            </form>
        </div>
    </section>
</div>

<!-- alert sukses tidak -->
<?php
if($this->session->flashdata('status') !== null){
    echo '<script type="text/javascript">';
    if ($this->session->flashdata('status')) {
        echo 'alert("Update data berhasil")';
    } else {
        echo 'alert("Update data gagal")';
    }
    echo '</script>';
}
?>