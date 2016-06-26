<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/select2/select2.min.css">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Himpunan
        </h1>
        <?php echo $breadcrumb ?>
    </section>

    <style type="text/css">
        input:invalid{
            outline: 1px solid red;
        }
        input:focus{
            color: green;
        }
        input[type=text]:valid {
            outline: 1px solid green;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url(); ?>himpunan/do_add">
            
            <div class="col-md-7">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Himpunan</h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">

                        <div class="form-group">
                            <label>Nama Himpunan</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Himpunan" name="nama" required>

                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <input type="text" class="form-control" id="prodi" placeholder="Program Studi" name="prodi" required>
                        </div>
                        <div class="form-group">
                            <label>Penanggung Jawab</label>
                            <select class="select2 form-control" name="penanggungjawab" required></select>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a data-toggle="modal" href="#" data-target="#submitModal" class="btn btn-primary">Submit</a>
                    </div>               
                </div><!-- /.box -->
            </div>

            <!-- modal column -->
            <!-- Submit Modal -->
                    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog center" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                            Apakah anda ingin <b>menambahkan</b> data ini?
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> &nbsp;
                          </div>
                        </div>
                      </div>
                    </div> <!-- /modal -->
            </form>
        </div>
    </section>
</div>

<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/select2/select2.min.js"></script>

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
            minimumInputLength: 4,
            placeholder: 'Masukkan NIM penanggungjawab',
            allowClear: true,
            ajax: {
                url: '<?php echo base_url('himpunan/select2') ?>',
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
                        // $.map(data.mahasiswa, function (mhs) {
                        //     return {
                        //         text: mhs.text,
                        //         id: mhs.id
                        //     }
                        // })
                    };
                },
                
            }
        });
      });
</script>