<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Cetak Surat Tugas
    </h1>
    <?php echo $breadcrumb ?>
  </section>

  <!-- Main content -->
  <section class="invoice">

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url('beasiswa/do_cetak?id='.$this->input->get('id')) ?>" target="_blank" class="btn btn-primary">
            <i class="fa fa-print"></i> Cetak
          </a>
        </div>
      </div>

      <?php $this->load->view('page/private/template/surat_rekomendasi.php') ?>

  </section><!-- /.content -->
  <div class="clearfix"></div>
</div><!-- /.content-wrapper -->