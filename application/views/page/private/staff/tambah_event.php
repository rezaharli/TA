<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/datepicker/datepicker3.css'); ?>">

<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah event
    </h1>
    <?php echo $breadcrumb ?>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-body">

            <form class="form-horizontal" method="post" action="<?php echo base_url() ?>event/do_tambah" enctype="multipart/form-data">

              <div class="form-group">
                <label class="col-sm-3 control-label">Nama Kompetisi</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama" placeholder="Nama Kompetisi" required title="Harus Diisi" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Deskripsi</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="penutup" placeholder="Deskripsi" name="keterangan" required placeholder="Jenis/Tema Kompetisi"></textarea> 
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Tingkat Kompetisi</label>
                <div class="col-sm-9">
                  <select class="form-control" name="tingkat_kompetisi" id="tingkat" required>
                    <option disabled selected>Pilih</option>
                    <option value="regional">Regional</option>
                    <option value="nasional">Nasional</option>
                    <option value="internasional">Internasional</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Penyelenggara</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="penyelenggara" required placeholder="Penyelenggara" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Mulai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="tanggal_mulai" value="" id="input-tanggal-mulai" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="tanggal_selesai" value="" id="input-tanggal-selesai">
                    *tidak wajib diisi
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Bukti Event</label>
                <div class="col-sm-9">
                  <input type="file" id="bukti_event" name="bukti_event" required="true">
                  *Poster/Screenshot web lomba maksimal 2 mb (.jpg/.png)
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </div>

            </form>

          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <div class="col-md-4">
        <?php $this->load->view('page/private/template/calendar') ?>
      </div><!-- /.col -->
    </div>
  </section>
</div>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/adminlte/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script>

  $(document).ready(function() {

    $('#input-tanggal-mulai').datepicker({
          format: 'yyyy-mm-dd'
      });

      $('#input-tanggal-selesai').datepicker({
        startDate: new Date($('#input-tanggal-mulai').val()),
          format: 'yyyy-mm-dd'
      });
    
  });

    $('#input-tanggal-mulai').change(function () {

      if($('#input-tanggal-mulai').val() > $('#input-tanggal-selesai').val()){
        $('#input-tanggal-selesai').val($('#input-tanggal-mulai').val());
      }

      $("#input-tanggal-selesai").datepicker("remove");
      $('#input-tanggal-selesai').datepicker({
        startDate: new Date($('#input-tanggal-mulai').val()),
          format: 'yyyy-mm-dd'
      });
    });

</script>