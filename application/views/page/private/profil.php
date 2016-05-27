<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      User Profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="#">User</a></li>
      <li class="active"><?php echo $username ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() ?>assets/img/foto-profil/<?php echo $foto_profil ?>" alt="User profile picture">
            <h3 class="profile-username text-center"><?php echo $nama ?></h3>
            <p class="text-muted text-center">
              <?php 
              if ($jenis == 'kaur') { 
                echo 'Kepala Urusan Kemahasiswaan';
              } elseif ($jenis == 'staff_kemahasiswaan') {
                echo 'Staff Kemahasiswaan';
              } elseif ($jenis == 'staff_admin') {
                echo 'Staff Admin';
              } else {
                echo 'Mahasiswa';
              } 
              ?>
            </p>

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <?php if ($role == 'staff') { ?>
                  <b>NIP</b> <a class="pull-right"><?php echo $nip ?></a>
                <?php } else if ($role == 'mahasiswa'){ ?> 
                  <b>NIM</b> <a class="pull-right"><?php echo $nim ?></a>
                <?php } ?>
                
              </li>
              <li class="list-group-item">
                <b>No. Telepon</b> <a class="pull-right"><?php echo $telp ?></a>
              </li>
            </ul>
          </div><!-- /.box-body -->
        </div><!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">About Me</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <strong><i class="fa fa-envelope margin-r-5"></i>  Email</strong>
            <p class="text-muted">
              <?php 
              if(strlen($email) > 32) { 
                echo substr_replace($email, ' ', 32, 0);
              } else { 
                echo $email; 
              } 
              ?>
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
            <p class="text-muted"><?php echo $alamat ?></p>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
            <?php if ($this->session->userdata('id') == $id_user) { ?>
              <li><a href="#ubah-username-password" data-toggle="tab">Kelola Akun</a></li>
              <li><a href="#ubah-data-diri" data-toggle="tab">Ubah Data Diri</a></li>
            <?php } ?>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="timeline">
              <!-- The timeline -->
              <ul class="timeline timeline-inverse">
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-red">
                    10 Feb. 2014
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                    <div class="timeline-body">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                      weebly ning heekya handango imeem plugg dopplr jibjab, movity
                      jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                      quora plaxo ideeli hulu weebly balihoo...
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-aqua"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-comments bg-yellow"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                    <div class="timeline-body">
                      Take me to your leader!
                      Switzerland is small and neutral!
                      We are more like Germany, ambitious and misunderstood!
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                    3 Jan. 2014
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-camera bg-purple"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                    <div class="timeline-body">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.tab-pane -->

            <?php if ($this->session->userdata('id') == $id_user) { ?>
              <div class="tab-pane" id="ubah-username-password">

                <form class="form-horizontal" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>user/do_foto_profil_edit">
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Foto Profil</label>
                    <div class="col-sm-5">
                      <input type="file" name="foto-profil" style="margin-top: 7px">
                    </div>
                    <div class="col-sm-5">
                      <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                  </div><!-- /.box-body -->
                </form>

                <hr />

                <form class="form-horizontal" autocomplete="off" method="post" action="<?php echo base_url() ?>user/do_username_edit" id="form-username">
                  <div id="form-group-username" class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="input-username" name="username" value="<?php echo $username ?>">
                    </div>
                    <div class="col-sm-2">
                      <h5 id="status-username" class="text-center"></h5>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" id="button-username-submit" disabled>Ganti & Log Out</button>
                    </div>
                  </div>
                </form>

                <hr />

                <form class="form-horizontal" autocomplete="off" method="post" action="<?php echo base_url() ?>user/do_password_edit" id="form-password">
                <div id="form-group-password" class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" placeholder="Password" id="input-password" name="password">
                    </div>
                  </div>
                  <div id="form-group-password-confirm" class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Konfirmasi Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" placeholder="Password" id="input-password-confirm">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" id="button-password-submit" disabled>Ganti & Log Out</button>
                    </div>
                  </div>
                </form>
              </div><!-- /.tab-pane -->

              <!-- cek username -->
              <script src="<?php echo base_url() ?>assets/js/cek_username.js"></script>
              <!-- cek password -->
              <script src="<?php echo base_url() ?>assets/js/cek_password.js"></script>

              <div class="tab-pane" id="ubah-data-diri">
                <form class="form-horizontal" method="post" action="<?php echo base_url() ?>user/do_datadiri_edit">
                  <div class="form-group">
                    <?php if ($role == 'staff') { ?>
                      <label for="inputName" class="col-sm-2 control-label">NIP</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $nip; ?>" disabled>
                      </div>
                    <?php } else if ($role == 'mahasiswa') { ?> 
                      <label for="inputName" class="col-sm-2 control-label">NIM</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $nim; ?>" disabled>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?php echo $nama ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" value="<?php echo $email ?>" placeholder="E-mail" name="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" placeholder="Alamat" name="alamat" style="resize: none;"><?php echo $alamat ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">No. Telp</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?php echo $telp ?>" placeholder="No. Telepon" name="telp">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div><!-- /.tab-pane -->
            <?php } ?>
          </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->