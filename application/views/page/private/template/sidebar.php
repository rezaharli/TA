<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
        <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-dashboard"></i> <span>Home</span></a>
        </li>

        <li class="treeview"><a href="#"><i class="fa fa-calendar"></i> <span>Event</span><i class="fa fa-angle-left pull-right"></i></a>

          <ul class="treeview-menu">

            <?php if($role == 'mahasiswa' || $jenis == 'staff_admin') { ?>
              
              <li><a href="#"><i class="fa fa-circle-o"></i>Lomba <i class="fa fa-angle-left pull-right"></i></a>
                
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('event/lomba/') ?>"><i class="fa fa-circle-o"></i>List Lomba</a>
                  </li>
                  <li><a href="<?php echo base_url('event/lomba/pengajuan') ?>"><i class="fa fa-circle-o"></i>List Pengajuan Anda</i></a>
                  </li>
                  <li><a href="<?php echo base_url('event/lomba/tambah') ?>"><i class="fa fa-circle-o"></i>Ajukan Event Lomba</a>
                  </li>
                </ul>

              </li>

              <li><a href="#"><i class="fa fa-circle-o"></i>Kegiatan Himpunan <i class="fa fa-angle-left pull-right"></i></a>
                
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('event/kegiatanhimpunan') ?>"><i class="fa fa-circle-o"></i>List Kegiatan</a>
                  </li>
                </ul>

              </li>

            <?php } ?>
            
            <?php if ($jenis == 'kaur' || $jenis == 'staff_kemahasiswaan') { ?>

              <li><a href="#"><i class="fa fa-circle-o"></i>Lomba <i class="fa fa-angle-left pull-right"></i></a>

                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('event/lomba/') ?>"><i class="fa fa-circle-o"></i>List Lomba</a>
                  </li>
                  <li><a href="<?php echo base_url('event/lomba/pengajuan') ?>"><i class="fa fa-circle-o"></i>List Pengajuan Event Lomba</i></a>
                  </li>
                  <li><a href="<?php echo base_url('event/lomba/tambah') ?>"><i class="fa fa-circle-o"></i>Tambah Event Lomba</a>
                  </li>
                </ul>

              </li>

              <li><a href="#"><i class="fa fa-circle-o"></i>Kegiatan Himpunan <i class="fa fa-angle-left pull-right"></i></a>
                
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('event/kegiatanhimpunan') ?>"><i class="fa fa-circle-o"></i>List Kegiatan</a>
                  </li>
                </ul>

              </li>

            <?php } ?>
          
          </ul>
        </li>

        <?php if ($jenis == 'kaur' || $jenis == 'staff_kemahasiswaan') { ?>
        <li class="treeview"><a href="#"><i class="fa fa-book"></i> <span>Proposal</span><i class="fa fa-angle-left pull-right"></i></a>
          
          <ul class="treeview-menu">

            <li><a href="<?php echo base_url('proposal_mahasiswa') ?>"><i class="fa fa-circle-o"></i>Mahasiswa</a>
            </li>

            <li><a href="<?php echo base_url('proposal_himpunan') ?>"><i class="fa fa-circle-o"></i>Himpunan</a>
            </li>
            
          </ul>
        </li>
        <?php } ?>

        <?php if($role != 'mahasiswa') { ?>
          <li><a href="#"><i class="fa fa-dashboard"></i> <span>Beasiswa</span> <i class="fa fa-angle-left pull-right"></i></a>

            <ul class="treeview-menu">

              <li><a href="<?php echo base_url('sertifikat') ?>"><i class="fa fa-flag-checkered"></i> <span>Kirim Email Rekomendasi</span></a>
              </li>

            </ul>

          </li>
        <?php } ?>

        <?php if ($jenis == 'kaur' || $jenis == 'staff_kemahasiswaan') { ?>
        <li class="treeview"><a href="<?php echo base_url('laporan/hitung') ?>"><i class="fa fa-book"></i> <span>Laporan</span></a>
          
        </li>
        <?php } ?>

        <?php if($role == 'mahasiswa') { ?>

          <li class="treeview"><a href="#"><i class="fa fa-clipboard"></i> <span>Pengajuan Lomba</span><i class="fa fa-angle-left pull-right"></i></a>

            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('proposal/upload_pengajuan') ?>"><i class="fa fa-file-o"></i>Upload Proposal</a>
              </li>
              <li><a href="<?php echo base_url('proposal/logbook_pengajuan_proposal_lomba') ?>"><i class="fa fa-table"></i>Logbook Pengajuan</a>
              </li>
            </ul>

          </li>
          
          <li><a href="<?php echo base_url('sertifikat') ?>"><i class="fa fa-flag-checkered"></i> <span>Bukti Lomba</span></a>
          </li>

        <?php } ?>

        <?php if ($jenis == 'kaur' || $jenis == 'himpunan' || $jenis == 'staff_admin') { ?>
          <li class="header">Menu Khusus</li>
          
          <?php if ($jenis == 'kaur') { ?>
            <li><a href="#"><i class="fa fa-users"></i> <span> Data Staff</span></a>
              
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('lists/staff') ?>"><i class="fa fa-circle-o"></i>List Staff</a>
                </li>
                <li><a href="<?php echo base_url('staff/add') ?>"><i class="fa fa-circle-o"></i>Tambah Staff</a>
                </li>
              </ul>

            </li>

            <li><a href="#"><i class="fa fa-users"></i> <span>Data Mahasiswa</span></a>
              
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('lists/mahasiswa') ?>"><i class="fa fa-circle-o"></i>List Mahasiswa</a>
                </li>
                <li><a href="<?php echo base_url('mahasiswa/add') ?>"><i class="fa fa-circle-o"></i>Tambah Mahasiswa</a>
                </li>
              </ul>

            </li>

            <li><a href="#"><i class="fa fa-users"></i> <span>Data Himpunan</span></a>
              
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('lists/himpunan') ?>"><i class="fa fa-circle-o"></i>List Himpunan</a>
                </li>
                <li><a href="<?php echo base_url('himpunan/add') ?>"><i class="fa fa-circle-o"></i>Tambah Himpunan</a>
                </li>
              </ul>

            </li>

          <?php } elseif ($jenis == 'himpunan') { ?>

            <li><a href="#"><i class="fa fa-user"></i>Akun Himpunan<i class="fa fa-angle-left pull-right"></i></a>
              
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('himpunan/update_himpunan') ?>"><i class="fa fa-edit"></i>Edit Profil Himpunan</a>
                </li>
              </ul>

            </li>

            <li><a href="#"><i class="fa fa-book"></i> <span>Pengajuan</span><i class="fa fa-angle-left pull-right"></i></a>
              
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('proposal_himpunan/upload_pengajuan') ?>"><i class="fa fa-file-o"></i>Unggah Proposal</a>
                </li>
                <li><a href="<?php echo base_url('proposal_himpunan/logbook_pengajuan') ?>"><i class="fa fa-calendar-check-o"></i>Daftar Pengajuan</a>
                </li>
                <li><a href="<?php echo base_url('proposal_himpunan/logbook_lpj') ?>"><i class="fa  fa-list-ol"></i>Daftar LPJ</a>
                </li>
              </ul>

            </li>

            <li><a href="#"><i class="fa  fa-tasks"></i> <span>Acara Himpunan</span><i class="fa fa-angle-left pull-right"></i></a>
                
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('kegiatan_himpunan/list_kegiatan') ?>"><i class="fa fa-calendar"></i>Lihat Acara</a>
                  </li>
                </ul>

            </li>

          <?php } else if ($jenis == 'staff_admin') { ?>

            <li><a href="<?php echo base_url('proposal/logbook_pengajuan_proposal_lomba') ?>"><i class="fa fa-print"></i> <span>Cetak Surat Tugas</span></a>
            </li>

          <?php } ?>
        <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<script>
  var a = $('a[href="<?php echo base_url(uri_string()) ?>"]');
  a.parent().addClass("active");
  var lewati = true;
  var parents = a.parents().map(function() {
    if (lewati == true) {
      if (this.tagName == "UL"){
        lewati = false;
      }
    } else {
      if (this.tagName == "LI"){
        $(this).addClass("active");
      }
    }
  });
</script>