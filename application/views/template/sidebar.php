<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Event</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Ajukan event</a></li>
            <?php if ($roled_user_data->jenis == 'kaur' || $roled_user_data->jenis == 'staff_kemahasiswaan') { ?>
              <li><a href="#"><i class="fa fa-circle-o"></i> Daftar pengajuan event</a></li>
            <?php } ?>
          </ul>
        </li>

        <li class="header">MAIN NAVIGATION</li>
        <?php if ($roled_user_data->jenis == 'kaur') { ?>
          <li><a href="#"><i class="fa fa-book"></i> <span>Menu Kaur</span></a></li>
        <?php } elseif ($roled_user_data->jenis == 'himpunan') { ?>
          <li><a href="#"><i class="fa fa-book"></i> <span>Menu Himpunan</span></a></li>
        <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
</aside>