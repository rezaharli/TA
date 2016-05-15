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

            <?php if($role == 'mahasiswa' || $jenis == 'staff_admin') { ?>
              <li><a href="<?php echo base_url('event') ?>"><i class="fa fa-circle-o"></i>Lihat event</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i>Ajukan event</a></li>
            <?php } ?>
            
            <?php if ($jenis == 'kaur' || $jenis == 'staff_kemahasiswaan') { ?>
              <li><a href="<?php echo base_url('event') ?>"><i class="fa fa-circle-o"></i>Daftar pengajuan event</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i>Tambah Event</a></li>
            <?php } ?>
          
          </ul>
        </li>

        <?php if($role == 'mahasiswa') { ?>
          <li><a href="<?php echo base_url('sertifikat') ?>"><i class="fa fa-files-o"></i> <span>Beasiswa</span></a></li>
          <li><a href="<?php echo base_url('laporan') ?>"><i class="fa fa-map-o"></i> <span>Lihat Laporan</span></a></li>
        <?php } ?>

        <?php if ($jenis == 'kaur' || $jenis == 'himpunan') { ?>
          <li class="header">Menu Khusus</li>
          <?php if ($jenis == 'kaur') { ?>
            <li><a href="<?php echo base_url(); ?>staff/list_staff"><i class="fa fa-book"></i> <span>Daftar Staff</span></a></li>
          <?php } elseif ($jenis == 'himpunan') { ?>
            <li>
              <a href="#">
                <i class="fa fa-book"></i> <span>Menu Himpunan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i>Akun<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('himpunan') ?>"><i class="fa fa-circle-o"></i>Edit profil</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> <span>Proposal</span><i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('proposal_himpunan') ?>"><i class="fa fa-circle-o"></i>Upload Proposal</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          <?php } ?>
        <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
</aside>