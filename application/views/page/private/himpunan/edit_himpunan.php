<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css" media="screen" title="no title" charset="utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $(".switch").bootstrapSwitch();
    $('.switch').on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            // request access to google API
            window.location.replace("<?php echo site_url(); ?>himpunan/get_google_auth");
        }else{
            // revoke access from google API
            window.location.replace("<?php echo site_url(); ?>himpunan/revoke_google_access");
        }
    });
});
</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-info">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">Data Himpunan</h3>
                </div>

                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url(); ?>himpunan/do_update" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="namahimpunan" class="col-sm-2 control-label">Nama Himpunan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" placeholder="Nama Himpunan" value="<?= $himpunan->nama ?>" name="nama">
                            </div>
                            <!-- <button type="submit" name="submit" class="btn btn-info pull-right">Update</button> -->
                        </div>
                        <div class="form-group">
                            <label for="prodi" class="col-sm-2 control-label">Program Studi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="prodi" placeholder="Program Studi" value="<?= $himpunan->prodi ?>" name="prodi">
                            </div>
                            <!-- <button type="submit" name="submit" class="btn btn-info pull-right">Update</button> -->
                        </div>
                        <div class="form-group">
                            <label for="nim" class="col-sm-2 control-label">Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control" id="id_penanggungjawab" placeholder="NIM" value="<?= $himpunan->id_penanggungjawab ?>" name="id_penanggungjawab">
                            </div>
                            <!-- <button type="submit" name="submit" class="btn btn-info pull-right">Update</button> -->
                        </div>
                        <!-- <div class="form-group">
                            <label for="google_drive" class="col-sm-2 control-label">Akun Google Drive</label>
                            <div class="col-sm-9">
                                <input type="checkbox" class="switch" id="google_drive"

                                <?php
                                    // if($user->google_is_connected == 1){
                                    //     echo "checked";
                                    // }
                                ?>

                                >
                            </div> -->
                        </div>
                    </div>

                    <!-- /.box-footer -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-info pull-right">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php
if($this->session->flashdata('status')){
    echo '<script type="text/javascript">';
    if ($this->session->flashdata('status')) {
        echo 'alert("Update data berhasil")';
    } else {
        echo 'alert("Update data gagal")';
    }
    echo '</script>';
}
?>
