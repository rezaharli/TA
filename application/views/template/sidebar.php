<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Event</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Ajukan event</a></li>
            <?php if ($jenis == 'kaur' || $jenis == 'staff_kemahasiswaan') { ?>
              <li><a href="#"><i class="fa fa-circle-o"></i> Daftar pengajuan event</a></li>
            <?php } ?>
          </ul>
        </li>

        <?php if($role == 'mahasiswa') { ?>
           <li><a href="<?php echo base_url('sertifikat/upload') ?>"><i class="fa fa-files-o"></i> <span>Upload Sertifikat</span></a></li>
           <li><a href="<?php echo base_url('laporan') ?>"><i class="fa fa-map-o"></i> <span>Lihat Laporan</span></a></li>
        <?php } ?>

        <?php if ($jenis == 'kaur' || $jenis == 'himpunan') { ?>
          <li class="header">Menu Khusus</li>
          <?php if ($jenis == 'kaur') { ?>
            <li><a href="#"><i class="fa fa-book"></i> <span>Menu Kaur</span></a></li>
          <?php } elseif ($jenis == 'himpunan') { ?>
            <li><a href="#"><i class="fa fa-book"></i> <span>Menu Himpunan</span></a></li>
          <?php } ?>
        <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
</aside>