<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/select2/select2.min.css">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Data Himpunan
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Akun</a></li>
            <li class="active">Edit Profil</li>
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
                        <div class="form-group">
                            <label>Nama Himpunan</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Himpunan" value="<?= $himpunan->nama ?>" name="nama" disabled>

                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <input type="text" class="form-control" id="prodi" placeholder="Program Studi" value="<?= $himpunan->prodi ?>" name="prodi" disabled>
                        </div>
                        <div class="form-group">
                            <label>Penanggung Jawab</label>
                            <select class="form-control select2" style="width: 100%;" name="penanggungjawab">
                              
                            </select>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>               
                </div><!-- /.box -->
            </div>
            </form>
        </div>
    </section>
</div>

<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

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

<script>
      $(function () {
        $(".select2").select2({
            minimumInputLength: 2,
            tags: true,
            tokenSeparators: [',', ' '],
            ajax: {
                url: '<?php echo base_url('himpunan/asd') ?>',
                dataType: 'json',
                type: 'GET',
                data: function (term) {
                    return {
                        term: term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (mahasiswas) {
                            return {
                                id: mahasiswas.nim,
                                text:'blabalbal'
                            }
                        })
                    };
                },
                cache: true
            },

        });
      });
</script>