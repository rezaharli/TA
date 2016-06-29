<style type="text/css">
  table{
    width: 100%;
    border-color: black;
    text-align: center;
  }
</style>

<div class="chapter">
  <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row" style="margin-top: 80px; padding: 0 1cm 0 1cm;">
        <div class="col-xs-12 text-justify">
            <h1 style="font-size: 15px; margin: 0 0 20px 0">
              Perihal : Permohonan Beasiswa
            </h1>
            <h1 style="font-size: 15px;">
              	Kepada Yth.<br />
				Direktur Kemahasiswaan dan Alumni<br />
				Bp. Andijoko Tjahjono<br />
				Di tempat.<br />
            </h1>
        </div><!-- /.col -->
      </div>

      <div class="row" style="margin-top: 80px; padding: 0 1cm 0 1cm;">
        <div class="col-xs-12 text-justify">
        	<h1 style="font-size: 15px; margin: 0 0 20px 0">
              Dengan hormat,
            </h1>
            <h1 style="font-size: 15px; margin: 0 0 20px 0">
              	Sehubungan dengan pengumuman penerimaan Beasiswa, saya yang bertanda tangan di bawah ini:<br />
				Nama			: <?php echo $sertifikat->pengupload->nama ?><br />
				NIM/NPM			: <?php echo $sertifikat->pengupload->roled_data->nim ?><br />
				Fakultas		: Rekayasa Industri<br />
				Program Studi	: <?php echo $sertifikat->pengupload->roled_data->prodi ?><br />
				Semester		:<br />
            </h1>
            <h1 style="font-size: 15px; margin: 0 0 20px 0">
              Dengan ini mengajukan surat permohonan Beasiswa untuk membantu meringankan beban orang tua dan memotivasi prestasi belajar saya. Adapun syarat-syarat yang dibutuhkan terlampir, semoga bisa menjadi pertimbangan bagi Bapak dalam memberikan Beasiswa.
            </h1>
            <h1 style="font-size: 15px;">
              Atas perhatian Bapak saya ucapkan terima kasih.
            </h1>
        </div><!-- /.col -->
      </div>

      <div class="row" style="margin-top: 80px; padding: 0 1cm 0 1cm;">
        <div class="col-xs-12 text-right">
            <h1 style="font-size: 15px; margin: 0 0 20px 0">
              Bandung, <?php echo $tanggal_display ?>
            </h1>
            <h1 style="font-size: 15px;">
              Pemohon
            </h1>
            <h1 style="font-size: 15px; text-decoration: underline; margin: 140px 0 0 0;">
              <?php echo $sertifikat->pengupload->nama ?>
            </h1>
      </div><!-- /.col -->
    </div>
  </section><!-- /.content -->
  <div class="clearfix"></div>
</div><!-- /.content-wrapper -->