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
      <div class="row">
        <div class="col-xs-12">
            <img class="img-responsive pad pull-right" src="<?php echo base_url('assets/img/logo/logotelu.png') ?>" style="height: 100px">
        </div><!-- /.col -->
      </div>

      <div class="row" style="margin-top: 70px;">
        <div class="col-xs-12 text-center">
            <h1 style="font-size: 30px; text-decoration: underline; margin-bottom: 0px;">SURAT TUGAS</h1>
            <h1 style="font-size: 15px; margin-top: 0px;">Nomor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
        </div><!-- /.col -->
      </div>

      <div class="row" style="margin-top: 80px; padding: 0 1cm 0 1cm;">
        <div class="col-xs-12 text-justify">
            <h1 style="font-size: 15px; margin: 0 0 20px 0">
              Yang bertanda tangan di bawah ini, Dekan Fakultas Rekayasa Industri Universitas Telkom menugaskan kepada mahasiswa dan dosen yang namanya tercantum pada lampiran ini untuk mengikuti Lomba "<?php echo $proposal->nama_event ?>" yang diselenggarakan oleh <?php echo $proposal->pengajuan->event->penyelenggara ?> pada tanggal <?php echo $proposal->tanggal_kompetisi_display ?>.
            </h1>
            <h1 style="font-size: 15px;">
              Demikian penugasan ini disampaikan untuk dipergunakan sebagaimana mestinya.  
            </h1>
        </div><!-- /.col -->
      </div>

      <div class="row" style="margin-top: 80px; padding: 0 1cm 0 1cm;">
        <div class="col-xs-12 text-justify">
            <h1 style="font-size: 15px; margin: 0 0 20px 0">
              Bandung, <?php echo $tanggal_display ?>
            </h1>
            <h1 style="font-size: 15px;">
              Dekan Fakultas Rekayasa Industri
            </h1>
            <h1 style="font-size: 15px; text-decoration: underline; margin: 140px 0 0 0;">
              Dr. Dida Diah Damayanti
            </h1>
            <h1 style="font-size: 15px; margin-top: 0px;">
              94700123-1
            </h1>
            <h1 style="font-size: 15px; margin: 50px 0 0 0">
              Tembusan
            </h1>
            <h1 style="font-size: 15px; margin: 0 0 0 1em">
            1. Direktur Kemahasiswaan
          </h1>
          <h1 style="font-size: 15px; margin: 0 0 0 1em">
            2. Ketua Program Studi <?php echo $proposal->detail_pengaju->roled_data->prodi ?>
          </h1>
      </div><!-- /.col -->
    </div>
  </section><!-- /.content -->
  <div class="clearfix"></div>
</div><!-- /.content-wrapper -->

<div class="appendix">
  <!-- Main content -->
    <section class="invoice">

      <div class="row" style="margin-top: 1cm; padding: 0 1cm 0 1cm;">
        <div class="col-xs-12 text-center">
            <h1 style="font-size: 20px; margin-bottom: 0px;">Daftar peserta lomba <?php echo $proposal->nama_event ?></h1>
        </div><!-- /.col -->
      </div>

      <!-- title row -->
      <div class="row" style="padding: 0 1cm 0 1cm;">
        <div class="col-xs-12 text-center">
          <table border="1" width="100%">
            <tbody>
              <tr>
                <td>Nama Tim</td>
                <td>Nama</td>
                <td>NIM</td>
                <td>Pembimbing</td>
                <td>Lomba</td>
                <td>Kategori Lomba</td>
              </tr>
              <tr>
                <td rowspan="<?php echo count($proposal->tim) ?>"><?php echo $proposal->nama_tim ?></td>
                <td><?php echo $proposal->tim[0]->mahasiswa->nama ?></td>
                <td><?php echo $proposal->tim[0]->nim_anggota ?></td>
                <td rowspan="<?php echo count($proposal->tim) ?>"><?php echo $proposal->lengkap->pembimbing ?></td>
                <td rowspan="<?php echo count($proposal->tim) ?>"><?php echo $proposal->nama_event ?></td>
                <td rowspan="<?php echo count($proposal->tim) ?>"><?php echo $proposal->kategori_kompetisi ?></td>
                <?php for ($i=1; $i < count($proposal->tim); $i++) { ?>
                  <tr>
                    <td><?php echo $proposal->tim[$i]->mahasiswa->nama ?></td>
                    <td><?php echo $proposal->tim[$i]->nim_anggota ?></td>
                  </tr>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row" style="margin-top: 80px; padding: 0 1cm 0 1cm;">
        <div class="col-xs-12 text-justify">
            <h1 style="font-size: 15px; margin: 0 0 20px 0">
              Bandung, <?php echo $tanggal_display ?>
            </h1>
            <h1 style="font-size: 15px;">
              Dekan Fakultas Rekayasa Industri
            </h1>
            <h1 style="font-size: 15px; text-decoration: underline; margin: 140px 0 0 0;">
              Dr. Dida Diah Damayanti
            </h1>
            <h1 style="font-size: 15px; margin-top: 0px;">
              94700123-1
            </h1>
      </div><!-- /.col -->
    </div>

    </section>
</div>